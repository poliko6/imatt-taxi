<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="5%" align="center"><img src="modules/mod_driver/images/managedriver-icon.png" alt="" width="50" height="50" /></td>
    <td width="29%"><a href="index.php?p=taxi.managedriver&menu=main_taxi" style="text-decoration:none;"><?=$lang_menu["menu_driver_manage"]?></a><br />
		<span class="normal">เมนูเพิ่ม แก้ไข และลบ รายละเีอียดคนขับแท๊กซี่ในระบบ</span></td>
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
	if ($handle_managedriver = opendir('modules/mod_driver/managedriver')) {
 		while (false !== ($file_managedriver = readdir($handle_managedriver)))
      	{
        	if ($file_managedriver != "." && $file_managedriver != "..")
			{   				
				if(strstr("$file_managedriver", "managedriver" ))
				{	
					$data_managedriver = explode('.', $file_managedriver);
					$file_menu_managedriver[$data_managedriver[1]]=$file_managedriver;
				}
			}
		}	
		
		closedir($handle_managedriver);
	}
	
	$ii_managedriver=0;
	
	foreach($file_menu_managedriver as $values)
	{		
		$ii_managedriver++;							
		
		if($file_menu_managedriver[$ii_managedriver]){
			include("modules/mod_driver/managedriver/$file_menu_managedriver[$ii_managedriver]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   