<?  
 	include("menu/lang.menu.php"); 
	
	$btn0="2";
	$btn1="2";
	$btn2="2";
	$btn3="2";
	$btn4="2";
	$btn5="2";
	$btn6="2";
	$btn7="2";
	$btn8="2";
	$btn9="2";
	$btn10="2";
	$btn11="2";


	$menuG = $_REQUEST["menu"]; 
	
	
	switch($menuG) {
	
	case '' : 
		$btn1="1";
		break;
		
	case 'main_user' : 
		$btn2="1";
		break;
	
	case 'main_car' : 
		$btn3="1";
		break;
	}
	
?>





<?	 
$im = 0;

//Supervisor Menu
if ($u_type == 1){
	$sql_mName = "select * from menulist where supervisorAllowed = 1 order by menuName";
	$rs_mName = mysql_query($sql_mName);
	while($data_mName = @mysql_fetch_object($rs_mName)) { 
		$menuname_subarr[$im] = $data_mName->menuName;	
		$im++;
	}
}

//Majors Menu
if ($u_type == 2){
	$sql_mName = "select * from menulist where majorAllowed = 1 order by menuName";
	$rs_mName = mysql_query($sql_mName);
	while($data_mName = @mysql_fetch_object($rs_mName)) { 
		$menuname_subarr[$im] = $data_mName->menuName;	
		$im++;
	}
}

//Entry Menu
if ($u_type == 3){
	$sql_mName = "SELECT * FROM minoradmin INNER JOIN minorType ON minorAdmin.minorTypeId = minorType.minorTypeId and username='".$u_username."'";
	$rs_mName = mysql_query($sql_mName);
	$data_mName = @mysql_fetch_object($rs_mName);
	$menuid = $data_mName->menuListId;
	$p_menuid = explode(',',$menuid);
	foreach($p_menuid as $valmenu){
		$data_mEntry = select_db('menuList',"where menuId='".$valmenu."'");
		$menuname_subarr[$im] = $data_mEntry[0]['menuName'];	
		$im++;
	}
}
#echo $sql_mName;
#echo "<pre>"; echo print_r($menuname_subarr); echo "</pre>";




$iiim = 0;
$menuname_arr = array();
for ($iim=0; $iim<count($menuname_subarr); $iim++){
	$menuname_data = explode('.', $menuname_subarr[$iim]);
	if(!(in_array($menuname_data[0],$menuname_arr))){
		$menuname_arr[$iiim] = $menuname_data[0];
		$iiim++;
	}	
}
//echo "<pre>"; echo print_r($menuname_arr); echo "</pre>";


if ($handle_index_submain = opendir('menu')) {
	while (false !== ($file_index_submain = readdir($handle_index_submain))) {
	    if ($file_index_submain != "." && $file_index_submain != "..") {   
			if(strstr("$file_index_submain", "menu.submain" )) {	
				$data_index_submain = explode('.', $file_index_submain);	
				//pre($data_index_submain);	
				//echo "===>".$data_index_submain[3]."<br>";
				
				#---------------Check permisstion--------------------------------------
				if ((in_array($data_index_submain[3],$menuname_arr))){
					$file_menu_submain[$data_index_submain[2]] = $file_index_submain;
				}			
				#----------------------------------------------------------------------	
				
			}
		}
	}	
	
	closedir($handle_index_submain);
}	



if ((count($file_menu_submain) > 1)){
	sort($file_menu_submain);
}
//echo "<pre>"; echo print_r($file_menu_submain); echo "</pre>";

$iii_index_submain = 0;

foreach($file_menu_submain as $values){	
	if($values){
		//echo '===>'.$values;
		echo "<li class='dropdown' style='font-size:12px;'>";
		include("menu/$values");
		
		$iii_index = explode('.', $values);
		$iii_index_submain = $iii_index[2];
				
		#sub menu -------------------------------------------------------------
		echo "<ul class='dropdown-menu'>";
		if ($handle_index_submain_sub = opendir('menu')) {
			while (false !== ($file_index_submain_sub = readdir($handle_index_submain_sub))) {
	   		 	if ($file_index_submain_sub != "." && $file_index_submain_sub != "..") {   
					$menu_submainx = "submain."."$iii_index_submain".".";
					//echo $menu_submainx."<br>";
					
					if(strstr("$file_index_submain_sub", "$menu_submainx" )) {	
						$data_index_submain_sub = explode('.', $file_index_submain_sub);
						
						#echo "<pre>"; echo print_r($data_index_submain_sub); echo "</pre>";
						$filecheck = $data_index_submain_sub[4].".".$data_index_submain_sub[5];	
						//echo $filecheck."<br>";
						#---------------Check permisstion--------------------------------------					
						if (in_array($filecheck,$menuname_subarr)) { 
							$file_menu_index_submain_sub[$data_index_submain_sub[3]]=$file_index_submain_sub;
						}
						#----------------------------------------------------------------------	
												
					}
				}
			}	
	
			closedir($handle_index_submain_sub);
		}
		
		#echo $values;
		#echo count($file_menu_index_submain_sub);
		
		#echo "<pre>"; echo print_r($file_menu_index_submain_sub); echo "</pre>";
		
		if ((count($file_menu_index_submain_sub) >= 1)){
			sort($file_menu_index_submain_sub);
		}
		
		
		#echo "<pre>"; echo print_r($file_menu_index_submain_sub); echo "</pre>";
		
		for ($iii_index_submain_sub=0; $iii_index_submain_sub<=count($file_menu_index_submain_sub); $iii_index_submain_sub++){
		
			if($file_menu_index_submain_sub[$iii_index_submain_sub]){
				echo "<li>";				
				include("menu/$file_menu_index_submain_sub[$iii_index_submain_sub]");
				echo "</li>";
			}	
				
		}

		
		$file_menu_index_submain_sub = "";
		echo "</ul>";
		#end sub ---------------------------------------------------------------
		
		
		echo "</li>";
	}	
							
	//$iii_index_submain++;	
}				
?>		