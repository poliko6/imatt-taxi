<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_taxi/images/mapposition-icon.png" alt="" width="50" height="50"/>
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=taxi.mapposition&menu=main_taxi" style="text-decoration:none;"><?=$lang_menu["taxi.position"]?></a></div>
                    <div class="normal">เมนูข้อมูลรายละเอียดตำแหน่งแท๊กซี่ในระบบ</div>
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
	if ($handle_mapposition = opendir('modules/mod_taxi/mapposition')) {
 		while (false !== ($file_mapposition = readdir($handle_mapposition)))
      	{
        	if ($file_mapposition != "." && $file_mapposition != "..")
			{   				
				if(strstr("$file_mapposition", "mapposition" ))
				{	
					$data_mapposition = explode('.', $file_mapposition);
					$file_menu_mapposition[$data_mapposition[1]]=$file_mapposition;
				}
			}
		}	
		
		closedir($handle_mapposition);
	}
	
	$ii_mapposition=0;
	
	foreach($file_menu_mapposition as $values)
	{		
		$ii_mapposition++;							
		
		if($file_menu_mapposition[$ii_mapposition]){
			include("modules/mod_taxi/mapposition/$file_menu_mapposition[$ii_mapposition]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   