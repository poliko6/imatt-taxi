<?php
include("../include/db_connect.php");
include ('class.function.php');
$conn = mysql_connect($gaSql['server'], $gaSql['user'], $gaSql['password']);
mysql_select_db($gaSql['db'], $conn);
mysql_query("SET NAMES 'utf8'");

$customerId = trim($_REQUEST["customerId"]);
$latitude = trim($_REQUEST["lat"]);
$longitude = trim($_REQUEST["lon"]);
$time = trim($_REQUEST["time"]);

$total = 0;
$sqlSelect = "SELECT COUNT(*) AS total FROM customer WHERE customerId='$customerId'";
$result = mysql_query($sqlSelect);
while ($row = mysql_fetch_array($result)) {
	$total = $row["total"];
}

$iresult = array();

if ($total != 0) { 
	if (($latitude == '') || ($longitude == '')) {
		if ($latitude == ''){
			$iresult["code"] = "300";
			$iresult["msg"] = "Don't have latitude";
		}
		if ($longitude == ''){
			$iresult["code"] = "400";
			$iresult["msg"] = "Don't have longitude";
		}
		
	} else {
		$sql = "INSERT INTO customermap (customerId,latitudeCustomer,longitudeCustomer,timeGPS) VALUES ('$customerId','$latitude','$longitude','$time')";
		mysql_query($sql, $conn);

		$iresult["code"] = "200";
		$iresult["msg"] = "Success";
	}

} else {
	$iresult["code"] = "500";
	$iresult["msg"] = "Don't have customerId";
}

//mysql_close($conn);

$json_array = array("result" => array($iresult));

echo json_encode($json_array);
?>
