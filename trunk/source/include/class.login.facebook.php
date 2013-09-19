<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
//imattioapps facebook
$facebook = new Facebook(array(
  'appId'  => '228765240611874',
  'secret' => '61ce414146f3a1442c4cefb6ca215666',
));



// See if there is a user from a cookie
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}


if ($user) {
		
	$sql = "SELECT * FROM customer where facebookId = '".$user_profile[id]."'";
	$objQuery = mysql_query($sql) or die ("Error Query [".$sql."]");
	$CheckData = @mysql_num_rows($objQuery);
	
	#echo $sql;
	
	$data['chk'] = 0;
		
	if($CheckData == 0)
	{
		$data['success'] = false;		
	}
	else
	{
		$objData = @mysql_fetch_object($objQuery);
		if ($objData->status == 0){
			$data['success'] = false;
			$data['chk'] = 1;
			//
		} else {
			
			$_SESSION['u_fbid'] = $user_profile[id];
			$_SESSION['u_garage'] = 0; //ถ้าเป็นลูกค้าให้เป็น 0
			$_SESSION['u_username'] = $objData->email;
			$_SESSION['u_id'] = $objData->id;	 	//id มาจากตาราง major และ minor
			$_SESSION['u_type'] = 4; 	//ถ้าเป็นลูกค้าให้เป็น 4
			//$_SESSION['pass_actived'] = 'actived';
	 		$data['success'] = true;
		}
	}	
	$logoutUrl = $facebook->getLogoutUrl();
	
} else { 	

	//session_destroy();
	//$user = NULL;
	
  	//$loginUrl = $facebook->getLoginUrl();
		
	$loginUrl = $facebook->getLoginUrl();
}

?>
