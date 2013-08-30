<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_car/images/gas-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=car.gas&menu=main_car" style="text-decoration:none;"><?=$lang_menu["menu_car_gas"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ ประเภทแก๊สรถยนต์</div>
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
	if ($handle_gas = opendir('modules/mod_car/gas')) {
 		while (false !== ($file_gas = readdir($handle_gas)))
      	{
        	if ($file_gas != "." && $file_gas != "..")
			{   				
				if(strstr("$file_gas", "gas" ))
				{	
					$data_gas = explode('.', $file_gas);
					$file_menu_gas[$data_gas[1]]=$file_gas;
				}
			}
		}	
		
		closedir($handle_gas);
	}
	
	$ii_gas=0;
	
	foreach($file_menu_gas as $values)
	{		
		$ii_gas++;							
		
		if($file_menu_gas[$ii_gas]){
			include("modules/mod_car/gas/$file_menu_gas[$ii_gas]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   