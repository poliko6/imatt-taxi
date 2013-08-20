<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$car_color_chk = select_db('carcolor',"where carColorId = '".$id."'");
 	$color_name_edit = $car_color_chk[0]['carColorName'];
	
	echo $color_name_edit;
?>