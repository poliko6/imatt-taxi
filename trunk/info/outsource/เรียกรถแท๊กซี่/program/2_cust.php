<?php
session_start();
set_time_limit(100000000);
include("var.php");
include("likit_google_map_distance.php");
$mysqli = new mysqli($MYSQLHOST,$MYSQLUSER,$MYSQLPASS,$MYSQLDB);
$mysqli->set_charset("utf8");
?>

<meta charset="UTF-8">
<style type="text/css"> 
 html { height: 100% }  
  body { height: 100%; margin: 0px; padding: 0px }  
</style> 
<script type="text/javascript" src="js/jquery-1.7.2.min.js" ></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>


<?php
$custid=$_GET['custid']; //เลข mobile id ของลูกค้า 
?>



<?php
	//ค้าหา พิกัด ของลูกค้า ที่ส่งคำขอรถแท๊กซี่

	$sql="select latitude,longitude from likit_cust_select_car where custid='custid' and flag='1'  ";
	$result=$mysqli->query($sql);
	$row=$result->fetch_array();
	$custLat=$row['latitude']; // พิกัด lat ลูกค้า 
	$custLong=$row['longitude']; // พิกัด long ลูกค้า
?>


<?php
//ลบข้อมูล เพิ่อคำนวณใหม่ 
$sql="delete from likit_calc_distance where custid='$custId' ";
$mysqli->query($sql);
?>
<?php
	$sql="select mobileId,latitude,longitude from mobile";
	$result=$mysqli->query($sql);
	while($row=$result->fetch_array()){
		$mobileId=$row['mobileId'];
		$latitude=$row['latitude'];
		$longitude=$row['longitude'];
	
		$distance=likit_google_map_distance($custLat,$custLong,$latitude,$longitude);
	
		$sql2="insert into likit_calc_distance(custid,mobileId,distance,cust_latitude,cust_longitude,latitude,longitude) values('$custId','$mobileId','$distance','$custLat','$custLong','$latitude','$longitude')";
		$mysqli->query($sql2);

	}

?>





<h1>จอภาพของลูกค้า เพื่อเลือกรถ ที่ใกล้ที่สุด</h1>
<?php
$sql="select b.carId,a.mobileId,a.cust_latitude,a.cust_longitude,a.latitude,a.longitude from likit_calc_distance a left join transportsection b on (a.mobileId=b.mobileId) order by distance asc limit 0,$var_car_show_count ";
$result=$mysqli->query($sql);
$i=0;
while($row=$result->fetch_array()){
$i++;
	$mobileId = $row['mobileId'];
	$cust_latitude = $row['cust_latitude'];
	$cust_longitude = $row['cust_longitude'];
	$latitude = $row['latitude'];
	$longitude = $row['longitude'];
	$carId= $row['carId'];

		$sql2="select carRegistration from car where carId='$carId' ";
		$result2=$mysqli->query($sql2);
		$row2=$result2->fetch_array();
		$carRegistration=$row2['carRegistration'];

	echo "ลำดับที่ $i. <a href='3_cust_a.php?custid=$carId&carid=$carId'>car Id = ".$carRegistration."</a>";
	
	echo "&nbsp;&nbsp;&nbsp;";
	echo "<br>";
}

?>

<br><br>
<a href="3_cust_b.php?custid=<?=$custid?>">ไม่เลือกรถใดๆ</a>
<br><br>
<a href="3_cust_c.php?custid=<?=$custid?>">ให้บริษัทเลือกรถแท๊กซี่ให้ </a>



