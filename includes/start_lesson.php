<form action="/" style="" method="post" class="start_lesson">
<?php
$link= mysqli_connect("cpd-db","cpd","dkfj55.1","cpd");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<h1>Create a Lesson <a id="menu-toggle" href="#" class="btn btn-success"><i class="glyphicon glyphicon-align-right"></i></a></h1>
<hr>
<h3>choose a slot:</h3>
<?php
$q = "select pool_ref from pool";
$res = mysqli_query($link, $q);
while($row = mysqli_fetch_row($res)){
?>
<input type="radio" value="<?php echo $row[0]; ?>" id="pool" name="pool"/><?php echo $row[0]; ?><br>
<?php
}
?>
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
<a href="#"><i class="glyphicon glyphicon-chevron-left" id="subtract"></i></a><input style="border:0; width:5%; font-size:28px;" id="example" name="instances" type="text" value="20" /><a href="#"><i id="add" class="glyphicon glyphicon-chevron-right"></i></a>
<h3>duration of lesson:</h3>
<select name="lesson_duration" id="lesson_duration" class="lesson-dropdown form-control">
  <option value="30">30 minutes</option>
  <option value="60">60 minutes</option>
  <option value="90">90 minutes</option>
</select>
<input type="submit" name="lesson_go" value="Go!" style="margin-top:15px" class="btn-success btn btn-lg"/>
</form>
