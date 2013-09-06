<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_user/images/major-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=user.major&menu=main_user" style="text-decoration:none;"><?=$lang_menu["user.major"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ อู่รถสมาชิก</div>
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
		echo "Act Here ".$act;
		switch($act) {
			case 'edit':
				$majorId = $mjId;
				include("modules/mod_user/major/major.edit.php");
				break;
			case 'saveedit':
				include("modules/mod_user/major/editmajor.php");	
				break;
			case 'add':
				include("modules/mod_user/major/major.add.php");
				break;
			case 'saveadd':
				$stat = "saveadd";
				include("modules/mod_user/major/addmajor.php");	
				break;				
			default:			
				echo "Status = ".$stat;
				include("modules/mod_user/major/major.show.php");
		}
	?>
    </td>
  </tr>
</table>   