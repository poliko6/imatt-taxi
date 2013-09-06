<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$time_data = select_db('transportsection',"where transportSectionId = '".$id."'");
 	$detail = $time_data[0]['detail'];
	
	echo $detail;
?>