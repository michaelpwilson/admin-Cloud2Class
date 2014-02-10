<div class="admin_screen" style="display:none;">
<?php
$morg = mysqli_query($link, "SELECT org_id FROM user WHERE user_id=$user_id");
$result = mysqli_fetch_row($morg);
$myorg = (int)$result[0];
?>
<h2 style="text-decoration:underline;">Time Remaining</h2>
<?php
    $query = mysqli_query($link, "select (o.sub_allowance-sum(l.duration)) as rate from lesson l, organization o, user u where l.user_id=u.user_id and u.org_id=o.org_id and u.user_id=". $user_id ."");
        $fetch = mysqli_fetch_row($query);
        $fetchy = (int)$fetch[0];
if($fetchy <= 0){
?>
<div class="bs-callout bs-callout-danger">
    <h4>You do not have any credit. Please purchase some using the link below.</h4>
  </div>
<b class="glyphicon glyphicon-minus minus-figure"></b>
<?php
}
else{
 echo "";
}

?>
<div style="width: 658px; height: 244px; margin-left: auto; margin-right: auto;">
<input type="hidden" class="time_remaining" value="<?php echo $fetchy; ?>"/>
<div class="paid_time_remaining stopwatch" data-timer="<?php echo $fetchy * 60; ?>"></div>
</div>
<form style="display:none" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="3XKPBJYKB6274">
<table>
<tr><td><input type="hidden" name="on0" value="Amount">Amount</td></tr><tr><td><select name="os0">
	<option value="2 hours">2 hours £1.00 GBP</option>
	<option value="10 hours">10 hours £5.00 GBP</option>
	<option value="20 hours">20 hours £10.00 GBP</option>
	<option value="100 hours">100 hours £50.00 GBP</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="GBP">
<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
<a href="mailto:support@brightprocess.com?Subject=Cloud2Class%20Account%20Request" class="btn btn-success">Make this Live!</a> (Requires 24hours)
<hr>
<h2 style="text-decoration:underline;">Last 10 Classes</h2>
<div style="height:340px">
<div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th class="header">Launched By <i class="fa fa-sort"></i></th>
                    <th class="header">Pool <i class="fa fa-sort"></i></th>
                    <th class="header">Lesson Start <i class="fa fa-sort"></i></th>
                    <th class="header">Duration <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>
 		  <?php
$lesn = mysqli_query($link, "select * from lesson l, user u where l.user_id=u.user_id and u.org_id=" . $myorg . " order by l.lesson_start desc limit 10");
	while($lesson = mysqli_fetch_row($lesn)){
$usr = mysqli_query($link, "select user_login from user where user_id = {$lesson[0]}");
$usr_lgn = mysqli_fetch_row($usr);
$pool = mysqli_query($link, "select pool_ref from pool where pool_id = {$lesson[1]}");
$plref = mysqli_fetch_row($pool);
		?>
		<tr>
                    <td><?php echo $usr_lgn[0]; ?></td>
                    <td><?php echo $plref[0]; ?></td>
                    <td><?php echo date("H:ia - d M Y", strtotime($lesson[2])); ?></td>
                    <td><?php echo $lesson[3]; ?></td>
                  </tr>
		<?php
		}
		?>
                </tbody>
              </table>
</div>
</div>
<hr>
<h2 style="text-decoration:underline; margin-top:83px;">Users</h2>
<div style="height:340px">
<div class="table-responsive">
              <table class="table table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th class="header">user login <i class="fa fa-sort"></i></th>
                    <th class="header">title <i class="fa fa-sort"></i></th>
                    <th class="header">forename <i class="fa fa-sort"></i></th>
                    <th class="header">surname <i class="fa fa-sort"></i></th>
                    <th class="header">change password</th>
		  </tr>
                </thead>
                <tbody>
<?php
$rsvm = mysqli_query($link, "select * from user where org_id = 2");
while($row = mysqli_fetch_row($rsvm)){
$usr_lgn = $row[1];
$fre_nme = $row[4];
$sur_nme = $row[5];
$usr_tit = $row[6];
?>
                  <tr style="text-align:left">
                    <td><?php echo $usr_lgn; ?></td>
                    <td><?php echo $usr_tit; ?></td>
			<td><?php echo $fre_nme; ?></td>
                    <td><?php echo $sur_nme; ?></td>
                    <td style="text-align:center;"><button value="<?php echo $usr_lgn; ?>" class="reset-p btn btn-primary btn-xs">reset</button></td>
                  </tr>
<?php
}
?>
                </tbody>
              </table>
            </div>
</div>
</div>
