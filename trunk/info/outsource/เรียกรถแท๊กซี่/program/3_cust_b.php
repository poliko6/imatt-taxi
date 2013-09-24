<?php
session_start();
set_time_limit(100000000);
include("var.php");
include("likit_google_map_distance.php");
$mysqli = new mysqli($MYSQLHOST,$MYSQLUSER,$MYSQLPASS,$MYSQLDB);
$mysqli->set_charset("utf8");
?>

<meta charset="UTF-8">
<?php
$custid=$_GET['custid'];
$sql="update likit_cust_select_car set flag='' where custid='$custid' ";
$mysqli->query($sql);

echo "<a href='1_cust_req.php'>ลูกค้ายกเลิก การเรียกรถแท๊กซี คลิกที่ เพื่อไปหน้าจอ เรียกรถแท๊กซี่ อีกครั้ง</a>";

?>

