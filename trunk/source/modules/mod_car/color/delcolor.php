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
	
	
	$car_color_chk = select_db('carcolor',"where carColorId = '".$id."'");
 	$color_name = $car_color_chk[0]['carColorName'];
	
	
	$car_color_chk2 = select_db('car',"where carColorId = '".$id."'");
 	$find_used = count($car_color_chk2);

	if ($find_used == 0){		
		
		$TableName = 'carcolor';
		$sql = delete_db($TableName, array('carColorId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบสีรถ "'.$color_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบสีรถ "'.$color_name.'" ไม่ได้เนื่องจากมีข้อมูลรถในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>