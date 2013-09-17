<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_user/images/customer-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=user.customer&menu=main_user" style="text-decoration:none;"><?=$lang_menu["user.customer"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ เกี่ยวกับลูกค้า</div>
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
	if ($handle_customer = opendir('modules/mod_user/customer')) {
 		while (false !== ($file_customer = readdir($handle_customer)))
      	{
        	if ($file_customer != "." && $file_customer != "..")
			{   				
				if(strstr("$file_customer", "customer" ))
				{	
					$data_customer = explode('.', $file_customer);
					$file_menu_customer[$data_customer[1]]=$file_customer;
				}
			}
		}	
		
		closedir($handle_customer);
	}
	
	$ii_customer=0;
	
	foreach($file_menu_customer as $values)
	{		
		$ii_customer++;							
		
		if($file_menu_customer[$ii_customer]){
			include("modules/mod_user/customer/$file_menu_customer[$ii_customer]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   