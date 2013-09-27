<?php
include("../include/db_connect.php");
include ('class.function.php');
$conn = mysql_connect($gaSql['server'], $gaSql['user'], $gaSql['password']);
mysql_select_db($gaSql['db'], $conn);
mysql_query("SET NAMES 'utf8'");

$customerId = trim($_REQUEST["customerId"]);

$driverPunctual = trim($_REQUEST["punctual"]);
$driverCarLook = trim($_REQUEST["carlook"]);
$driverCourtesy = trim($_REQUEST["courtesy"]);
$driverDrivingSkill = trim($_REQUEST["skill"]);

//pre($_REQUEST);

$iresult = array();


if (($customerId == '')) {
	
	$iresult["code"] = "100";
	$iresult["msg"] = "Don't have customer ID";
		
} else {
	
	$sqlSelect = "SELECT historyId, carId FROM driverhistory WHERE customerId='".$customerId."' AND statusWork = '5'";
	$result = mysql_query($sqlSelect);
	$row = mysql_fetch_array($result);
	//echo $sqlSelect;
	
	$sql_cust = "SELECT latitudeCustomer, longitudeCustomer FROM customer WHERE customerId='".$customerId."'";
	$result_cust = mysql_query($sql_cust);
	$row_cust = mysql_fetch_array($result_cust);
	
	//Update driverhistory Data
	$sql_status = "UPDATE driverhistory ";
	$sql_status .= "SET statusWork = '6', ";
	$sql_status .= "finishLatitude = '".$row_cust['latitudeCustomer']."', ";
	$sql_status .= "finishLongitude = '".$row_cust['longitudeCustomer']."', ";	
	$sql_status .= "driverPunctual = '".$driverPunctual."', ";
	$sql_status .= "driverCarLook = '".$driverCarLook."', ";
	$sql_status .= "driverCourtesy = '".$driverCourtesy."', ";
	$sql_status .= "driverDrivingSkill = '".$driverDrivingSkill."' ";
	
	$sql_status .= "WHERE historyId='".$row['historyId']."'";
	mysql_query($sql_status);
	
	//echo $sql_status;

	//Update Car Status
	if ($row['carId'] != '') {
		$sql_status_car = "UPDATE car SET carStatusId = '1' WHERE carId='".$row['carId']."'";
		mysql_query($sql_status_car);
	}

	
	$iresult["code"] = "200";
	$iresult["msg"] = "Success";
	
}


$json_array = array("result" => array($iresult));

echo json_encode($json_array);
?>
