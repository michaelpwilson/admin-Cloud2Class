<div class="end_lesson">
<?php
$link= mysqli_connect("cpd-db","cpd","dkfj55.1","cpd");
$user_lesson_ajax = $_POST['user_lesson'];
if(isset($user_lesson_ajax)){
$q = "select * from lesson where lesson_id = {$user_lesson_ajax}";
$res = mysqli_query($link, $q); 
$row = mysqli_fetch_row($res);
$started = $row[2];
$minutes = $row[3];
?>
 <h1>Lesson <a id="menu-toggle" href="#" class="btn btn-success"><i class="glyphicon glyphicon-align-right"></i></a></h1>
 <h3>Started time:<br> <?php echo date("H:i", strtotime($started)); ?></h3>
 <h3>Finishes At:<br>
<?php
$finished = strtotime("+".$minutes." minutes", strtotime($started));
$ttl = date("H:i", $finished);
echo $ttl;

$current = date("H:i:s");
$time_now = strtotime($current);
$diff = $finished - $time_now;
if($diff > 0){
echo "<br>lesson is in progress";
}elseif($diff <= 0){
echo "<br>lesson ended, now for cpd to abolish instances and lesson";
}
?>
</h3>
<div style=""><div id="CountDownTimer<?php if ($diff > 60) { echo "Hourly"; } ?>" data-timer="<?php echo $diff; ?>" style="width:361px; height: 180px; margin-left:auto; margin-right:auto;"></div></div>

  <button type="button" class="btn btn-primary" id="giveme" data-toggle="button">give me 30 more minutes</button>
  <button type="submit" class="btn btn-danger" id="end_lesson" data-toggle="button">end</button>
</div>
<?php
} elseif(isset($user_lesson)){
$q = "select * from lesson where lesson_id = {$user_lesson}";
$res = mysqli_query($link, $q);
$row = mysqli_fetch_row($res);  
$started = $row[2];
$minutes = (int)$row[3];
?>
 <h1>Lesson <a id="menu-toggle" href="#" class="btn btn-success"><i class="glyphicon glyphicon-align-right"></i></a></h1>
 <h3>Started time:<br> <?php echo date("H:i", strtotime($started)); ?></h3>
 <h3>Finishes At:<br>
<?php
$finished = strtotime("+".$minutes." minutes", strtotime($started));
$ttl = date("H:i", $finished); 
echo $ttl;

$current = date("H:i:s");
$time_now = strtotime($current);
$diff = $finished - $time_now;
if($diff > 0){
echo "<br>lesson is in progress";
}elseif($diff <= 0){
echo "<br>lesson ended, now for cpd to abolish instances and lesson";
}
?>   
</h3>
<div style=""><div id="CountDownTimer<?php if ($diff > 60) { echo "Hourly"; } ?>" data-timer="<?php echo $diff; ?>" style="width:361px; height: 180px; margin-left:auto; margin-right:auto;"></div></div>

  <button type="button" class="btn btn-primary" id="giveme" data-toggle="button">give me 30 more minutes</button>
  <button type="submit" class="btn btn-danger" id="end_lesson" data-toggle="button">end</button>
</div>
<?php
}
?>
