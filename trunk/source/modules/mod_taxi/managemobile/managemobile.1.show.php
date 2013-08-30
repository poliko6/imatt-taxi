 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	echo $key ."=". $value."<br>";
 }
 //pre($_FILES);
 //pre($_SESSION);
 pre(error_get_last());
 
 
 $find_chk1 = $find_chk2 = 0;
 	
 switch ($act){
	case 'addmobile':	
		include('modules/mod_taxi/managemobile/formAdd.php');		
	 	break;		
		
	case 'editmobile':
		include('modules/mod_taxi/managemobile/formEdit.php');
		break;	
		
	case 'saveedit':

		if ((trim($carRegistration) == trim($carRegistrationTmp)) && (trim($provinceId) == trim($provinceIdTmp))){
			$find_chk = 0;
		} else {
			//Check หมายเลขโทรศํพท์ซ้ำ	
			$find_chk = count_data_mysql('carId','car',"carRegistration = '".trim($carRegistration)."' and provinceId = '".$provinceId."'");
		}		

		
		if ($find_chk) {
			
			$message = "ไม่สามารถแก้ไขได้ เนื่องจากข้อมูลรถแท๊กซี่คันนี้มีแล้วในระบบ";
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg2','alert2','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_taxi/managemobile/formEdit.php');
		
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
			//mysql_query($sql);	
			echo $sql;
			//exit;
			
			$message = "แก้ไขข้อมูลรถแท๊กซี่เรียบร้อยแล้วค่ะ";
			
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg3','alert3','<?=$message?>',0);			
			});		
			</script>
			<?
			include('modules/mod_taxi/managemobile/mobileShow.php');
		}
		break;
		
		
		
		
		
	case 'saveadd':	
		
		//Check หมายเลขโทรศํพท์ซ้ำ			
		$find_chk1 = count_data_mysql('mobileId','mobile',"mobileNumber = '".trim($mobileNumber)."'");
		//Check Emi/Msi ซ้ำ		
		$find_chk2 = count_data_mysql('mobileId','mobile',"EmiMsi = '".trim($EmiMsi)."'");
			
		if (($find_chk1 > 0)  || ($find_chk2 > 0)){
			
			$message = "ข้อมูลโทรศัพท์นี้มีแล้วในระบบ";
			$act = 'addmobile';
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg2','alert2','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_taxi/managemobile/formAdd.php');
			
		} else {
		
		
			$act = '';
			$TableName = 'car';
			$data = array(
				'garageId'=>$garageId,
				'carRegistration'=>$carRegistration,
				'provinceId'=>$provinceId,			
				'carTypeId'=>$carTypeId,
				'carBannerId'=>$carBannerId,
				'carModelId'=>$carModelId,
				'carColorId'=>$carColorId,
				'carFuelId'=>$carFuelId,
				'carYear'=>$carYear,
				'carGasId'=>$carGasId,
				'carStatusId'=>3,
				'carImage'=>$filename
			);
			$sql = insert_db($TableName, $data);
			//mysql_query($sql);	
			echo $sql;
			
			$message = "เพิ่มข้อมูลรถแท๊กซี่ทะเบียน '".$carRegistration."' เรียบร้อยแล้วค่ะ";
			
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg3','alert3','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_taxi/managemobile/mobileShow.php');
		}		
			
		break;	
		
		
		
		
	default:
		include('modules/mod_taxi/managemobile/mobileShow.php');
 }
 
 
 ?>


<form action="index.php?p=taxi.managemobile&menu=main_taxi" name="fmReload" id="fmReload" method="post">
	<input type="hidden" name="garageId" value="<?=$garageId?>" />
</form>
 
 

<script type="text/javascript">
	var delayAlert=null; 
	var find_chk = <?=$find_chk1?>;
	
	$(document).ready(function(){	
		console.log(find_chk);	
		
		if (find_chk == 1){
			$('#errNumber').show();
		} else {
			$('#errNumber').hide();
		}		
	});
	
	function alertFadeOut(id){
		$('#'+id+'').fadeOut(1000); 
	}
	
	function reloadPage(){
		//window.location = 'index.php?p=taxi.managemobile&menu=main_taxi&garageId=<?=$garageId?>'; 
		$('#fmReload').submit();
	}
	
	function fn_goToPage(page){
		console.log(page);	
		if (page == 'add'){	
			$("#fm_selectmajor").attr("action", 'index.php?p=taxi.managemobile&menu=main_taxi&act=addmobile');
			$('#fm_selectmajor').submit();		
		}
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