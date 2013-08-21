<?	 
	if ($handle_taxi = opendir('modules/mod_taxi/menu')) {
 		while (false !== ($file_taxi = readdir($handle_taxi)))
      	{
         	if ($file_taxi != "." && $file_taxi != "..")
			{   
				if(strstr("$file_taxi", "menu.main" ))
				{	
					$data_taxi = explode('.', $file_taxi);
					
					//echo "<pre>".print_r($data_taxi)."</pre>";
									
					#---------------Check permisstion--------------------------------------
					$filecheck = "taxi.".$data_taxi[3];
					if (in_array($filecheck,$menuname_subarr)){		
						$file_menu_taxi[$data_taxi[2]]=$file_taxi;
					}
					#----------------------------------------------------------------------	
				}
			}
		}	
		closedir($handle_taxi);
	}	

	//if ((count($file_menu_taxi) > 1)){
	sort($file_menu_taxi);
	//}
				
	foreach($file_menu_taxi as $values){		
		if($values){
			include("modules/mod_taxi/menu/$values");
		}			
	}
?>  