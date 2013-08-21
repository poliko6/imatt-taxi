<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="5%" align="center"><img src="modules/mod_car/images/model-icon.png" alt="" width="50" height="50" /></td>
    <td width="29%"><a href="index.php?p=car.model&menu=main_car" style="text-decoration:none;"><?=$lang_menu["menu_car_model"]?></a><br />
		<span class="normal">เมนูเพิ่ม แก้ไข และลบ รุ่นรถยนต์</span></td>
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
	if ($handle_model = opendir('modules/mod_car/model')) {
 		while (false !== ($file_model = readdir($handle_model)))
      	{
        	if ($file_model != "." && $file_model != "..")
			{   				
				if(strstr("$file_model", "model" ))
				{	
					$data_model = explode('.', $file_model);
					$file_menu_model[$data_model[1]]=$file_model;
				}
			}
		}	
		
		closedir($handle_model);
	}
	
	$ii_model=0;
	
	foreach($file_menu_model as $values)
	{		
		$ii_model++;							
		
		if($file_menu_model[$ii_model]){
			include("modules/mod_car/model/$file_menu_model[$ii_model]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   