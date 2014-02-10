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
    <h4>You currently owe money from previous lessons</h4>
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
<div class="btn-group btn-group-lg">

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
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
</div>
<hr>
<h2 style="text-decoration:underline;">Classes</h2>
<div style="height:340px">
<div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th class="header">launched by <i class="fa fa-sort"></i></th>
                    <th class="header">Visits <i class="fa fa-sort"></i></th>
                    <th class="header">% New Visits <i class="fa fa-sort"></i></th>
                    <th class="header">Revenue <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>
 		  <?php
$lesn = mysqli_query($link, "select * from lesson l, user u where l.user_id=u.user_id and u.org_id=" . $myorg . " order by l.lesson_id desc limit 7");
$result = mysqli_query($link, "select count(*) from lesson l, user u where l.user_id=u.user_id and u.org_id=" . $myorg);
$count = mysqli_fetch_row($result);
$per_page = 7;
$pages = ceil((int)$count[0]/$per_page);
		var_dump($pages);
	while($lesson = mysqli_fetch_row($lesn)){
		?>
		<tr>
                    <td><?php echo $lesson[0]; ?></td>
                    <td>261</td>
                    <td>33.3%</td>
                    <td>$234.12</td>
                  </tr>
		<?php
		}
		?>
                </tbody>
              </table>
 <ul class="pagination">
    <?php
       	//Show page links
        for($i=1; $i<=$pages; $i++)
        {
     echo '<li id="'.$i.'"><a href="#">'.$i.'</a></li>';
       	}
    ?>
              </ul>
            </div>
</div>
<hr>
<h2 style="text-decoration:underline;">Users</h2>
<div style="height:340px">
<div class="table-responsive">
              <table class="table table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th class="header">user login <i class="fa fa-sort"></i></th>
                    <th class="header">title <i class="fa fa-sort"></i></th>
                    <th class="header">forename <i class="fa fa-sort"></i></th>
                    <th class="header">surname <i class="fa fa-sort"></i></th>
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
                    <td>$321.33</td>
                  </tr>
<?php
}
?>
                </tbody>
              </table>
            </div>
</div>
<div class="btn-group btn-group-lg">
  <button type="button" class="btn btn-primary">Test</button>
  <button type="button" class="btn btn-success">Change Password</button>
</div>
</div>
