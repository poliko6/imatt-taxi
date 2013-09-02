<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_driver/images/period-icon.png" alt="" width="50" height="50"/>
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=driver.period&menu=main_driver" style="text-decoration:none;"><?=$lang_menu["driver.period"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ รายละเีอียดช่วงเวลางานของพนักงานแท๊กซี่</div>
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
	if ($handle_period = opendir('modules/mod_driver/period')) {
 		while (false !== ($file_period = readdir($handle_period)))
      	{
        	if ($file_period != "." && $file_period != "..")
			{   				
				if(strstr("$file_period", "period" ))
				{	
					$data_period = explode('.', $file_period);
					$file_menu_period[$data_period[1]]=$file_period;
				}
			}
		}	
		
		closedir($handle_period);
	}
	
	$ii_period=0;
	
	foreach($file_menu_period as $values)
	{		
		$ii_period++;							
		
		if($file_menu_period[$ii_period]){
			include("modules/mod_driver/period/$file_menu_period[$ii_period]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   