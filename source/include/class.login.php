<?  //ob_start();
	session_start();

	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key.'='.$value."<br>";
	}
	
	$time = time(); // Gets the current server time 
		
	include("class.mysqldb.php");
	include("config.inc.php");
	
	$find = 0;
	
	$sql = "SELECT COUNT(majorId) AS finddata FROM majoradmin INNER JOIN garagelist ON majoradmin.garageId = garagelist.garageId ";
	$sql .= "WHERE username = '".trim($username)."' AND password = '".trim(sha1($password))."' ";
	$sql .= "AND garagelist.garageName = '".trim($garageid)."'";
	
	$exe = mysql_query($sql) or die(mysql_error());
	$data = mysql_fetch_object($exe);
	$finddata_major = $data->finddata;
	
	
	if ($finddata_major > 0) {
		
		$sql_major = "SELECT * FROM majoradmin INNER JOIN garagelist ON majoradmin.garageId = garagelist.garageId ";
		$sql_major .= "WHERE username = '".trim($username)."' AND password = '".trim(sha1($password))."' ";
		$sql_major .= "AND garagelist.garageName = '".trim($garageid)."'";
		
		$rs_major = mysql_query($sql_major);
		$data_major = mysql_fetch_object($rs_major);
		
		$u_id = $data_major->majorId;
		$u_garageid = $data_major->garageId;	
		$u_type = $data_major->majorTypeId;	
		$u_username = $username;
		$find = 1;
	
	} else {
		
		$sql = "SELECT COUNT(minorId) AS finddata FROM minoradmin INNER JOIN garagelist ON minoradmin.garageId = garagelist.garageId ";
		$sql .= "WHERE username = '".trim($username)."' AND password = '".trim(sha1($password))."' ";
		$sql .= "AND garagelist.garageName = '".trim($garageid)."'";
		
		$exe = mysql_query($sql) or die(mysql_error());
		$data = mysql_fetch_object($exe);
		$finddata_minor = $data->finddata;
		
		if ($finddata_minor > 0) {
			$sql_minor = "SELECT * FROM minoradmin INNER JOIN garagelist ON minoradmin.garageId = garagelist.garageId ";
			$sql_minor .= "WHERE username = '".trim($username)."' AND password = '".trim(sha1($password))."' ";
			$sql_minor .= "AND garagelist.garageName = '".trim($garageid)."'";
			
			$exe_minor = mysql_query($sql_minor) or die(mysql_error());
			$data_minor = mysql_fetch_object($exe_minor);
		
			$u_id = $data_minor->minorId;
			$u_garageid = $data_minor->garageId;	
			$u_type = 3;	
			$u_username = $username;
			$find = 1;			
				
		}
	
	}
	

	if ($find > 0){	
		$_SESSION['u_garage'] = $u_garageid; //ถ้าเป็นพนักงานให้เป็น 3
		$_SESSION['u_username'] = $u_username;
		$_SESSION['u_id'] = $u_id;	 //id มาจากตาราง major และ minor
		$_SESSION['u_type'] = $u_type; //ถ้าเป็นพนักงานให้เป็น 3
		$_SESSION['pass_actived'] = 'actived';
		
		echo "<div class='alert alert-login alert-success'>เข้าสู่ระบบโดย : <strong>".$u_username."</strong></div>";

		//มีปัญหาเรื่อง Cookie
		if($chkMem) { 			
			//setcookie("ID", $username, time()+3600*24*365);
			//setcookie("uname",$username,time()+3600*24*365,'/','.taxi.imattioapp.com');
			//setcookie("taximeter_[username]", $username, $time + 3600); // Sets the cookie username 
			//setcookie("taximeter_[password]", $password, $time + 3600); // Sets the cookie password 
			//setcookie("taximeter_[garageid]", $garageid, $time + 3600); // Sets the cookie password 
			
		}
		/*echo "<script>window.location='index.php';</script>";*/
		echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";
		
	} else {
		echo "<div class='alert alert-login alert-error'>ไม่สามารถเข้าสู่ระบบได้</div>";	
	}
	//ob_end_flush();
?>