<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="5%" align="center"><img src="modules/mod_user/images/major-icon.png" alt="" width="50" height="50" /></td>
    <td width="29%"><a href="index.php?<?=$_SERVER['QUERY_STRING']?>" style="text-decoration:none;"><?=$lang_menu["menu_user_major"]?></a><br />
		<span class="normal">เมนูเพิ่ม แก้ไข และลบ อู่รถสมาชิก</span></td>
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
		switch($act) {
			case 'edit':
				break;
			case 'add':
				include("modules/mod_user/major/major.add.php");
				break;
			default:
				include("modules/mod_user/major/major.show.php");
		}
	?>
    </td>
  </tr>
</table>   