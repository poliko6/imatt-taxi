<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$car_model_chk = select_db('carmodel',"where carModelId = '".$id."'");
 	$model_name_edit = $car_model_chk[0]['carModelName'];
	
	echo $model_name_edit;
?>