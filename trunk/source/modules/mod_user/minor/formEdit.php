<?
$major_data = select_db('majoradmin',"where garageId = '".$u_garage."'");
$major_name = $major_data[0]['thaiCompanyName'];

$minor_data = select_db('minoradmin',"where minorId = '".$minorId."'");
$username = $minor_data[0]['username'];
$provinceId = $minor_data[0]['provinceId'];
$amphurId = $minor_data[0]['amphurId'];
$districtId = $minor_data[0]['districtId'];
$firstName = $minor_data[0]['firstName'];
$lastName = $minor_data[0]['lastName'];
$address = $minor_data[0]['address'];
$zipcode = $minor_data[0]['zipcode'];
$mobilePhone = $minor_data[0]['mobilePhone'];
$telephone = $minor_data[0]['telephone'];
$email = $minor_data[0]['email'];
$minorTypeId = $minor_data[0]['minorTypeId'];


?>

<div class="row-fluid">
  <div class="span12">
    <h3 class="heading" style="font-size:12px; text-align:center;">แก้ไขพนักงานในระบบ ของอู่ "<span style="color:#06C;"><?=$major_name?></span>"</h3>
    <div class="row-fluid">
      <div class="span8">
        <form class="form-horizontal" action="" method="post" name="fm_edit" id="fm_edit">
          <fieldset>
         
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ประเภทพนักงาน <span class="f_req">*</span> :</label>
              <div class="controls text_line">
              	<? $type_data = select_db('minortype',"where garageId = '".$u_garage."' order by dateAdded"); ?>
                 <select class="input-large" name="minorTypeId" id="minorTypeId" >	
                    <option value="">กรุณาเลือกประเภทพนักงาน</option>
					<? foreach($type_data as $valType){?>
                	<option value="<?=$valType['minorTypeId']?>" <? if ($minorTypeId == $valType['minorTypeId']) { echo "selected=\"selected\""; } ?> ><?=$valType['minorType']?></option>
                	<? } ?> 
                 </select>
                 <div class="help-block" id="minorTypeId_err" style="display:none; color:#C00;">กรุณาเลือกประเภทพนักงาน</div>                       
              </div>
            </div>
            
            <div class="control-group formSep">
              <label for="firstName" class="control-label">ชื่อจริง <span class="f_req">*</span> :</label>
              <div class="controls text_line">
                <input type="text" id="firstName" name="firstName" class="input-xlarge" value="<?=$firstName?>"  /> 
                <div class="help-block" id="firstName_err" style="display:none; color:#C00;">กรุณาป้อนชื่อพนักงาน</div>  
              </div>
              <br />
              <label for="lastName" class="control-label">นามสกุล <span class="f_req">*</span> :</label>
              <div class="controls">
                <input type="text" name="lastName" id="lastName" class="input-xlarge" value="<?=$lastName?>" />  
                <div class="help-block" id="lastName_err" style="display:none; color:#C00;">กรุณาป้อนนามสกุลพนักงาน</div>            
              </div>
              <br />             
            </div>
            
            
            <div class="control-group formSep">
              <label for="username" class="control-label">Username <span class="f_req">*</span> :</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="txtuserName" id="txtuserName" value="<?=$username?>" maxlength="20" disabled="disabled" />
                <div class="help-block" id="txtuserName_err" style="display:none; color:#C00;">กรุณาป้อน Username</div>                
                <div class="help-block" id="errUsername" style="display:none; color:#C00;">Username ซ้ำในระบบ</div>                
                <font color="#006600"><div id="usernameOK"></div></font>
                </i></font> <span class="help-block">ตัวอักษรภาษาอังกฤษเท่านั้น ความยาวไม่เกิน 20 ตัวอักษร</span> </div>
              <br />
              
              
              <label for="password" class="control-label">Password <span class="f_req">*</span> :</label>
              <div class="controls">
                <div class="sepH_b">
                  <div><font color="#FF0000"><i>หากไม่ต้องการแก้ไขรหัสผ่าน ให้ช่องรหัสผ่านว่างไว้ค่ะ</i></font></div>
                    
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
                <textarea class="input-xlarge" name="address" id="address" placeholder="(บ้านเลขที่ ซอย ถนน)"><?=$address?></textarea>
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
                <input type="text" name="zipcode" id="zipcode" class="input-xlarge" value="<?=$zipcode?>" />
                <div class="help-block" id="zipcode_err" style="display:none; color:#C00;">กรุณาป้อนรหัสไปรษณีย์</div>
                <font color="#FF0000"><i><div id="txtZipcodechk" ></div></i></font>
              </div>
            </div>
            
            <div class="control-group formSep">
              <label for="telephone" class="control-label">เบอร์โทรศัพท์</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="telephone" id="telephone" value="<?=$telephone?>" maxlength="10" />
                <font color="#FF0000"><i><div id="telephone_err" ></div></i></font>
              </div>
              <br />  
              
              <label for="mobilePhone" class="control-label">เบอร์โทรศัพท์มือถือ</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="mobilePhone" id="mobilePhone" value="<?=$mobilePhone?>" maxlength="10" />
                <font color="#FF0000"><i><div id="mobilePhone_err" ></div></i></font>
              </div>
              <br />            
             
              <label for="email" class="control-label">E-mail<span class="f_req">*</span> :</label>
              <div class="controls">
                <input type="text" name="txtemail" id="txtemail" class="input-xlarge" value="<?=$email?>" />
                <div class="help-block" id="txtemail_err" style="display:none; color:#C00;">กรุณาป้อน EMail</div>
                <font color="#FF0000"><i><div id="txtemailerr"></div></i></font>                
              </div>
            </div>
            
            <div class="control-group">
              <div class="controls">
                <input class="btn btn-gebo" type="button" value="บันทึกการแก้ไขข้อมูล" onclick="fn_editData();">
                <input type="button" class="btn" onClick="reloadPage()" value="ยกเลิก">
              </div>
            </div>
          </fieldset>
            <input type="hidden" name="p" value="<?=$p?>" />
            <input type="hidden" name="menu" value="<?=$menu?>" />
            <input type="hidden" name="minorId" value="<?=$minorId?>" />
            <input type="hidden" name="act" value="saveedit" />           
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">	
//function ใส่ จังหวัด อำเภอ ตำบล	
$(document).ready( function () {
	
	var province = '<?=$provinceId?>';	
	var amphur = '<?=$amphurId?>';
	var district = '<?=$districtId?>';
	
	//alert(car_ss_gensub);

	if ($('#provinceId').val() != ''){
		fn_callamphur(province, amphur);
		fn_calldistrict(amphur, district);
	}
	
	$('#provinceId').change(function () {
		fn_callamphur($('#provinceId').val(), 0);
		fn_calldistrict(0, 0);
	});
	
	//console.log($.isNumeric('8'));

});



function fn_editData(){
	var pass = 1;
	
	if (checkData('minorTypeId') == 0){ pass = 0 }
	if (checkData('firstName') == 0){ pass = 0 }
	if (checkData('lastName') == 0){ pass = 0 }
	/*if (checkData('txtuserName') == 0){ pass = 0 }
	if (checkData('txtpassword') == 0){ pass = 0 }
	if (checkData('txtpassword2') == 0){ pass = 0 }*/
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
	/*if ($('#txtuserName').val() != ''){
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
	}*/
	
	
	
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
		
		if ($('#txtpassword').val() != ''){
			$('#txtpassword2').closest('div').addClass("f_error");
			$('#txtpassword2_err').fadeIn(1000);
			pass = 0;
		} else {				
			$('#errtxtpassword2').hide();
		}
	}
	
	
	//newstr.length<long
	console.log('pass = '+pass);
	if (pass){
		console.log('Edit Data');
		$('#fm_edit').submit();
	}
}


</script> 



<!-- sticky messages -->
<script src="lib/sticky/sticky.min.js"></script>
<!-- fix for ios orientation change -->
<script src="js/ios-orientationchange-fix.js"></script>
<!-- scrollbar -->
<script src="lib/antiscroll/antiscroll.js"></script>
<script src="lib/antiscroll/jquery-mousewheel.js"></script>
<!-- lightbox -->
<script src="lib/colorbox/jquery.colorbox.min.js"></script>
<!-- common functions -->
<script src="js/gebo_common.js"></script>

<!-- validation -->
<script src="lib/validation/jquery.validate.min.js"></script>
<!-- validation functions -->
<script src="js/gebo_validation.js"></script>

<script>
	$(document).ready(function() {
		//* show all elements & remove preloader
		setTimeout('$("html").removeClass("js")',1000);
	});
</script>