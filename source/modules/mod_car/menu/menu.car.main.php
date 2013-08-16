<?	 
	if ($handle_car = opendir('modules/mod_car/menu')) {
 		while (false !== ($file_car = readdir($handle_car)))
      	{
         	if ($file_car != "." && $file_car != "..")
			{   
				if(strstr("$file_car", "menu.main" ))
				{	
					$data_car = explode('.', $file_car);
					
					//echo "<pre>".print_r($data_car)."</pre>";
									
					#---------------Check permisstion--------------------------------------
					$filecheck = "car.".$data_car[3];
					if (in_array($filecheck,$menuname_subarr)){		
						$file_menu_car[$data_car[2]]=$file_car;
					}
					#----------------------------------------------------------------------	
				}
			}
		}	
		closedir($handle_car);
	}	

	//if ((count($file_menu_car) > 1)){
	sort($file_menu_car);
	//}
				
	foreach($file_menu_car as $values){		
		if($values){
			include("modules/mod_car/menu/$values");
		}			
	}
?>  