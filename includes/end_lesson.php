<div class="end_lesson">
<?php
date_default_timezone_set('Europe/London');
$link= mysqli_connect("cpd-db","cpd","dkfj55.1","cpd");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
#$pool_ref=$_POST['pool_ref'];
$lesson_id=$_POST['lesson_id'];
$qw = "select p.pool_id, p.pool_ref from pool p, lesson l where lesson_id = {$lesson_id} and l.pool_id=p.pool_id";
$resw = mysqli_query($link, $qw);
$rows = mysqli_fetch_row($resw);
$pool_id = $rows[0];
$pool_ref = $rows[1];
if(isset($pool_id)){
$q = "select user_id, pool_id, lesson_start, duration, login, password, instance_type from lesson where pool_id = {$pool_id} AND lesson_id = {$_POST['lesson_id']}";
$res = mysqli_query($link, $q);
$row = mysqli_fetch_row($res);  
$lesson_type = $row[6];
$started = $row[2];
$minutes = (int)$row[3];
$shell_user = $row[4];
$shell_pass = $row[5];
$finished = strtotime("+".$minutes." minutes", strtotime($started));
$hid_ttl = date('Y-m-d H:i:s', $finished);
$ttl = date("H:i a", $finished);
print "<input type=\"hidden\" id=\"pool_ref\" value=\"$pool_ref\"/>";
print "<input type=\"hidden\" id=\"lesson_id\" value=\"$lesson_id\"/>";
print "<input type=\"hidden\" id=\"ttl\" value=\"$hid_ttl\"/>";
print "<input type=\"hidden\" id=\"lesson_type\" value=\"$lesson_type\"/>";
?>
<ul class="pager">
  <li class="previous"><a href="#" class="gobacktopools">&larr; Go Back</a></li>
  <li class="next"><a href="#" id="menu-toggle">View Instances &rarr;</a></li>
</ul>
<?php
print "<h2 style=\"margin-top:-15px\">Lesson in progress (<b>$pool_ref</b>)";
$me = (int)$_POST['user_id'];
$owner = (int)$row[0];
print "<hr>";
print "<div class=\"bs-callout bs-callout-info\"><h4>URL is: <a target=\"_blank\" href=\"https://beta.cloud2class.com/bportal/$pool_ref/\">https://beta.cloud2class.com/bportal/$pool_ref/</a></h4></div>";
print "<code style='left-margin: 30%;'>username is: $shell_user</code>";
print "<br><code>password is: $shell_pass</code><br>"; 
?>
</p>
 <h3>Started At:<br> <?php echo date("H:i a", strtotime($started)); ?></h3>
 <h3>Finishes At:<br>
<?php
echo $ttl;
$current = date("H:i:s");
$time_now = strtotime($current);
$diff = $finished - $time_now;
?>
</h3>
<div id="CountDownTimer<?php if ($diff > 60) { echo "Hourly"; } else { echo ""; } ?>" data-timer="<?php echo $diff; ?>" style="width:361px; height: 122px; margin-left:auto; margin-right:auto;"></div>
<?php
if($owner == $me){
?>
<ul class="pager">
  <li><a id="giveme" href="#">give me 30 more minutes</a></li>
  <li><a id="fiveMore" href="#">5 more nodes</a></li>
  <li><a id="end_lesson" href="#">end lesson</a></li>
</ul>
<?php
} else {
echo "";
}
if($diff > 0){
}elseif($diff <= 0){
}
}
?>
</div>
