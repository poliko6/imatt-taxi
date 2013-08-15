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
$facebook = new Facebook(array(
  'appId'  => '595440030501428',
  'secret' => '4376db4d073178d3e1860436f1e3b097',
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
		
	$sql = "SELECT id,type_id,status FROM usedcar_member where facebook = '".$user_profile[id]."'";
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
			$_SESSION['user_id'] = $objData->id;
			$_SESSION['type_user'] = $objData->type_user;
	 		$data['success'] = true;
		}
	}	
	$logoutUrl = $facebook->getLogoutUrl();
} else { 	
	//session_destroy();
  	//$loginUrl = $facebook->getLoginUrl();
		
	$loginUrl = $facebook->getLoginUrl();
}

?>
