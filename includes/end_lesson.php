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
 <h1>Lesson</h1>
 <h3>Started time:<br> <?php echo date("h:i", strtotime($started)); ?></h3>
 <h3>Finishes At:<br>
<?php
$finished = strtotime("+".$minutes." minutes", strtotime($started));
echo date("h:i", $finished);
?>
</h3>
 <h3>Elapsed:<span id="stopwatch"></span></h3>
  <button type="button" class="btn btn-primary" data-toggle="button">give me 30 more minutes</button>
  <button type="button" class="btn btn-danger" data-toggle="button">end</button>
</div>
<?php
} elseif(isset($user_lesson)){
$q = "select * from lesson where lesson_id = {$user_lesson}";
$res = mysqli_query($link, $q);
$row = mysqli_fetch_row($res);  
$started = $row[2];
$minutes = $row[3];
?>
 <h1>Lesson</h1>
 <h3>Started time:<br> <?php echo date("h:i", strtotime($started)); ?></h3>
 <h3>Finishes At:<br>
<?php
$finished = strtotime("+".$minutes." minutes", strtotime($started));
echo date("h:i", $finished); 
?>   
</h3>
 <h3>Elapsed:<span id="stopwatch"></span></h3>
  <button type="button" class="btn btn-primary" data-toggle="button">give me 30 more minutes</button>
  <button type="button" class="btn btn-danger" data-toggle="button">end</button>
</div>
<?php
}
?>
