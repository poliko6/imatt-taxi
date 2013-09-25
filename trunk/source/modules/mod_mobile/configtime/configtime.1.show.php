 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
 }
 
 
 if (($act != '') && ($timemobile_edit != '') && ($timemobile_edit != 0)){

	$new = '';						
	$timemobile_edit = str_replace('_',$new,$timemobile_edit);
	 
	$TableName = 'configuration';
	$data = array(
		'configValue'=>$timemobile_edit
	);
	$sql = update_db($TableName, array('configName='=>'timemobile'), $data);
	//echo $sql;
	mysql_query($sql);
	
	$message = "เปลี่ยนแปลงเวลาเรียบร้อยแล้วค่ะ";
			
	?>
	<script type="text/javascript">			
	$(document).ready(function() {
		alertPopup('msg3','alert3','<?=$message?>',0);
	});		
	</script>
	<?
 }
 
 $data_time = select_db('configuration',"Where configName = 'timemobile'");
 $timemobile = $data_time[0]['configValue'];
 
 ?>
 
 
 
 
  
 <div class="row-fluid">
 	<div class="span3"></div>
    <div class="span6"  style="margin-top:10px;">
        <form class="form-horizontal well" method="post"  id="fm_search">
            <fieldset>
                <p class="f_legend">เวลาในการส่งค่าพิกัดของมือถือ</p>
                
                <div class="control-group">
                    <label class="control-label">เวลาปัจจุบัน</label>
                    <div class="controls">                        
                        <input type="text" name="timemobile" id="timemobile" class="span2" value="<?=$timemobile?>" disabled="disabled" /> &nbsp; วินาที                     
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">แก้ไขเวลา</label>
                    <div class="controls">
                        <input type="text" name="timemobile_edit" id="timemobile_edit" class="span2" /> &nbsp; วินาที   
                        <div class="help-block" style="font-style:italic; color:#F00; display:none;" id="search_text_err">กรุณากรอกชื่อหรือหมายเลขบัตรประชาชนที่ต้องการค้นหา</div>
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <input class="btn btn-danger" type="submit" value="แก้ไขเวลา">
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="act" value="edittime" />
            <input type="hidden" name="p" value="<?=$p?>" />
            <input type="hidden" name="menu" value="<?=$menu?>" />
        </form>
    </div>
   <div class="span3"></div>
</div>



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
		$("#timemobile_edit").inputmask("99999");
	});
</script>