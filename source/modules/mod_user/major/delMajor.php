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
	
	$delMJ = "DELETE FROM majoradmin WHERE username = '".$username."'";
	
	//get garageId
	$strSQL = "SELECT garageId FROM majoradmin WHERE username = '".$username."'";
	$strQuery = mysql_query($strSQL);
	$strResult = mysql_fetch_array($strQuery);
	//SQL delete garagelist data
	$delGarage = "DELETE FROM garagelist WHERE garageId = '".$strResult['garageId']."'";
			
	mysql_query($delMJ);
	mysql_query($delGarage);

	//check delete was done
	$chkMJ = "SELECT username FROM majoradmin WHERE username ='".$username."'";
	$mjQuery = mysql_query($chkMJ);
	$mjResult = mysql_fetch_array($mjQuery);
	echo "Value major check ".$mjResult;
	$chkGarage = "SELECT garageId FROM garagelist WHERE garageId = '".$strResult."'";
	$grQuery = mysql_query($chkGarage);
	$grResult = mysql_fetch_array($grQuery);
	echo "Value garage check ".$grResult;

	if ($mjResult['username']==null && $grResult['garageId']==null){	
		
		$data['success'] = true;
		$data['message'] = 'ลบแท๊กซี่ทะเบียน "'.$username.'" เรียบร้อยแล้ว';
		
	} 
	else {
		
		$data['success'] = false;
		$data['message'] = 'ลบแท๊กซี่ทะเบียน "'.$username.'" ไม่ได้';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>