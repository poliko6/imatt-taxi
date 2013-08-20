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
	
	
	$car_type_chk = select_db('cartype',"where carTypeId = '".$id."'");
 	$type_name = $car_type_chk[0]['carTypeName'];
	
	
	$car_type_chk2 = select_db('car',"where carTypeId = '".$id."'");
 	$find_used = count($car_type_chk2);

	if ($find_used == 0){		
		
		$TableName = 'cartype';
		$sql = delete_db($TableName, array('carTypeId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบประเภทรถ "'.$type_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบประเภทรถ "'.$type_name.'" ไม่ได้เนื่องจากมีข้อมูลรถในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>