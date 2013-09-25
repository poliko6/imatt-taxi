<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_mobile/images/network-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=mobile.network&menu=main_mobile" style="text-decoration:none;"><?=$lang_menu["mobile.network"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ เครือข่ายโทรศัพท์</div>
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
	if ($handle_network = opendir('modules/mod_mobile/network')) {
 		while (false !== ($file_network = readdir($handle_network)))
      	{
        	if ($file_network != "." && $file_network != "..")
			{   				
				if(strstr("$file_network", "network" ))
				{	
					$data_network = explode('.', $file_network);
					$file_menu_network[$data_network[1]]=$file_network;
				}
			}
		}	
		
		closedir($handle_network);
	}
	
	$ii_network=0;
	
	foreach($file_menu_network as $values)
	{		
		$ii_network++;							
		
		if($file_menu_network[$ii_network]){
			include("modules/mod_mobile/network/$file_menu_network[$ii_network]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   