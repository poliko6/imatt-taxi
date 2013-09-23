<?PHP
	require_once '../../../include/Zend/JSON.php';
    $json = new Services_JSON();
	
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	$sql = "SELECT * FROM transportsection WHERE mobileId = '".$mobileId."'";
	$rs = mysql_query($sql);
	$data_transport = mysql_fetch_object($rs);
	
	//echo $sql;
	
	$driverId = $data_transport->driverId;
	$mobileId = $data_transport->mobileId;
	$carId = $data_transport->carId;
	$garageId = $data_transport->garageId;
	
	//สังกัดอู่
 	$major_data = select_db('majoradmin',"where garageId = '".$garageId."'");
	$major_name = $major_data[0]['thaiCompanyName'];
	if ($major_name == NULL) $major_name = 'ไม่มี';
	
	//รถแท๊กซี่
	$taxi_data = select_db('car',"where carId = '".$carId."'");
	$carRegistration = $taxi_data[0]['carRegistration'];
	
	//จังหวัด
	$province_data = select_db('province',"where provinceId = '".$taxi_data[0]['provinceId']."'");
	$province_name = $province_data[0]['provinceName'];	

	$data['driverId'] = $driverId;
	$data['mobileId'] = $mobileId;
	$data['carId'] = $carId;					
	$data['garageId'] = $garageId;				
	$data['major_name'] = $major_name;
	$data['carRegistration'] = $carRegistration;
	$data['province'] = $province_name;			

	echo $_GET['callback'].'('.$json->encode($data).')';

?>