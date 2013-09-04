<?
 	require_once '../../../include/Zend/JSON.php';
	$json = new Services_JSON();
	
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	$username = trim($username);
	$u_garage = trim($u_garage);
		
	$minor_chk = select_db('minoradmin',"where username = '".$username."' and garageId = '".$u_garage."'");
 	$find_used = count($minor_chk);
	
	
	if ($find_used){
		$data['success'] = false;
	} else {
		$data['success'] = true;		
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>