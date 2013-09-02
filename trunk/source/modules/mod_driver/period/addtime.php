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
	$time1 = trim($time1);
	$time2 = trim($time2);
	$u_garage = trim($u_garage);
	
	
	$time_chk = select_db('timeschedule',"where scheduleName = '".$time_name."' and garageId = '".$u_garage."'");
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
			'timeEnd'=>$time2,
			'garageId'=>$u_garage
		);
		$sql = insert_db($TableName, $data);
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'เพิ่มช่วงเวลา "'.$time_name.'" เรียบร้อยแล้ว';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>