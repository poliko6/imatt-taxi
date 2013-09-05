<?php
$conn = mysql_connect("imattioapp.com", "taxi", "taxi2013");
mysql_select_db("taxi_db2", $conn);

$mobileId = trim($_REQUEST["mobileId"]);
$latitude = trim($_REQUEST["lat"]);
$longitude = trim($_REQUEST["lon"]);
$time = trim($_REQUEST["time"]);
//$accuracy = trim($_REQUEST["accuracy"]);
//$speed = trim($_REQUEST["speed"]);
//$bearing = trim($_REQUEST["bearing"]);




$total = 0;
$sqlSelect = "SELECT COUNT(*) AS total FROM mobile WHERE mobileId='$mobileId'";
$result = mysql_query($sqlSelect);
while ($row = mysql_fetch_array($result)) {
	$total = $row["total"];
}

$iresult = array();

if ($total != 0) { 
	if (($latitude == '') || ($longitude == '') || ($time == '')) {
		
		
		if ($latitude == ''){
			$iresult["code"] = "100";
			$iresult["msg"] = "Don't have latitude";
		} else if ($longitude == ''){
			$iresult["code"] = "101";
			$iresult["msg"] = "Don't have longitude";
		} else if ($time == ''){
			$iresult["code"] = "103";
			$iresult["msg"] = "Don't have time";
		}	

	} else {
		
		$sql = "INSERT INTO taxiposition (mobileId,latitude,longitude,timeGPS) ";
		$sql .= "VALUES ('$mobileId','$latitude','$longitude','$time')";
		mysql_query($sql, $conn);
		
		
		$sql_update = "UPDATE mobile SET latitude = $latitude, longitude = $longitude WHERE mobileId = $mobileId";
		mysql_query($sql_update);
		#echo $sql_update;


		$iresult["code"] = "200";
		$iresult["msg"] = "Success";
	}

} else {
	$iresult["code"] = "500";
	$iresult["msg"] = "Don't have mobileId";
}

mysql_close($conn);

$json_array = array("result" => array($iresult));
echo json_encode($json_array);
?>
