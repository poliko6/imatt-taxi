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
	$car_gas_chk = select_db('cargas',"where carGasName = '".$gas_name."'");
	#print_r($car_gas_chk);
 	$find_chk = count($car_gas_chk);
	
	if ($find_chk) {
		$data['success'] = false;
		$data['message'] = 'ประเภทแก๊สรถยนต์ "'.$gas_name.'" มีแล้วในระบบ';
		
	} else {
		
		$TableName = 'cargas';
		$data = array(
			'carGasName'=>$gas_name
		);
		$sql = insert_db($TableName, $data);
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'เพิ่มประเภทแก๊สรถยนต์ "'.$gas_name.'" เรียบร้อยแล้ว';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>