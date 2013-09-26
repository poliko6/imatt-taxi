<?php
include("../include/db_connect");
$conn = mysql_connect("$gaSql[server] ", "$gaSql[user]", "$gaSql[password]");
mysql_select_db("$gaSql[db]", $conn);

$customerId = trim($_REQUEST["customerId"]);
$latitude = trim($_REQUEST["tat"]);
$longitude = trim($_REQUEST["lon"]);

$iresult = array();

if (($customerId == '') && ($latitude == '') && ($longitude == '')) {
	if ($customerId == ''){
		$iresult["code"] = "100";
		$iresult["msg"] = "Don't have customer ID";
	}
	if ($latitude == ''){
		$iresult["code"] = "300";
		$iresult["msg"] = "Don't have latitude";
	}
	if ($longitude == ''){
		$iresult["code"] = "400";
		$iresult["msg"] = "Don't have longitude";
	}
	
} else {

	$total = 0;
	$sqlSelect = "SELECT statusWork FROM driverhistory WHERE customerId='$customerId' and statusWork LIKE 'wait%'";
	$result = mysql_query($sqlSelect);
	$total = mysql_num_rows($result);
	if ($total != 0) {
		while ($row = mysql_fetch_array($result)) {
			$sql_status = "UPDATE driverhistory SET statusWork = 'customercancel' WHERE statusWork LIKE 'wait%' AND  customerId='$customerId'";
			mysql_query($sql_status);
			//echo $sql_status;
		}
	}
	
	//echo $sqlSelect;
		
	$sql = "INSERT INTO driverhistory (customerId,startLatitude,startLongitude,statusWork) ";
	$sql .= "VALUES ('$customerId','$latitude','$longitude','wait')";
	mysql_query($sql);
	
	$iresult["code"] = "200";
	$iresult["msg"] = "Success";

}

$json_array = array("result" => array($iresult));

echo json_encode($json_array);
?>
