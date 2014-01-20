<?php
$link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");

if($_POST['action'] == "end"){
$pool_ref = $_POST['pool_ref'];
mysqli_query($link,"UPDATE instances SET ttl = NOW() WHERE pool_ref = '{$pool_ref}' ");
}

if($_POST['action'] == "give"){
mysqli_query($link,"UPDATE lesson SET duration = duration+30 WHERE pool_ref = '{$pool_ref}' ");
var_dump($pool_ref);
}

?>
