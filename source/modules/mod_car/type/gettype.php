<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$car_type_chk = select_db('cartype',"where carTypeId = '".$id."'");
 	$type_name_edit = $car_type_chk[0]['carTypeName'];
	
	echo $type_name_edit;
?>