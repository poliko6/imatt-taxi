<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_user/images/profile-icon.png" alt="" width="50" height="50" />
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=user.profile&menu=main_user" style="text-decoration:none;"><?=$lang_menu["user.profile"]?></a></div>
                    <div class="normal">แก้ไขข้อมูลส่วนตัว</div>
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
	//Get Session
	$userType = $u_type;
	// 1 = Supervisor
	// 2 = Company Admin
	// 3 = Minor Admin
	
	if($sav=='yes')
	{	
		$message = "แก้ไขข้อมูลเรียบร้อยแล้วค่ะ";
		?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg3','alert3','<?=$message?>');			
			});		
			</script>        
        <?				
	}
		switch ($userType)	
		{
			case 1 :
					include("modules/mod_user/profile/major.profile.php");
					break;
			case 2 :
					include("modules/mod_user/profile/major.profile.php");
					break;
			case 3 :	
					include("modules/mod_user/profile/minor.profile.php");
					break;
			case 4 :
					include("modules/mod_user/profile/customer.profile.php");
					break;
		}
	?>
    </td>
  </tr>
</table>   
<script type="text/javascript">	
var delayAlert=null; 

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