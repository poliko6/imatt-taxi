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
	
	
	$gas_name = trim($gas_name);
	$gas_name_temp = trim($gas_name_temp);
	
	if($gas_name != $gas_name_temp){
		
		
		
		$TableName = 'cargas';
		$data = array(
       	 	'carGasName'=>$gas_name
		);
		$sql = update_db($TableName, array('carGasId='=>$id), $data);
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ปรับปรุงประเภทแก๊สรถยนต์ "'.$gas_name_temp.'" เป็น "'.$gas_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ประเภทแก๊สรถยนต์ "'.$gas_name.'" ไม่มีการเปลี่ยนแปลง';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>