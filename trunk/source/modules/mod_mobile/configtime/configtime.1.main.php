 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
 }
 
 
 switch ($act){
	 case 'edittime':
	 	include('modules/mod_mobile/configtime/configtime.edit.php');	
	 	break;
		
	case 'save_edittime':
		
		

		$new = '';						
		$time_ready = str_replace('_',$new,$time_ready);
		$time_working = str_replace('_',$new,$time_working);
		$time_orderjob = str_replace('_',$new,$time_orderjob);
		$time_other = str_replace('_',$new,$time_other);
		 
		 
		$TableName = 'configuration';
		
		if (($time_ready != 0) && ($time_ready != '')){
			$data = array(
				'configValue'=>$time_ready
			);
			$sql = update_db($TableName, array('configName='=>'time_ready'), $data);
			mysql_query($sql);
		}		
		
		if (($time_working != 0) && ($time_working != '')){
			$data = array(
				'configValue'=>$time_working
			);
			$sql = update_db($TableName, array('configName='=>'time_working'), $data);
			mysql_query($sql);
		}
		
		if (($time_orderjob != 0) && ($time_orderjob != '')){
			$data = array(
				'configValue'=>$time_orderjob
			);
			$sql = update_db($TableName, array('configName='=>'time_orderjob'), $data);
			mysql_query($sql);
		}
		
		if (($time_other != 0) && ($time_other != '')){
			$data = array(
				'configValue'=>$time_other
			);
			$sql = update_db($TableName, array('configName='=>'time_other'), $data);
			mysql_query($sql);
		}
		
		//echo $sql;
		//mysql_query($sql);
		
		$message = "เปลี่ยนแปลงเวลาเรียบร้อยแล้วค่ะ";
				
		?>
		<script type="text/javascript">			
		$(document).ready(function() {
			alertPopup('msg3','alert3','<?=$message?>',0);
		});		
		</script>
		<?
	
	 	include('modules/mod_mobile/configtime/configtime.show.php');	
	 	break;
	 
	 
	 default:
	 	include('modules/mod_mobile/configtime/configtime.show.php');	
	 	break;
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
</script>
 

	
<script src="lib/jquery-ui/jquery-ui-1.8.23.custom.min.js"></script>
<!-- touch events for jquery ui-->
<script src="js/forms/jquery.ui.touch-punch.min.js"></script>
<!-- masked inputs -->
<script src="js/forms/jquery.inputmask.min.js"></script>
<!-- autosize textareas -->
<script src="js/forms/jquery.autosize.min.js"></script>
<!-- textarea limiter/counter -->
<script src="js/forms/jquery.counter.min.js"></script>
<!-- datepicker -->
<script src="lib/datepicker/bootstrap-datepicker.min.js"></script>
<!-- timepicker -->
<script src="lib/datepicker/bootstrap-timepicker.min.js"></script>
<!-- tag handler -->
<script src="lib/tag_handler/jquery.taghandler.min.js"></script>
<!-- input spinners -->
<script src="js/forms/jquery.spinners.min.js"></script>
<!-- styled form elements -->
<script src="lib/uniform/jquery.uniform.min.js"></script>
<!-- animated progressbars -->
<script src="js/forms/jquery.progressbar.anim.js"></script>
<!-- multiselect -->
<script src="lib/multiselect/js/jquery.multi-select.min.js"></script>
<!-- enhanced select (chosen) -->
<script src="lib/chosen/chosen.jquery.min.js"></script>
<!-- TinyMce WYSIWG editor -->
<script src="lib/tiny_mce/jquery.tinymce.js"></script>
<!-- plupload and all it's runtimes and the jQuery queue widget (attachments) -->
<script type="text/javascript" src="lib/plupload/js/plupload.full.js"></script>
<script type="text/javascript" src="lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.full.js"></script>
<!-- colorpicker -->
<script src="lib/colorpicker/bootstrap-colorpicker.js"></script>
<!-- password strength checker -->
<script src="lib/complexify/jquery.complexify.min.js"></script>
<!-- form functions -->
<script src="js/gebo_forms.js"></script>

<script>
	$(document).ready(function() {
		//* show all elements & remove preloader
		setTimeout('$("html").removeClass("js")',1000);		
		$("#time_ready_edit").inputmask("99999");
		$("#time_working_edit").inputmask("99999");
		$("#time_orderjob_edit").inputmask("99999");
		$("#time_other_edit").inputmask("99999");
	});
</script>