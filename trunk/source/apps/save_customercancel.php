<?php
include("../include/db_connect.php");
include ('class.function.php');
$conn = mysql_connect($gaSql['server'], $gaSql['user'], $gaSql['password']);
mysql_select_db($gaSql['db'], $conn);
mysql_query("SET NAMES 'utf8'");

$customerId = trim($_REQUEST["customerId"]);

$iresult = array();


if (($customerId == '')) {
	
	$iresult["code"] = "100";
	$iresult["msg"] = "Don't have customer ID";
		
} else {
	
	$sqlSelect = "SELECT historyId, carId FROM driverhistory WHERE customerId='".$customerId."' AND statusWork = '4'";
	$result = mysql_query($sqlSelect);
	$row = mysql_fetch_array($result);
	
	//Update driverhistory Data
	$sql_status = "UPDATE driverhistory ";
	$sql_status .= "SET statusWork = '99' ";
	$sql_status .= "WHERE (statusWork = '' OR statusWork = '1' OR statusWork = '2' OR statusWork = '3' OR statusWork = '4') AND customerId='".$customerId."'";
	mysql_query($sql_status);

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
