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
	$strSQL = "SELECT COUNT(username) AS cDriver FROM drivertaxi WHERE username = '".$username."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);

	//check major table
	$strSQL2 = "SELECT COUNT(username) AS cMajor FROM majoradmin WHERE username = '".$username."'";
	$objQuery2 = mysql_query($strSQL2);
	$objResult2 = mysql_fetch_array($objQuery2);
	
	//check minor table
	$strSQL3 = "SELECT COUNT(username) AS cMinor FROM minoradmin WHERE username = '".$username."'";
	$objQuery3 = mysql_query($strSQL3);
	$objResult3 = mysql_fetch_array($objQuery3);
	
	//check customer table
	$strSQL4 = "SELECT COUNT(email) AS cCustomer FROM customer WHERE email = '".$username."'";
	$objQuery4 = mysql_query($strSQL4);
	$objResult4 = mysql_fetch_array($objQuery4);
	
	if($objResult['cDriver']!=0 || $objResult2['cMajor']!=0 || $objResult3['cMinor']!=0 || $objResult4['cCustomer']!=0)
	{
		$data['status'] = "Already use";
		$data['exist'] = true;
	}	
	

	else
	{
		$data['status'] = "Can be use";
		$data['exist'] = false;
	}

	echo $_GET['callback'].'('.$json->encode($data).')';
?>