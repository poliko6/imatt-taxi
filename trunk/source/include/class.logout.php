<?php 
session_start(); 
session_unset(); 
session_destroy();
$user = NULL; 

$time = time(); 	
setcookie("u_id",'', $time - 3600,'/','.imattioapp.com'); 
setcookie("u_username",'', $time - 3600,'/','.imattioapp.com'); 
setcookie("u_garage",'', $time - 3600,'/','.imattioapp.com'); 
setcookie("u_garagepass",'', $time - 3600,'/','.imattioapp.com'); 
setcookie("u_type",'', $time - 3600,'/','.imattioapp.com'); 
setcookie("u_password",'', $time - 3600,'/','.imattioapp.com'); 
setcookie("chkMem",'', $time - 3600,'/','.imattioapp.com');

header('Location: ../login.php?typeuser=1');
?>
<!--<META HTTP-EQUIV="Refresh" CONTENT="0;URL=login.php"> -->