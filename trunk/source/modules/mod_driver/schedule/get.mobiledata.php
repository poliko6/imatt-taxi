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

	$mobileId = trim($mobileId);
		
	$mobile_data = select_db('mobile',"where mobileId = '".$mobileId."'");
	
	//data network
	$network_data = select_db('mobilenetwork',"where mobileNetworkId = '".$mobile_data[0]['mobileNetworkId']."'");
	$network_name = $network_data[0]['mobileNetworkName'];	


	//สังกัดอู่
 	$major_data = select_db('majoradmin',"where garageId = '".$mobile_data[0]['garageId']."'");
	$major_name = $major_data[0]['thaiCompanyName'];
	if ($major_name == NULL) $major_name = 'ไม่มี';
	
	$data['mobilenumber'] = $mobile_data[0]['mobileNumber'];
	$data['emimsi'] = $mobile_data[0]['EmiMsi'];
	$data['simid'] = $mobile_data[0]['simId'];				
	$data['banner'] = $mobile_data[0]['mobileBanner'];				
	$data['model'] = $mobile_data[0]['mobileModel'];
	$data['network'] = $network_name;			
	$data['garagename'] = $major_name;


	echo $_GET['callback'].'('.$json->encode($data).')';
?>