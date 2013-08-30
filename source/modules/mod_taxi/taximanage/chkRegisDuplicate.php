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
	
	$carRegistration = trim($carRegistration);
	
	if ($act == 'add') { 	
		$car_chk = select_db('car',"where carRegistration = '".$carRegistration."' and provinceId = '".$provinceId."'");
 		$find_used = count($car_chk);
	} 
	
	
	if ($act == 'edit'){
		if ((trim($carRegistration) == trim($carRegistrationTmp)) && (trim($provinceId) == trim($provinceIdTmp))){
			$find_used = 0;
		} else {
			//Check ป้ายทะเบียนซ้ำ	
			$find_used = count_data_mysql('carId','car',"carRegistration = '".trim($carRegistration)."' and provinceId = '".$provinceId."'");
		}	
	}
	
	if ($find_used == 0){			
		$data['success'] = true;
		$data['message'] = 'แท๊กซี่ทะเบียน "'.$carRegistration.'" ใช้งานได้';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ใช้แท๊กซี่ทะเบียน "'.$carRegistration.'" ไม่ได้เนื่องจากมีข้อมูลแท๊กซี่ถูกใช้งานในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>