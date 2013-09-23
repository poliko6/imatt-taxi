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
	
	//GET Banner
	$mobile_banner_chk = select_db('mobilebanner',"where mobileBannerId = '".$id."'");
 	$banner_name = $mobile_banner_chk[0]['mobileBannerNameEng'];	
	
	//Table mobile
	$mobile_banner_chk2 = select_db('mobile',"where mobileBannerId = '".$id."'");
 	$find_mobile_used = count($mobile_banner_chk2);
	
	//Table mobileModel
	$mobile_banner_chk3 = select_db('mobilemodel',"where mobileBannerId = '".$id."'");
 	$find_model_used = count($mobile_banner_chk3);

	if (($find_mobile_used == 0) && ($find_model_used == 0)){		
		
		$TableName = 'mobilebanner';
		$sql = delete_db($TableName, array('mobileBannerId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบยี่ห้อมือถือ "'.$banner_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		
		if ($find_mobile_used != 0){
				
			$data['message'] = 'ลบยี่ห้อมือถือ "'.$banner_name.'" ไม่ได้เนื่องจากมีข้อมูลรถยี่ห้อนี้ในระบบ';
		}
		
		if ($find_model_used != 0){
				
			$data['message'] = 'ลบยี่ห้อมือถือ "'.$banner_name.'" ไม่ได้เนื่องจากมีข้อมูลรุ่นรถอยู่';
		}
		
		
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>