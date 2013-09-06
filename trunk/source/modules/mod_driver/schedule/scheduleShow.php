 <!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script>

 <div class="row-fluid search_page">
	<div class="span12">
    	<?
		//Select Minor Data
		$time_data = select_db('transportsection',"where garageId = '".$u_garage."' and dateAdd like '".date('Y-m-d')."%' OR statusWork = 'online' order by statusWork");
		$total = count($time_data);
		
		$major_data = select_db('majoradmin',"where garageId = '".$u_garage."'");
		$major_name = $major_data[0]['thaiCompanyName'];
		?>
 
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">จำนวนการลงเวลาเข้างาน ของอู่ "<span style="color:#C30; font-weight:bold;"><?=$major_name?></span>" มีจำนวน <strong><?=$total?></strong></div>
     	
                <form action="" name="fm_addminor" id="fm_addminor" method="post">   
                	<input type="hidden" name="act" value="addschedule" />             	
                	<div class="pull-right">                  
                        <input type="submit" class="btn btn-success" name="btnSubmit" id="btnSubmit" value="ลงเวลางาน">
              	 	</div>              
                </form>
                
            </div>
        </div>
        
  		
  		
  
		<? if ($total != 0){ ?>
        
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px;">ลำดับ</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>รถแท๊กซี่</th>
                        <th>โทรศพท์</th>                        
                        <th>ตำแหน่งปัจจุบัน</th>
                        <th>ช่วงเวลาทำงาน</th>
                        <th>สถานะ</th>
                        <th>เครื่องมือ</th>
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
                            <td>
                            	<i class="splashy-contact_grey"></i>
								<?
                            	$driver_data = select_db('drivertaxi',"where driverId = '".$time_data[$i]['driverId']."'");
								$firstName = $driver_data[0]['firstName'];	
								$lastName = $driver_data[0]['lastName'];
								$citizenId = $driver_data[0]['citizenId'];
								$licenseNumber = $driver_data[0]['licenseNumber'];
								?>	
                                <a href="#" class="ttip_t" title="ดูรายละเอียดเพิ่มเติม" onclick="fn_showInfoDriver(<?=$time_data[$i]['driverId']?>);">
									<?=$firstName?>  <?=$lastName?>
                                </a>
                            </td>
                            <td>
                            	<?
                                $car_data = select_db('car',"where carId = '".$time_data[$i]['carId']."'");
								$carRegistration = $car_data[0]['carRegistration'];
								
								$province_data = select_db('province',"where provinceId = '".$car_data[0]['provinceId']."'");
								$province_name = $province_data[0]['provinceName'];	
								?>
                            	<a href="#" class="ttip_t" title="ดูรายละเอียดเพิ่มเติม" onclick="fn_showInfoCar(<?=$time_data[$i]['carId']?>);">
									<?=$carRegistration?> <?=$province_name?>
                                </a>
                            </td>
                            <td><i class="splashy-cellphone"></i>
                            	<?
                                $mobile_data = select_db('mobile',"where mobileId = '".$time_data[$i]['mobileId']."'");
								$mobileNumber = $mobile_data[0]['mobileNumber'];
								$lat = $mobile_data[0]['latitude'];
								$lon = $mobile_data[0]['longitude'];
								?>
                            	<a href="#" class="ttip_t" title="ดูรายละเอียดเพิ่มเติม" onclick="fn_showInfoMobile(<?=$time_data[$i]['mobileId']?>);">
									<?=$mobileNumber?>
                                </a>
							</td>
                            <td><?=$lat?>, <?=$lon?></td>                                                    
                            <td style="text-align:center;"><?=$p_time1[0]?>:<?=$p_time1[1]?> น. - <?=$p_time2[0]?>:<?=$p_time2[1]?> น. </td>
                            <td style="text-align:center;">
                            	<?
								if ($time_data[$i]['statusWork'] == 'online') {
									?><span style="color:#0C0; font-weight:bold;">กำลังทำงาน</span><?
								} else {
									?><span style="color:#666; font-style:italic;">ออกจากงานแล้ว</span><?
								}
                                ?>
                            </td>
                            <td>
                            	<? if ($time_data[$i]['statusWork'] == 'online') { ?>                            	
                                    <div style="float:left; margin-right:5px;">
                                    <a href="#" class="ttip_t" data-toggle="modal" data-backdrop="static" title="ออกจากงาน" onclick="fn_formEdit(<?=$time_data[$i]['transportSectionId']?>, 'select');"><i class="splashy-warning"></i></a>
                                    </div>
                                <? } ?> 
                                
                                <div style="float:left;">
                                    <a href="#myModalDel<?=$time_data[$i]['transportSectionId']?>" class="ttip_t" data-toggle="modal" title="ยกเลิก"><i class="splashy-remove"></i></a>
                                </div>
                               
                            </td>
                          
                        </tr>
                        
                        <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$time_data[$i]['transportSectionId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการยกเลิกรายการ "<?=$firstName?>  <?=$lastName?>" ?</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$time_data[$i]['transportSectionId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
                                หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a>
                               	</p>
                            </div>
                        </div>
                        
                        <? 
                        $i++;
                    } ?>
                   
                </tbody>
            </table>

         <? } else {  ?>
         
            <div style="text-align:center;">
                <strong>ยังไม่มีข้อมูลการลงเวลา!</strong>
            </div>
            
         <? } ?>

        
    </div>
 </div>
 
 
 
<!-- POP UP -->
<div class="modal hide fade" id="myModalEdit">
    <div class="modal-header">
        <h3>ออกจากงาน</h3>
    </div>
    <form action="" name="fm_edittype" id="fm_edittype">
    <div class="modal-body">
        <div class="formSep">
        	<label class="uni-checkbox">
                <input type="checkbox" value="offline" id="statuswork" name="uni_c1" class="uni_style" />
                เลือกเพื่อลงเวลาออกจากงาน
            </label>
            <span class="help-inline" id="errtxt_edit" style="color:#F00; display:none;">กรุณาเลือกเพื่อลงเวลาออกจากงาน</span>
            <br />
            <label>รายละเอียด</label>
            <textarea name="detail" id="detail" cols="10" rows="3" class="span4"></textarea>
        </div> 
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>ลงเวลาออกจากงาน</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    <input type="hidden" name="transportSectionId" id="transportSectionId" value="" />
    </form>
</div>

 
 
 
 
<!-- POP UP -->
<style type="text/css">
.table10 td{border:none;}
.table10 th{border:none;}
.table10 tr{border:none;}
</style>
<div class="modal hide fade" id="showInfoDriver">
  <div class="modal-header">
    <h3>รายละเอียดข้อมูลของคนขับรถ</h3>
  </div>
  <form action="" name="fm_edittype">
    <div class="modal-body">
      <div class="formSep">
        <table class="table10">
          <tr>
            <th></th>
            <td>
            	<div style="width: 50px; height: 50px;" class="fileupload-new thumbnail">
            		<img src="gallery/temp.gif" alt="" id="driverImage" />
              	</div>
            </td>
          </tr> 
          <tr>
            <th>ชื่อ - นามสกุล : </th>
            <td><div id="txtName"></div></td>
          </tr>
          <tr class="table10">
            <th>หมายเลขบัตรประชาชน : </th>
            <td><div id="txtcitizenId"></div></td>
          </tr>
          <tr>
            <th>หมายเลขใบขับขี่ : </th>
            <td><div id="txtlicenseNumber"></div></td>
          </tr>
          <tr>
            <th>วันเกิด : </th>
            <td><div id="txtBirthday"></div></td>
          </tr>         
          <tr>
            <th>ที่อยู่ : </th>
            <td><div id="txtAddress"></div></td>
          </tr>
          <tr>
            <th>เบอร์มือถือ : </th>
            <td><div id="txtMobile"></div></td>
          </tr>
          <tr>
            <th>เบอร์สำนักงาน : </th>
            <td><div id="txtTelephone"></div></td>
          </tr>                
          <tr>
            <th>สังกัดอู่ : </th>
            <td><div id="txtGarage"></div></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="modal-footer"> 
      <center>
      <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ปิดหน้าต่าง</a> 
      </center>
    </div>
  </form>
</div>




<div class="modal hide fade" id="showInfoCar">
  <div class="modal-header">
    <h3>รายละเอียดข้อมูลของรถแท๊กซี่</h3>
  </div>
  <form action="" name="fm_edittype">
    <div class="modal-body">
      <div class="formSep">
        <table class="table10">
          <tr>
            <th></th>
            <td>
            	<div style="width: 50px; height: 50px;" class="fileupload-new thumbnail">
            		<img src="gallery/temp.gif" alt="" id="carImage" />
              	</div>
            </td>
          </tr> 
          <tr>
            <th>หมายเลขทะเบียน : </th>
            <td><div id="txtRegistration"></div></td>
          </tr>
          <tr class="table10">
            <th>จังหวัด : </th>
            <td><div id="txtProvince"></div></td>
          </tr>
          <tr>
            <th>ยี่ห้อ : </th>
            <td><div id="txtBanner"></div></td>
          </tr>
          <tr>
            <th>รุ่น : </th>
            <td><div id="txtModel"></div></td>
          </tr>  
          <tr>
            <th>สี : </th>
            <td><div id="txtColor"></div></td>
          </tr>    
          <tr>
            <th>ปีรถ : </th>
            <td><div id="txtYear"></div></td>
          </tr>
          <tr>
            <th>เชื้อเพลิง : </th>
            <td><div id="txtFuel"></div></td>
          </tr>
          <tr>
            <th>ติดแก๊ส : </th>
            <td><div id="txtGas"></div></td>
          </tr>                
          <tr>
            <th>สังกัดอู่ : </th>
            <td><div id="txtcarGarage"></div></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="modal-footer">       
      <center>
      <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ปิดหน้าต่าง</a> 
      </center>
    </div>    
  </form>
</div>
 
 
 
 
<div class="modal hide fade" id="showInfoMobile">
  <div class="modal-header">
    <h3>รายละเอียดข้อมูลโทรศัพท์</h3>
  </div>
  <form action="" name="fm_edittype">
    <div class="modal-body">
      <div class="formSep">
        <table class="table10">          
          <tr>
            <th>หมายเลขโทรศัพท์ : </th>
            <td><div id="txtMobileNum"></div></td>
          </tr>
          <tr>
            <th>Emi/Msi : </th>
            <td><div id="txtEmiMsi"></div></td>
          </tr>  
          <tr>
            <th>SIM ID : </th>
            <td><div id="txtSimId"></div></td>
          </tr>   
          <tr class="table10">
            <th>ยี่ห้อ : </th>
            <td><div id="txtMobileBanner"></div></td>
          </tr>
          <tr>
            <th>รุ่น : </th>
            <td><div id="txtMobileModel"></div></td>
          </tr>          
          <tr>
            <th>เครือข่าย : </th>
            <td><div id="txtMobileNetworkId"></div></td>
          </tr>                       
          <tr>
            <th>สังกัดอู่ : </th>
            <td><div id="txtMobileGarage"></div></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="modal-footer">       
      <center>
      <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ปิดหน้าต่าง</a> 
      </center>
    </div>    
  </form>
</div>



<script type="text/javascript">

	
	
	function fn_formEdit(id,process){
		//console.log(id);
		
		if (process == 'select') {
			$.post("modules/mod_driver/schedule/get.data.php", { 
					process: process,
					id: id
				}, 
				function(data){
					$('textarea#detail').val(data);
					$("#transportSectionId").val(id);
				}
			);
			
			$('#myModalEdit').modal('toggle');
		}
		
		
		
		
		
		if (process == 'update') {			
			var id = $("#transportSectionId").val();			
			
			if (!($('#statuswork').is(':checked'))){
				$('#errtxt_edit').fadeIn(500);
			
			} else {
				
				jQuery.ajax({
					url :'modules/mod_driver/schedule/edit.time.php',
					type: 'GET',
					data: 'act=update&id='+id+'&detail='+$('textarea#detail').val()+'',
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
	
	
	function fn_formDel(id){
		jQuery.ajax({
			url :'modules/mod_driver/schedule/del.time.php',
			type: 'GET',
			data: 'act=del&id='+id+'',
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
	
	function fn_showInfoMobile(id){
	//console.log(id);
		$('#showInfoMobile').modal('toggle');	

		jQuery.ajax({
			url :'modules/mod_driver/schedule/get.mobiledata.php',
			type: 'GET',
			data: 'mobileId='+id+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.name);
				//stored\driver\thumbnail			
				$('#txtMobileNum').text(data.mobilenumber);
				$('#txtEmiMsi').text(data.emimsi);
				$('#txtSimId').text(data.simid);						
				$('#txtMobileBanner').text(data.banner);				
				$('#txtMobileModel').text(data.model);
				$('#txtMobileNetworkId').text(data.network);			
				$('#txtMobileGarage').text(data.garagename);
			}
		});	
	}	
	
	
	function fn_showInfoDriver(id){
	//console.log(id);
		$('#showInfoDriver').modal('toggle');	

		jQuery.ajax({
			url :'modules/mod_driver/schedule/get.driverdata.php',
			type: 'GET',
			data: 'driverId='+id+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.name);
				//stored\driver\thumbnail
				if (data.img != ''){
					$('#driverImage').attr('src','stored/driver/thumbnail/'+data.img+'');
				}
				$('#txtName').text(data.name);
				$('#txtcitizenId').text(data.citizenId);
				$('#txtlicenseNumber').text(data.licensenumber);						
				$('#txtBirthday').text(data.birthday);				
				$('#txtAddress').text(data.fullAddress);
				$('#txtMobile').text(data.mobile);
				$('#txtTelephone').text(data.telephone);				
				//$('#txtEmail').text(data.email);				
				$('#txtGarage').text(data.garagename);
			}
		});	
	}	
	
	
	function fn_showInfoCar(id){
	//console.log(id);
		$('#showInfoCar').modal('toggle');	

		jQuery.ajax({
			url :'modules/mod_driver/schedule/get.taxidata.php',
			type: 'GET',
			data: 'carId='+id+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.name);
				//stored\driver\thumbnail
				if (data.img != ''){
					$('#carImage').attr('src','stored/taxi/thumbnail/'+data.img+'');
				}
				$('#txtRegistration').text(data.registration);
				$('#txtProvince').text(data.province);
				$('#txtBanner').text(data.banner);						
				$('#txtModel').text(data.model);				
				$('#txtColor').text(data.color);
				$('#txtYear').text(data.year);
				$('#txtFuel').text(data.fuel);				
				$('#txtGas').text(data.gas);				
				$('#txtcarGarage').text(data.garagename);
			}
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

<!-- sticky messages -->
<script src="lib/sticky/sticky.min.js"></script>
<!-- fix for ios orientation change -->
<script src="js/ios-orientationchange-fix.js"></script>
<!-- scrollbar -->
<script src="lib/antiscroll/antiscroll.js"></script>
<script src="lib/antiscroll/jquery-mousewheel.js"></script>
<!-- common functions -->
<script src="js/gebo_common.js"></script>

<!-- colorbox -->
<script src="lib/colorbox/jquery.colorbox.min.js"></script>
<!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<!-- additional sorting for datatables -->
<script src="lib/datatables/jquery.dataTables.sorting.js"></script>
<!-- tables functions -->
<script src="js/gebo_tables.js"></script>

<script>
    $(document).ready(function() {
        //* show all elements & remove preloader
        setTimeout('$("html").removeClass("js")',1000);
    });
</script>


 