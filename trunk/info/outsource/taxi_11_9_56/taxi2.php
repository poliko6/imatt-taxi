<meta charset="utf-8"/>

<?php

include("var.php");

$id=$_POST['id'];

$mysqli = new mysqli("$MYSQLHOST","$MYSQLUSER","$MYSQLPASS","$MYSQLDB");
$mysqli->set_charset("utf8");
$sql="select latitude,longitude from mobile where mobileId ='$id'";
$result=$mysqli->query($sql);
$row=$result->fetch_array();
$latitude=$row['latitude'];
$longitude=$row['longitude'];

?>

<form method="post" action="taxi3.php">
<input type='hidden' name='id' value="<?=$id?>">
	lat : <input type="text" name="a" value="<?=$latitude?>">
	&nbsp;&nbsp;&nbsp;&nbsp;
	long: <input type="text" name="b" value="<?=$longitude?>">

	&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='submit' value="Save">
</form>