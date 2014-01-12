<!-- errors & messages --->
<?php

// show negative messages
if ($registration->errors) {
    foreach ($registration->errors as $error) {
        echo $error;    
    }
}

// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
        echo $message;
    }
}

?>
<!-- errors & messages --->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="docs-assets/ico/favicon.png">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="views/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
<!-- register form -->
<form class="form-register" method="post" action="register.php" name="registerform">   
<h2 class="form-signin-heading">Registration</h2>
    <input id="login_input_username" class="form-control" placeholder="username" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
    <input id="login_input_forename" class="form-control" placeholder="forename" type="text" name="user_forename" required />
    <input id="login_input_surname" class="form-control" placeholder="surname" type="text" name="user_surname" />
    <input id="login_input_password_new" class="form-control" placeholder="password" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />  
    <input id="login_input_password_repeat" class="form-control" placeholder="repeat password" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />        
    <a href="index.php">Go back to admin dashboard.</a>
    <button type="submit" style="margin-top:10px;" class="btn btn-lg btn-primary btn-block" name="register">Register</button>
    
</form>
