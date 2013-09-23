 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
 }
 //pre($_REQUEST);
 //pre(error_get_last());
 
 $find_chk = 0;
	
 switch ($act){
	case 'addschedule':	
		include('modules/mod_driver/schedule/formAdd.php');		
	 	break;		
		
	case 'saveadd':	
		
		//Check ซ้ำ	
		//ลอง Check อีกที		
		$find_chk = count_data_mysql('transportSectionId','transportsection',"driverId = '".trim($driverId)."' and garageId = '".$u_garage."'");
			
		if ($find_chk) {
			
			$message = "ข้อมูลพนักงาน Username : ".trim($txtuserName)." มีแล้วในระบบ";
			$act = 'addschedule';
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg2','alert2','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_driver/schedule/formAdd.php');
			
		} else {
			
			$get_time_data = select_db('timeschedule',"where timeScheduleId = '".$radioGroupTime."'"); 
			$timeStart = $get_time_data[0]['timeStart'];
			$timeEnd = $get_time_data[0]['timeEnd'];
			$act = '';
			
			$TableName = 'transportsection';
			$data = array(
				'garageId'=>$u_garage,
				'detail'=>trim($detail),
				'timeStart'=>trim($timeStart),			
				'timeEnd'=>trim($timeEnd),
				'driverId'=>$thisdriverId,
				'mobileId'=>$thismobileId,
				'carId'=>$thiscarId,
				'statusWork'=>'online'
				
			);
			$sql = insert_db($TableName, $data);
			mysql_query($sql);	
			//echo $sql;
			
			$message = "ลงเวลางานพนักงานเรียบร้อยแล้วค่ะ";
			
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg3','alert3','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_driver/schedule/scheduleShow.php');
		}		
			
		break;	
		
	default:
		include('modules/mod_driver/schedule/scheduleShow.php');
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
	
	function reloadPage(){
		window.location = 'index.php?p=driver.schedule&menu=main_driver'; 
		//$('#fmReload').submit();
	}	
	
	function alertPopup(msgid,alertid,message,newload){
		$('#'+msgid+'').text(''+message+'');
		$('#'+alertid+'').fadeIn(500, function() {
			clearTimeout(delayAlert);  
			delayAlert=setTimeout(function(){  
				//alertFadeOut(''+alertid+'');
				$('#'+alertid+'').fadeOut(1000);
				if (newload == 1){
					reloadPage();  
				}
				delayAlert=null;  
			},2000);  
		});
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