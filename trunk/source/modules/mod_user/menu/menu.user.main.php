<?	 
	if ($handle_user = opendir('modules/mod_user/menu')) {
 		while (false !== ($file_user = readdir($handle_user)))
      	{
         	if ($file_user != "." && $file_user != "..")
			{   
				if(strstr("$file_user", "menu.main" ))
				{	
					$data_user = explode('.', $file_user);
					
					//echo "<pre>".print_r($data_user)."</pre>";
									
					#---------------Check permisstion--------------------------------------
					$filecheck = "user.".$data_user[3];
					if (in_array($filecheck,$menuname_subarr)){		
						$file_menu_user[$data_user[2]]=$file_user;
					}
					#----------------------------------------------------------------------	
				}
			}
		}	
		closedir($handle_user);
	}	

	//if ((count($file_menu_user) > 1)){
	sort($file_menu_user);
	//}
				
	foreach($file_menu_user as $values){		
		if($values){
			include("modules/mod_user/menu/$values");
		}			
	}
?>  