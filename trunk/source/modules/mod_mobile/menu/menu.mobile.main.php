<?	 
	if ($handle_mobile = opendir('modules/mod_mobile/menu')) {
 		while (false !== ($file_mobile = readdir($handle_mobile)))
      	{
         	if ($file_mobile != "." && $file_mobile != "..")
			{   
				if(strstr("$file_mobile", "menu.main" ))
				{	
					$data_mobile = explode('.', $file_mobile);
					
					//echo "<pre>".print_r($data_mobile)."</pre>";
									
					#---------------Check permisstion--------------------------------------
					$filecheck = "mobile.".$data_mobile[3];
					if (in_array($filecheck,$menuname_subarr)){		
						$file_menu_mobile[$data_mobile[2]]=$file_mobile;
					}
					#----------------------------------------------------------------------	
				}
			}
		}	
		closedir($handle_mobile);
	}	
	//pre($menuname_subarr);
	//echo count($file_menu_mobile);
	//if ((count($file_menu_mobile) > 1)){
		sort($file_menu_mobile);
	//}
	
				
	foreach($file_menu_mobile as $values){		
		if($values){
			include("modules/mod_mobile/menu/$values");
		}			
	}
?>  