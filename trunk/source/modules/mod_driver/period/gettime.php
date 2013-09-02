<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$time_chk = select_db('timeschedule',"where timeScheduleId = '".$id."'");
 	$time_name = $time_chk[0]['scheduleName'];
	$time1 = $time_chk[0]['timeStart'];
	$time2 = $time_chk[0]['timeEnd'];
	
	$p_time1 = explode(":", $time1);
	$p_time2 = explode(":", $time2);
	
	$thist1 = $p_time1[0].':'.$p_time1[1];
	$thist2 = $p_time2[0].':'.$p_time2[1];
	
	echo $time_name.','.$thist1.','.$thist2;
?>