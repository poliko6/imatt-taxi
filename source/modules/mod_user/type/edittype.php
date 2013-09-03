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
	
	
	$type_name = trim($type_name);
	$type_name_temp = trim($type_name_temp);
	
	$v_menu = trim($v_menu);
	$temp_menu = trim($temp_menu);
	
	$u_garage = trim($u_garage);

	
	if(($type_name != $type_name_temp) || ($v_menu != $temp_menu)) {
		
		$minor_type_chk = select_db('minortype',"where minorType = '".$type_name."' and menuListId = '".$v_menu."'");
 		$find_chk = count($minor_type_chk);

		if ($find_chk) {
			$data['success'] = false;
			$data['message'] = 'ประเภทพนักงาน "'.$type_name.'" มีแล้วในระบบ';
		
		} else {
			$TableName = 'minortype';
			$data = array(
				'minorType'=>$type_name,
				'menuListId'=>$v_menu,
				'dateUpdated'=>date('Y-m-d H:i:s')
			);
			$sql = update_db($TableName, array('minorTypeId='=>$id), $data);
			//echo $sql;
			mysql_query($sql);
			
			$data['success'] = true;
			$data['message'] = 'ปรับปรุงประเภทพนักงาน "'.$type_name_temp.'" เรียบร้อยแล้ว';
		}
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ประเภทพนักงาน "'.$type_name.'" ไม่มีการเปลี่ยนแปลง';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>