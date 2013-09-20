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
<body> 

<?php
$custid=$_GET['custid'];
$carid=$_GET['carid'];


// table likit_cust_select_car  จะเปลี่ยน flag จาก 1 เป็น 4
// table car  จะเปลี่ยน carStatusId  จาก 1=ว่าง  เป็น  4=มีการถูกเลือกจากลูกค้า

/*
table car จะมี carStatusId ดังนี้
1 = ว่าง 
2 = ไม่ว่าง
3 = จอด
4 = มีการเลือกรถ จากลูกค้า
5 = มีการเลือกรถ จาก Call center
*/


$sql="update likit_cust_select_car set flag='4' where custid='$custid' ";
$mysqli->query($sql);

$sql="update car set carStatusId='4' where carId='$carid' ";
$mysqli->query($sql);


$sql="select  carRegistration  from car where carId='$carid' ";
$result=$mysqli->query($sql);
$row=$result->fetch_array();
$carRegistration=$row['carRegistration'];

?>

ลูกค้าเลือกรถ ทะเบียน  <?=$carRegistration?>

<br><br>

<a href='1_cust_req.php'>ลูกค้ายกเลิก การเรียกรถแท๊กซี คลิกที่ เพื่อไปหน้าจอ เรียกรถแท๊กซี่ อีกครั้ง</a>


</body> 
</html> 