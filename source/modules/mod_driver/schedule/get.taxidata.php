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

	$carId = trim($carId);
		
	$taxi_data = select_db('car',"where carId = '".$carId."'");
	
	//จังหวัด
	$province_data = select_db('province',"where provinceId = '".$taxi_data[0]['provinceId']."'");
	$province_name = $province_data[0]['provinceName'];	
	
	//ยี่ห้อ
	$banner_data = select_db('carbanner',"where carBannerId = '".$taxi_data[0]['carBannerId']."'");
	$banner_name = $banner_data[0]['carBannerNameEng'];	
	
	//รุ่น
	$model_data = select_db('carmodel',"where carModelId = '".$taxi_data[0]['carModelId']."'");
	$model_name = $model_data[0]['carModelName'];		
	
	//สี
	$color_data = select_db('carcolor',"where carColorId = '".$taxi_data[0]['carColorId']."'");
	$color_name = $color_data[0]['carColorName'];	
	
	//เชื้อเพลิง
	$fuel_data = select_db('carfuel',"where carFuelId = '".$taxi_data[0]['carFuelId']."'");
	$fuel_name = $fuel_data[0]['carFuelName'];		
	
	//แก๊ส
	$gas_data = select_db('cargas',"where carGasId = '".$taxi_data[0]['carGasId']."'");
	$gas_name = $gas_data[0]['carGasName'];	
	if ($gas_name == NULL) $gas_name = 'ไม่ติดแก๊ส';

	//สังกัดอู่
 	$major_data = select_db('majoradmin',"where garageId = '".$taxi_data[0]['garageId']."'");
	$major_name = $major_data[0]['thaiCompanyName'];
	if ($major_name == NULL) $major_name = 'ไม่มี';
	

	//Image
	$pathimage  = '../../../stored/taxi/thumbnail/'.$taxi_data[0]['carImage'];
	if (file_exists($pathimage)) {  //check file			
		$pathimage  = $taxi_data[0]['carImage'];
	} else { 						
		$pathimage  = ''; 	
	}
	
	$data['img'] = $pathimage;	
	
	$data['registration'] = $taxi_data[0]['carRegistration'];
	$data['province'] = $province_name;
	$data['banner'] = $banner_name;					
	$data['model'] = $model_name;				
	$data['color'] = $color_name;
	$data['year'] = $taxi_data[0]['carYear'];
	$data['fuel'] = $fuel_name;				
	$data['gas'] = $gas_name;				
	$data['garagename'] = $major_name;
	

	echo $_GET['callback'].'('.$json->encode($data).')';
?>