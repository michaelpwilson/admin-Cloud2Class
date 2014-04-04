<?php
  // checking for minimum PHP version
  if (version_compare(PHP_VERSION, '5.3.7', '<')) {
   exit("Sorry, you need PHP 5.3.7 !");
  } else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
   // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
   require_once("libraries/password_compatibility_library.php");
  }
  // include the configs / constants for the database connection
  require_once("config/db.php");
  // load the login class
  require_once("classes/Login.php");
  // create a login object. when this object is created, it will do all login/logout stuff automatically
  $login = new Login();

  // ... I am logged in?
  if ($login->isUserLoggedIn() == true) {
  // Yes, I am logged in.
  require("views/controller.php");
  // The main view has been launched.
  } else {
  // I'm not logged in. So I'll go to the sign in page...
  require("views/not_logged_in.php");
  }

