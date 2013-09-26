<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_driver/images/managedriver-icon.png" alt="" width="50" height="50"/>
                    </div>
                </div>
                <div class="span6">
                    <div><a href="index.php?p=driver.managedriver&menu=main_taxi" style="text-decoration:none;"><?=$lang_menu["driver.managedriver"]?></a></div>
                    <div class="normal">เมนูเพิ่ม แก้ไข และลบ รายละเอียดคนขับแท๊กซี่ในระบบ</div>
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
	switch ($act) {
		case 'add' :
			include("modules/mod_driver/managedriver/driver.add.php");		
			break;
		case 'saveadd' :
			include("modules/mod_driver/managedriver/adddriver.php");		
			break;		
		case 'editdriver' :
			include("modules/mod_driver/managedriver/driver.edit.php");
			break;
		case 'saveedit' :
			include("modules/mod_driver/managedriver/editdriver.php");		
			break;				
		default :
			include("modules/mod_driver/managedriver/driver.show.php");		
	}
	?>
<form action="index.php?p=driver.managedriver&menu=main_driver" name="fmReload" id="fmReload" method="post">
	<input type="hidden" name="garageId" value="<?=$garageId?>" />
    <input type="hidden" name="current_page" id="current_pageLoad" value="<?=$current_page?>" />
</form>


    
    </td>
  </tr>
</table>   

<script type="text/javascript">
	function reloadPage(){
		//window.location = 'index.php?p=driver.managedriver&menu=main_driver&garageId=<?=$garageId?>'; 
		$('#fmReload').submit();
	}    
</script>  