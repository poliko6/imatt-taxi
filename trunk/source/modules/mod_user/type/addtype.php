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
	
	$p_menu = explode(',',$v_menu);
	//pre($p_menu);
		
	
	$type_name = trim($type_name);
	$u_garage = trim($u_garage);
	
	$minor_type_chk = select_db('minortype',"where minorType = '".$type_name."' and garageId = '".$u_garage."'");
 	$find_chk = count($minor_type_chk);
	
	if ($find_chk) {
		$data['success'] = false;
		$data['message'] = 'ประเภทพนักงาน "'.$type_name.'" มีแล้วในระบบ';
		
	} else {
		
		$TableName = 'minortype';
		$data = array(
			'minorType'=>$type_name,
			'garageId'=>$u_garage,
			'menuListId'=>$v_menu
		);
		$sql = insert_db($TableName, $data);
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'เพิ่มประเภทพนักงาน "'.$type_name.'" เรียบร้อยแล้ว';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>