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
	$car_banner_chk = select_db('carbanner',"where carBannerId = '".$id."'");
 	$banner_name = $car_banner_chk[0]['carBannerNameEng'];	
	
	//Table Car
	$car_banner_chk2 = select_db('car',"where carBannerId = '".$id."'");
 	$find_car_used = count($car_banner_chk2);
	
	//Table CarModel
	$car_banner_chk3 = select_db('carmodel',"where carBannerId = '".$id."'");
 	$find_model_used = count($car_banner_chk3);

	if (($find_car_used == 0) && ($find_model_used == 0)){		
		
		$TableName = 'carbanner';
		$sql = delete_db($TableName, array('carBannerId='=>$id));
		//echo $sql;
		mysql_query($sql);
		
		$data['success'] = true;
		$data['message'] = 'ลบยี่ห้อรถยนต์ "'.$banner_name.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		
		if ($find_car_used != 0){
				
			$data['message'] = 'ลบยี่ห้อรถยนต์ "'.$banner_name.'" ไม่ได้เนื่องจากมีข้อมูลรถยี่ห้อนี้ในระบบ';
		}
		
		if ($find_model_used != 0){
				
			$data['message'] = 'ลบยี่ห้อรถยนต์ "'.$banner_name.'" ไม่ได้เนื่องจากมีข้อมูลรุ่นรถอยู่';
		}
		
		
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>