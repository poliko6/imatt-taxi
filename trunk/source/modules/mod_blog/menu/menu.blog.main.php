<?	 
	if ($handle_blog = opendir('modules/mod_blog/menu')) {
 		while (false !== ($file_blog = readdir($handle_blog)))
      	{
         	if ($file_blog != "." && $file_blog != "..")
			{   
				if(strstr("$file_blog", "menu.main" ))
				{	
					$data_blog = explode('.', $file_blog);
					
					//echo "<pre>".print_r($data_blog)."</pre>";
									
					#---------------Check permisstion--------------------------------------
					$filecheck = "blog.".$data_blog[3];
					if (in_array($filecheck,$menuname_subarr)){		
						$file_menu_blog[$data_blog[2]]=$file_blog;
					}
					#----------------------------------------------------------------------	
				}
			}
		}	
		closedir($handle_blog);
	}	

	//if ((count($file_menu_blog) > 1)){
	sort($file_menu_blog);
	//}
				
	foreach($file_menu_blog as $values){		
		if($values){
			include("modules/mod_blog/menu/$values");
		}			
	}
?>  