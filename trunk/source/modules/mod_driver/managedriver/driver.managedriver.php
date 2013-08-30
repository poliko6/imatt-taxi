<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_driver/images/managedriver-icon.png" alt="" width="50" height="50"/>
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=driver.managedriver&menu=main_taxi" style="text-decoration:none;"><?=$lang_menu["menu_driver_manage"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ รายละเีอียดคนขับแท๊กซี่ในระบบ</div>
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
	if ($handle_managedriver = opendir('modules/mod_driver/managedriver')) {
 		while (false !== ($file_managedriver = readdir($handle_managedriver)))
      	{
        	if ($file_managedriver != "." && $file_managedriver != "..")
			{   				
				if(strstr("$file_managedriver", "managedriver" ))
				{	
					$data_managedriver = explode('.', $file_managedriver);
					$file_menu_managedriver[$data_managedriver[1]]=$file_managedriver;
				}
			}
		}	
		
		closedir($handle_managedriver);
	}
	
	$ii_managedriver=0;
	
	foreach($file_menu_managedriver as $values)
	{		
		$ii_managedriver++;							
		
		if($file_menu_managedriver[$ii_managedriver]){
			include("modules/mod_driver/managedriver/$file_menu_managedriver[$ii_managedriver]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   