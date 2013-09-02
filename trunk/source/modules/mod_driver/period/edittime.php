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
	

	$time_name = trim($time_name);
	$time_name_temp = trim($time_name_temp);
	$time1 = trim($time1);
	$time1_temp = trim($time1_temp);
	$time2 = trim($time2);
	$time2_temp = trim($time2_temp);
	$u_garage = trim($u_garage);
	
	if(($time_name != $time_name_temp) || ($time1 != $time1_temp) || ($time2 != $time2_temp)){
		
		$time_chk = select_db('timeschedule',"where scheduleName = '".$time_name."' and timeStart  = '".$time1."'  and timeEnd  = '".$time2."' and garageId = '".$u_garage."'");
		#print_r($car_type_chk);
 		$find_chk = count($time_chk);
	
		if ($find_chk) {
			
			$data['success'] = false;
			$data['message'] = 'ช่วงเวลา "'.$time_name.'" มีแล้วในระบบ';
		
		} else {
			
			$TableName = 'timeschedule';
			$data = array(
				'scheduleName'=>$time_name,
				'timeStart'=>$time1,
				'timeEnd'=>$time2
			);
			$sql = update_db($TableName, array('timeScheduleId='=>$id), $data);
			//echo $sql;
			mysql_query($sql);
		
			$data['success'] = true;
			$data['message'] = 'ปรับปรุงช่วงเวลา "'.$time_name_temp.'" เรียบร้อยแล้ว';
		}
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ช่วงเวลา "'.$time_name.'" ไม่มีการเปลี่ยนแปลง';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>