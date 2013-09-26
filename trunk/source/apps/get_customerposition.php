<?php
include("../include/db_connect");
$conn = mysql_connect("$gaSql[server] ", "$gaSql[user]", "$gaSql[password]");
mysql_select_db("$gaSql[db]", $conn);

$customerId = $_REQUEST["customerId"];

$sql = "SELECT customer.*, customermap.latitudeCustomer, customermap.longitudeCustomer, ";
$sql .= "customermap.dateMapping FROM customermap ";
$sql .= "INNER JOIN customer ON customer.customerId = customermap.customerId ";
$sql .= "WHERE customermap.customerId='".$customerId."' AND dateMapping LIKE '".date('Y-m-d')."%' ";
$sql .= "ORDER BY dateMapping DESC ";

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
