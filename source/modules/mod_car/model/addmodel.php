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
	
	
	$model_name = trim($model_name);
	$bannerid = trim($bannerid);
	
	
	$car_model_chk = select_db('carmodel',"where carModelName = '".$model_name."' and carBannerId = '".$bannerid."'");
	#print_r($car_model_chk);
 	$find_chk = count($car_model_chk);
	
	if ($find_chk) {
		$data['success'] = false;
		$data['message'] = 'รุ่นรถ "'.$model_name.'" มีแล้วในระบบ';
		
	} else {
		
		$TableName = 'carmodel';
		$data = array(
			'carModelName'=>$model_name,
			'carBannerId'=>$bannerid
		);
		$sql = insert_db($TableName, $data);
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'เพิ่มรุ่นรถ "'.$model_name.'" เรียบร้อยแล้ว';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>