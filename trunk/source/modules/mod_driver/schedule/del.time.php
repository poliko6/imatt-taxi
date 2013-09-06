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
	
	
	$time_data = select_db('transportsection',"where transportSectionId = '".$id."'");
 	$driverId = $time_data[0]['driverId'];
	
	$driver_data = select_db('drivertaxi',"where driverId = '".$driverId."'");
 	$name = $driver_data[0]['firstName'].' '.$driver_data[0]['lastName'] ;
	
	$TableName = 'transportsection';
	$sql = delete_db($TableName, array('transportSectionId='=>$id));
	$rs = mysql_query($sql);

	if ($rs){	
		
		$data['success'] = true;
		$data['message'] = 'ยกเลิกคุณ "'.$name.'" จากการลงเวลางานเรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ผิดพลาดในการยกเลิก กรุณาลองอีกครั้ง';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>