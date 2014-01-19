<?php
$user_lesson = $_POST['user_lesson'];
$link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");

if($_POST['action'] == "end"){
mysqli_query($link,"UPDATE instances SET ttl = NOW() WHERE lesson_id = {$user_lesson} ");
}

if($_POST['action'] == "give"){
mysqli_query($link,"UPDATE lesson SET duration = duration+30 WHERE lesson_id = {$user_lesson} ");
}

?>
