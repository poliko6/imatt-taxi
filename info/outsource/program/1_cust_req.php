<?php
session_start();
set_time_limit(100000000);
include("var.php");
$mysqli = new mysqli($MYSQLHOST,$MYSQLUSER,$MYSQLPASS,$MYSQLDB);
$mysqli->set_charset("utf8");


//สมมุติ รหัสลูกค้า และ lat , long ที่ส่งมาจาก Android
	$custId="1";// รหัสลูกค้า
	$custLat="18.031406"; // พิกัด lat ลูกค้า
	$custLong="99.023514"; // พิกัด long ลูกค้า
	
/*
===============================
อธิบาย ความหมายของ flag 
===============================
table likit_cust_select_car
flag = 1     หมายถึง   ลูกค้าแจ้งเข้ามา ว่าต้องการ รถแท๊กซี่
flag = ว่าง  	  หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน และลูกค้าตอบ "ไม่เลือกรถใดๆ"
flag = 2     หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน และลูกค้าตอบ "ให้บริษัทเลือกรถให้"
flag = 3     หมายถึง   call center ส่งรถให้ ลูกค้า
flag = 4     หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน และลูกค้าตอบ "เลือกรถแท๊กซี่ 1 คัน ที่จะให้มารับ"


*/

?>
<meta charset="UTF-8">
<h1>ลูกค้า ที่แจ้งความต้องการ แท๊กซี่</h1>
<form method="post" action="1_cust_req_save.php">
ลูกค้า Mobile Id	<input type="text" name="custid" readonly value="<?=$custId?>"><br/>
Lat<input type="text" name="lat" value="<?=$custLat;?>"><br/>
Long<input type="text" name="long" value="<?=$custLong?>"><br/>
<br/><br/>
<input type="submit" value="Submit">

</form>

