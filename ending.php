<?php
$user_lesson = $_POST['user_lesson'];

$link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");

mysqli_query($link,"UPDATE instances SET ttl = NOW() WHERE lesson_id = {$user_lesson} ");
?>
