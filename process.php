<?php
  
  $link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");
  $user_login = $_POST['user_login'];
  $action=$_POST["action"];
    if($action=="showcomment"){
    $show=mysqli_query($link, "Select * from instances order by ttl desc");
      $row_cnt = mysqli_num_rows($show);
	if($row_cnt > 1){
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
    if($row[instance_state] == 'Requested'){
    echo '<b class="glyphicon glyphicon-tasks" style="color:#eee; font-size:28px; position:relative; top:13px; right:25px;"></b>';
    }
      echo '<text style="font-weight:bold; padding-left:5px;">' . $row[instance_name] . '</text><text class="pull-right" id="instance_state" style="padding-right:15px; font-size:11px;">' . $row[instance_state] . '</text>';
      echo '<br><text style="font-size:11px; float:right; margin-right:5%; margin-top:-27px;">' . date("H:i", strtotime($row[ttl])) . '</text>';
      echo '</a></li>';
   }
} else {
echo '<li><img class="none_instance" src="views/c2c-logo.png"/></li>';
}
       } elseif($action=="addcomment"){

	$pool = $_POST['pool'];
	$resa = mysqli_query($link, "SELECT pool_id FROM pool WHERE pool_ref = '{$pool}'");
	$rw = mysqli_fetch_row($resa);
	$pool_id = (int)$rw[0];
	$lesson_type = $_POST['lesson_type'];
	$no_instances = $_POST['instances'];
	$lesson_duration = (int)$_POST['lesson_duration'];
	$query = "select user_id from user where user_login = '" . $user_login . "'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_row($result);
	$user_id = (int)$row[0];

    $sql = "INSERT INTO lesson (user_id, pool_id, lesson_start, duration, mounts, instance_type) VALUES ({$user_id}, {$pool_id}, NOW(), {$lesson_duration}, 'uploads:resources', '{$lesson_type}')";

    if (!mysqli_query($link,$sql)) {
    die('Error: ' . mysqli_error($link));
    }

    $lesson_id = mysqli_insert_id($link);

    $anuv = "insert into instances (instance_name, instance_state, instance_type, lesson_id, ttl, pool_ref) values('Unassigned', 'Requested', '" . $lesson_type  . "', " . $lesson_id  . ", now() + INTERVAL " . $lesson_duration * 60  . " SECOND, '{$pool}' )";
    var_dump($anuv, $lesson_id);

    for($i=0;$i<$no_instances;$i++){ // loop depending on the choosen amount of instances
    if (!mysqli_query($link,$anuv)) {
    die('Error: ' . mysqli_error($link));
     }
   }
 }
?>
