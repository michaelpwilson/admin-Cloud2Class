  <?php
   $link= mysqli_connect("cpd-db","cpd","dkfj55.1","cpd");
   $idq = 'select * from user where user_login = "' . $_SESSION['user_name'] . '"';
   $res = mysqli_query($link, $idq);
   $getid = mysqli_fetch_row($res);
   $user_id = (int)$getid[0];
   $user_role = (int)$getid[3];
  ?>
  <!DOCTYPE html>
   <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cloud2Class | welcome to the lesson creator</title>
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <link href="dist/css/TimeCircles.css" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="dist/css/simple-sidebar.css" rel="stylesheet">
    <link href="dist/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
    <link href="dist/css/docs.min.css" rel="stylesheet">
  </head>
 <body>
<div id="wrapper">
   <div style="border:0; border-radius:0px; moz-border-radius:0px" class="navbar navbar-inverse" role="navigation">
  <div class="container" style="width:100%">
     <div class="navbar-header">
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     </button>
   <a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-cloud" style="font-size:15px;"></i> Cloud2Class</a>
  </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
<?php
if($user_role == 2){
?>   
<li class="admin_button"><a class="btn btn-danger btn-xs">admin</a></li>
<?php
} else {
echo "";
}
?>   
 </ul>

    <ul class="nav navbar-nav navbar-right">
          <li id="fat-menu" class="dropdown">
      <input type="hidden" class="user_id" value="<?php echo $user_id; ?>"/>
      <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user_name']; ?> <b class="glyphicon glyphicon-user"></b></a>
      <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
         <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?logout">logout</a></li>
      </ul>
      </li>
    </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div>
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
	<div class="sidebar-helper">
	<ul class="help-right">
	<li><a href="#"><b class="glyphicon glyphicon-tag"></b></a></li>
	<li><a href="#"><b class="glyphicon glyphicon-refresh"></b></a></li>
	</ul>
	</div>
        <ul id="comment" class="sidebar-nav">
        </ul>
      </div>
      <!-- Page content -->
      <div id="page-content-wrapper" style="min-height:556px;">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
<div class="example" data-date="2014-01-01 12:14:32"></div>
<?php 
if($user_role == 2){
include "includes/admin.php"; 
} else {
// echo "user role";
}
?>
       <div class="holder">
	<?php include "includes/start_lesson.php"; ?>
	 <?php include "includes/end_lesson.php"; ?>
       </div>
      <div id="instances-holder">
        </div>
      </div>
    </div>
<nav class="navbar navbar-inverse bottom-navy navbar-sam-main navey" role="navigation" style="border:0; border-radius:0; moz-border-radius:0">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
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
                <li style="padding-left:25px;"><a href="http://cloud2class.com" target="_blank">cloud2class.com</a><a style="margin-top:-30px;" target="_blank" href="http://www.brightprocess.com/about-us">www.brightprocess.com/about-us</a></li>
                <li style="margin-top:2px; margin-right:24px;"><img class="trademark" src="img/logo-trans.png" width="64" height="64"/></li>

    </ul>

</div><!-- /.navbar-collapse -->
</nav>
</div>
<?php include "modals/init.php"; ?> 
    <script src="dist/js/jquery.min.js"></script>
      <script type="text/javascript" src="dist/js/process.js"></script>
      <script src="dist/js/TimeCircles.js"></script>
      <script src="dist/js/bootstrap.js"></script>
	<script src="dist/js/tablesorter/jquery.tablesorter.js"></script>
	<script src="dist/js/tablesorter/tables.js"></script>
	<script type="text/javascript" src="dist/js/kinetic.js"></script>
	<script type="text/javascript" src="dist/js/jquery.final-countdown.js"></script>   
   </body>
   </html>
