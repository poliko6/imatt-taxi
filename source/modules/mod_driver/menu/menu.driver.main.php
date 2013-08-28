<?	 
	if ($handle_driver = opendir('modules/mod_driver/menu')) {
 		while (false !== ($file_driver = readdir($handle_driver)))
      	{
         	if ($file_driver != "." && $file_driver != "..")
			{   
				if(strstr("$file_driver", "menu.main" ))
				{	
					$data_driver = explode('.', $file_driver);
					
					//echo "<pre>".print_r($data_driver)."</pre>";
									
					#---------------Check permisstion--------------------------------------
					$filecheck = "driver.".$data_driver[3];
					if (in_array($filecheck,$menuname_subarr)){		
						$file_menu_driver[$data_driver[2]]=$file_driver;
					}
					#----------------------------------------------------------------------	
				}
			}
		}	
		closedir($handle_driver);
	}	

	//if ((count($file_menu_driver) > 1)){
	sort($file_menu_driver);
	//}
				
	foreach($file_menu_driver as $values){		
		if($values){
			include("modules/mod_driver/menu/$values");
		}			
	}
?>  