<?php
include("../include/db_connect.php");
include ('class.function.php');
$conn = mysql_connect($gaSql['server'], $gaSql['user'], $gaSql['password']);
mysql_select_db($gaSql['db'], $conn);
mysql_query("SET NAMES 'utf8'");

$customerId = trim($_REQUEST["customerId"]);
$custLat = trim($_REQUEST["tat"]);
$custLong = trim($_REQUEST["lon"]);

$iresult = array();

if (($customerId == '') && ($custLat == '') && ($custLong == '')) {
	
	if ($customerId == ''){
		$iresult["code"] = "100";
		$iresult["msg"] = "Don't have customer ID";
	}
	if ($custLat == ''){
		$iresult["code"] = "300";
		$iresult["msg"] = "Don't have latitude";
	}
	if ($custLong == ''){
		$iresult["code"] = "400";
		$iresult["msg"] = "Don't have longitude";
	}
	
} else {

	//Clear last call
	$total = 0;
	$sqlSelect = "SELECT historyId, statusWork FROM driverhistory WHERE customerId='$customerId' AND (statusWork = '' 
				 OR statusWork = '1'  OR statusWork = '2' OR statusWork = '3'  OR statusWork = '4')";
	$result = mysql_query($sqlSelect);
	$total = mysql_num_rows($result);
	if ($total != 0) {
		while ($row = mysql_fetch_array($result)) {
			$sql_status = "UPDATE driverhistory SET statusWork = '99' WHERE historyId = '".$row['historyId']."'";
			mysql_query($sql_status);
			//echo $sql_status;
		}
	}	
	//echo $sqlSelect;
		
	$sql = "INSERT INTO driverhistory (customerId,startLatitude,startLongitude,statusWork) ";
	$sql .= "VALUES ('$customerId','$custLat','$custLong','1')";
	mysql_query($sql);
	
	
	
	
	//Gen CarId for this customer
	/*
	===============================
	อธิบาย ความหมายของ flag 
	===============================
	table likit_cust_select_car
	flag = 1     หมายถึง   ลูกค้าแจ้งเข้ามา ว่าต้องการ รถแท๊กซี่ (wait)
	flag = ว่าง    หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน
	flag = 2     หมายถึง   ลูกค้าตอบ "ให้บริษัทเลือกรถให้"
	flag = 3     หมายถึง   call center ส่งรถให้ ลูกค้า
	flag = 4     หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน และลูกค้าตอบ "เลือกรถแท๊กซี่ 1 คัน ที่จะให้มารับ" 
	flag = 5     หมายถึง   ลูกค้า ขึ้นรถ
	flag = 6     หมายถึง   ลูกค้า ลงรถ
	flag = 99    หมายถึง   ลูกค้า ยกเลิก
	flag = 88    หมายถึง   แท๊กซี่ ยกเลิก
	

	table car จะมี carStatusId ดังนี้
	1 = ว่าง 
	2 = ไม่ว่าง
	3 = จอด
	4 = มีการเลือกรถ จากลูกค้า
	5 = มีการเลือกรถ จาก Call center
	*/
	
	include('likit_google_map_distance.php');

	$sql= " SELECT transportsection.mobileId, mobile.latitude, mobile.longitude,
			transportsection.carId,transportsection.driverId,transportsection.garageId
			FROM transportsection
			JOIN mobile ON mobile.mobileId = transportsection.mobileId
			JOIN car ON car.carId = transportsection.carId
			WHERE transportsection.statusWork = 'online' AND carStatusId = 1";
	$result = mysql_query($sql);
	
	$arr_distance = array();
	$i = 0;
	
	while($row = mysql_fetch_array($result)){
		
		$mobileId = $row['mobileId'];
		$driverId = $row['driverId'];
		$garageId = $row['garageId'];
		$carId = $row['carId'];
		$latitude = $row['latitude'];
		$longitude = $row['longitude'];
	
		$distance = likit_google_map_distance($custLat,$custLong,$latitude,$longitude);
		
		$arr_distance[$i]['customerId'] = $customerId;
		$arr_distance[$i]['mobileId'] = $mobileId;
		$arr_distance[$i]['carId'] = $carId;
		$arr_distance[$i]['driverId'] = $driverId;
		$arr_distance[$i]['garageId'] = $garageId;
		$arr_distance[$i]['distance'] = $distance;		
		$arr_distance[$i]['latitude'] = $latitude;
		$arr_distance[$i]['longitude'] = $longitude;
		$i++;
	}
	
	
	
	array_sort_by_column($arr_distance, 'distance');
	//pre($arr_distance);
	
	for($i=0; $i<10; $i++){
		$sql_car = "SELECT carRegistration, provinceName FROM car
				JOIN province ON province.provinceId = car.provinceId
				WHERE carId = '".$arr_distance[$i]['carId']."'";
		$result_car = mysql_query($sql_car);
		$row_car = mysql_fetch_array($result_car);
		
		$iresult["car"]['carRegistration'][$i] = $row_car['carRegistration'].' '.$row_car['provinceName'];
		$iresult["car"]['carId'][$i] = $arr_distance[$i]['carId'];
		
	}
	
	
	$sql_status = "UPDATE driverhistory SET statusWork = '' WHERE statusWork = '1' AND customerId='$customerId'";
	mysql_query($sql_status);
	
	$iresult["code"] = "200";
	$iresult["msg"] = "Success";

}





$json_array = array("result" => array($iresult));

echo json_encode($json_array);
?>
