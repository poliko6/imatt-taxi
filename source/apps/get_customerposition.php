<?php
include("../include/db_connect.php");
include ('class.function.php');
$conn = mysql_connect($gaSql['server'], $gaSql['user'], $gaSql['password']);
mysql_select_db($gaSql['db'], $conn);
mysql_query("SET NAMES 'utf8'");

$mobileId = $_REQUEST["mobileId"];

$sql = "SELECT customer.*, customermap.latitudeCustomer, customermap.longitudeCustomer, ";
$sql .= "customermap.timeServer FROM customermap ";
$sql .= "INNER JOIN customer ON customer.customerId = customermap.customerId ";
$sql .= "WHERE customermap.customerId='".$customerId."' AND timeServer LIKE '".date('Y-m-d')."%' ";
$sql .= "ORDER BY timeServer DESC ";

$result = mysql_query($sql, $conn);

$multipleD = array();

while ($row = mysql_fetch_array($result)) {
	$singleD = array();
	$singleD["customerId"] = $row["customerId"];
	$singleD["latitude"] = $row["latitudeCustomer"];
	$singleD["longitude"] = $row["longitudeCustomer"];
	$singleD["firstName"] = $row["firstName"];
	$singleD["lastName"] = $row["lastName"];
	$singleD["gender"] = $row["gender"];
	$singleD["telephone"] = $row["telephone"];
	$singleD["dateMapping"] = $row["dateMapping"];
	array_push($multipleD, $singleD);
}

$json_array = array("record" => $multipleD);

mysql_free_result($result);
//mysql_close($conn);

echo json_encode($json_array);
?>
