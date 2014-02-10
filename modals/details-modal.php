<!-- Modal -->
<div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="password-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">My Details</h4>
      </div>
      <div class="modal-body">
<form class="form-register" method="post" action="" name="form">
<?php
$result = mysqli_query($link, "select * from user where user_login = '{$_SESSION['user_name']}'");
$details = mysqli_fetch_row($result);
$user_name = $details[1];
$forename = $details[4];
$surname = $details[6];
?>
    <input class="form-control" placeholder="username" type="text" value="<?php echo $user_name; ?>" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
    <input class="form-control" placeholder="forename" type="text" value="<?php echo $forename; ?>" name="user_forename" required />
    <input class="form-control" placeholder="surname" type="text" value="<?php echo $surname; ?>" name="user_surname" />
<hr>
<h4>Want to change your password?</h4>
<code>Leave blank if you do not want to change your password *</code>
    <input class="form-control" style="margin-top:10px;" placeholder="new password" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
    <input class="form-control" placeholder="repeat new password" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
<div class="confirm-account">
<h4>Please confirm your Password</h4>
    <input class="form-control" placeholder="your current password" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
</div>      

</div>
      <div class="modal-footer">
<button type="button" class="btn btn-primary">Update Details</button>
</form> 
<?php
var_dump($_POST['user_name'], $_POST['user_forename'], $_POST['user_surname']);
?>
</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
