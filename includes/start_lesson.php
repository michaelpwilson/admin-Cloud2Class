<form action="" style="" method="post" class="start_lesson">
<?php
$link= mysqli_connect("cpd-db","cpd","dkfj55.1","cpd");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<h1>Create a Lesson <a id="menu-toggle" href="#" class="btn btn-success"><i class="glyphicon glyphicon-align-right"></i></a></h1>
<hr>
<h3>choose a pool:</h3>
<input type="radio" value="demo" name="pool"/> demo
<h3>type of machine:</h3>
<select name="lesson_type" class="lesson-dropdown form-control">
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
<a href="#"><i class="glyphicon glyphicon-chevron-left" id="subtract"></i></a><input style="border:0; width:5%; font-size:28px;" id="example" name="instances" type="text" value="20" /><a href="#"><i id="add" class="glyphicon glyphicon-chevron-right"></i></a>
<h3>duration of lesson:</h3>
<select name="lesson_duration" class="lesson-dropdown form-control">
  <option value="30">30 minutes</option>
  <option value="60">60 minutes</option>
  <option value="90">90 minutes</option>
</select>
<input type="submit" name="lesson_go" value="Go!" style="margin-top:15px" class="launch_lesson btn-success btn btn-lg"/>
</form>
<?php
$pool = $_POST['pool'];
$lesson_type = $_POST['lesson_type'];
$no_instances = $_POST['instances'];
$lesson_duration = (int)$_POST['lesson_duration'];

if(isset($pool)){
$query = "select user_id from user where user_login = '" . $_SESSION['user_name'] . "'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_row($result);
$user_id = (int)$row[0];
$sql = "INSERT INTO lesson VALUES (" . $user_id . ", 1, NOW(), " . $lesson_duration . ", '', 'hello', 'Bergun21', 'puppet', 'mysql', 'mount', '" . $lesson_type . "')";

if (!mysqli_query($link,$sql))
  {
  die('Error: ' . mysqli_error($link));
  }
$lesson_id = mysqli_insert_id($link);

$anuv = "insert into instances values('unassigned', 'requested', '" . $lesson_type  . "', " . $lesson_id  . ", now() + INTERVAL " . $lesson_duration * 100  . " SECOND, '', '')";
for($i=0;$i<$no_instances;$i++){ // loop depending on the choosen amount of instances
if (!mysqli_query($link,$anuv)) {
  die('Error: ' . mysqli_error($link));
  }
}
}
?>
