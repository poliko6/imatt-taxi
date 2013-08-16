<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="5%" align="center"><img src="modules/mod_car/images/banner-icon.png" alt="" width="50" height="50" /></td>
    <td width="29%"><a href="index.php?<?=$_SERVER['QUERY_STRING']?>" style="text-decoration:none;"><?=$lang_menu["menu_car_banner"]?></a><br />
		<span class="normal">เมนูเพิ่ม แก้ไข และลบ ยี่ห้อรถยนต์</span></td>
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
	if ($handle_banner = opendir('modules/mod_car/include/banner')) {
 		while (false !== ($file_banner = readdir($handle_banner)))
      	{
        	if ($file_banner != "." && $file_banner != "..")
			{   				
				if(strstr("$file_banner", "banner" ))
				{	
					$data_banner = explode('.', $file_banner);
					$file_menu_banner[$data_banner[1]]=$file_banner;
				}
			}
		}	
		
		closedir($handle_banner);
	}
	
	$ii_banner=0;
	
	foreach($file_menu_banner as $values)
	{		
		$ii_banner++;							
		
		if($file_menu_banner[$ii_banner]){
			include("modules/mod_car/include/banner/$file_menu_banner[$ii_banner]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   