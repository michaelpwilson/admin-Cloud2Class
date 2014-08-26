<?php

 # Connect to mysql database
 $link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");
 # Get 'pool_ref'
 $pool_ref = mysqli_real_escape_string($link, $_POST['pool_ref']);
 # Get the 'lesson_id'
 $lesson_id = intval($_POST['lesson_id']);

 # If the AJAX POST has an action of 'changing'
 if($_POST['action'] == "changing"){
 	
  # Require password compatibility library
  require_once("libraries/password_compatibility_library.php");
  # Get the User
  $user = mysqli_real_escape_string($link, $_POST['user']);
  # Get the password the user used in the Change Password modal
  $pass = $_POST['first_pass'];
  # Use the password_hash function on to generate a hashed version of the password
  $password = password_hash($pass, PASSWORD_DEFAULT);
  # Update the user by the user with the new password
  $qq = mysqli_query($link, "update user set user_password = '{$password}' where user_login = '{$user}'");
  
 }

 # If the AJAX POST has an action of 'end'
 if($_POST['action'] == "end"){
 	
  # Update the instance by the $lesson_id, set time to live to NOW()
  mysqli_query($link,"UPDATE instances SET ttl = NOW() WHERE lesson_id={$lesson_id}");
  # Update the lesson by the $lesson_id
  mysqli_query($link,"UPDATE lesson SET duration=timestampdiff(MINUTE,lesson_start,now()) WHERE lesson_id={$lesson_id}");

 }
 
 # If the AJAX POST has an action of 'give'
 if($_POST['action'] == "give"){

  # update lesson by the $lesson_id, add 30 to the lesson's duration
  $query = mysqli_query($link,"UPDATE lesson SET duration = duration+30 WHERE lesson_id = {$lesson_id}");
  # update instance by the $lesson_id, add 30 minutes to the time to live
  $query = mysqli_query($link,"UPDATE instances SET ttl = (ttl + interval 30 minute) WHERE lesson_id = {$lesson_id}");

 }
 # If the AJAX POST has an action of 'give'
 if($_POST['action'] == "gfive"){
 
     # Get the lesson_type
     $lesson_type = mysqli_real_escape_string($link, $_POST['lesson_type']);
     # Get the time to live
     $ttl = mysqli_real_escape_string($link, $_POST['ttl']);
     # insert statement to be repeat
     $give = "insert into instances (instance_name, instance_state, instance_type, lesson_id, ttl, pool_ref) values('Unassigned', 'Requested', '" . $lesson_type  . "', " . $lesson_id  . ", '" . $ttl . "', '" . $pool_ref . "')";
     # loop depending on the choosen amount of instances
     for($i=0;$i<5;$i++) {
     	
        if (!mysqli_query($link,$give)) {
         die('Error: ' . mysqli_error($link));
        }
        
     }
     
  }
  
?>
