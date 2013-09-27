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
	
	$sqlSelect = "SELECT historyId, carId FROM driverhistory WHERE customerId='".$customerId."' AND statusWork = '7'";
	$result = mysql_query($sqlSelect);
	$row = mysql_fetch_array($result);
	//echo $sqlSelect;
	
	//Update driverhistory Data
	$sql_status = "UPDATE driverhistory ";
	$sql_status .= "SET statusWork = '5' ";
	$sql_status .= "WHERE historyId='".$row['historyId']."'";
	mysql_query($sql_status);

	//Update Car Status
	if ($row['carId'] != '') {
		$sql_status_car = "UPDATE car SET carStatusId = '2' WHERE carId='".$row['carId']."'";
		mysql_query($sql_status_car);
	}
	$iresult["code"] = "200";
	$iresult["msg"] = "Success";
	
}


$json_array = array("result" => array($iresult));

echo json_encode($json_array);
?>
