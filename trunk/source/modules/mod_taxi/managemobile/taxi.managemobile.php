<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="5%" align="center"><img src="modules/mod_taxi/images/mobile-icon.png" alt="" width="50" height="50" /></td>
    <td width="29%"><a href="index.php?p=taxi.managemobile&menu=main_taxi" style="text-decoration:none;"><?=$lang_menu["menu_taxi_managemobile"]?></a><br />
		<span class="normal">เมนูเพิ่ม แก้ไข และลบ รายละเีอียดโทรศัพท์ในระบบ</span></td>
    <td width="66%" style="border:none;">
        <div class="alert" id="alert1" style="display:none; margin-top:5px; margin-bottom:5px;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg1"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>
        <div class="alert alert-error" id="alert2" style="display:none; margin-top:5px; margin-bottom:5px;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg2"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>
        <div class="alert alert-success" id="alert3" style="display:none; margin-top:5px; margin-bottom:5px;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg3"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>
        <div class="alert alert-info" id="alert4" style="display:none; margin-top:5px; margin-bottom:5px;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg4"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>        
    </td>
  </tr>
  <tr>
  	<td colspan="3">
	<?
	if ($handle_managemobile = opendir('modules/mod_taxi/managemobile')) {
 		while (false !== ($file_managemobile = readdir($handle_managemobile)))
      	{
        	if ($file_managemobile != "." && $file_managemobile != "..")
			{   				
				if(strstr("$file_managemobile", "managemobile" ))
				{	
					$data_managemobile = explode('.', $file_managemobile);
					$file_menu_managemobile[$data_managemobile[1]]=$file_managemobile;
				}
			}
		}	
		
		closedir($handle_managemobile);
	}
	
	$ii_managemobile=0;
	
	foreach($file_menu_managemobile as $values)
	{		
		$ii_managemobile++;							
		
		if($file_menu_managemobile[$ii_managemobile]){
			include("modules/mod_taxi/managemobile/$file_menu_managemobile[$ii_managemobile]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   