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
	$strSQL = "SELECT COUNT(citizenId) AS cID FROM customer WHERE citizenId = '".$citizenId."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	
	if($objResult['cID']!=0)
	{
		$strRes = "<b>หมายเลขบัตรประชาชน \"".$citizenId."\" ได้เคยลงทะเบียนไว้แล้ว</b>";
		
		$data['status'] = "Already use";
		$data['exist'] = true;
		$data['response'] = $strRes;
	}	
	else
	{
		$data['status'] = "Can be use";
		$data['exist'] = false;
	}

	echo $_GET['callback'].'('.$json->encode($data).')';
?>