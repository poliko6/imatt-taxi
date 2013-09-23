<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$mobile_model_chk = select_db('mobilemodel',"where mobileModelId = '".$id."'");
 	$model_name_edit = $mobile_model_chk[0]['mobileModelName'];
	
	echo $model_name_edit;
?>