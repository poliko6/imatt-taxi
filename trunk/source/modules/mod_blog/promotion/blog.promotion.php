<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_blog/images/promotion-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=blog.promotion&menu=main_blog" style="text-decoration:none;"><?=$lang_menu["blog.promotion"]?></a></div>
                    <div class="normal">เมนเพิ่ม ลบ แก้ไขโปรโมชั่นของอู่รถ</div>
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
	if ($handle_promotion = opendir('modules/mod_blog/promotion')) {
 		while (false !== ($file_promotion = readdir($handle_promotion)))
      	{
        	if ($file_promotion != "." && $file_promotion != "..")
			{   				
				if(strstr("$file_promotion", "promotion" ))
				{	
					$data_promotion = explode('.', $file_promotion);
					$file_menu_promotion[$data_promotion[1]]=$file_promotion;
				}
			}
		}	
		
		closedir($handle_promotion);
	}
	
	$ii_promotion=0;
	
	foreach($file_menu_promotion as $values)
	{		
		$ii_promotion++;							
		
		if($file_menu_promotion[$ii_promotion]){
			include("modules/mod_blog/promotion/$file_menu_promotion[$ii_promotion]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   