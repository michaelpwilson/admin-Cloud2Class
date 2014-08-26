<?php

 # PAYMENT RATE
 $rate=120;
 
 # STEP 1: read POST data
 
 # Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
 # Instead, read raw POST data from the input stream. 
 $raw_post_data = file_get_contents('php://input');
 $raw_post_array = explode('&', $raw_post_data);
 $myPost = array();
    
  foreach ($raw_post_array as $keyval) {
    $keyval = explode ('=', $keyval);
    if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
  }
  
  # read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
  $req = 'cmd=_notify-validate';
  
  if(function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
  }
  
  foreach ($myPost as $key => $value) {        
  
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
  
        $value = urlencode(stripslashes($value)); 
  
   } else {
  
        $value = urlencode($value);
  
   }
  
   $req .= "&$key=$value";
    
  }
 
 
  # Step 2: POST IPN data back to PayPal to validate
 
  $ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
  curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
  curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
 
  # In wamp-like environments that do not come bundled with root authority certificates,
  # please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set 
  # the directory path of the certificate as shown below:
  # curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');

  if( !($res = curl_exec($ch)) ) {
   
    # error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
    
  }
  
  curl_close($ch)


  if (strcmp ($res, "VERIFIED") == 0) {
   
    # The IPN is verified, process it:
    # check whether the payment_status is Completed
    # check that txn_id has not been previously processed
    # check that receiver_email is your Primary PayPal email
    # check that payment_amount/payment_currency are correct
    # process the notification
 
    # assign posted variables to local variables
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
 
    # IPN message values depend upon the type of notification sent.
    # To loop through the &_POST array and print the NV pairs to the screen:
    foreach($_POST as $key => $value) {
 
      echo $key." = ". $value."<br>";
 
    }

    # For valid entries, add to the transaction table

    # Connect to database
    $link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");

    # Retreive the org id based on the email address
    $org = mysqli_query($link, "SELECT org_id from user where email='{$payer_email}'");
    $org_id = mysqli_fetch_row($org);

    if (! isset($org_id) {
     
        # If the email address is not valid, raise a CRITICAL error and send a mail
        echo "CRITICAL: Failed to verify email on successful payment!! Payer $payer_email";
        exit;
        
    }

    # If it is valid, add the amount*$rate to the orgs sub_allowance
    mysqli_query($link,"UPDATE organization SET sub_allowance=sub_allowance + ($payment_amount * $rate) WHERE org_id=$org_id");
    echo "Payment Made: $org_id, $payment_amount at rate $rate";

  } else if (strcmp ($res, "INVALID") == 0) {
   
    # IPN invalid, log for manual investigation
    echo "The response from IPN was: <b>" .$res ."</b>";

  }
  
