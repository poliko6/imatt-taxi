<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$car_gas_chk = select_db('cargas',"where carGasId = '".$id."'");
 	$gas_name_edit = $car_gas_chk[0]['carGasName'];
	
	echo $gas_name_edit;
?>