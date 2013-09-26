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
	
	
	$banner_name_eng = trim($banner_name_eng);
	$mobile_banner_chk = select_db('mobilebanner',"where mobileBannerNameEng = '".$banner_name_eng."'");
	#print_r($mobile_banner_chk);
 	$find_chk = count($mobile_banner_chk);
	
	if ($find_chk) {
		$data['success'] = false;
		$data['message'] = 'ยี่ห้อมือถือ "'.$banner_name_eng.'" มีแล้วในระบบ';
		
	} else {
		
		$TableName = 'mobilebanner';
		$data = array(
			'mobileBannerNameEng'=>$banner_name_eng,
			'mobileBannerNameThai'=>$banner_name_thai,
			'garageId'=>$garageId
		);
		$sql = insert_db($TableName, $data);
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'เพิ่มยี่ห้อมือถือ "'.$banner_name_eng.'" เรียบร้อยแล้ว';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>