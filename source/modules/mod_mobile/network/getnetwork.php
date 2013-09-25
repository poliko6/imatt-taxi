<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$mobile_network_chk = select_db('mobilenetwork',"where mobileNetworkId = '".$id."'");
 	$network_name_edit = $mobile_network_chk[0]['mobileNetworkName'];
	
	echo $network_name_edit;
?>