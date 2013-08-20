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
	$color_name_temp = trim($color_name_temp);
	
	if($color_name != $color_name_temp){
		
		
		
		$TableName = 'carcolor';
		$data = array(
       	 	'carColorName'=>$color_name
		);
		$sql = update_db($TableName, array('carColorId='=>$id), $data);
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ปรับปรุงสีรถ "'.$color_name_temp.'" เป็น "'.$color_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'สีรถ "'.$color_name.'" ไม่มีการเปลี่ยนแปลง';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>