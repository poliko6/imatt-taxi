<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_driver/images/schedule-icon.png" alt="" width="50" height="50"/>
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=driver.schedule&menu=main_driver" style="text-decoration:none;"><?=$lang_menu["driver.schedule"]?></a></div>
                    <div class="normal">เมนูจัดการรายละเีอียดการลงเวลาเข้างานของพนักงานแท๊กซี่</div>
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
	if ($handle_schedule = opendir('modules/mod_driver/schedule')) {
 		while (false !== ($file_schedule = readdir($handle_schedule)))
      	{
        	if ($file_schedule != "." && $file_schedule != "..")
			{   				
				if(strstr("$file_schedule", "schedule" ))
				{	
					$data_schedule = explode('.', $file_schedule);
					$file_menu_schedule[$data_schedule[1]]=$file_schedule;
				}
			}
		}	
		
		closedir($handle_schedule);
	}
	
	$ii_schedule=0;
	
	foreach($file_menu_schedule as $values)
	{		
		$ii_schedule++;							
		
		if($file_menu_schedule[$ii_schedule]){
			include("modules/mod_driver/schedule/$file_menu_schedule[$ii_schedule]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   