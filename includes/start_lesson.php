<form action="/" style="" method="post" class="start_lesson">
<?php
$link= mysqli_connect("cpd-db","cpd","dkfj55.1","cpd");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<h1><a href="#" class="gobacktopools" style="display:none;"><b style="float:left;" class="glyphicon glyphicon-arrow-left"></b></a>Create a Lesson <a id="menu-toggle" href="#" class="btn btn-success"><i class="glyphicon glyphicon-align-right"></i></a></h1>
<hr>
<div class="pool-buttons">
<h3>choose a Class:</h3>
<?php
$q = "select * from pool order by pool_ref";
$res = mysqli_query($link, $q);
$result = mysqli_query($link, "SELECT * FROM instances WHERE pool_ref = '{$pool_ref}'");
$resuml = mysqli_query($link, "SELECT pool_id FROM pool WHERE pool_ref = '{$pool_ref}'");

while($row = mysqli_fetch_row($res)){
$rowi = mysqli_fetch_row($resuml);
$pool_id = (int)$rowi[0];

$pool_ref = $row[2];
$qres = "SELECT * FROM user_pool WHERE user_id = {$user_id}";
$resu = mysqli_query($link, $qres);
$rowiey = mysqli_fetch_row($resu);
$pool_id = (int)$rowiey[0];
$user_id = (int)$rowiey[1];

if ($result || isset($pool_id) && isset($user_id)) {
/* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);
if($row_cnt < 1){
$rowx = mysqli_fetch_row($result);
$ttl = strtotime($rowx[4]);
$pool_ref = $row[2];
$current = date("H:i:s");
$time_now = strtotime($current);
$diff = $ttl - $time_now;
$lesson_id = (int)$rowx[3];
$resem = mysqli_query($link, "SELECT * FROM lesson where lesson_id = {$lesson_id}"); 
$xox = mysqli_fetch_row($resem);
if($diff < 1){
?> 
<div class="btn btn-primary" style="min-width:100px; max-width:100px; text-align:left; font-size:20px; margin-top:20px;"><input type="radio" value="<?php echo $row[2]; ?>" id="pool" name="pool"/><?php echo $row[2]; ?></div><br>
<?php
} else {
?>
<div class="btn btn-success" style="min-width:100px; max-width:100px; text-align:left; font-size:20px; margin-top:20px; "><a style="color:white" value="<?php echo $row[2]; ?>"><b class="glyphicon glyphicon-asterisk" style="float:left; padding-right:23px; margin-top:3px;"></b><?php echo $row[2]; ?></a></div><br>
<?php
}
}elseif($row_cnt == 0){
?>
<div class="btn btn-primary" style="min-width:100px; max-width:100px; text-align:left; font-size:20px; margin-top:20px;"><input type="radio" value="<?php echo $row[2]; ?>" id="pool" name="pool"/><?php echo $row[2]; ?></div><br>
<?php
}
}
}
?>
</div>
<div class="bottom-half" style="display:none;">
<h3>type of machine:</h3>
<select id="lesson_type" name="lesson_type" class="lesson-dropdown form-control">
<?php
$q = "select type_desc from type";
$res = mysqli_query($link, $q);
while($row = mysqli_fetch_row($res)){
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
?>
</select> 
<h3>number of instances:</h3>
<a href="#"><i class="glyphicon glyphicon-chevron-left" id="subtract"></i></a><input style="border:0; width:5%; font-size:28px;" id="example" name="instances" type="text" value="7"/><a href="#"><i id="add" class="glyphicon glyphicon-chevron-right"></i></a>
<h3>duration of lesson:</h3>
<select name="lesson_duration" id="lesson_duration" class="lesson-dropdown form-control">
  <option value="30">30 minutes</option>
  <option value="60">60 minutes</option>
  <option value="90">90 minutes</option>
</select>
<input type="submit" name="lesson_go" value="Go!" style="margin-top:15px" class="btn-success btn btn-lg"/>
</div>
</form>
