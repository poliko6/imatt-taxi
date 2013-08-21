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
	
	
	$car_model_chk = select_db('carmodel',"where carModelId = '".$id."'");
 	$model_name = $car_model_chk[0]['carModelName'];
	
	
	$car_model_chk2 = select_db('car',"where carModelId = '".$id."'");
 	$find_used = count($car_model_chk2);

	if ($find_used == 0){		
		
		$TableName = 'carmodel';
		$sql = delete_db($TableName, array('carModelId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบรุ่นรถ "'.$model_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบรุ่นรถ "'.$model_name.'" ไม่ได้เนื่องจากมีข้อมูลรถยนต์รุ่นนี้ในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>