<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_taxi/images/taximanage-icon.png" alt="" width="50" height="50"/>
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=taxi.taximanage&menu=main_taxi" style="text-decoration:none;"><?=$lang_menu["taxi.taximanage"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ รายละเีอียดรถแท๊กซี่ในระบบ</div>
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
	if ($handle_taximanage = opendir('modules/mod_taxi/taximanage')) {
 		while (false !== ($file_taximanage = readdir($handle_taximanage)))
      	{
        	if ($file_taximanage != "." && $file_taximanage != "..")
			{   				
				if(strstr("$file_taximanage", "taximanage" ))
				{	
					$data_taximanage = explode('.', $file_taximanage);
					$file_menu_taximanage[$data_taximanage[1]]=$file_taximanage;
				}
			}
		}	
		
		closedir($handle_taximanage);
	}
	
	$ii_taximanage=0;
	
	foreach($file_menu_taximanage as $values)
	{		
		$ii_taximanage++;							
		
		if($file_menu_taximanage[$ii_taximanage]){
			include("modules/mod_taxi/taximanage/$file_menu_taximanage[$ii_taximanage]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   