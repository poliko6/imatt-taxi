<?php
session_start();
set_time_limit(100000000);
include("var.php");
$mysqli = new mysqli($MYSQLHOST,$MYSQLUSER,$MYSQLPASS,$MYSQLDB);
$mysqli->set_charset("utf8");



$custid=$_POST['custid'];
$lat=$_POST['lat'];
$long=$_POST['long'];


$sql="delete from likit_cust_select_car where custid ='$custid' "; 
$mysqli->query($sql);



$sql="insert into likit_cust_select_car values('$custid','$lat','$long','1')";
$mysqli->query($sql);


echo "ลูกค้าส่งคำขอรถแท๊กซี่ มาแล้ว  ";
echo "<a href='2_cust.php?custid=$custid'>คลิก ดูจอภาพ ของลูกค้า</a>";
?>

