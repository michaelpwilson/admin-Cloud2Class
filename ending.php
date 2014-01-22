<?php
$link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");
$pool_ref = $_POST['pool_ref'];
$resa = mysqli_query($link, "SELECT pool_id FROM pool WHERE pool_ref = '{$pool_ref}'");
        $rw = mysqli_fetch_row($resa);
        $pool_id = (int)$rw[0];


if($_POST['action'] == "end"){
mysqli_query($link,"UPDATE instances SET ttl = NOW() WHERE pool_ref = '{$pool_ref}' ");
mysqli_query($link,"DELETE FROM lesson WHERE pool_id={$pool_id} ORDER BY lesson_start DESC LIMIT 1");
}

if($_POST['action'] == "give"){
$query = mysqli_query($link,"UPDATE lesson SET duration = duration+30 WHERE pool_id = {$pool_id} ");
var_dump($query);
}

if($_POST['action'] == "restart"){
mysqli_query($link,"DELETE FROM lesson");
mysqli_query($link,"DELETE FROM instances");
}

?>
