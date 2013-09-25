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
	
	
	$mobile_network_chk = select_db('mobilenetwork',"where mobileNetworkId = '".$id."'");
 	$network_name = $mobile_network_chk[0]['mobileNetworkName'];
	
	
	$mobile_network_chk2 = select_db('mobile',"where mobileNetworkId = '".$id."'");
 	$find_used = count($mobile_network_chk2);

	if ($find_used == 0){		
		
		$TableName = 'mobilenetwork';
		$sql = delete_db($TableName, array('mobileNetworkId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบเครือข่ายมือถือ "'.$network_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบเครือข่ายมือถือ "'.$network_name.'" ไม่ได้เนื่องจากมีข้อมูลมือถือใช้งานเครือข่ายนี้ในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>