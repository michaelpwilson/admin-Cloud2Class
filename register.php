<?php
  // load the login class
  require_once("classes/Login.php");
  $login = new Login();

  // ... ask if we are logged in here:
  if ($login->isUserLoggedIn() == true) {
  // We are logged in.

  // checking for minimum PHP version
  if (version_compare(PHP_VERSION, '5.3.7', '<')) {
  exit("Sorry, PHP version smaller than 5.3.7 !");
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
    $registration = new Registration();

    // showing the register view (with the registration form, and messages/errors)
    include("views/register.php");
    } else {
    // off you go, back to where you came from!
    header("Location:index.php");
    }

