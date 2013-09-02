<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_car/images/color-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=car.color&menu=main_car" style="text-decoration:none;"><?=$lang_menu["car.color"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ สีรถยนต์</div>
                </div>
                <div class="span7">
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
                </div>
            </div>
        </div>
	</td>   
  </tr>
  <tr>
  	<td>
 
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