<?php
  // database connection
  $link = mysqli_connect("cpd-db", "cpd", "dkfj55.1", "cpd");

  // post variables coming through from ajax
  $user_login = $_POST['user_login'];
  $action=$_POST["action"];

  // If the action is set to show the instances
  if($action=="showcomment"){
     // get the lesson pool variable from ajax
     $lesson_pool = $_POST['lesson_pool'];
      // select from instances where the pool ref = lesson_pool
      $show=mysqli_query($link, "Select * from instances where pool_ref = '" . $lesson_pool . "' order by instance_state desc");
      // count the amount of rows
      $row_cnt = mysqli_num_rows($show);
      echo '<div class="sidebar-helper">
      <text class="amount_instances" style="float:right; margin-left:10px; display:';
      if($row_cnt <= 0){ 
      echo "none"; 
      } else {
	echo "block";
      }
      echo '">' . $row_cnt  . ' instances</text></div>';
        // if the row count is more than or equal to 1
        if($row_cnt >= 1){
          // loop through all of our instances
          while($row = mysqli_fetch_array($show))
            {
                echo '<li style="border-bottom:1px solid #eee;"><a href="#">';

		// if the instance is set to Ready
                if($row[instance_state] == 'Ready')
                {
                    echo '<b class="glyphicon glyphicon-tasks" style="color:green; font-size:28px; position:relative; top:13px; right:25px;"></b>';
                } 
		// if the instance state is set to Failed or Shutting down
		elseif($row[instance_state] == 'Failed' || $row[instance_state] == 'Shutting Down')
                {
                    echo '<b class="glyphicon glyphicon-tasks" style="color:red; font-size:28px; position:relative; top:13px; right:25px;"></b>';
                }
		// if the instance state is set to In use
                if($row[instance_state] == 'In Use')
                {
                    echo '<b class="glyphicon glyphicon-tasks" style="font-size:28px; position:relative; top:13px; right:25px;"></b>';
                } 
		// if the instance state is set to Launching
		elseif($row[instance_state] == 'Launching')
                {
                    echo '<b class="glyphicon glyphicon-tasks" style="color:blue; font-size:28px; position:relative; top:13px; right:25px;"></b>';
                }
		// if the instance state is set to Requested
                if($row[instance_state] == 'Requested')
                {
                    echo '<b class="glyphicon glyphicon-tasks" style="color:#eee; font-size:28px; position:relative; top:13px; right:25px;"></b>';
                }

		// set the rest of the html
                echo '<text style="font-weight:bold; padding-left:5px;">' . $row[instance_name] . '</text><text class="pull-right" id="instance_state" style="padding-right:15px; font-size:11px;">' . $row[instance_state] . '</text>';
                echo '<br><text style="font-size:11px; float:right; margin-right:5%; margin-top:-27px;">expires: ' . date("H:i", strtotime($row[ttl])) . '</text>';
                echo '</a></li>';
            }
        } else
        {
	    // if there are no instances then show our Logo
            echo '<li><img class="none_instance" src="views/c2c-logo.png"/></li>';
       }
    } elseif($action=="addcomment")
    {
	// the name of the pool we are launching a lesson on
	$pool = mysqli_real_escape_string($link, $_POST['pool']);
        $resa = mysqli_query($link, "SELECT pool_id FROM pool WHERE pool_ref = '{$pool}'");
        $rw = mysqli_fetch_row($resa);
	//get the pool id
        $pool_id = intval($rw[0]);
	// other variables passed through ajax
        $lesson_type = mysqli_real_escape_string($link, $_POST['lesson_type']);
        $no_instances = intval($_POST['instances']);
        $lesson_duration = intval($_POST['lesson_duration']);
        $user_id = intval($_POST['user_id']);
	$sudo = intval($_POST['sudo']);
	// large sql query for inserted into the lesson table
        $sql = "INSERT INTO lesson (user_id, pool_id, lesson_start, duration, mounts, instance_type, sudo_root) VALUES ({$user_id}, {$pool_id}, NOW(), {$lesson_duration}, 'uploads:resources', '{$lesson_type}', {$sudo})";

	// development query checker FLAG	
	if (!mysqli_query($link,$sql))
        {
            die('Error: ' . mysqli_error($link));
        }
	// the id of the inserted lesson
        $lesson_id = mysqli_insert_id($link);
        echo $lesson_id;
	// now we insert into the instances table
        $anuv = "insert into instances (instance_name, instance_state, instance_type, lesson_id, ttl, pool_ref) values('Unassigned', 'Requested', '" . $lesson_type  . "', " . $lesson_id  . ", now() + INTERVAL " . $lesson_duration * 60  . " SECOND, '{$pool}' )";

	// loop depending on the choosen amount of instances
        for($i=0;$i<$no_instances;$i++)
        {
            if (!mysqli_query($link,$anuv))
            {
                die('Error: ' . mysqli_error($link));
            }
        }
    }
?>
