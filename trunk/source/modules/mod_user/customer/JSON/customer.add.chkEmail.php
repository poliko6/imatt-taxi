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
	$strSQL = "SELECT COUNT(email) AS cEmail FROM customer WHERE email = '".$email."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	
	if($objResult['cEmail']!=0)
	{
		$strRes = "\"".$email."\" ได้เคยใช้ในการลงทะเบียนไปก่อนหน้าแล้ว";
		
		$data['status'] = "Already use";
		$data['exist'] = true;
		$data['response'] = $strRes;
	}	
	else
	{
		$data['status'] = "Can be use";
		$data['exist'] = false;
		$data[response] = "E-mail นี้สามารถใช้งานได้";
	}

	echo $_GET['callback'].'('.$json->encode($data).')';
?>