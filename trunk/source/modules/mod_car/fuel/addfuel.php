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
	$car_fuel_chk = select_db('carfuel',"where carFuelName = '".$fuel_name."'");
	#print_r($car_fuel_chk);
 	$find_chk = count($car_fuel_chk);
	
	if ($find_chk) {
		$data['success'] = false;
		$data['message'] = 'ประเภทเชื้อเพลิง "'.$fuel_name.'" มีแล้วในระบบ';
		
	} else {
		
		$TableName = 'carfuel';
		$data = array(
			'carFuelName'=>$fuel_name
		);
		$sql = insert_db($TableName, $data);
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'เพิ่มประเภทเชื้อเพลิง "'.$fuel_name.'" เรียบร้อยแล้ว';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>