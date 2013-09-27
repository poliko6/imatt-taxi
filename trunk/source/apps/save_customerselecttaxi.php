<?php
include("../include/db_connect.php");
include ('class.function.php');
$conn = mysql_connect($gaSql['server'], $gaSql['user'], $gaSql['password']);
mysql_select_db($gaSql['db'], $conn);
mysql_query("SET NAMES 'utf8'");

$customerId = trim($_REQUEST["customerId"]);
$carId = trim($_REQUEST["carId"]);

$iresult = array();


if (($customerId == '') && ($carId == '')) {
	
	if ($customerId == ''){
		$iresult["code"] = "100";
		$iresult["msg"] = "Don't have customer ID";
	}
	if ($carId == ''){
		$iresult["code"] = "300";
		$iresult["msg"] = "Don't have car ID";
	}
	
} else {
	
	//Select Data 
	$sql= " SELECT * FROM transportsection WHERE carId = '".$carId."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	$invID = str_pad($customerId, 4, '0', STR_PAD_LEFT);
	$genCode = 'G'.$invID.createRandomPassword();
	
	//Update driverhistory Data
	$sql_status = "UPDATE driverhistory ";
	$sql_status .= "SET carId = '".$carId."', ";
	$sql_status .= "mobileId = '".$row['mobileId']."', ";
	$sql_status .= "driverId = '".$row['driverId']."', ";
	$sql_status .= "garageId = '".$row['garageId']."', ";
	$sql_status .= "generateCode = '".$genCode."', ";
	$sql_status .= "statusWork = '4' ";
	$sql_status .= "WHERE statusWork = '' AND customerId='".$customerId."'";
	mysql_query($sql_status);
	//echo $sql_status;

	//Update Car Status
	$sql_status_car = "UPDATE car SET carStatusId = '4' WHERE carId='".$carId."'";
	mysql_query($sql_status_car);
	
	$iresult["code"] = "200";
	$iresult["msg"] = "Success";
}


$json_array = array("result" => array($iresult));

echo json_encode($json_array);
?>
