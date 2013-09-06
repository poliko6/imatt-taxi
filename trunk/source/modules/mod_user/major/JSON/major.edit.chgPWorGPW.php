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
	
	// Change Password
	if($type == '1')
	{
		$pwSQL = "UPDATE majoradmin SET password = '".sha1($newPW)."' WHERE garageId ='".$garageId."'";
		mysql_query($pwSQL);
		$data['success'] = true;
		$data['message'] = "เปลี่ยนรหัสผ่านสำหรับ Username นี้แล้ว";
	}
	//Change Garage Password
	else
	{
		$gpwSQL = "UPDATE garagelist SET garagePassword = '".$newPW."' WHERE garageId ='".$garageId."'";
		mysql_query($gpwSQL);
		$data['message'] = "เปลี่ยนรหัสผ่านสำหรับอู่นี้แล้ว";		
	}

	echo $_GET['callback'].'('.$json->encode($data).')';
?>