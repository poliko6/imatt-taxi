<?php
include("var.php");
?>
<meta charset="utf-8">
<h1>ตัวอย่าง การแสดงตำแหน่ง รถtaxi ที่เปลี่ยนไป เมื่อเปลี่ยนพิกัด lat,long</h1>
<form method="post" action="taxi2.php">
	ป้อนเลข 1- <?=$var_car_number?>  <input type="text" name="id">
	<input type="submit" value="แสดงค่าพิกัด">
</form>
