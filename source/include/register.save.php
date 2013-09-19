<?
	session_start();
	include("class.function.php");
	include("class.mysqldb.php");
	include("config.inc.php");
	include("class.login.facebook.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		//echo $key ."=". $value."<br>";
	}
	
	
	if(isset($regis)) {
	
		define('FACEBOOK_APP_ID', '228765240611874');
		define('FACEBOOK_SECRET', '61ce414146f3a1442c4cefb6ca215666');
		
		function parse_signed_request($signed_request, $secret) {
			  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 		  
			  
			
			  // decode the data
			  $sig = base64_url_decode($encoded_sig);
			  $data = json_decode(base64_url_decode($payload), true);
			
			  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
				error_log('Unknown algorithm. Expected HMAC-SHA256');
				return null;
			  }
			
			  // check sig
			  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
			  	
				//pre($expected_sig);
				//pre($sig);
				
			  /*if ($sig !== $expected_sig) {
				error_log('Bad Signed JSON signature!');
				return null;
			  }*/
				
			  return $data;
		}
		
		
		function base64_url_decode($input) {
			return base64_decode(strtr($input, '-_', '+/'));
		}
		
		
		$status = false;
		
		if ($_REQUEST) {
			//echo '<p>signed_request contents:</p>';
			$response = parse_signed_request($_REQUEST['signed_request'], 
										   FACEBOOK_SECRET);
			/*echo '<pre>';
			print_r($response);
			echo '</pre>';*/
			
			if ($response['registration']['email'] != ''){

				try {
			 
					$fbId = (isset($response['user_id'])) ? $response['user_id'] : 0;
					 
					$sth = "SELECT * FROM customer WHERE email = '".$response['registration']['email']."' ";
					$rs = mysql_query($sth);
					$chkuser = mysql_num_rows($rs); 
					//echo $sth;      
					 
					if ($chkuser != 0)
					{              		 
						if ($fbId != 0)
						{
							
							$location = $response['registration']['location'];
							if (is_array($location))
							{
								$location = $location['name'];
							}						 
				
							$name_p = explode(' ',$response['registration']['name']);
							
							$Table_Name = 'customer';
							$data = array(
								'facebookId'=>$fbId,								
								'password'=>trim(sha1($response['registration']['password'])),
								'firstName'=>$name_p[0],
								'lastName'=>$name_p[1],
								'citizenId'=>$response['registration']['citizenid'],
								'location'=>$location,
								'birthday'=>$response['registration']['birthday'],
								'telephone'=>$response['registration']['phone'],
								'gender'=>$response['registration']['gender']
							);
							$sql_prepare = update_db($Table_Name, array('email='=>$response['registration']['email']), $data);
							$rs_prepare = mysql_query($sql_prepare);	
						
							//echo $sql_prepare;	
							//exit;	
							if ($rs_prepare)
							{
								$status = true;
								echo "<meta http-equiv=\"refresh\" content=\"0;URL=../login.php?typeuser=2\">";
							}
						}
					}
					else
					{
						$location = $response['registration']['location'];
						if (is_array($location))
						{
							$location = $location['name'];
						}						 
				
						$name_p = explode(' ',$response['registration']['name']);
									 
						$Table_Name = 'customer';
						$data = array(
								'facebookId'=>$fbId,
								'email'=>$response['registration']['email'],
								'password'=>trim(sha1($response['registration']['password'])),
								'firstName'=>$name_p[0],
								'lastName'=>$name_p[1],
								'citizenId'=>$response['registration']['citizenid'],
								'location'=>$location,
								'birthday'=>$response['registration']['birthday'],
								'telephone'=>$response['registration']['phone'],
								'gender'=>$response['registration']['gender']
						);
						$sql = insert_db($Table_Name, $data);
						$rs_adddata = mysql_query($sql);						
						//echo $sql;
				
						if ($rs_adddata)
						{
							$status = true;
							echo "<meta http-equiv=\"refresh\" content=\"0;URL=../login.php?typeuser=2\">";
						}
					}
				
	
			   
				} catch (Exception $e) {
					array_push($errors, 'Database error: ' . $e->getMessage());
				}
		  
			}
			
		  	$message = $message2 = '';
			if (true === $status)
			{
				$message = "User registered successfully";
			}
			else
			{
				$message = "Errors during registration";
				/*if (!empty($errors))
				{
					echo '<ul>';
					 
					foreach ($errors as $e)
					{
						echo '<li>' . $e . '</li>';
					}
					 
					echo '</ul>';
				}*/
			}
		  
		} else {
		  $message = '$_REQUEST is empty';
		}
	}

?>

