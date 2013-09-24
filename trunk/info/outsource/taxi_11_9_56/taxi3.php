<meta charset="utf-8"/>
<?php

include("var.php");

$id=$_POST['id'];
$a=$_POST['a'];
$b=$_POST['b'];

$mysqli = new mysqli("$MYSQLHOST","$MYSQLUSER","$MYSQLPASS","$MYSQLDB");
$mysqli->set_charset("utf8");
$sql="update mobile set  latitude='$a',longitude='$b' where mobileId ='$id'";
$result=$mysqli->query($sql);
?>

<h1>แก้ไข lat ,long เรียบร้อยแล้ว </h1>
<?
echo "<meta http-equiv=refresh content=1;URL=taxi1.php>";
?>
