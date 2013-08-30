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

	$find_used = 0;
	
	$mobileNumber = trim($mobileNumber);
	$EmiMsi = trim($EmiMsi);
	
	if ($act == 'add') { 	
		$mobile_chk = select_db('mobile',"where mobileNumber = '".$mobileNumber."'");
 		$find_number_used = count($mobile_chk);
		
		$mobile_chk = select_db('mobile',"where EmiMsi = '".$EmiMsi."'");
 		$find_emi_used = count($mobile_chk);		
	} 
	
	
	if ($act == 'edit'){		
		if (trim($mobileNumber) == trim($mobileNumberTmp)){
			$find_number_used = 0;
		} else {
			//Check ป้ายทะเบียนซ้ำ	
			$find_number_used = count_data_mysql('mobileId','mobile',"mobileNumber = '".trim($mobileNumber)."'");
		}	
		
		if (trim($EmiMsi) == trim($EmiMsiTmp)){
			$find_emi_used = 0;
		} else {
			//Check ป้ายทะเบียนซ้ำ	
			$find_emi_used = count_data_mysql('mobileId','mobile',"EmiMsi = '".trim($EmiMsi)."'");
		}	
		
		
	}
	
	
	if ($find_number_used == 0){			
		$data['number'] = true;
		$data['message1'] = 'หมายเลขโทรศัพท์ "'.$mobileNumber.'" ใช้งานได้';
		
	} else {
		
		$data['number'] = false;
		$data['message1'] = 'เพิ่มหมายเลขโทรศัพท์ "'.$mobileNumber.'" ไม่ได้เนื่องจากมีข้อมูลถูกใช้งานในระบบ';
	}
	
	
	if ($find_emi_used == 0){			
		$data['emi'] = true;
		$data['message2'] = 'Emi/Msi "'.$EmiMsi.'" ใช้งานได้';
		
	} else {
		
		$data['emi'] = false;
		$data['message2'] = 'Emi/Msi "'.$EmiMsi.'" ไม่ได้เนื่องจากมีข้อมูลถูกใช้งานในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>