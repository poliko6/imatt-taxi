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
	
	
	$bannereng = trim($bannereng);
	$bannereng_temp = trim($bannereng_temp);
	$bannerthai = trim($bannerthai);
	$bannerthai_temp = trim($bannerthai_temp);
	
		
	if(($bannereng != $bannereng_temp) || ($bannerthai != $bannerthai_temp)){
		
		$car_banner_chk = select_db('carbanner',"where carBannerNameEng = '".$bannereng."'");
		$find_chk = count($car_banner_chk);
		
		if ($find_chk) {
			$data['success'] = false;
			$data['message'] = 'ยี่ห้อรถยนต์ "'.$banner_name_eng.'" มีแล้วในระบบ';
			
		} else {
		
			$TableName = 'carbanner';
			$data = array(
				'carBannerNameEng'=>$bannereng,
				'carBannerNameThai'=>$bannerthai
			);
			$sql = update_db($TableName, array('carBannerId='=>$id), $data);
			//echo $sql;
			mysql_query($sql);	
			
			$data['success'] = true;	
			if(($bannereng != $bannereng_temp)){	
				$data['message'] = 'ปรับปรุงยี่ห้อรถยนต์ "'.$bannereng_temp.'" เป็น "'.$bannereng.'" เรียบร้อยแล้ว';
			}
			if(($bannerthai != $bannerthai_temp)){	
				$data['message'] = 'ปรับปรุงยี่ห้อรถยนต์ "'.$bannerthai_temp.'" เป็น "'.$bannerthai.'" เรียบร้อยแล้ว';
			}
			
		}
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ยี่ห้อรถยนต์ "'.$bannereng.'" ไม่มีการเปลี่ยนแปลง';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>