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
	
	
	if ($process == 'login') {
	
		$sql = "SELECT COUNT(customerId) AS finddata FROM customer ";
		$sql .= "WHERE email = '".trim($username)."' AND password = '".trim(sha1($password))."' ";
	} 
	
	if ($process == 'loginfb') {
		$sql = "SELECT COUNT(customerId) AS finddata FROM customer ";
		$sql .= "WHERE facebookId = '".trim($fbID)."'";
	}
	
	$exe = mysql_query($sql) or die(mysql_error());
	$data = mysql_fetch_object($exe);
	$finddata = $data->finddata;
	


	if ($finddata > 0){	
	
		if ($process == 'login') {
			$sql_customer = "SELECT * FROM customer ";
			$sql_customer .= "WHERE email = '".trim($username)."' AND password = '".trim(sha1($password))."' ";
		}
		
		if ($process == 'loginfb') {
			$sql_customer = "SELECT * FROM customer ";
			$sql_customer .= "WHERE facebookId = '".trim($fbID)."' ";
		}
		//echo $sql_customer;
		$rs_customer = mysql_query($sql_customer);
		$data_customer = mysql_fetch_object($rs_customer);
		
		$u_id = $data_customer->customerId;
		$u_lock = $data_customer->lock;
		$u_type = 4;	
		$u_username = $username;
		
		if ($u_lock == 0){ 
		
			if ($process == 'login') {
				echo "<div class='alert alert-login alert-error'>User ของคุณถูกล๊อค</div>";	
			}
			
			if ($process == 'loginfb') {
				echo '0';
			}
			session_destroy();
			$user = NULL; 
		
		} else { //Unlock
		
			$_SESSION['u_fbid'] = $fbID;
			$_SESSION['u_garage'] = 0; //ถ้าเป็นลูกค้าให้เป็น 0
			$_SESSION['u_username'] = $u_username;
			$_SESSION['u_id'] = $u_id;	 	//id มาจากตาราง major และ minor
			$_SESSION['u_type'] = $u_type; 	//ถ้าเป็นลูกค้าให้เป็น 4
			$_SESSION['pass_actived'] = 'actived';		
			
			//มีปัญหาเรื่อง Cookie
			if($chkMem) { 			
				//setcookie("ID", $username, time()+3600*24*365);
				//setcookie("uname",$username,time()+3600*24*365,'/','.taxi.imattioapp.com');
				//setcookie("taximeter_[username]", $username, $time + 3600); // Sets the cookie username 
				//setcookie("taximeter_[password]", $password, $time + 3600); // Sets the cookie password 
				//setcookie("taximeter_[garageid]", $garageid, $time + 3600); // Sets the cookie password 
				
			}
			
			if ($process == 'login') {
				echo "<div class='alert alert-login alert-success'>เข้าสู่ระบบโดย : <strong>".$u_username."</strong></div>";
				echo "<script>window.location='index.php';</script>";
				/*echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";*/
			}
			if ($process == 'loginfb') {
				echo '1';
			}
			
		} //if Lock
		
	} else {
		if ($process == 'login') {
			echo "<div class='alert alert-login alert-error'>ไม่สามารถเข้าสู่ระบบได้</div>";	
		}
		
		if ($process == 'loginfb') {
			echo '0';
		}
		
		session_destroy();
		$user = NULL; 
	}
	//ob_end_flush();
?>