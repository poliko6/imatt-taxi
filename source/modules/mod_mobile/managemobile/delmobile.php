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
	
	//Check On Table transportsection
	$mobile_chk = select_db('transportsection',"where mobileId = '".$id."'");
 	$find_used = count($mobile_chk);
	
	//taxiPosition
	$position_chk = select_db('taxiposition',"where mobileId = '".$id."'");
 	$find_used2 = count($position_chk);
	
	$mobile_data = select_db('mobile',"where mobileId = '".$id."'");
 	$mobileNumber = $mobile_data[0]['mobileNumber'];
	
	if (($find_used == 0) && ($find_used2 == 0)){	

		/*$TableName = 'mobile';
		$data = array(		
			'dateUpdate'=>date('Y-m-d H:i:s'),		
			'checkDelete'=>'d'
		);
		$sql = update_db($TableName, array('mobileId='=>$id), $data);*/
		
		$TableName = 'mobile';
		$sql = delete_db($TableName, array('mobileId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบโทรศัพท์หมายเลข "'.$mobileNumber.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบโทรศัพท์หมายเลข "'.$mobileNumber.'" ไม่ได้เนื่องจากมีข้อมูลโทรศัพท์ถูกใช้งานในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>