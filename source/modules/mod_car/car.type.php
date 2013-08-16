<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="5%" align="center"><img src="modules/mod_car/images/type-icon.png" alt="" width="50" height="50" /></td>
    <td width="29%"><a href="index.php?<?=$_SERVER['QUERY_STRING']?>" style="text-decoration:none;"><?=$lang_menu["menu_car_type"]?></a><br />
		<span class="normal">เมนูเพิ่ม แก้ไข และลบ ประเภทรถยนต์</span></td>
    <td width="66%" style="border:none;">
        <div class="alert" id="alert1" style="display:none;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg1"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>
        <div class="alert alert-error" id="alert2" style="display:none;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg2"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>
        <div class="alert alert-success" id="alert3" style="display:none;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg3"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>
        <div class="alert alert-info" id="alert4" style="display:none;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg4"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>        
    </td>
  </tr>
  <tr>
  	<td colspan="3">
	<?
	if ($handle_type = opendir('modules/mod_car/include/type')) {
 		while (false !== ($file_type = readdir($handle_type)))
      	{
        	if ($file_type != "." && $file_type != "..")
			{   				
				if(strstr("$file_type", "type" ))
				{	
					$data_type = explode('.', $file_type);
					$file_menu_type[$data_type[1]]=$file_type;
				}
			}
		}	
		
		closedir($handle_type);
	}
	
	$ii_type=0;
	
	foreach($file_menu_type as $values)
	{		
		$ii_type++;							
		
		if($file_menu_type[$ii_type]){
			include("modules/mod_car/include/type/$file_menu_type[$ii_type]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   