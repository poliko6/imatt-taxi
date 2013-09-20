<?
foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	echo $key ."=". $value."<br>";
}


if ($driverId == '') {
	
	switch ($act) {
		case 'search':
			include('modules/mod_driver/drivercheck/drivercheck.listsearch.php');		
			break;
		
		default:
			include('modules/mod_driver/drivercheck/drivercheck.search.php');
			break;
	}
	
} else { 
	include('modules/mod_driver/drivercheck/drivercheck.show.php');
}
?>