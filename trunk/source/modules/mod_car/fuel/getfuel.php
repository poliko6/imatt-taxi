<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$car_fuel_chk = select_db('carfuel',"where carFuelId = '".$id."'");
 	$fuel_name_edit = $car_fuel_chk[0]['carFuelName'];
	
	echo $fuel_name_edit;
?>