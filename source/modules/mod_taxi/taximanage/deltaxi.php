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
	
	
	$car_chk = select_db('transportsection',"where carId = '".$id."'");
 	$find_used = count($car_chk);
	
	
	$car_data = select_db('car',"where carId = '".$id."'");
 	$carRegistration = $car_data[0]['carRegistration'];
	

	if ($find_used == 0){		
		
		$TableName = 'car';
		$sql = delete_db($TableName, array('carId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบแท๊กซี่ทะเบียน "'.$carRegistration.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบแท๊กซี่ทะเบียน "'.$carRegistration.'" ไม่ได้เนื่องจากมีข้อมูลแท๊กซี่ถูกใช้งานในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>