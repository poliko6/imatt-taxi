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
	
		$pwSQL = "UPDATE drivertaxi SET password = '".sha1($newPW)."' WHERE driverId ='".$driverId."'";
		mysql_query($pwSQL);
		$data['success'] = true;
		$data['message'] = "เปลี่ยนรหัสผ่านสำหรับ Username นี้แล้ว";
		$data['savpw'] = sha1($newPW);

	echo $_GET['callback'].'('.$json->encode($data).')';
?>