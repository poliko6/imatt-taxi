<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_driver/images/drivercheck-icon.png" alt="" width="50" height="50"/>
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=driver.drivercheck&menu=main_driver" style="text-decoration:none;"><?=$lang_menu["driver.drivercheck"]?></a></div>
                    <div class="normal">เมนูแสดงรายละเีอียดของคนขับรถแท๊กซี่ในระบบ</div>
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
	if ($handle_drivercheck = opendir('modules/mod_driver/drivercheck')) {
 		while (false !== ($file_drivercheck = readdir($handle_drivercheck)))
      	{
        	if ($file_drivercheck != "." && $file_drivercheck != "..")
			{   				
				if(strstr("$file_drivercheck", "drivercheck" ))
				{	
					$data_drivercheck = explode('.', $file_drivercheck);
					$file_menu_drivercheck[$data_drivercheck[1]]=$file_drivercheck;
				}
			}
		}	
		
		closedir($handle_drivercheck);
	}
	
	$ii_drivercheck=0;
	
	foreach($file_menu_drivercheck as $values)
	{		
		$ii_drivercheck++;							
		
		if($file_menu_drivercheck[$ii_drivercheck]){
			include("modules/mod_driver/drivercheck/$file_menu_drivercheck[$ii_drivercheck]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   