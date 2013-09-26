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
	
	
	$color_name = trim($color_name);
	$car_color_chk = select_db('carcolor',"where carColorName = '".$color_name."'");
	#print_r($car_color_chk);
 	$find_chk = count($car_color_chk);
	
	if ($find_chk) {
		$data['success'] = false;
		$data['message'] = 'สีรถ "'.$color_name.'" มีแล้วในระบบ';
		
	} else {
		
		$TableName = 'carcolor';
		$data = array(
			'carColorName'=>$color_name,
			'garageId'=>$garageId
		);
		$sql = insert_db($TableName, $data);
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'เพิ่มสีรถ "'.$color_name.'" เรียบร้อยแล้ว';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>