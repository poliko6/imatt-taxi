<?php
$conn = mysql_connect("imattioapp.com", "taxi", "taxi2013");
mysql_select_db("taxi_db2", $conn);

$mobileId = trim($_REQUEST["mobileId"]);
$latitude = trim($_REQUEST["lat"]);
$longitude = trim($_REQUEST["lon"]);


$total = 0;
$sqlSelect = "SELECT COUNT(*) AS total FROM mobile WHERE mobileId='$mobileId'";
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
		$sql = "INSERT INTO mobilemap (mobileId,latitude,longitude) VALUES ('$mobileId','$latitude','$longitude')";
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
