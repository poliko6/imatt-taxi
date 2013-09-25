<?
    require_once '../../../../include/Zend/JSON.php';
    $json = new Services_JSON();
	
	include("../../../../include/class.mysqldb.php");
	include("../../../../include/config.inc.php");
	include("../../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	$canpass = 1;
	//check driver table
	$strSQL = "SELECT COUNT(citizenId) AS cID FROM drivertaxi WHERE citizenId = '".$citizenId."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	
	if($objResult['cID']!=0)
	{
		$data['status'] = "Already use";
		$data['exist'] = true;
		
		$driChkSQL = "SELECT drivertaxi.*,majoradmin.thaiCompanyName FROM drivertaxi,majoradmin ";
		$driChkSQL .= "WHERE drivertaxi.citizenId = '".$citizenId."' AND drivertaxi.garageId = majoradmin.garageId";
		$driChkQuery = mysql_query($driChkSQL);
		$driChkResult = mysql_fetch_array($driChkQuery);
		if($driChkResult['garageId']!=0 && $u_type != '1')
		{
			$strRes = "ผู้ขับ \"<b>".$driChkResult['firstName']." ".$driChkResult['lastName'];
			$strRes .= "</b>\" ได้สังกัดอู่ \"<b>".$driChkResult['thaiCompanyName']."\"</b> แล้ว ";
			$strRes .= "<br />โดยผู้ขับจะต้องยกเลิกสังกัดกับอู่เดิมก่อน จึงจะสามารถเข้าสังกัดอู่ใหม่ได้";
			$data['g_exist'] = true;
			$data['response'] = $strRes;
		}
		else
		{
			$driSQL = "SELECT drivertaxi.*,majoradmin.thaiCompanyName FROM drivertaxi,majoradmin ";
			$driSQL .= "WHERE drivertaxi.citizenId = '".$citizenId."'";
			$driQuery = mysql_query($driSQL);
			$driResult = mysql_fetch_array($driQuery);			
			$strRes = "ผู้ขับ \"<b>".$driResult['firstName']." ".$driResult['lastName'];
			$strRes .= "</b>\" ได้เคยลงทะเบียนไว้แล้ว";
			
			if($driResult['garageId'] == 0)	$strRes .= " แต่ยังไม่ได้สังกัดอู่ใด";
			
			$data['g_exist'] = false;
			$data['response'] = $strRes;
			$data['fName'] = $driResult['firstName'];
			$data['lName'] = $driResult['lastName'];
			$data['driverImg'] = $driResult['driverImage'];
			$data['birthDay'] = $driResult['driverBirthday'];
			$data['dLicense'] = $driResult['licenseNumber'];
			$data['txtAddress'] = $driResult['address'];
			$data['txtZipcode'] = $driResult['zipcode'];
			$data['txtMobilePhone'] = $driResult['mobilePhone'];
			$data['txtTel'] = $driResult['telephone'];
			$data['userName'] = $driResult['username'];
			$data['province_ss'] = $driResult['provinceId'];
			$data['amphur_ss'] = $driResult['amphurId'];
			$data['district_ss'] = $driResult['districtId'];
			$data['garageId'] = $driResult['garageId'];
		}
	}	
	else
	{
		$data['status'] = "Can be use";
		$data['exist'] = false;
	}

	echo $_GET['callback'].'('.$json->encode($data).')';
?>