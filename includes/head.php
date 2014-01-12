<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="docs-assets/ico/favicon.png">

    <title>Off Canvas Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="views/offcanvas.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script type="text/javascript" src="dist/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="dist/js/select_image.js"></script>
<script type="text/javascript" src="dist/js/delete_category.js"></script>
<script type="text/javascript" src="dist/js/delete_page.js"></script>
<script type="text/javascript" src="dist/js/delete_post.js"></script>
  </head>
<body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
<a class="navbar-brand" href="index.php">Training</a>
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
    </div><!-- /.navbar -->

    <div class="container" style="margin-top:5px; padding-bottom:50px;">

