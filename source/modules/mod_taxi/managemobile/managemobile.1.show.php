 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
 }
 //pre($_FILES);
 //pre($_SESSION);
 //pre(error_get_last());
 
 
 $find_chk1 = $find_chk2 = 0;
 	
 switch ($act){
	case 'addmobile':	
		include('modules/mod_taxi/managemobile/formAdd.php');		
	 	break;		
		
	case 'editmobile':
		include('modules/mod_taxi/managemobile/formEdit.php');
		break;	
		
	case 'saveedit':

		if ((trim($mobileNumber) == trim($mobileNumberTmp)) && (trim($EmiMsi) == trim($EmiMsiTmp))){
			//ไม่เปลี่ยน
		} else {
			//Check หมายเลขโทรศํพท์ซ้ำ	
			if (trim($mobileNumber) != trim($mobileNumberTmp)){				
				$find_chk1 = count_data_mysql('mobileId','mobile',"mobileNumber = '".trim($mobileNumber)."'");
			}
			if (trim($EmiMsi) != trim($EmiMsiTmp)) {
				$find_chk2 = count_data_mysql('mobileId','mobile',"EmiMsi = '".trim($EmiMsi)."'");
			}
		}		

		
		if (($find_chk1 > 0)  || ($find_chk2 > 0)){
			
			$message = "ไม่สามารถแก้ไขได้ เนื่องจากข้อมูลโทรศัพท์เครื่องนี้มีแล้วในระบบ";
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg2','alert2','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_taxi/managemobile/formEdit.php');
		
		} else {						
		
			$TableName = 'mobile';
			$data = array(
				'mobileNumber'=>trim($mobileNumber),
				'mobileBanner'=>trim($mobileBanner),	
				'simId'=>trim($simId),		
				'mobileModel'=>trim($mobileModel),
				'mobileNetworkId'=>$mobileNetworkId,
				'EmiMsi'=>trim($EmiMsi),
				'dateUpdate'=>date('Y-m-d H:i:s')			
			);
			$sql = update_db($TableName, array('mobileId='=>$mobileId), $data);
			mysql_query($sql);	
			//echo $sql;
			//exit;
			
			$message = "แก้ไขข้อมูลโทรศัพท์เรียบร้อยแล้วค่ะ";
			
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
			//$act = 'addmobile';
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
			$TableName = 'mobile';
			$data = array(
				'garageId'=>$garageId,
				'mobileNumber'=>trim($mobileNumber),
				'simId'=>trim($simId),
				'mobileBanner'=>trim($mobileBanner),			
				'mobileModel'=>trim($mobileModel),
				'mobileNetworkId'=>$mobileNetworkId,
				'EmiMsi'=>trim($EmiMsi)
				
			);
			$sql = insert_db($TableName, $data);
			mysql_query($sql);	
			//echo $sql;
			
			$message = "เพิ่มข้อมูลโทรศัพท์หมายเลข ".$mobileNumber." เรียบร้อยแล้วค่ะ";
			
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
	var find_chk1 = <?=$find_chk1?>;
	var find_chk2 = <?=$find_chk2?>;
	
	$(document).ready(function(){	
		//console.log('find_chk1 = '+find_chk1);	
		
		if (find_chk1 == 1){
			$('#errNumber').show();
		} else {
			$('#errNumber').hide();
		}	
		
		if (find_chk2 == 1){
			$('#errEmiMsi').show();
		} else {
			$('#errEmiMsi').hide();
		}	
		
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
		//window.location = 'index.php?p=taxi.managemobile&menu=main_taxi&garageId=<?=$garageId?>'; 
		$('#fmReload').submit();
	}
	
	function fn_goToPage(page){
		//console.log(page);	
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
				$('#'+alertid+'').fadeOut(1000);
				if (newload == 1){
					reloadPage();  
				}
				delayAlert=null;  
			},2000);  
		});
	}
	
	
	
	function fn_chkNumberDuplicate(act){
		var mobileNumber = $('#mobileNumber').val();
		var EmiMsi = $('#EmiMsi').val();
		
		if (act == 'add'){
			datatag = 'act=add&mobileNumber='+mobileNumber+'&EmiMsi='+EmiMsi+'';
		}
		if (act == 'edit'){
			var mobileNumberTmp = $('#mobileNumberTmp').val();
			var EmiMsiTmp = $('#EmiMsiTmp').val();
			datatag = 'act=edit&mobileNumber='+mobileNumber+'&EmiMsi='+EmiMsi+'&mobileNumberTmp='+mobileNumberTmp+'&EmiMsiTmp='+EmiMsiTmp+'';
		}
		
		jQuery.ajax({
			url :'modules/mod_taxi/managemobile/chkNumDuplicate.php',
			type: 'GET',
			data: datatag,
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.success);
				if (data.number){ 
					$('#errNumber').hide();
				} else {
					$('#errNumber').fadeIn(200);
				}	
				
				if (data.emi){ 
					$('#errEmiMsi').hide();
				} else {
					$('#errEmiMsi').fadeIn(200);
				}				
			}
		});	
	}
</script>