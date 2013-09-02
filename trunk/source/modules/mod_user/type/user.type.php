<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_user/images/type-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=user.type&menu=main_user" style="text-decoration:none;"><?=$lang_menu["user.type"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ ประเภทพนักงาน</div>
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
	if ($handle_type = opendir('modules/mod_user/type')) {
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
			include("modules/mod_user/type/$file_menu_type[$ii_type]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   