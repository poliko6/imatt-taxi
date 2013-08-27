<?php
$conn = mysql_connect("imattioapp.com", "taxi", "taxi2013");
mysql_select_db("taxi_db2", $conn);

$mobileId = $_REQUEST["mobileId"];

$sql = "SELECT mobile.*, mobilemap.latitude, mobilemap.longitude, ";
$sql .= "mobilemap.dateMapping FROM mobilemap ";
$sql .= "INNER JOIN mobile ON mobile.mobileId = mobilemap.mobileId ";
$sql .= "WHERE mobilemap.mobileId='".$mobileId."' AND dateMapping LIKE '".date('Y-m-d')."%' ";
$sql .= "ORDER BY dateMapping DESC ";

#echo $sql;
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
mysql_close($conn);

echo json_encode($json_array);
?>
