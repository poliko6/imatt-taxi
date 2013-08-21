<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="5%" align="center"><img src="modules/mod_car/images/color-icon.png" alt="" width="50" height="50" /></td>
    <td width="29%"><a href="index.php?p=car.color&menu=main_car" style="text-decoration:none;"><?=$lang_menu["menu_car_color"]?></a><br />
		<span class="normal">เมนูเพิ่ม แก้ไข และลบ ประเภทรถยนต์</span></td>
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
	if ($handle_color = opendir('modules/mod_car/color')) {
 		while (false !== ($file_color = readdir($handle_color)))
      	{
        	if ($file_color != "." && $file_color != "..")
			{   				
				if(strstr("$file_color", "color" ))
				{	
					$data_color = explode('.', $file_color);
					$file_menu_color[$data_color[1]]=$file_color;
				}
			}
		}	
		
		closedir($handle_color);
	}
	
	$ii_color=0;
	
	foreach($file_menu_color as $values)
	{		
		$ii_color++;							
		
		if($file_menu_color[$ii_color]){
			include("modules/mod_car/color/$file_menu_color[$ii_color]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   