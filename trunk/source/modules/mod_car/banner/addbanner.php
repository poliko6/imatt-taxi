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
	$car_banner_chk = select_db('carbanner',"where carBannerNameEng = '".$banner_name_eng."'");
	#print_r($car_banner_chk);
 	$find_chk = count($car_banner_chk);
	
	if ($find_chk) {
		$data['success'] = false;
		$data['message'] = 'ยี่ห้อรถยนต์ "'.$banner_name_eng.'" มีแล้วในระบบ';
		
	} else {
		
		$TableName = 'carbanner';
		$data = array(
			'carBannerNameEng'=>$banner_name_eng,
			'carBannerNameThai'=>$banner_name_thai
		);
		$sql = insert_db($TableName, $data);
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'เพิ่มยี่ห้อรถยนต์ "'.$banner_name_eng.'" เรียบร้อยแล้ว';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>