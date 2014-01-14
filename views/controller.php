<?php
$link= mysqli_connect("cpd-db","cpd","dkfj55.1","cpd");
$idq = 'select * from user where user_login = "' . $_SESSION['user_name'] . '"';
$res = mysqli_query($link, $idq);
$getid = mysqli_fetch_row($res);
$user_id = (int)$getid[0];
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

    <!-- Add custom CSS here -->
    <link href="dist/css/simple-sidebar.css" rel="stylesheet">
    <link href="dist/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>
<div style="border:0;" class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container" style="width:100%;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
<a class="navbar-brand" href="index.php">
<?php
$q = 'select * FROM lesson WHERE user_id = ' . $user_id . '';
$result = mysqli_query($link, $q);      

if(mysqli_num_rows($result) >= 1){
$getulesson = mysqli_fetch_row($result);
$user_lesson = $getulesson[4];
?>
<input class="user_lesson" type="hidden" value="<?php echo $user_lesson; ?>"/>
<?php
}
?>


</a>
 </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">settings <b class="glyphicon glyphicon-wrench"></b></a>
                  <ul class="dropdown-menu">
                        <li><a href="settings.php">Settings</a></li>
                        <li><a href="settings.php">More Settings....</a></li>
                  </ul>
                </li>
<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">help <b class="glyphicon glyphicon-info-sign"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="glyphicons.php">Help Page</a></li>
                  </ul>
                </li>
 </ul>
<ul class="nav navbar-nav navbar-right">
            <li id="fat-menu" class="dropdown">
<input type="hidden" class="session_name" value="<?php echo $_SESSION['user_name']; ?>"/>
              <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user_name']; ?> <b class="glyphicon glyphicon-align-justify"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Login Log</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Updates <span class="badge">1</span></a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Notifications <span class="badge">6</span></a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?logout">logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.nav-collapse -->
</div><!-- /.container -->
    </div>

    <div id="wrapper">

      <!-- Sidebar -->
      <div id="sidebar-wrapper">
        <ul id="comment" class="sidebar-nav">
        </ul>
      </div>
      <!-- Page content -->
      <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
<div class="holder">
	<?php include "includes/start_lesson.php"; ?>
	 <?php include "includes/end_lesson.php"; ?>
</div>
<div id="instances-holder">
</div>
</div>
      </div>
</div>
<div class="navbar-inverse  navbar-fixed-bottom navbar-ex1-collapse">
<ul class="nav navbar-nav navbar-right">
<li><a class="navbar-brand" href="index.php">Bright Process Ltd 2014 &copy;</a></li>
</ul>
</div>
  </body>
<script src="dist/js/jquery.min.js"></script>
<script type="text/javascript" src="dist/js/process.js"></script>
<script src="dist/js/bootstrap.js"></script>
</html>
