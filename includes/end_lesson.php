<div class="end_lesson">
<?php
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
$q = "select user_id, pool_id, lesson_start, duration, login, password from lesson where pool_id = {$pool_id} AND lesson_id = {$_POST['lesson_id']}";
$res = mysqli_query($link, $q);
$row = mysqli_fetch_row($res);  
$started = $row[2];
$minutes = (int)$row[3];
$shell_user = $row[4];
$shell_pass = $row[5];
print "<input type=\"hidden\" id=\"pool_ref\" value=\"$pool_ref\"/>";
print "<input type=\"hidden\" id=\"lesson_id\" value=\"$lesson_id\"/>";
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
print "<code>URL is: <a target=\"_blank\" href=\"https://beta.cloud2class.com/bportal/$pool_ref/\">https://beta.cloud2class.com/bportal/$pool_ref/</a></code>";
print "<br><code style='left-margin: 30%;'>username is: $shell_user</code>";
print "<br><code>password is: $shell_pass</code><br>"; 
?>
</p>
 <h3>Started At:<br> <?php echo date("H:i a", strtotime($started)); ?></h3>
 <h3>Finishes At:<br>
<?php
$finished = strtotime("+".$minutes." minutes", strtotime($started));
$ttl = date("H:i a", $finished); 
echo $ttl;
$current = date("h:i:s");
$time_now = strtotime($current);
// $diff = $finished - $time_now;
$diff = $time_now - $finished;
echo 'Time 1: '.date('H:i:s', $time_now).'<br>';
echo 'Time 2: '.date('H:i:s', $finished).'<br>';

if($diff){
    echo 'Diff: '.date('h:i:s', $diff);
}else{
    echo 'No Diff.';
}

?>   
</h3>
<div id="CountDownTimer<?php if ($diff > 60) { echo "Hourly"; } else { echo ""; } ?>" data-timer="<?php echo $diff; ?>" style="width:361px; height: 122px; margin-left:auto; margin-right:auto;"></div>
</div>

</div>
<?php
if($owner == $me){
?>
<br>
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
