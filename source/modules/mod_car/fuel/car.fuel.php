<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_car/images/fuel-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=car.fuel&menu=main_car" style="text-decoration:none;"><?=$lang_menu["menu_car_fuel"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ ประเภทเชื้อเพลิงรถยนต์</div>
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
	if ($handle_fuel = opendir('modules/mod_car/fuel')) {
 		while (false !== ($file_fuel = readdir($handle_fuel)))
      	{
        	if ($file_fuel != "." && $file_fuel != "..")
			{   				
				if(strstr("$file_fuel", "fuel" ))
				{	
					$data_fuel = explode('.', $file_fuel);
					$file_menu_fuel[$data_fuel[1]]=$file_fuel;
				}
			}
		}	
		
		closedir($handle_fuel);
	}
	
	$ii_fuel=0;
	
	foreach($file_menu_fuel as $values)
	{		
		$ii_fuel++;							
		
		if($file_menu_fuel[$ii_fuel]){
			include("modules/mod_car/fuel/$file_menu_fuel[$ii_fuel]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   