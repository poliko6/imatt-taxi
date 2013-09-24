<?php
session_start();
include("var.php");
$mysqli = new mysqli($MYSQLHOST,$MYSQLUSER,$MYSQLPASS,$MYSQLDB);
$mysqli->set_charset("utf8");

?>
<!DOCTYPE html> 
<html> 
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<style type="text/css"> 
 html { height: 100% }  
  body { height: 100%; margin: 0px; padding: 0px }  
  #map_canvas { height: 100% }  
</style> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>
<meta charset="utf-8">
</head> 
<?php
/*
table likit_cust_select_car มี flag สถานะดังนี้
flag = 1     หมายถึง   ลูกค้าแจ้งเข้ามา ว่าต้องการ รถแท๊กซี่
flag = ว่าง  หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน และลูกค้าตอบ "ไม่เลือกรถใดๆ" หรือ กรณี ลูกค้าขึ้นรถแท๊กซี่แล้ว
flag = 2     หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน และลูกค้าตอบ "ให้บริษัทเลือกรถให้"
flag = 3     หมายถึง   call center ส่งรถให้ ลูกค้า
flag = 4     หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน และลูกค้าตอบ "เลือกรถแท๊กซี่ 1 คัน ที่จะให้มารับ"


table car จะมี carStatusId ดังนี้
1 = ว่าง 
2 = ไม่ว่าง
3 = จอด
4 = มีการเลือกรถ จากลูกค้า
5 = มีการเลือกรถ จาก Call center


*/

$carid_no=$_POST['carid_no'];
$custid=$_POST['custid'];


$sql="update likit_cust_select_car set flag='3' where custid='$custid' ";
$mysqli->query($sql);


$sql="update car set carStatusId='5' where carId='$carid_no' ";
$mysqli->query($sql);

?>
<h1>Call center เลือกรถให้ลูกค้า เรียบร้อยแล้ว</h1>

<!-- 
เมื่อ รถไปถึง ลูกค้า แล้วลูกค้าขึ้นไป  จะต้องมีการเปลี่ยนสถานะ table car ดังนี้

1.  update car set carStatusId='2' where carId='$carid_no' 
2.  update likit_cust_select_car set flag='' where custid='$custid' 


-->