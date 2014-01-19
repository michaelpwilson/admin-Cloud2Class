<?php
$link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");
$user_login = $_POST['user_login'];
$action=$_POST["action"];
	if($action=="showcomment"){
     $show=mysqli_query($link, "Select * from instances order by ttl desc");
     while($row = mysqli_fetch_array($show)){
        echo '<li style="border-bottom:1px solid #eee;"><a href="#">';
if($row[instance_state] == 'Ready'){        
echo '<b class="glyphicon glyphicon-tasks" style="color:green; font-size:28px; position:relative; top:13px; right:25px;"></b>';
} elseif($row[instance_state] == 'Failed' || $row[instance_state] == 'Shutting Down'){
echo '<b class="glyphicon glyphicon-tasks" style="color:red; font-size:28px; position:relative; top:13px; right:25px;"></b>';
}
if($row[instance_state] == 'In Use'){
echo '<b class="glyphicon glyphicon-tasks" style="font-size:28px; position:relative; top:13px; right:25px;"></b>';
} elseif($row[instance_state] == 'Launching'){
echo '<b class="glyphicon glyphicon-tasks" style="color:blue; font-size:28px; position:relative; top:13px; right:25px;"></b>';
}
 echo '<text style="font-weight:bold; padding-left:5px;">' . $row[instance_name] . '</text><text class="pull-right" id="instance_state" style="padding-right:15px; font-size:11px;">' . $row[instance_state] . '</text>';
 echo '<br><text style="font-size:11px; float:right; margin-right:5%; margin-top:-27px;">' . date("H:i", $row[ttl]) . '</text>';
 echo '</a></li>';
     }
  } elseif($action=="addcomment"){
$pool = $_POST['pool'];
var_dump($pool);
$lesson_type = $_POST['lesson_type'];
$no_instances = $_POST['instances'];
$lesson_duration = (int)$_POST['lesson_duration'];
$query = "select user_id from user where user_login = '" . $user_login . "'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_row($result);
$user_id = (int)$row[0];

$sql = "INSERT INTO lesson (user_id, pool_id, lesson_start, duration, instance_type) VALUES ({$user_id}, 1, NOW(), {$lesson_duration}, '{$lesson_type}')";
var_dump($sql);

if (!mysqli_query($link,$sql))
  {
  die('Error: ' . mysqli_error($link));
  }
$lesson_id = mysqli_insert_id($link);

$anuv = "insert into instances (instance_name, instance_state, instance_type, lesson_id, ttl) values('unassigned', 'requested', '" . $lesson_type  . "', " . $lesson_id  . ", now() + INTERVAL " . $lesson_duration * 60  . " SECOND)";
var_dump($anuv, $lesson_id);

for($i=0;$i<$no_instances;$i++){ // loop depending on the choosen amount of instances
if (!mysqli_query($link,$anuv)) {
  die('Error: ' . mysqli_error($link));
  }
}
}
?>
