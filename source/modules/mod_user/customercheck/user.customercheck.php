<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_user/images/customercheck-icon.png" alt="" width="50" height="50"/>
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=user.customercheck&menu=main_user" style="text-decoration:none;"><?=$lang_menu["user.customercheck"]?></a></div>
                    <div class="normal">เมนูแสดงรายละเีอียดของลูกค้าในระบบ</div>
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
	if ($handle_customercheck = opendir('modules/mod_user/customercheck')) {
 		while (false !== ($file_customercheck = readdir($handle_customercheck)))
      	{
        	if ($file_customercheck != "." && $file_customercheck != "..")
			{   				
				if(strstr("$file_customercheck", "customercheck" ))
				{	
					$data_customercheck = explode('.', $file_customercheck);
					$file_menu_customercheck[$data_customercheck[1]]=$file_customercheck;
				}
			}
		}	
		
		closedir($handle_customercheck);
	}
	
	$ii_customercheck=0;
	
	foreach($file_menu_customercheck as $values)
	{		
		$ii_customercheck++;							
		
		if($file_menu_customercheck[$ii_customercheck]){
			include("modules/mod_user/customercheck/$file_menu_customercheck[$ii_customercheck]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   