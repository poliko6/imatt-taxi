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
	
	
	$mobile_model_chk = select_db('mobilemodel',"where mobileModelId = '".$id."'");
 	$model_name = $mobile_model_chk[0]['mobileModelName'];
	
	
	$mobile_model_chk2 = select_db('mobile',"where mobileModelId = '".$id."'");
 	$find_used = count($mobile_model_chk2);

	if ($find_used == 0){		
		
		$TableName = 'mobilemodel';
		$sql = delete_db($TableName, array('mobileModelId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบรุ่นมือถือ "'.$model_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบรุ่นมือถือ "'.$model_name.'" ไม่ได้เนื่องจากมีข้อมูลมือถือรุ่นนี้ในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>