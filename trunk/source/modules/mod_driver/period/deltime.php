<?
    require_once '../../../include/Zend/JSON.php';
    $json = new Services_JSON();
	
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	$find_used = 0;
	
	$time_chk = select_db('timeschedule',"where timeScheduleId = '".$id."'");
 	$time_name = $time_chk[0]['scheduleName'];
	
	
	//$time_chk2 = select_db('transportsection',"where timeScheduleId = '".$id."'");
 	//$find_used = count($time_chk2);
	
	if ($find_used == 0){		
		
		$TableName = 'timeschedule';
		$sql = delete_db($TableName, array('timeScheduleId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบช่วงเวลา "'.$time_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบช่วงเวลา "'.$time_name.'" ไม่ได้เนื่องจากมีข้อมูลใช้งานอยู่ี้ในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>