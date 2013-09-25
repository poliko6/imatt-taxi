<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_mobile/images/configtime-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=mobile.configtime&menu=main_mobile" style="text-decoration:none;"><?=$lang_menu["mobile.configtime"]?></a></div>
                    <div class="normal">เมนูแก้ไข ระยะเวลาการส่งค่าพิกัดของมือถือ</div>
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
	if ($handle_configtime = opendir('modules/mod_mobile/configtime')) {
 		while (false !== ($file_configtime = readdir($handle_configtime)))
      	{
        	if ($file_configtime != "." && $file_configtime != "..")
			{   				
				if(strstr("$file_configtime", "configtime" ))
				{	
					$data_configtime = explode('.', $file_configtime);
					$file_menu_configtime[$data_configtime[1]]=$file_configtime;
				}
			}
		}	
		
		closedir($handle_configtime);
	}
	
	$ii_configtime=0;
	
	foreach($file_menu_configtime as $values)
	{		
		$ii_configtime++;							
		
		if($file_menu_configtime[$ii_configtime]){
			include("modules/mod_mobile/configtime/$file_menu_configtime[$ii_configtime]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   