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
	$type_name_temp = trim($type_name_temp);
	
	if($type_name != $type_name_temp){
		
		$car_type_chk = select_db('cartype',"where carTypeName = '".$type_name."'");
 		$find_chk = count($car_type_chk);

		if ($find_chk) {
			$data['success'] = false;
			$data['message'] = 'ประเภทรถ "'.$type_name.'" มีแล้วในระบบ';
		
		} else {
			$TableName = 'cartype';
			$data = array(
				'carTypeName'=>$type_name
			);
			$sql = update_db($TableName, array('carTypeId='=>$id), $data);
			//echo $sql;
			mysql_query($sql);
			
			$data['success'] = true;
			$data['message'] = 'ปรับปรุงประเภทรถ "'.$type_name_temp.'" เป็น "'.$type_name.'" เรียบร้อยแล้ว';
		}
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ประเภทรถ "'.$type_name.'" ไม่มีการเปลี่ยนแปลง';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>