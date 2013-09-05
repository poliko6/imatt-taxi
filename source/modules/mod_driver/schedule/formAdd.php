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
          
          
            <div class="formStep">             
             	<div class="control-group">
                  <label for="driverId" class="control-label">คนขับ <span class="f_req">*</span> :</label>
                  <div class="controls text_line">
                        <div class="span6">  
                        <? $time_data = select_db('timeschedule',"where garageId = '".$u_garage."' order by timeStart"); ?>  
                        
                        </div>
                 	</div>
         		</div>
            </div>
          
          
			<div class="formSep">
            
                <div class="control-group">
                  <label for="driverId" class="control-label">คนขับ <span class="f_req">*</span> :</label>
                  <div class="controls text_line">
                        <div class="span6">    
                            <? $driver_data = select_db('drivertaxi',"order by firstName"); ?>          		
                            <select name="driverId" id="driverId" data-placeholder="เลือกคนขับรถ..." class="chzn_a">
                                <option value=""></option> 
                                <? foreach($driver_data as $valDriver){?>
                                    <option value="<?=$valDriver['driverId']?>" <? if ($driverId == $valDriver['driverId']) { echo "selected=\"selected\""; } ?> ><?=$valDriver['firstName']?>  <?=$valDriver['lastName']?> [<?=$valDriver['garageId']?>]</option>
                                <? } ?>  
                            </select>
                        </div>	
                    <div class="help-block" id="minorTypeId_err" style="display:none; color:#C00;">กรุณาเลือกคนขับรถ</div>                       
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="driverId" class="control-label">รถแท๊กซี่ <span class="f_req">*</span> :</label>
                  <div class="controls text_line">
                        <div class="span6">    
                            <? $car_data = select_db('car',"where garageId = '".$u_garage."' order by carRegistration"); ?>          		
                            <select name="carId" id="carId" data-placeholder="เลือกรถแท๊กซี่..." class="chzn_a">
                                <option value=""></option> 
                                <? foreach($car_data as $valCar){?>
                                    <option value="<?=$valCar['carId']?>" <? if ($carId == $valCar['carId']) { echo "selected=\"selected\""; } ?> ><?=$valCar['carRegistration']?> [<?=$valCar['carRegistration']?>]</option>
                                <? } ?>  
                            </select>
                        </div>	
                    <div class="help-block" id="minorTypeId_err" style="display:none; color:#C00;">กรุณาเลือกแท๊กซี่</div>                       
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label for="driverId" class="control-label">โทรศัพท์ <span class="f_req">*</span> :</label>
                  <div class="controls text_line">
                        <div class="span6">    
                            <? $mobile_data = select_db('mobile',"where garageId = '".$u_garage."' order by mobileNumber"); ?>          		
                            <select name="mobileId" id="mobileId" data-placeholder="เลือกโทรศัพท์..." class="chzn_a">
                                <option value=""></option> 
                                <? foreach($mobile_data as $valMobile){?>
                                    <option value="<?=$valMobile['mobileId']?>" <? if ($mobileId == $valMobile['mobileId']) { echo "selected=\"selected\""; } ?> ><?=$valMobile['mobileNumber']?> [<?=$valMobile['mobileNumber']?>]</option>
                                <? } ?>  
                            </select>
                        </div>	
                    <div class="help-block" id="minorTypeId_err" style="display:none; color:#C00;">กรุณาเลือกโทรศัพท์</div>                       
                  </div>
                </div>
            
            </div>
            
            
            <div class="control-group formSep">
              <label for="firstName" class="control-label">ชื่อจริง <span class="f_req">*</span> :</label>
              <div class="controls text_line">
                <input type="text" id="firstName" name="firstName" class="input-xlarge" value=""  /> 
                <div class="help-block" id="firstName_err" style="display:none; color:#C00;">กรุณาป้อนชื่อพนักงาน</div>  
              </div>
              <br />
              <label for="lastName" class="control-label">นามสกุล <span class="f_req">*</span> :</label>
              <div class="controls">
                <input type="text" name="lastName" id="lastName" class="input-xlarge" value="" />  
                <div class="help-block" id="lastName_err" style="display:none; color:#C00;">กรุณาป้อนนามสกุลพนักงาน</div>            
              </div>
              <br />             
            </div>
            
            
            <div class="control-group formSep">
              <label for="username" class="control-label">Username <span class="f_req">*</span> :</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="txtuserName" id="txtuserName" value="" maxlength="20" />
                <div class="help-block" id="txtuserName_err" style="display:none; color:#C00;">กรุณาป้อน Username</div>                
                <div class="help-block" id="errUsername" style="display:none; color:#C00;">Username ซ้ำในระบบ</div>                
                <font color="#006600"><div id="usernameOK"></div></font>
                </i></font> <span class="help-block">ตัวอักษรภาษาอังกฤษเท่านั้น ความยาวไม่เกิน 20 ตัวอักษร</span> </div>
              <br />
              
              <label for="password" class="control-label">Password <span class="f_req">*</span> :</label>
              <div class="controls">
                <div class="sepH_b">
                  <input type="password" class="input-xlarge" name="txtpassword" id="txtpassword" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" />
                  <div class="help-block" id="txtpassword_err" style="display:none; color:#C00;">กรุณาป้อน Password</div>
                  <div class="help-block" id="errPassword" style="display:none; color:#C00;">Password Error</div>                   
                  <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span> </div>
                  
                  <input type="password" class="input-xlarge" name="txtpassword2" id="txtpassword2" placeholder="พิมพ์พาสเวิร์ดเดิมอีกครั้ง" maxlength="20" />
                  <div class="help-block" id="txtpassword2_err" style="display:none; color:#C00;">กรุณายืนยัน Password</div>
                  <div class="help-block" id="errtxtpassword2" style="display:none; color:#C00;">กรุณายืนยัน Password</div>
                  <font color="#FF0000"><i><div id="u_password2chk"></div></i></font>                  
              </div>              
            </div>
            
            
            <div class="control-group formSep">
              <label class="control-label">ที่อยู่ <span class="f_req">*</span> :</label>
              <div class="controls">
                <textarea class="input-xlarge" name="address" id="address" placeholder="(บ้านเลขที่ ซอย ถนน)"></textarea>
                <div class="help-block" id="address_err" style="display:none; color:#C00;">กรุณาป้อนที่อยู่</div>  
              </div>
              <br />
              <label class="control-label">จังหวัด <span class="f_req">*</span> :</label>
              <div class="controls">
                <div class="span6">
                  <select name="provinceId" id="provinceId">
                    <option value="" <? if($provinceId==""){echo "selected=\"selected\""; } ?> >กรุณาเลือกจังหวัด</option>
                    <?PHP				  	
									
					$sql = "SELECT * FROM province ORDER BY provinceName";		
                    $exe = mysql_query($sql);
                    while($result = mysql_fetch_array($exe)){	?>
                    <option value="<?=$result['provinceId']?>" <? if($provinceId==$result['provinceId']){echo "selected=\"selected\""; } ?> >
                    	<?=$result['provinceName']?>
                    </option>                
                    <?  }  ?>
                  </select>
                </div>
              </div>
              
              <br />
              <br />   
                         
              <label class="control-label">อำเภอ <span class="f_req">*</span> :</label>
              <div class="controls">
                <div class="span6">
                  <div id="genamphur">
                    <select name="amphurId" id="amphurId">
                      <option value="">กรุณาเลือกอำเภอ</option>
                    </select>
                  </div>
                </div>
              </div>
              
              <br /> 
              <br />
              
              <label class="control-label">ตำบล <span class="f_req">*</span> :</label>
              <div class="controls">
                <div class="span6">
                  <div id="gendistrict">
                    <select name="districtId" id="districtId">
                      <option value="">กรุณาเลือกตำบล</option>
                    </select>
                  </div>
                </div>
              </div>
              
              <br />
              <br />  
                          
              <label class="control-label">รหัสไปรษณีย์ <span class="f_req">*</span> :</label>
              <div class="controls">
                <input type="text" name="zipcode" id="zipcode" class="input-xlarge" value="" />
                <div class="help-block" id="zipcode_err" style="display:none; color:#C00;">กรุณาป้อนรหัสไปรษณีย์</div>
                <font color="#FF0000"><i><div id="txtZipcodechk" ></div></i></font>
              </div>
            </div>
            
            <div class="control-group formSep">
              <label for="telephone" class="control-label">เบอร์โทรศัพท์</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="telephone" id="telephone" value="" maxlength="10" />
                <font color="#FF0000"><i><div id="telephone_err" ></div></i></font>
              </div>
              <br />  
              
              <label for="mobilePhone" class="control-label">เบอร์โทรศัพท์มือถือ</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="mobilePhone" id="mobilePhone" value="" maxlength="10" />
                <font color="#FF0000"><i><div id="mobilePhone_err" ></div></i></font>
              </div>
              <br />            
             
              <label for="email" class="control-label">E-mail</label>
              <div class="controls">
                <input type="text" name="txtemail" id="txtemail" class="input-xlarge" value="" />
                <div class="help-block" id="txtemail_err" style="display:none; color:#C00;">กรุณาป้อน EMail</div>
                <font color="#FF0000"><i><div id="txtemailerr"></div></i></font>                
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
//function ใส่ จังหวัด อำเภอ ตำบล	
$(document).ready( function () {
	
	var provinceId = '<?=$provinceId?>';	
	var amphurId = '<?=$amphurId?>';
	var districtId = '<?=$districtId?>';
	
	//alert(car_ss_gensub);

	if ($('#province').val() != ''){
		fn_callamphur(provinceId, amphurId);
		fn_calldistrict(amphurId, districtId);
	}
	
	$('#province').change(function () {
		fn_callamphur($('#provinceId').val(), 0);
		fn_calldistrict(0, 0);
	});
	
	//console.log($.isNumeric('8'));

});



function fn_addData(){
	var pass = 1;
	
	if (checkData('minorTypeId') == 0){ pass = 0 }
	if (checkData('firstName') == 0){ pass = 0 }
	if (checkData('lastName') == 0){ pass = 0 }
	if (checkData('txtuserName') == 0){ pass = 0 }
	if (checkData('txtpassword') == 0){ pass = 0 }
	if (checkData('txtpassword2') == 0){ pass = 0 }
	if (checkData('address') == 0){ pass = 0 }
	if (checkData('provinceId') == 0){ pass = 0 }
	if (checkData('amphurId') == 0){ pass = 0 }
	if (checkData('districtId') == 0){ pass = 0 }
	if (checkData('zipcode') == 0){ pass = 0 }
	if (checkData('txtemail') == 0){ pass = 0 }
	
	
	/// Mobile
	if ($('#mobilePhone').val() != ''){ 
		var chkmobile = $.isNumeric(''+$('#mobilePhone').val()+'');
		if (chkmobile == false){
			$('#mobilePhone').closest('div').addClass("f_error");
			$('#mobilePhone_err').text('กรุณาป้อนตัวเลขเท่านั้น');
			$('#mobilePhone_err').fadeIn(1000);
			pass = 0;
		} else {
			$('#mobilePhone').closest('div').removeClass("f_error");
			$('#mobilePhone_err').fadeOut(100);
		}
	} else {
		$('#mobilePhone').closest('div').removeClass("f_error");
		$('#mobilePhone_err').hide();
	}
	
	/// Telephone
	if ($('#telephone').val() != ''){ 
		var chkphone = $.isNumeric(''+$('#telephone').val()+'');
		if (chkphone == false){
			$('#telephone').closest('div').addClass("f_error");
			$('#telephone_err').text('กรุณาป้อนตัวเลขเท่านั้น');
			$('#telephone_err').fadeIn(1000);
			pass = 0;
		} else {
			$('#telephone').closest('div').removeClass("f_error");
			$('#telephone_err').fadeOut(100);
		}
	} else {
		$('#telephone').closest('div').removeClass("f_error");
		$('#telephone_err').hide();
	}
	
	
	///Email
	if ($('#txtemail').val() != ''){	
		var chkmail = checkEmail($('#txtemail').val());
		if (chkmail == false){
			$('#txtemail').closest('div').addClass("f_error");
			$('#txtemailerr').text('กรุณากรอก email ให้ถูกต้อง');
			$('#txtemailerr').fadeIn(1000);
			pass = 0;
		} else {
			$('#txtemail').closest('div').removeClass("f_error");
			$('#txtemailerr').fadeOut(100);
		}
	} else {		
		$('#txtemailerr').hide();
	}
	
	
	
	//Username
	if ($('#txtuserName').val() != ''){
		var username = $('#txtuserName').val();
		var chkuser = checkEngNum(username);
		if (chkuser == false){
			$('#txtuserName').closest('div').addClass("f_error");
			$('#errUsername').text('กรุณากรอกตัวอักษรภาษาอังกฤษ และตัวเลขเท่านั้น');
			$('#errUsername').fadeIn(1000);
			pass = 0;
		} else {
			
			///Count 
			if (username.length < 8){
				$('#txtuserName').closest('div').addClass("f_error");
				$('#errUsername').text('กรุณากรอก Username ให้มากกว่า 8 ตัวอักษร');
				$('#errUsername').fadeIn(1000);
				pass = 0;
			} else {
				
				jQuery.ajax({
					url :'modules/mod_user/minor/chkRegisDuplicate.php',
					type : 'GET',
					data : 'username='+username+'&u_garage=<?=$u_garage?>',
					dataType: 'jsonp',
					dataCharset: 'jsonp',
					success: function (data){			
						//console.log(data.success);
						if (data.success){
							$('#txtuserName').closest('div').removeClass("f_error");
							$('#errUsername').fadeOut(100);	
							$('#usernameOK').text('Username นี้ใช้งานได้');
							$('#usernameOK').fadeIn(1000);
						} else {
							$('#txtuserName').closest('div').addClass("f_error");
							$('#errUsername').text('Username นี้มีผู้ใช้งานแล้ว');
							$('#errUsername').fadeIn(1000);
							$('#usernameOK').hide();
							pass = 0;
						}			
					}		
				});				
				
			}
		}		
	} else {		
		$('#errUsername').hide();
	}
	
	
	
	//Password1
	if ($('#txtpassword').val() != ''){
		var pwd = $('#txtpassword').val();
		var chkpwd = checkEngNum(pwd);
		if (chkpwd == false){
			$('#txtpassword').closest('div').addClass("f_error");
			$('#errPassword').text('กรุณากรอกตัวอักษรภาษาอังกฤษ และตัวเลขเท่านั้น');
			$('#errPassword').fadeIn(1000);
			pass = 0;
		} else {
			if (pwd.length < 8){
				$('#txtpassword').closest('div').addClass("f_error");
				$('#errPassword').text('กรุณากรอก Password ให้มากกว่า 8 ตัวอักษร');
				$('#errPassword').fadeIn(1000);
				pass = 0;
			} else {
				$('#txtpassword').closest('div').removeClass("f_error");
				$('#errPassword').fadeOut(100);
			}
		}
	} else {		
		$('#errPassword').hide();
	}
	
	
	//Password2
	if ($('#txtpassword2').val() != ''){
		//errtxtpassword2
		var pwd1 = $('#txtpassword').val();
		var pwd2 = $('#txtpassword2').val();
		if (pwd1 != pwd2){
			$('#txtpassword2').closest('div').addClass("f_error");
			$('#errtxtpassword2').text('รหัสผ่านไม่ตรงกัน');
			$('#errtxtpassword2').fadeIn(1000);
			pass = 0;
		} else {
			$('#txtpassword2').closest('div').removeClass("f_error");
			$('#errtxtpassword2').fadeOut(100);
		}
	} else {		
		$('#errtxtpassword2').hide();
	}
	
	
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
		