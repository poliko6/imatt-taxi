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
	$chkSQL = "SELECT garagePassword FROM garagelist WHERE garageId = '".$garageId."'";

		
//	$chkSQL = "SELECT garageShortName FROM garagelist WHERE garageShortName = '".$garageShortName."'";
	mysql_query("SET NAMES UTF8");	
	$chkQuery = mysql_query($chkSQL) or die (mysql_error());			

		//echo $sql;		
		$chkResult = mysql_fetch_array($chkQuery);
		if($chkResult['garagePassword']==$garagePassword)		
		{
			$data['correct'] = true;	
		}
		else
			$data['correct'] = false;
		
/*		if($chkResult['garageShortName']==null)
		{
			$data['garageShortName'] = "Can be Add";
			$data['exist'] = false;
		}
		else
		{
			$data['garageShortName'] = $chkResult['garageShortName'];
			$data['exist'] = true;
		}
	*/

	echo $_GET['callback'].'('.$json->encode($data).')';
?>