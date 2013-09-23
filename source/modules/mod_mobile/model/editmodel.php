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
	
	
	$model_name = trim($model_name);
	$model_name_temp = trim($model_name_temp);
	
	if($model_name != $model_name_temp){
		
		$mobile_model_chk = select_db('mobilemodel',"where mobileModelName = '".$model_name."' and mobileBannerId = '".$bannerid."'");
		#print_r($mobile_model_chk);
		$find_chk = count($mobile_model_chk);
		
		if ($find_chk) {
			$data['success'] = false;
			$data['message'] = 'รุ่นมือถือ "'.$model_name.'" มีแล้วในระบบ';
			
		} else {
		
			$TableName = 'mobilemodel';
			$data = array(
				'mobileModelName'=>$model_name
			);
			$sql = update_db($TableName, array('mobileModelId='=>$id), $data);
			//echo $sql;
			mysql_query($sql);
			
			$data['success'] = true;
			$data['message'] = 'ปรับปรุงรุ่นมือถือ "'.$model_name_temp.'" เป็น "'.$model_name.'" เรียบร้อยแล้ว';
		}
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'รุ่นมือถือ "'.$model_name.'" ไม่มีการเปลี่ยนแปลง';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>