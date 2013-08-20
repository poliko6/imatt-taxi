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
	
	
	$car_gas_chk = select_db('cargas',"where carGasId = '".$id."'");
 	$gas_name = $car_gas_chk[0]['carGasName'];
	
	
	$car_gas_chk2 = select_db('car',"where carGasId = '".$id."'");
 	$find_used = count($car_gas_chk2);

	if ($find_used == 0){		
		
		$TableName = 'cargas';
		$sql = delete_db($TableName, array('carGasId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบประเภทแก๊สรถยนต์ "'.$gas_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบแก๊สรถยนต์ "'.$gas_name.'" ไม่ได้เนื่องจากมีข้อมูลรถในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>