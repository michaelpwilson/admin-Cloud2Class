<?php
$link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");
$action=$_POST["action"];
	if($action=="showcomment"){
     $show=mysqli_query($link, "Select * from instances order by ttl desc");
     while($row = mysqli_fetch_array($show)){
        echo '<li style="border-bottom:1px solid darkblue;"><a href="#"><b class="glyphicon glyphicon-tasks" style="color:green; font-size:28px; position:relative; top:13px; right:25px;"></b><text style="font-weight:bold; padding-left:5px;">' . $row[instance_name] . '</text><text class="pull-right" style="padding-right:15px; font-size:11px;">' . $row[instance_state] . '</text>';
 echo '<br><text style="font-size:11px; float:right; margin-right:5%; margin-top:-27px;">' . $row[ttl] . '</text>';
 echo '</a></li>';
     }
  }
else if($action=="addcomment"){
    $name=$_POST["name"];
    $message=$_POST["message"];
     $query=mysql_query("INSERT INTO comment(name,message) values('$name','$message') ");
     if($query){
        echo "Your comment has been sent";
     }
     else{
        echo "Error in sending your comment";
     }
  }
?>
