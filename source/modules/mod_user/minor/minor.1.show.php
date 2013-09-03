 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	echo $key ."=". $value."<br>";
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
		
		//Check ป้ายทะเบียนซ้ำ			
		$find_chk = count_data_mysql('minorId','minoradmin',"username = '".trim($userName)."' and garageId = '".$u_garage."'");
			
		if ($find_chk) {
			
			$message = "ข้อมูลพนักงาน Username : ".trim($userName)." มีแล้วในระบบ";
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
			$TableName = 'minoradmin';
			$data = array(
				'garageId'=>$u_garage,
				'firstName'=>$firstName,
				'lastName'=>$lastName,			
				'username'=>$userName,
				'minorTypeId'=>$minorTypeId,
				'password'=>$u_password,
				'address'=>$txtAddress_add,
				'provinceId'=>$province_add,
				'amphurId'=>$amphur_add,
				'districtId'=>$district_add,
				'telephone'=>$txtPhone,
				'mobilePhone'=>$txtMobilePhone,				
				'email'=>$txtEmail,
				'zipcode'=>$txtZipcode_add
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

		if ((trim($carRegistration) == trim($carRegistrationTmp)) && (trim($provinceId) == trim($provinceIdTmp))){
			$find_chk = 0;
		} else {
			//Check ป้ายทะเบียนซ้ำ	
			$find_chk = count_data_mysql('carId','car',"carRegistration = '".trim($carRegistration)."' and provinceId = '".$provinceId."'");
		}		

		
		if ($find_chk) {
			
			$message = "ไม่สามารถแก้ไขได้ เนื่องจากข้อมูลพนักงานคันนี้มีแล้วในระบบ";
			//$act = 'edittaxi';
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg2','alert2','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_user/minor/formEdit.php');
		
		} else {	
					
			$TableName = 'car';
			$data = array(
				'carRegistration'=>$carRegistration,
				'provinceId'=>$provinceId,			
				'carTypeId'=>$carTypeId,
				'carBannerId'=>$carBannerId,
				'carModelId'=>$carModelId,
				'carColorId'=>$carColorId,
				'carFuelId'=>$carFuelId,
				'carYear'=>$carYear,
				'carGasId'=>$carGasId,
				'dateUpdate'=>date('Y-m-d H:i:s'),
				'carImage'=>$filename
			);
			$sql = update_db($TableName, array('carId='=>$carId), $data);
			mysql_query($sql);	
			//echo $sql;
			//exit;
			
			$message = "แก้ไขข้อมูลพนักงานเรียบร้อยแล้วค่ะ";
			
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
		
		
		
	default:
		include('modules/mod_user/minor/minorShow.php');
 }
 
 
 ?>




<script type="text/javascript">
	var delayAlert=null; 
	var find_chk = <?=$find_chk?>;
	
	$(document).ready(function(){	
		console.log(find_chk);	
		
		if (find_chk == 1){
			$('#errUsername').show();
		} else {
			$('#errUsername').hide();
		}		
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
	
</script>