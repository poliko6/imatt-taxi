<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_mobile/images/banner-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=mobile.banner&menu=main_mobile" style="text-decoration:none;"><?=$lang_menu["mobile.banner"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ ยี่ห้อมือถือ</div>
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
	if ($handle_banner = opendir('modules/mod_mobile/banner')) {
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
			include("modules/mod_mobile/banner/$file_menu_banner[$ii_banner]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   