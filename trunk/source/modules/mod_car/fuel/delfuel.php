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
	
	
	$car_fuel_chk = select_db('carfuel',"where carFuelId = '".$id."'");
 	$fuel_name = $car_fuel_chk[0]['carFuelName'];
	
	
	$car_fuel_chk2 = select_db('car',"where carFuelId = '".$id."'");
 	$find_used = count($car_fuel_chk2);

	if ($find_used == 0){		
		
		$TableName = 'carfuel';
		$sql = delete_db($TableName, array('carFuelId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบประเภทเชื้อเพลิง "'.$fuel_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบสีรถ "'.$fuel_name.'" ไม่ได้เนื่องจากมีข้อมูลรถในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>