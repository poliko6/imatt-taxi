<?
$major_data = select_db('majoradmin',"where garageId = '".$u_garage."'");
$major_name = $major_data[0]['thaiCompanyName'];
?>

<div class="row-fluid">
  <div class="span12">
    <h3 class="heading" style="font-size:12px; text-align:center;">ลงเวลางานในระบบ ของอู่ "<span style="color:#06C;"><?=$major_name?></span>"</h3>
    <div class="row-fluid">
      <div class="span12">
      
      
        <form class="form-horizontal" action="" method="post" name="fm_add" id="fm_add">
          <fieldset>
          
          
            <div class="formSep">             
             	<div class="control-group">
                  <label for="driverId" class="control-label">เวลางาน <span class="f_req">*</span> :</label>
                  <div class="controls text_line">
                        <div class="span6">  
                        <? $time_data = select_db('timeschedule',"where garageId = '".$u_garage."' order by timeStart"); ?>  
                        <? 
						$iradio = 0;
						if (empty($radioGroupTime)){ $radioGroupTime = $time_data[0]['timeScheduleId']; }
						foreach($time_data as $valTime){
							$p_tStart = explode(':',$valTime['timeStart']);
							$p_tEnd = explode(':',$valTime['timeEnd']);
							$iradio++;
							?>                       	
                          <label class="uni-radio">
                            <input type="radio" name="radioGroupTime" value="<?=$valTime['timeScheduleId']?>" id="radioGroupTime_<?=$iradio?>" <? if ($radioGroupTime == $valTime['timeScheduleId']) { echo "checked=\"checked\""; } ?>  class="uni_style" />
                            <strong><?=$valTime['scheduleName']?></strong> [<?=$p_tStart[0].':'.$p_tStart[1]?> - <?=$p_tEnd[0].':'.$p_tEnd[1]?> ]
                          </label>                     	
                        <? } ?>
                        </div>
                 	</div>
         		</div>
            </div>
          
          
			<div class="formSep">
            
                <div class="control-group">
                  <label for="driverId" class="control-label">คนขับ <span class="f_req">*</span> :</label>
                  <div class="controls text_line">
                    <div class="span10">    
                        <? 
						$driver_data = select_db('drivertaxi',"where `lock` = 1 order by firstName"); 
						/*foreach($driver_data as $valDriver){
								//$driver_working = select_db('transportsection',"where driverId = '".$valDriver['driverId']."' and dateAdd Like '".date('Y-m-d')."%' and ('".date('H:i:s')."' BETWEEN timeStart and timeEnd) ");
								$driver_working = select_db('transportsection',"where driverId = '".$valDriver['driverId']."' and dateAdd Like '".date('Y-m-d')."%' and statusWork = 'online' ");
								echo count($driver_working);
						}*/
						?>          		
                        <select name="thisdriverId" id="thisdriverId" data-placeholder="เลือกคนขับรถ..." class="chzn_a span8">
                            <option value=""></option> 
                            <? 
							foreach($driver_data as $valDriver){
								//$driver_working = select_db('transportsection',"where driverId = '".$valDriver['driverId']."' and dateAdd Like '".date('Y-m-d')."%' and ('".date('H:i:s')."' BETWEEN timeStart and timeEnd) ");<br />
								$driver_working = select_db('transportsection',"where driverId = '".$valDriver['driverId']."' and statusWork = 'online' ");
								if (count($driver_working) == 0){
									$major_driver_data = select_db('majoradmin',"where garageId = '".$valDriver['garageId']."'");
									$major_driver_name = $major_driver_data[0]['thaiCompanyName'];
									?>
									<option value="<?=$valDriver['driverId']?>" <? if ($driverId == $valDriver['driverId']) { echo "selected=\"selected\""; } ?> ><?=$valDriver['citizenId']?>: <?=$valDriver['firstName']?>  <?=$valDriver['lastName']?> [<i><?=$major_driver_name?></i>]</option>
                            		<? 
								}
							} 
							?>  
                        </select>
                        <div class="help-block" id="thisdriverId_err" style="display:none; color:#C00;">กรุณาเลือกคนขับรถ</div>  
                    </div>                  
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="driverId" class="control-label">รถแท๊กซี่ <span class="f_req">*</span> :</label>
                  <div class="controls text_line">
                    <div class="span10">    
                        <? 
						$car_data = select_db('car',"where garageId = '".$u_garage."' and `lock` = 1 order by carRegistration"); 					
						/*foreach($car_data as $valCar){
								$car_working = select_db('transportsection',"where carId = '".$valCar['carId']."' and dateAdd Like '".date('Y-m-d')."%' and statusWork = 'online' ");
								//echo count($car_working);
						}*/
						
						?>          		
                        <select name="thiscarId" id="thiscarId" data-placeholder="เลือกรถแท๊กซี่..." class="chzn_a span6">
                            <option value=""></option> 
                            <? 
							foreach($car_data as $valCar){
								$car_working = select_db('transportsection',"where carId = '".$valCar['carId']."' and statusWork = 'online' ");
								if (count($car_working) == 0){
									$province_car_data = select_db('province',"where provinceId = '".$valCar['provinceId']."'");
									$province_car_name = $province_car_data[0]['provinceName'];	
									
									$banner_car_data = select_db('carbanner',"where carBannerId = '".$valCar['carBannerId']."'");
									$banner_car_name = $banner_car_data[0]['carBannerNameEng'];							
									?>
									<option value="<?=$valCar['carId']?>" <? if ($carId == $valCar['carId']) { echo "selected=\"selected\""; } ?> ><?=$valCar['carRegistration']?> <?=$province_car_name?> [ยี่ห้อ: <?=$banner_car_name?>]</option>
                            		<? 
								}
							} 
							?>  
                        </select>
                        <div class="help-block" id="thiscarId_err" style="display:none; color:#C00;">กรุณาเลือกแท๊กซี่</div> 
                    </div>	                                          
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label for="driverId" class="control-label">โทรศัพท์ <span class="f_req">*</span> :</label>
                  <div class="controls text_line">
                    <div class="span10">    
                        <? $mobile_data = select_db('mobile',"where garageId = '".$u_garage."' and `lock` = 1 order by mobileNumber"); ?>          		
                        <select name="thismobileId" id="thismobileId" data-placeholder="เลือกโทรศัพท์..." class="chzn_a span6">
                            <option value=""></option> 
                            <? 
							foreach($mobile_data as $valMobile){
								$mobile_working = select_db('transportsection',"where carId = '".$valMobile['mobileId']."'  and statusWork = 'online' ");
								if (count($mobile_working) == 0){
									?>
									<option value="<?=$valMobile['mobileId']?>" <? if ($thismobileId == $valMobile['mobileId']) { echo "selected=\"selected\""; } ?> ><?=$valMobile['mobileNumber']?> [EMI/MSI : <?=$valMobile['EmiMsi']?>]</option>
									<? 
								}
							} 
							?>  
                        </select>
                        <div class="help-block" id="thismobileId_err" style="display:none; color:#C00;">กรุณาเลือกโทรศัพท์</div>
                    </div>	                                           
                  </div>
                </div>
            
            </div>
            
            
            <div class="formSep">            
                <div class="control-group">
                	<div class="controls text_line">
                    	<div class="span6">
                        <label>รายละเอียดเพิ่มเติม</label>
                        <textarea name="detail" id="detail" cols="10" rows="3" class="span8"></textarea>
                    	</div>
                    </div>
                </div>
            </div>
            
 
            <div class="control-group">
              <div class="controls">
                <input class="btn btn-gebo" type="button" value="บันทึกการเพิ่มข้อมูล" onclick="fn_addData();">
                <input type="button" class="btn" onClick="reloadPage()" value="ยกเลิก">
              </div>
            </div>
          </fieldset>
            <input type="hidden" name="p" value="<?=$p?>" />
            <input type="hidden" name="menu" value="<?=$menu?>" />
            <input type="hidden" name="act" value="saveadd" />           
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">	
$(document).ready( function () {
	//console.log($.isNumeric('8'));
});



function fn_addData(){
	var pass = 1;
	
	if (checkData('thisdriverId') == 0){ pass = 0 }
	if (checkData('thiscarId') == 0){ pass = 0 }
	if (checkData('thismobileId') == 0){ pass = 0 }	

	//newstr.length<long
	console.log('pass = '+pass);
	if (pass){
		//console.log('Add Data');
		$('#fm_add').submit();
	}
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

<!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script>

<script>
    $(document).ready(function() {
        //* show all elements & remove preloader
        setTimeout('$("html").removeClass("js")',1000);
    });
</script>
		