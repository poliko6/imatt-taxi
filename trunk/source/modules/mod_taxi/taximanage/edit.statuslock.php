<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$TableName = 'car';
	$data = array(
		'lock'=>$status
	);
	$sql = update_db($TableName, array('carId='=>$id), $data);
	$rs = mysql_query($sql);
	//echo $sql;
	if($rs){
				
		echo '1';
		
	} else {
		
		echo '0';
	}
					
?>