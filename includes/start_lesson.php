<form action="/" style="" method="post" class="start_lesson">
<?php

$link= mysqli_connect("cpd-db","cpd","dkfj55.1","cpd");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
<h1><a href="#" class="gobacktopools" style="display:none;"><b style="float:left;" class="glyphicon glyphicon-arrow-left"></b></a>Create a Lesson <a id="menu-toggle" href="#" class="btn btn-success"><i class="glyphicon glyphicon-align-right"></i></a></h1>
<hr>
<div class="pool-buttons">
<h3>choose a Class:</h3>
<?php

$pool_list = mysqli_query($link, "select up.pool_id, p.pool_ref from user_pool up, pool p where up.user_id={$user_id} and up.pool_id=p.pool_id");

while($row = mysqli_fetch_row($pool_list))
{
    $pool_id=(int)$row[0];
    $pool_ref=$row[1];
    $pool_count=$row[2];

    $current_lesson = mysqli_query($link, "SELECT lesson_id FROM lesson WHERE pool_id=$pool_id and  (lesson_start + interval duration minute > now())");
    $row_cnt = mysqli_num_rows($current_lesson);
    $rowx = mysqli_fetch_row($current_lesson);
    if($row_cnt)
    {
        # Get count of instances
        $instance_count = mysqli_query($link, "SELECT count(*) from instances where pool_ref=\"$pool_ref\"");
        $inst_count = mysqli_fetch_row($instance_count);

        $lesson_id=(int)$rowx[0]; 

        $current = date("H:i:s");
        $time_now = strtotime($current);

        print "<div class=\"btn btn-success\" style=\"min-width:100px; max-width:100px; text-align:left; font-size:20px; margin-top:20px; \">";
        print "<a style=\"color:white\" value=\"$pool_ref\">";
        print "<b class=\"glyphicon glyphicon-asterisk\" style=\"float:left; padding-right:23px; margin-top:3px;\"></b>$pool_ref<input type=\"hidden\" id=\"lesson_id\" value=\"{$lesson_id}\"/></a></div><br>";
    }
    elseif($row_cnt == 0 | $row_cnt < 1 | $rowx[2] == "Shutting Down")
    {
        print "<div class=\"btn btn-primary\" style=\"min-width:100px; max-width:100px; text-align:left; font-size:20px; margin-top:20px;\">";
        print "<input type=\"radio\" value=\"$pool_ref\" id=\"pool\" name=\"pool\">$pool_ref</div><br>";
    }
}

?>
</div>
<div class="bottom-half" style="display:none;">
<h3>type of machine:</h3>
<select id="lesson_type" name="lesson_type" class="lesson-dropdown form-control">
<?php

$q = "select type_desc from type";
$res = mysqli_query($link, $q);
while($row = mysqli_fetch_row($res))
{
    print "<option value=\"$row[0]\">$row[0]</option>";

}

?>
</select> 
<h3>number of instances:</h3>
<a href="#"><i class="glyphicon glyphicon-chevron-left" id="subtract"></i></a><input style="border:0; width:5%; font-size:28px;" id="example" name="instances" type="text" value="7"/><a href="#"><i id="add" class="glyphicon glyphicon-chevron-right"></i></a>
<h3>duration of lesson:</h3>
<select name="lesson_duration" id="lesson_duration" class="lesson-dropdown form-control">
  <option value="30">30 minutes</option>
  <option value="60">60 minutes</option>
  <option value="90">90 minutes</option>
</select>
<input type="submit" name="lesson_go" value="Go!" style="margin-top:15px" class="btn-success btn btn-lg"/>
</div>
</form>
