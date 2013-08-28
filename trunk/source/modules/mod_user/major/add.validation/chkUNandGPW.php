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
	console.log("username is ".$username);
	console.log("username is ".$garagePassword);	
		
	$chkSQL = "SELECT username FROM majoradmin WHERE username = '".$username."'";
	$chkSQL2 = "SELECT garagePassword FROM garagelist WHERE garagePassword = '".$garagePassword."'";
	
	mysql_query("SET NAMES UTF8");	
	$chkQuery = mysql_query($chkSQL) or die (mysql_error());			
	$chkQuery2 = mysql_query($chkSQL2) or die (mysql_error());				

		//echo $sql;		
		$chkResult = mysql_fetch_array($chkQuery);
		$chkResult2 = mysql_fetch_array($chkQuery2);
				
		if($chkResult['username']==null)
		{
			$data['username'] = $username;
			$data['username_exist'] = false;
		}
		else
		{
			$data['username'] = $chkResult['username'];
			$data['username_exist'] = true;
		}
		
		if($chkResult2['garagePassword']==null)
		{
			$data['garagePassword'] = $garagePassword;
			$data['garagePW_exist'] = false;
		}
		else
		{
			$data['garagePassword'] = $chkResult2['garagePassword'];
			$data['garagePW_exist'] = true;
		}	

	echo $_GET['callback'].'('.$json->encode($data).')';
?>