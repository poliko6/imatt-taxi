<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$minor_type_chk = select_db('minortype',"where minorTypeId = '".$id."'");
 	$type_name_edit = $minor_type_chk[0]['minorType'];
	$menu_name_edit = $minor_type_chk[0]['menuListId'];
	
	echo $type_name_edit.'|'.$menu_name_edit;
?>