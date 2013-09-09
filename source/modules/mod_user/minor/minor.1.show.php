 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
 }
 //pre($_SESSION);
 //pre(error_get_last());
 
 $find_chk = 0;
	
 switch ($act){
	case 'addminor':	
		include('modules/mod_user/minor/formAdd.php');		
	 	break;		
		
	case 'editminor':
		include('modules/mod_user/minor/formEdit.php');
		break;	
		
	case 'saveadd':	
		
		//Check Usernaem ซ้ำ			
		$find_chk = count_data_mysql('minorId','minoradmin',"username = '".trim($txtuserName)."' and garageId = '".$u_garage."'");
			
		if ($find_chk) {
			
			$message = "ข้อมูลพนักงาน Username : ".trim($txtuserName)." มีแล้วในระบบ";
			$act = 'addminor';
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg2','alert2','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_user/minor/formAdd.php');
			
		} else {
		
			$act = '';
			$txtpassword = trim($txtpassword);
			$TableName = 'minoradmin';
			$data = array(
				'garageId'=>$u_garage,
				'firstName'=>trim($firstName),
				'lastName'=>trim($lastName),			
				'username'=>trim($txtuserName),
				'minorTypeId'=>$minorTypeId,
				'password'=>sha1($txtpassword),
				'address'=>trim($address),
				'provinceId'=>$provinceId,
				'amphurId'=>$amphurId,
				'districtId'=>$districtId,
				'telephone'=>trim($telephone),
				'mobilePhone'=>trim($mobilePhone),				
				'email'=>trim($txtemail),
				'zipcode'=>trim($zipcode)
			);
			$sql = insert_db($TableName, $data);
			mysql_query($sql);	
			#echo $sql;
			
			$message = "เพิ่มข้อมูลพนักงาน ".$firstName." ".$lastName." เรียบร้อยแล้วค่ะ";
			
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg3','alert3','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_user/minor/minorShow.php');
		}		
			
		break;	
		
	case 'saveedit':

		$TableName = 'minoradmin';
		
		if (trim($txtpassword) != ''){
			$txtpassword = trim($txtpassword);
			
			$data = array(
				//'garageId'=>$u_garage,
				'firstName'=>trim($firstName),
				'lastName'=>trim($lastName),			
				//'username'=>trim($txtuserName),
				'minorTypeId'=>$minorTypeId,			 
				'password'=>sha1($txtpassword),
				'address'=>trim($address),
				'provinceId'=>$provinceId,
				'amphurId'=>$amphurId,
				'districtId'=>$districtId,
				'telephone'=>trim($telephone),
				'mobilePhone'=>trim($mobilePhone),				
				'email'=>trim($txtemail),
				'zipcode'=>trim($zipcode),
				'dateUpdated'=>date('Y-m-d H:i:s'),
			);	
		} else {		
			$data = array(
				//'garageId'=>$u_garage,
				'firstName'=>trim($firstName),
				'lastName'=>trim($lastName),			
				//'username'=>trim($txtuserName),
				'minorTypeId'=>$minorTypeId,			 
				//'password'=>sha1($txtpassword),
				'address'=>trim($address),
				'provinceId'=>$provinceId,
				'amphurId'=>$amphurId,
				'districtId'=>$districtId,
				'telephone'=>trim($telephone),
				'mobilePhone'=>trim($mobilePhone),				
				'email'=>trim($txtemail),
				'zipcode'=>trim($zipcode),
				'dateUpdated'=>date('Y-m-d H:i:s'),
			);	
		}
		
		$sql = update_db($TableName, array('minorId='=>$minorId), $data);
		mysql_query($sql);	
		#echo $sql;
		//exit;
		
		$message = "แก้ไขข้อมูลพนักงาน ".trim($firstName).' '.trim($lastName)." เรียบร้อยแล้วค่ะ";
		
		?>
		<script type="text/javascript">			
		$(document).ready(function() {
			alertPopup('msg3','alert3','<?=$message?>',0);			
		});		
		</script>
		<?
		include('modules/mod_user/minor/minorShow.php');
		
		break;
		
		
		
	default:
		include('modules/mod_user/minor/minorShow.php');
 }
 
 
 ?>




<script type="text/javascript">
	var delayAlert=null; 
		
	$(document).ready(function(){	
		//console.log(find_chk);	
		$(document).on("keydown.NewActionOnF5", function(e){
			var charCode = e.which || e.keyCode;
			switch(charCode){
				case 116: // F5
					e.preventDefault();
					window.location = "index.php?p=<?=$p?>&menu=<?=$menu?>";
					break;
			}
		});	
	});
	
	function alertFadeOut(id){
		$('#'+id+'').fadeOut(1000); 
	}
	
	function reloadPage(){
		window.location = 'index.php?p=user.minor&menu=main_user'; 
		//$('#fmReload').submit();
	}	


	
	function alertPopup(msgid,alertid,message,newload){
		$('#'+msgid+'').text(''+message+'');
		$('#'+alertid+'').fadeIn(500, function() {
			clearTimeout(delayAlert);  
			delayAlert=setTimeout(function(){  
				alertFadeOut(''+alertid+'');
				if (newload == 1){
					reloadPage();  
				}
				delayAlert=null;  
			},2000);  
		});
	}
	
	
	
	function fn_callamphur(province, amphur){
		//alert(id);
		$.post('modules/mod_user/minor/get.amphur.php', {provinceId:province, amphurId:amphur} , function(data) {
			$('#genamphur').html(data);	
		});	
	}
	
	
	function fn_calldistrict(amphur, district){
		//alert(id);
		$.post('modules/mod_user/minor/get.district.php', {amphurId:amphur, districtId:district} , function(data) {
			$('#gendistrict').html(data);	
		});	
	}
	
	
	function checkEmail(email) {
		var emailFilter=/^.+@.+\..{2,3}$/;
		if (!(emailFilter.test(email))) {
			//console.log('กรุณากรอก email ให้ถูกต้อง');
			return 0; 
		} else {
			return 1; 
		}
	}
	
	function checkEngNum(str) {
		var engnumFilter = /[^A-Za-z0-9]/;
		var newstr = jQuery.trim(str);	
		if (engnumFilter.test(newstr)){	
			//console.log("กรุณากรอกแต่ภาษาอังกฤษหรือตัวเลขเท่านั้น");
			return 0; 	
		} else {	
			return 1;
		}				
	}
	
	
	function trim(s)
	{
	   var l=0; var r=s.length -1;
	   while(l < s.length && s[l] == ' ')
	   {   l++; }
	   while(r > l && s[r] == ' ')
	   {   r-=1;   }
	   return s.substring(l, r+1);
	}
	
	
	
	function checkData(id){
		if ($('#'+id+'').val() == ''){ 
			$('#'+id+'').closest('div').addClass("f_error");
			$('#'+id+'_err').fadeIn(1000);
			return 0;
		} else {
			$('#'+id+'').closest('div').removeClass("f_error");
			$('#'+id+'_err').fadeOut(100);
			return 1;
		}
	}
	
</script>