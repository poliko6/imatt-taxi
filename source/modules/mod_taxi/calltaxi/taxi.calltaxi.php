<?
foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	echo $key ."=". $value."<br>";
}

switch ($act) {
	case 'calltaxi':
		include('modules/mod_taxi/calltaxi/calltaxiSelect.php');		
		break;
	
	default:
		include('modules/mod_taxi/calltaxi/calltaxiShow.php');
		break;
}
?>