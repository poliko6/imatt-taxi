 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
 }


 $time_data = select_db('timeschedule','where garageId ='.$u_garage.' order by timeScheduleId');
 $total = count($time_data);
 ?>
<!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script>  
 
<script type="text/javascript">
	var delayAlert=null; 
	$(document).ready(function(){
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
		window.location = 'index.php?p=driver.period&menu=main_driver'; 
	}
	
	
	function fn_formDel(id){
		jQuery.ajax({
			url :'modules/mod_driver/period/deltime.php',
			type: 'GET',
			data: 'act=deltime&id='+id+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.success);
				if (data.success){
					alertPopup('msg3','alert3',''+data.message+'',1);					
				} else {
					alertPopup('msg2','alert2',''+data.message+'',0);
				}
				
				
				$('#myModalDel'+id+'').modal('toggle');
			}
		});	
	}
	
	
	
	function fn_formAdd(){		
		var pass = 1;
		
		if ($('#time_name').val() == ''){
			$('#time_name').closest('div').addClass("f_error");
			$('#errtxt').fadeIn(500);
			pass = 0;
		}
		if ($('#time1').val() == ''){
			$('#time1').closest('div').addClass("f_error");
			$('#errtxt1').fadeIn(500);
			pass = 0;
		}
		if ($('#time2').val() == ''){
			$('#time2').closest('div').addClass("f_error");
			$('#errtxt2').fadeIn(500);
			pass = 0;
		}
		
		
		if (pass){
			//$('#fm_addtype').submit();	
			var time_name = $('#time_name').val();	
			var time1 = $('#time1').val();
			var time2 = $('#time2').val();	
			var u_garage = <?=$u_garage?>;
			
			jQuery.ajax({
   				url :'modules/mod_driver/period/addtime.php',
   				type: 'GET',
  				data: 'act=addtime&time_name='+time_name+'&time1='+time1+'&time2='+time2+'&u_garage='+u_garage+'',
   				dataType: 'jsonp',
   				dataCharset: 'jsonp',
   				success: function (data){
					console.log(data.success);
      				if (data.success){
						alertPopup('msg3','alert3',''+data.message+'',1);						
     				} else {
						alertPopup('msg2','alert2',''+data.message+'',0);
					}					
					
					$('#myModalAdd').modal('toggle');
					$('#time_name').val('');
   				}
			});	
			
		}
	}
	
	
	
	
	function fn_formEdit(id,process){
		//console.log(id);
		
		if (process == 'select') {
			$.post("modules/mod_driver/period/gettime.php", { 
					process: process,
					id: id
				}, 
				function(data){
					var str = data.split(",")
					$("#time_name_edit").val(str[0]);
					$("#time1_edit").val(str[1]);
					$("#time2_edit").val(str[2]);					
					$("#temp").val(str[0]);
					$("#time1_temp").val(str[1]);
					$("#time2_temp").val(str[2]);
					$("#timeid").val(id);
				}
			);
			
			$('#myModalEdit').modal('toggle');
		}
		
			
		
		
		if (process == 'update') {
			
			var id = $("#timeid").val();
			var pass = 1;
			
			if ($('#time_name_edit').val() == ''){
				$('#time_name_edit').closest('div').addClass("f_error");
				$('#errtxt_edit').fadeIn(500);
				pass = 0;
			}
			if ($('#time1_edit').val() == ''){
				$('#time1_edit').closest('div').addClass("f_error");
				$('#errtxt_edit1').fadeIn(500);
				pass = 0;
			}
			if ($('#time2_edit').val() == ''){
				$('#time2_edit').closest('div').addClass("f_error");
				$('#errtxt_edit2').fadeIn(500);
				pass = 0;
			}
			
			
			
			if (pass) {
				var time_name = $('#time_name_edit').val();	
				var time1 = $('#time1_edit').val();
				var time2 = $('#time2_edit').val();	
				var u_garage = <?=$u_garage?>;
				
				var time_name_temp = $('#temp').val();	
				var time1_temp = $('#time1_temp').val();
				var time2_temp = $('#time2_temp').val();	
				var u_garage = <?=$u_garage?>;
				
				jQuery.ajax({
					url :'modules/mod_driver/period/edittime.php',
					type: 'GET',
					data: 'act=update&time_name='+$('#time_name_edit').val()+'&time_name_temp='+time_name_temp+'&time1='+time1+'&time1_temp='+time1_temp+'&time2='+time2+'&time2_temp='+time2_temp+'&id='+id+'&u_garage='+u_garage+'',
					dataType: 'jsonp',
					dataCharset: 'jsonp',
					success: function (data){
						console.log(data.success);
						if (data.success){
							alertPopup('msg3','alert3',''+data.message+'',1);						
						} else {
							alertPopup('msg2','alert2',''+data.message+'',0);
						}	
						
						
						$('#myModalEdit').modal('toggle');
					}
				});	
			}
			
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
	
</script>



<!-- POP UP -->
<div class="modal hide fade" id="myModalAdd">
    <div class="modal-header">
        <h3>เพิ่มช่วงเวลาทำงาน</h3>
    </div>
    <form action="" name="fm_addtime" id="fm_addtime">
    <div class="modal-body">
    	<div class="formSep">
            <label>ชื่อช่วงเวลาทำงาน</label>
            <input type="text" name="time_name" id="time_name" value="" />
            <span class="help-inline">ตัวอย่าง : กะเวลาเช้า</span>
            <span class="help-block" id="errtxt" style="color:#900; display:none;">กรุณาป้อนชื่อช่วงเวลาทำงาน</span>
        </div> 
        
    	<div class="formSep">
            <p class="sepH_c"><span class="label label-inverse">ช่วงเวลาทำงาน</span></p>
            <div class="row-fluid">
                <div class="span3">
                    <input type="text" class="span8" id="time1" name="time1" />
                    <span class="help-block">เวลาเริ่มต้น</span>
                </div>
                <span class="help-block" id="errtxt1" style="color:#900; display:none;">กรุณาเลือกเวลาเริ่มต้น</span>
                <div class="span3">
                    <input type="text" class="span8" id="time2" name="time2" />
                    <span class="help-block">เวลาสิ้นสุด</span>
                </div>
                <span class="help-block" id="errtxt2" style="color:#900; display:none;">กรุณาเลือกเวลาสิ้นสุด</span>
            </div>
        </div>
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formAdd();"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    </form>
</div>


<!-- POP UP -->
<div class="modal hide fade" id="myModalEdit">
    <div class="modal-header">
        <h3>แก้ไขช่วงเวลาทำงาน</h3>
    </div>
    <form action="" name="fm_edittype" id="fm_edittype">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อช่วงเวลาทำงาน</label>
            <input type="text" name="time_name_edit" id="time_name_edit" value="<?=$time_name_edit?>" />
            <span class="help-inline">ตัวอย่าง : กะเวลาเช้า</span>
            <span class="help-block" id="errtxt_edit" style="color:#900; display:none;">กรุณาป้อนชื่อช่วงเวลาทำงาน</span>
        </div> 
        
        <div class="formSep">
            <p class="sepH_c"><span class="label label-inverse">ช่วงเวลาทำงาน</span></p>
            <div class="row-fluid">
                <div class="span3">
                    <input type="text" class="span8" id="time1_edit" name="time1_edit" />
                    <span class="help-block">เวลาเริ่มต้น</span>
                </div>
                <span class="help-block" id="errtxt_edit1" style="color:#900; display:none;">กรุณาเลือกเวลาเริ่มต้น</span>
                <div class="span3">
                    <input type="text" class="span8" id="time2_edit" name="time2_edit" />
                    <span class="help-block">เวลาสิ้นสุด</span>
                </div>
                <span class="help-block" id="errtxt_edit2" style="color:#900; display:none;">กรุณาเลือกเวลาสิ้นสุด</span>
            </div>
        </div>
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    <input type="hidden" name="temp" id="temp" value="" />
    <input type="hidden" name="time1_temp" id="time1_temp" value="" />
    <input type="hidden" name="time2_temp" id="time2_temp" value="" />
    <input type="hidden" name="timeid" id="timeid" value="" />
    </form>
</div>



 
 <div class="row-fluid search_page">
	<div class="span12">
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการช่วงเวลางานทั้งหมด <strong><?=$total?></strong></div>
                <div class="pull-right">
                  <a data-toggle="modal" data-backdrop="static" href="#myModalAdd">
                  	<button class="btn btn-success" onClick="">เพิ่มเวลางาน</button></a>  
                </div>
            </div>
        </div>
        
  
  		
  
		<? if ($total != 0){ ?>
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px">ลำดับ</th>
                        <th style="width:250px">ชื่อเวลางาน</th>
                        <th style="width:200px">เวลาเริ่มต้น - เวลาสิ้นสุด</th>
                        <th style="width:100px">เครื่องมือ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                        
                    
                    <? 
                    $i = 0;
                    while ($i < $total) {   
						$p_time1 = explode(':',$time_data[$i]['timeStart']);
						$p_time2 = explode(':',$time_data[$i]['timeEnd']);          
                        ?>
                        <tr>                   
                            <td style="text-align:center;"><?=$i+1?></td>
                            <td><?=$time_data[$i]['scheduleName']?></td>
                            <td style="text-align:center;"><?=$p_time1[0]?>:<?=$p_time1[1]?> น. - <?=$p_time2[0]?>:<?=$p_time2[1]?> น. </td>
                            <td>                            
                               	<a href="#" data-toggle="modal" data-backdrop="static" title="Edit" onclick="fn_formEdit(<?=$time_data[$i]['timeScheduleId']?>, 'select');"><i class="icon-pencil"></i></a>
                                <a href="#myModalDel<?=$time_data[$i]['timeScheduleId']?>" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$time_data[$i]['timeScheduleId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบช่วงเวลา "<?=$time_data[$i]['scheduleName']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$time_data[$i]['timeScheduleId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
                                หรือ 
                                <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a></p>
                            </div>
                        </div>
                        
                        <? 
                        $i++;
                    } ?>
                   
                </tbody>
            </table>

         <? } else {  ?>
         
            <div style="text-align:center;">
                <strong>ยังไม่มีข้อมูล!</strong>
            </div>
            
         <? } ?>
        
    </div>
</div>

		
		
	
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
	});
</script>