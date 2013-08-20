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
	
	
	$fuel_name = trim($fuel_name);
	$fuel_name_temp = trim($fuel_name_temp);
	
	if($fuel_name != $fuel_name_temp){
		
		
		
		$TableName = 'carfuel';
		$data = array(
       	 	'carFuelName'=>$fuel_name
		);
		$sql = update_db($TableName, array('carFuelId='=>$id), $data);
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ปรับปรุงประเภทเชื้อเพลิง "'.$fuel_name_temp.'" เป็น "'.$fuel_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ประเภทเชื้อเพลิง "'.$fuel_name.'" ไม่มีการเปลี่ยนแปลง';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>