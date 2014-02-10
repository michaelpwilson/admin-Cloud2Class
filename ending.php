<?php
require_once("libraries/password_compatibility_library.php");
$link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");
#$pool_ref = $_POST['pool_ref'];
$lesson_id = $_POST['lesson_id'];
#$minutes = (int)$row[3];
var_dump($lesson_id);
#$resa = mysqli_query($link, "SELECT pool_id FROM pool WHERE pool_ref = '{$pool_ref}'");
#        $rw = mysqli_fetch_row($resa);
#        $pool_id = (int)$rw[0];

if($_POST['action'] == "changing"){
$user = $_POST['user'];
 $first_pass = $_POST['first_pass'];
$password_hash = password_hash($first_pass, PASSWORD_DEFAULT);
$qq = mysqli_query($link, "update user set user_password = '{$password_hash}' where user_login = '{$user}'");
}

if($_POST['action'] == "end"){
mysqli_query($link,"UPDATE instances SET ttl = NOW() WHERE lesson_id={$lesson_id}");
mysqli_query($link,"UPDATE lesson SET duration=timestampdiff(MINUTE,lesson_start,now()) WHERE lesson_id={$lesson_id}");
}

if($_POST['action'] == "give"){
$query = mysqli_query($link,"UPDATE lesson SET duration = duration+30 WHERE lesson_id = {$lesson_id}");
$query = mysqli_query($link,"UPDATE instances SET ttl = (ttl + interval 30 minute) WHERE lesson_id = {$lesson_id}");
}
?>
