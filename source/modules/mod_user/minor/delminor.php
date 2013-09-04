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

	$minor_data = select_db('minoradmin',"where minorId = '".$id."'");
 	$firstName = $minor_data[0]['firstName'];
	$lastName = $minor_data[0]['lastName'];
	
	
	$TableName = 'minoradmin';	
	$sql = delete_db($TableName, array('minorId='=>$id));	
	$rs = mysql_query($sql);

	
	if ($rs){	

		$data['success'] = true;
		$data['message'] = 'ลบพนักงาน "'.$firstName.' '.$lastName.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบพนักงาน "'.$firstName.' '.$lastName.'" ไม่ได้เนื่องจากมีข้อมูลถูกใช้งานในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>