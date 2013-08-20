<?
	//$sql_menu = select_db('menulist', '');
	//pre($sql_menu);
	

	if ($handleMAIN = opendir('menu')) {
 		while (false !== ($fileMAIN = readdir($handleMAIN)))
    {
     	if ($fileMAIN != "." && $fileMAIN != "..")
			{   
				if(strstr("$fileMAIN", "menu.main" ))
				{	
					$dataMAIN = explode('.', $fileMAIN);
					
					//echo $dataMAIN[3]."<br>";
					#---------------Check permisstion--------------------------------------			
						if ((in_array($dataMAIN[3],$menuname_arr))){
							$file_menuMAIN[$dataMAIN[2]] = $fileMAIN;
						}							
					#----------------------------------------------------------------------	
					
				}
			}
		}	
		closedir($handleMAIN);
	}	
		
	$iiiMAIN = 0;
	
	if ((count($file_menuMAIN) > 1)){
		sort($file_menuMAIN);
	}

	
	//echo "<pre>"; echo print_r($file_menuMAIN); echo "</pre>";
		
	foreach($file_menuMAIN as $values)
	{		
		$iiiMAIN++;
		include("menu/$values");	
	}
		
?>      