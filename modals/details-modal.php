<!-- Modal -->
<div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="password-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
<form class="form-register" method="post" action="" name="form">
    <input value="" type="hidden" class="user"/>
 <div class="form-group">   
 <input class="form-control" style="margin-top:10px;" placeholder="new password" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
<span style="display:none; right:22px; top:35px;" class="glyphicon glyphicon-remove form-control-feedback"></span>
</div><div class="form-group"> 
<input class="form-control" placeholder="repeat new password" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
<span style="display:none; right:22px; top:94px;" class="glyphicon glyphicon-remove form-control-feedback"></span>
</div>
<div id="pwd-message"></div>
</div>
      <div class="modal-footer"> <button class="update_pwd btn btn-primary" type="button">Update Details</button>
</form> 
</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
