<?php
include("../include/db_connect.php");
include ('class.function.php');
$conn = mysql_connect($gaSql['server'], $gaSql['user'], $gaSql['password']);
mysql_select_db($gaSql['db'], $conn);
mysql_query("SET NAMES 'utf8'");

$mobileId = $_REQUEST["mobileId"];

$sql = "SELECT mobile.*, taxiposition.latitude, taxiposition.longitude, ";
$sql .= "taxiposition.timeGPS FROM taxiposition ";
$sql .= "INNER JOIN mobile ON mobile.mobileId = taxiposition.mobileId ";
$sql .= "WHERE taxiposition.mobileId='".$mobileId."' AND timeGPS LIKE '".date('Y-m-d')."%' ";
$sql .= "ORDER BY timeGPS DESC ";

//echo $sql;
$result = mysql_query($sql);

$multipleD = array();

while ($row = mysql_fetch_array($result)) {
	
	$sql_network = "SELECT mobileNetworkName FROM mobilenetwork WHERE mobileNetworkId = '".$row["mobileNetworkId"]."'";
	//echo $sql_network;
	$rs_network = mysql_query($sql_network);
	$data_network = mysql_fetch_object($rs_network);
	$mobileNetworkName = $data_network->mobileNetworkName;
	
	$singleD = array();
	$singleD["mobileId"] = $row["mobileId"];
	$singleD["latitude"] = $row["latitude"];
	$singleD["longitude"] = $row["longitude"];
	$singleD["mobileNumber"] = $row["mobileNumber"];
	$singleD["EmiMsi"] = $row["EmiMsi"];	
	$singleD["mobileBanner"] = $row["mobileBanner"];
	$singleD["mobileModel"] = $row["mobileModel"];
	$singleD["mobileNetworkId"] = $row["mobileNetworkId"];	
	$singleD["mobileNetworkName"] = $mobileNetworkName;	
	$singleD["dateMapping"] = $row["dateMapping"];
	array_push($multipleD, $singleD);
}

$json_array = array("record" => $multipleD);

mysql_free_result($result);
//mysql_close($conn);

echo json_encode($json_array);
?>
