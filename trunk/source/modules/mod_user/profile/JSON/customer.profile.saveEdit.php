<?
    require_once '../../../../include/Zend/JSON.php';
    $json = new Services_JSON();
	
	include("../../../../include/class.mysqldb.php");
	include("../../../../include/config.inc.php");
	include("../../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}

date_default_timezone_set('Asia/Bangkok');
$today = date("Y-m-d H:i:s");

$dataCus = array(
	'firstName'=>$firstName,
	'lastName'=>$lastName,
	'citizenId'=>$citizenId,
	'telephone'=>$telephone,
	'location'=>$location,
	'birthDay'=>$birthday,
	'dateUpdated'=>$today
);
$udCustomer = update_db('customer', array('customerId ='=>$customerId), $dataCus); 
$cusResult = mysql_query($udCustomer) or die ("Can't Update User");	

	$data['success'] = true;
	$data['message'] = "บันทึกการแก้ไขข้อมูลเรียบร้อยแล้ว";

echo $_GET['callback'].'('.$json->encode($data).')';
?>
