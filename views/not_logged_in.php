<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="docs-assets/ico/favicon.png">

    <title>Sign into Cloud2Class</title>

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
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  </head>

  <body>

    <div class="container">

<!-- login form box -->
<form class="form-signin" method="post" action="index.php" name="loginform">
<!-- errors & messages --->
<?php

// show negative messages
if ($login->errors) {
    foreach ($login->errors as $error) {
        echo $error;
    }
}

// show positive messages
if ($login->messages) {
    foreach ($login->messages as $message) {
        echo $message;
    }
}

?>
<img src="views/c2c-logo.png">
<h2 class="form-signin-heading">sign in</h2>
<div class="login-inputs">
<div class="input-group">
<span class="input-group-addon glyphicon glyphicon-user"></span>
<input id="login_input_username" class="form-control" placeholder="username" type="text" name="user_name" required />
</div>
<div class="input-group">
<span class="input-group-addon glyphicon glyphicon-ok"></span>
<input id="login_input_password" class="form-control" placeholder="password" type="password" name="user_password" autocomplete="off" required />
</div>
</div>
<button style="margin-top:10px;" name="login" class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
      </form>


</form>
</body>
<script>
$( document ).ready(function() {
$('#login_input_username').blur(function()
{
      if( this.value ) {
            $('.input-group span').addClass('green');
      }
});
});
</script>
</html>
