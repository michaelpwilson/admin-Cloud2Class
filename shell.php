<?php
// load the login class
require_once("classes/Login.php");
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == false) {
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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Bright Process Ltd">

    <title>Cloud2Class</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="dist/css/simple-sidebar2.css" rel="stylesheet">
    <link href="dist/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  </head>

  <body style="overflow-y:hidden; overflow-x:hidden;">
<style>
iframe{border:0;}
</style>  
    <div id="wrapper">
      
      <!-- Sidebar -->
      <div id="sidebar-wrapper" style="overflow-x:hidden;">
        <ul class="sidebar-nav">
<div class="sidebar-group" style="padding:0px 15px 15px 15px; width:100%;">
	<h4 style="padding-bottom:15px; border-bottom:1px solid white; color:white;">Options:</h4>
          <li><a href="#">Dashboard</a></li>
          <li><a href="#">Shortcuts</a></li>
          <li><a href="#">Overview</a></li>
          <li><a href="#">Events</a></li>
          <li><a href="#">About</a></li>
</div>       
<div class="sidebar-group" style="padding:0px 15px 15px 15px">
        <h4 style="padding-bottom:15px; border-bottom:1px solid white; color:white; width:100%;">Details:</h4>
          <li><a href="#">Dashboard</a></li>  
          <li><a href="#">Shortcuts</a></li>
          <li><a href="#">Overview</a></li> 
          <li><a href="#">Events</a></li>  
          <li><a href="#">About</a></li>
</div>
 </ul>
      </div>
          
      <!-- Page content -->
      <iframe src="https://shell.demo.cpd.brightprocess.com" id="page-content-wrapper">
        </iframe>
</div>
    </div>
<nav class="navbar navbar-inverse navbar-fixed-bottom navbar-sam-main" role="navigation">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">

    <a class="navbar-brand navbar-left" href="" title="aaaa" style="padding-top:25px; padding-left:15px; font-size:24px;">
        Cloud2Class
    </a>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-mycol">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    </div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-mycol">
    <ul class="nav navbar-nav navbar-right">
<li class="siteseal" style="margin-right:170px; margin-top:20px;"><span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=AywkROD2O9vhtzzwflDU4VLXEb6GXv8TKsXF6eoVTX8bSfFbkxUR"></script></span></li>
              <li><h1>support</h1></li>
<li class="email-us" style="margin-right:57px;"><a href="mailto:support@brightprocess.com?Subject=Cloud2Class Support Request">tel: +44 (0)208 8195 925<br>email: support@brightprocess.com</a></li>
                <li><h1 style="left:-62px;">web</h1></li>
                <li style="padding-left:25px;"><a href="http://cloud2class.com">cloud2class.com</a><a style="margin-top:-30px;" href="http://www.brightprocess.com/about-us">www.brightprocess.com/about-us</a></li>
                <li style="margin-top:2px; margin-right:24px;"><img class="trademark" src="img/logo-trans.png" width="64" height="64"/></li>

    </ul>

</div><!-- /.navbar-collapse -->
</nav>
    <!-- JavaScript -->
    <script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript for the Menu Toggle -->
<div class="modal fade" id="email-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Us</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="contact_us" class="contact_us">
<p class="notes">Have a problem using Cloud2Class? Report it here and we will respond within 48 hours.</p>
<div class="input-group">
<span class="input-group-addon glyphicon glyphicon-user"></span>
<input placeholder="your name...." class="form-control" id="author" name="author" type="text" value="" size="30">
</div>
<div class="input-group"><span class="input-group-addon">@</span>
<input class="form-control" id="email" placeholder="your email address...." name="contact_email" type="text" value="" size="30">
</div>
<p><textarea id="contact_message" class="form-control" name="contact_message" cols="45" rows="8" placeholder="your message...." aria-required="true"></textarea></p>
</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="contact-us-btn" name="contact_us">send email</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  </body>
</html>
<?php
} else {
header("Location:index.php");
}
?>
