<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_blog/images/news-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=blog.news&menu=main_blog" style="text-decoration:none;"><?=$lang_menu["blog.news"]?></a></div>
                    <div class="normal">เมนเพิ่ม ลบ แก้ไขข่าวสารของอู่รถ</div>
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
	if ($handle_news = opendir('modules/mod_blog/news')) {
 		while (false !== ($file_news = readdir($handle_news)))
      	{
        	if ($file_news != "." && $file_news != "..")
			{   				
				if(strstr("$file_news", "news" ))
				{	
					$data_news = explode('.', $file_news);
					$file_menu_news[$data_news[1]]=$file_news;
				}
			}
		}	
		
		closedir($handle_news);
	}
	
	$ii_news=0;
	
	foreach($file_menu_news as $values)
	{		
		$ii_news++;							
		
		if($file_menu_news[$ii_news]){
			include("modules/mod_blog/news/$file_menu_news[$ii_news]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   