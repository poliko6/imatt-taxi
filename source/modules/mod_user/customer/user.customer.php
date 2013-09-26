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
	if($done=="yes")
	{	
		$message = "แก้ไขข้อมูลเรียบร้อยแล้วค่ะ";
		?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg3','alert3','<?=$message?>');
				
				$(document).on("keydown.NewActionOnF5", function(e){
					var charCode = e.which || e.keyCode;
					switch(charCode){
						case 116: // F5
							e.preventDefault();
							window.location = "index.php?p=user.customer&menu=main_user&current_page="+<?=$current_page?>;
							break;
					}
				});										
			});							
	
			</script>        
        <?	
	}
	
	switch ($act) {
		case 'add' :
			include("modules/mod_user/customer/customer.add.php");
			break;
		case 'saveadd' :
			include("modules/mod_user/customer/addcustomer.php");		
			break;		
		case 'edit' :
			include("modules/mod_user/customer/customer.edit.php");
			break;
		case 'saveedit' :
			include("modules/mod_user/customer/editcustomer.php");
			break;
		default :
			include("modules/mod_user/customer/customer.show.php");		
			
	}
	?>
    
    <form action="index.php?p=user.customer&menu=main_user" name="fmReload" id="fmReload" method="post">
        <input type="hidden" name="customerId" value="<?=$customerId?>" />
        <input type="hidden" name="current_page" id="current_pageLoad" value="<?=$current_page?>" />
    </form>    
    </td>
  </tr>
</table>   
<script type="text/javascript">
var delayAlert=null

	function reloadPage(){
		$('#fmReload').submit();
	}    
	
	function alertPopup(msgid,alertid,message){
		$('#'+msgid+'').text(''+message+'');
		$('#'+alertid+'').fadeIn(500, function() {
			clearTimeout(delayAlert);  
			delayAlert=setTimeout(function(){  
	//				alertFadeOut(''+alertid+'');
				$('#'+alertid+'').fadeOut(500);
				delayAlert=null;  
			},2000);  
		});
	}	
</script>  
