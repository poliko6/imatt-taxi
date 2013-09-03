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
	
	
	$minor_type_chk = select_db('minortype',"where minorTypeId = '".$id."'");
 	$type_name = $minor_type_chk[0]['minorType'];
	
	
	$minor_chk = select_db('minoradmin',"where minorTypeId = '".$id."'");
 	$find_used = count($minor_chk);

	if ($find_used == 0){		
		
		$TableName = 'minortype';
		$sql = delete_db($TableName, array('minorTypeId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบประเภทพนักงาน "'.$type_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ลบประเภทพนักงาน "'.$type_name.'" ไม่ได้เนื่องจากมีข้อมูลพนักงานประเภทนี้ในระบบ';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>