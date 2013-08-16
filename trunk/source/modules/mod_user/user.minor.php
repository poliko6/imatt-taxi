<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="5%" align="center"><img src="modules/mod_user/images/minor-icon.png" alt="" width="50" height="50" /></td>
    <td width="29%"><a href="index.php?<?=$_SERVER['QUERY_STRING']?>" style="text-decoration:none;"><?=$lang_menu["menu_user_minor"]?></a><br />
		<span class="normal">เมนูเพิ่ม แก้ไข และลบ พนักงาน</span></td>
    <td width="66%" style="border:none;">
        <div class="alert" id="alert1" style="display:none;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg1"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>
        <div class="alert alert-error" id="alert2" style="display:none;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg2"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>
        <div class="alert alert-success" id="alert3" style="display:none;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg3"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>
        <div class="alert alert-info" id="alert4" style="display:none;">
            <a class="close" data-dismiss="alert">×</a>
            <div id="msg4"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
        </div>        
    </td>
  </tr>
  <tr>
  	<td colspan="3">
	<?
	if ($handle_minor = opendir('modules/mod_user/include/minor')) {
 		while (false !== ($file_minor = readdir($handle_minor)))
      	{
        	if ($file_minor != "." && $file_minor != "..")
			{   				
				if(strstr("$file_minor", "minor" ))
				{	
					$data_minor = explode('.', $file_minor);
					$file_menu_minor[$data_minor[1]]=$file_minor;
				}
			}
		}	
		
		closedir($handle_minor);
	}
	
	$ii_minor=0;
	
	foreach($file_menu_minor as $values)
	{		
		$ii_minor++;							
		
		if($file_menu_minor[$ii_minor]){
			include("modules/mod_user/include/minor/$file_menu_minor[$ii_minor]");									
		}
	}	
	?>
    </td>
  </tr>
</table>   