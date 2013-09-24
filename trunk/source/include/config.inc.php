<?php

	$_config['database']['hostname'] = "imattioapp.com";
	$_config['database']['username'] = "imattioa_taxi";
	$_config['database']['password'] = "taxi2013";
	$_config['database']['database'] = "imattioa_taxi";
	
	
	/*$_config['database']['hostname'] = "localhost";
	$_config['database']['username'] = "root";
	$_config['database']['password'] = "root";
	$_config['database']['database'] = "imattio_taxi";*/

	//connect the database server
	
		
	$link = new mysqldb();
	$link->connect($_config['database']);
	$link->selectdb($_config['database']['database']);
	$link->query("SET NAMES 'utf8'");
	
	
?>
