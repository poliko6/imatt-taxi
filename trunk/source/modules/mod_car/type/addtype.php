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
	
	
	$type_name = trim($type_name);
	$car_type_chk = select_db('cartype',"where carTypeName = '".$type_name."'");
	#print_r($car_type_chk);
 	$find_chk = count($car_type_chk);
	
	if ($find_chk) {
		$data['success'] = false;
		$data['message'] = 'ประเภทรถ "'.$type_name.'" มีแล้วในระบบ';
		
	} else {
		
		$TableName = 'cartype';
		$data = array(
			'carTypeName'=>$type_name
		);
		$sql = insert_db($TableName, $data);
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'เพิ่มประเภทรถ "'.$type_name.'" เรียบร้อยแล้ว';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>