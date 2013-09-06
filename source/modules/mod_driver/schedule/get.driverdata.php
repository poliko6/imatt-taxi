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

	$driverId = trim($driverId);
		
	$driver_data = select_db('drivertaxi',"where driverId = '".$driverId."'");
	
	//Address
	$province_data = select_db('province',"where provinceId = '".$driver_data[0]['provinceId']."'");
	$province_name = $province_data[0]['provinceName'];		
	
	$amphur_data = select_db('amphur',"where amphurId = '".$driver_data[0]['amphurId']."'");
	$amphur_name = $amphur_data[0]['amphurName'];	
	
	$district_data = select_db('district',"where districtId = '".$driver_data[0]['districtId']."'");
	$district_name = $district_data[0]['districtName'];	
 	
	//สังกัดอู่
 	$major_data = select_db('majoradmin',"where garageId = '".$driver_data[0]['garageId']."'");
	$major_name = $major_data[0]['thaiCompanyName'];

	if ($major_name == NULL) $major_name = 'ไม่มี';
	
	
	//B Day
	$p_bday = explode('/',$driver_data[0]['driverBirthday']);	
	
	$thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
                     "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");	
	
	
	//Image
	$pathimage  = '../../../stored/driver/thumbnail/'.$driver_data[0]['driverImage'];
	if (file_exists($pathimage)) {  //check file			
		$pathimage  = $driver_data[0]['driverImage'];
	} else { 						
		$pathimage  = ''; 	
	}
	
	$data['img'] = $pathimage;	
	$data['name'] = $driver_data[0]['firstName'].' '.$driver_data[0]['lastName'];
	$data['citizenId'] = $driver_data[0]['citizenId'];
	$data['licensenumber'] = $driver_data[0]['licenseNumber'];				
	$data['birthday'] = $p_bday[0].' '.$thMonth[$p_bday[1]-1].' '.$p_bday[2];		
	$data['fullAddress'] = $driver_data[0]['address'].' '.$district_name.' '.$amphur_name.' '.$province_name.','.$driver_data[0]['zipcode'];
	$data['mobile'] = $driver_data[0]['mobilePhone'];
	$data['telephone'] = $driver_data[0]['telephone'];				
	$data['garagename'] = $major_name;

	echo $_GET['callback'].'('.$json->encode($data).')';
?>