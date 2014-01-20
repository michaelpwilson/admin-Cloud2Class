<?php
  // load the login class
  require_once("classes/Login.php");
  $login = new Login();

  // ... ask if we are logged in here:
  if ($login->isUserLoggedIn() == true) {
  // the user is logged in. you can do whatever you want here.
  // for demonstration purposes, we simply show the "you are logged in" view. 
  // checking for minimum PHP version
  if (version_compare(PHP_VERSION, '5.3.7', '<')) {
  exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
  } else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
  // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
  // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
  require_once("libraries/password_compatibility_library.php");
  }
    // include the configs / constants for the database connection
    require_once("config/db.php");

    // load the registration class
    require_once("classes/Registration.php");

    // create the registration object. when this object is created, it will do all registration stuff automaticly
    // so this single line handles the entire registration process.
    $registration = new Registration();

    // showing the register view (with the registration form, and messages/errors)
    include("views/register.php");
    } else {
    header("Location:index.php");
    }

