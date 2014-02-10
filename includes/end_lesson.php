<div class="end_lesson">
<?php
$link= mysqli_connect("cpd-db","cpd","dkfj55.1","cpd");
$qw = "select * from pool where pool_ref = '{$_POST['pool_ref']}'";
$resw = mysqli_query($link, $qw);
$rows = mysqli_fetch_row($resw);
$pool_id = $rows[0];
if(isset($pool_id)){
$q = "select * from lesson where pool_id = {$pool_id} AND lesson_id = {$_POST['lesson_id']}";
$res = mysqli_query($link, $q);
$row = mysqli_fetch_row($res);  
$started = $row[2];
$minutes = (int)$row[3];
$lesson_id = (int)$row[4];
$shell_user = $row[5];
$shell_pass = $row[6];
$pool_ref=$_POST['pool_ref'];
print "<input type=\"hidden\" id=\"pool_ref\" value=\"$pool_ref\"/>";
?>
<ul class="pager">
  <li class="previous"><a href="#" class="gobacktopools">&larr; Go Back</a></li>
  <li class="next"><a href="#" id="menu-toggle">View Instances &rarr;</a></li>
</ul>
<?php
print "<h2>Lesson in progress (<b>$pool_ref</b>)";
$me = (int)$_POST['user_id'];
$owner = (int)$row[0];
print "<hr><div class=\"bs-callout bs-callout-info\">";
print "<p class=\"lead\">URL is: <a target=\"_blank\" href=\"https://$pool_ref.cloud2class.com\">https://$pool_ref.cloud2class.com</a>";
print "<br>username is: $shell_user";
print "<br>password is: $shell_pass</p></div>"; 

?>
 <h3>Started At:<br> <?php echo date("H:i a", strtotime($started)); ?></h3>
 <h3>Finished At:<br>

<?php
$finished = strtotime("+".$minutes." minutes", strtotime($started));
$ttl = date("H:i a", $finished); 
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
  <button type="button" id="giveme" class="btn btn-primary" data-toggle="button">give me 30 more minutes</button>
  <button type="button" id="end_lesson" class="btn btn-danger" data-toggle="button">end</button>
<?php
} else {
echo "";
}
if($diff > 0){
}elseif($diff <= 0){
}
?>
</div>
</div>
<?php
}
?>
