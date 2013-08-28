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

	$strSQL = "SELECT majortype.majorType,garagelist.garageShortName,majoradmin.* ";
	$strSQL .= "FROM garagelist,majoradmin,majortype WHERE majoradmin.majorId = '".$majorId."' ";
	$strSQL .= "&& majoradmin.majorTypeId=majortype.majorTypeId ";
	$strSQL .= "&& majoradmin.garageId=garagelist.garageId";
	
	$addSQL = "SELECT province.provinceName,amphur.amphurName,district.districtName ";
	$addSQL .= "FROM province,amphur,district,majoradmin WHERE majoradmin.majorId = '".$majorId."' ";
	$addSQL .= "&& majoradmin.provinceId=province.provinceId ";
	$addSQL .= "&& majoradmin.amphurId=amphur.amphurId ";
	$addSQL .= "&& majoradmin.districtId=district.districtId";
	//$strSQL2 = "SELECT  FROM garagelist,majoradmin WHERE garagelist.garageId=majoradmin.garageId";
	mysql_query("SET NAMES UTF8");
	$objQuery = mysql_query($strSQL) or die (mysql_error());		
	$addQuery = mysql_query($addSQL) or die (mysql_error());			

		//echo $sql;		
		$objResult = mysql_fetch_array($objQuery);
		$addResult = mysql_fetch_array($addQuery);		
		$data['majorId'] = $objResult['majorId'];		
		$data['thaiCompanyName'] = $objResult['thaiCompanyName'];
		$data['englishCompanyName'] = $objResult['englishCompanyName'];	
		$data['managerName'] = $objResult['managerName'];
		$data['username'] = $objResult['username'];
		$data['businessType'] = $objResult['businessType'];
		//ทำ string ที่อยู่
		$strAddress = $objResult['address'];
		$strAddress .= " ".$addResult['districtName'];
		$strAddress .= " ".$addResult['amphurName'];
		$strAddress .= " ".$addResult['provinceName'];
		$strAddress .= " ".$objResult['zipcode'];				
		$data['fullAddress'] = $strAddress;
		$data['mobilePhone'] = $objResult['mobilePhone'];
		$data['telephone'] = $objResult['telephone'];
		$data['fax'] = $objResult['fax'];
		$data['callCenter'] = $objResult['callCenter'];
		$data['email'] = $objResult['email'];
		$data['majorType'] = $objResult['majorType'];
		$data['garageShortName'] = $objResult['garageShortName'];
		
		$data['district'] = " ".$addResult['districtName'];
		$data['amphur'] = " ".$addResult['amphurName'];
		$data['province'] = " ".$addResult['provinceName'];		

	echo $_GET['callback'].'('.$json->encode($data).')';
?>