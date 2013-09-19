<?php 
session_start(); 
session_unset(); 
session_destroy();
$user = NULL; 
/*if(isset($_COOKIE['taximeter_imattio'])) // If the cookie 'taximeter_imattio is set, do the following; 
{ 
	$time = time(); 
	setcookie("taximeter_imattio[username]", $time - 3600); 
	setcookie("taximeter_imattio[password]", $time - 3600); 
	setcookie("taximeter_imattio[garageid]", $time - 3600); 
} */
header('Location: ../login.php?typeuser=1');
?>
<!--<META HTTP-EQUIV="Refresh" CONTENT="0;URL=login.php"> -->