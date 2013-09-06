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
	
	//get garageId
	$strSQL = "SELECT garageId FROM majoradmin WHERE username = '".$username."'";
	$strQuery = mysql_query($strSQL);
	$strResult = mysql_fetch_array($strQuery);
	
	//get carImage to DELETE
	$carSQL = "SELECT carImage FROM car WHERE garageId = '".$strResult['garageId']."'";
	$carQuery = mysql_query($carSQL);
	//$carResult = mysql_fetch_array($carQuery);
	
	//get mobileId to DELETE child table
	$mobSQL = "SELECT mobileId FROM car WHERE garageId = '".$strResult['garageId']."'";
	$mobQuery = mysql_query($mobSQL);
	$mobResult = mysql_fetch_array($mobQuery);
	
	//SQL delete data
	$delGarage = "DELETE FROM garagelist WHERE garageId = '".$strResult['garageId']."'";
	$delMJ = "DELETE FROM majoradmin WHERE username = '".$username."'";
	$delMN = "DELETE FROM minoradmin WHERE garageId = '".$strResult['garageId']."'";
	$delCar = "DELETE FROM car WHERE garageId = '".$strResult['garageId']."'";
	$delTrans = "DELETE FROM transportsection WHERE garageId = '".$strResult['garageId']."'";

	$delMobile = "DELETE FROM mobile WHERE garageId = '".$strResult['garageId']."'";
	$delTaxipos = "DELETE FROM taxiposition WHERE mobileId = '".$mobResult['mobileId']."'";
	
	$delTimes = "DELETE FROM timeschedule WHERE garageId = '".$strResult['garageId']."'";
			
	////////////////// DELETE BEGIN //////////////////////
	
	//DELETE majoradmin	and minoradmin
	mysql_query($delMJ);
	mysql_query($delMN);
	
	//DELETE timeschedule
	mysql_query($delTimes);
	
	//DELETE transportsection
	mysql_query($delTrans);
	
	//DELETE taxiposition
	mysql_query($delTaxipos);
	
	//DELETE mobile
	mysql_query($delMob);
	
	//DELETE car and carImage
	while($carResult = mysql_fetch_array($carQuery))
	{
		$carPic = "../../../stored/taxi/".$carResult['carImage']."";
		$carThumb = "../../../stored/taxi/thumbnail/".$carResult['carImage']."";
		
		unlink($carPic);
		unlink($carThumb);
	}
	mysql_query($delCar);
	
	//DELETE garagelist
	mysql_query($delGarage);
	///////////////////////////////////////////////////////////////////////

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
		$data['message'] = 'ลบข้อมูลอู่ "'.$username.'" เรียบร้อยแล้ว';
		
	} 
	else {
		
		$data['success'] = false;
		$data['message'] = 'ลบแท๊กซี่ทะเบียน "'.$username.'" ไม่ได้';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>