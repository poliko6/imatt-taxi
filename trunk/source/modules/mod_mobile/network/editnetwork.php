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
	
	
	$network_name = trim($network_name);
	$network_name_temp = trim($network_name_temp);
	
	if($network_name != $network_name_temp){
		
		$mobile_network_chk = select_db('mobilenetwork',"where mobileNetworkName = '".$network_name."'");
		#print_r($mobile_network_chk);
		$find_chk = count($mobile_network_chk);
		
		if ($find_chk) {
			$data['success'] = false;
			$data['message'] = 'เครือข่ายมือถือ "'.$network_name.'" มีแล้วในระบบ';
			
		} else {
		
			$TableName = 'mobilenetwork';
			$data = array(
				'mobileNetworkName'=>$network_name
			);
			$sql = update_db($TableName, array('mobileNetworkId='=>$id), $data);
			//echo $sql;
			mysql_query($sql);
			
			$data['success'] = true;
			$data['message'] = 'ปรับปรุงเครือข่ายมือถือ "'.$network_name_temp.'" เป็น "'.$network_name.'" เรียบร้อยแล้ว';
		}
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'เครือข่ายมือถือ "'.$network_name.'" ไม่มีการเปลี่ยนแปลง';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>