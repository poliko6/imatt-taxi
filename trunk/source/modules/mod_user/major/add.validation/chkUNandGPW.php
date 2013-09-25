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

	//check exist from table major driver minor customer
	$chkSQL = "SELECT username FROM majoradmin WHERE username = '".$username."'";
	$chkSQL2 = "SELECT username FROM drivertaxi WHERE username = '".$username."'";
	$chkSQL3 = "SELECT username FROM minoradmin WHERE username = '".$username."'";
	$chkSQL4 = "SELECT email FROM customer WHERE email = '".$username."'";
	
	$chkQuery = mysql_query($chkSQL) or die (mysql_error());			
	$chkResult = mysql_fetch_array($chkQuery);
	
	$chkQuery2 = mysql_query($chkSQL2) or die (mysql_error());			
	$chkResult2 = mysql_fetch_array($chkQuery2);
	
	$chkQuery3 = mysql_query($chkSQL3) or die (mysql_error());			
	$chkResult3 = mysql_fetch_array($chkQuery3);
	$chkQuery4 = mysql_query($chkSQL4) or die (mysql_error());			
	$chkResult4 = mysql_fetch_array($chkQuery4);

				
	$chkSQL5 = "SELECT garagePassword FROM garagelist WHERE garagePassword = '".$garagePassword."'";	
	$chkQuery5 = mysql_query($chkSQL5) or die (mysql_error());				
	$chkResult5 = mysql_fetch_array($chkQuery5);
			
	if($chkResult['username'] == null && $chkResult2['username'] == null && $chkResult3['username'] == null && $chkResult4['email'] == null)
	{
		$data['username'] = $username;
		$data['username_exist'] = false;
	}
	else
	{
		$data['username'] = $chkResult['username'];
		$data['username_exist'] = true;
	}
	
	if($chkResult5['garagePassword']==null)
	{
		$data['garagePassword'] = $garagePassword;
		$data['garagePW_exist'] = false;
	}
	else
	{
		$data['garagePassword'] = $chkResult5['garagePassword'];
		$data['garagePW_exist'] = true;
	}	

	echo $_GET['callback'].'('.$json->encode($data).')';
?>