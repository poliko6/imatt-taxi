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
		
	//SQL delete data
	$delDriver = "UPDATE drivertaxi SET garageId = 0 WHERE driverId ='".$driverId."'";
			
	////////////////// DELETE BEGIN //////////////////////
	
	$delQuery = mysql_query($delDriver);	
		
	///////////////////////////////////////////////////////////////////////

	$data['success'] = true;
	$data['message'] = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>