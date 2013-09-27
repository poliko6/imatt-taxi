<?
	if($garageId != '0')
	{	$strSQL = "SELECT drivertaxi.*,majoradmin.thaiCompanyName ";
		$strSQL .= "FROM drivertaxi,majoradmin WHERE drivertaxi.driverId ='".$driverId."' ";
		$strSQL .= "&& drivertaxi.garageId = majoradmin.garageId"; }
	else
	{	$strSQL = "SELECT * FROM drivertaxi WHERE drivertaxi.driverId ='".$driverId."'";	}
	$objQuery = mysql_query($strSQL);	
	$objResult = mysql_fetch_array($objQuery);
	
	$driverId = $objResult['driverId'];
	$citizenId = $objResult['citizenId'];
	$firstName = $objResult['firstName'];
	$lastName = $objResult['lastName'];
	
	if($objResult['driverImage']=='')
	{	$imgSrc = "gallery/80x80.gif"; }
	else
	{	$imgSrc = "stored/driver/".$objResult['driverImage'];	 }
	$licenseNumber = $objResult['licenseNumber'];
	$driverBirthday = $objResult['driverBirthday'];
	$address = $objResult['address'];
	$province_ss = $objResult['provinceId'];
	$amphur_ss = $objResult['amphurId'];
	$district_ss = $objResult['districtId'];
	$zipcode = $objResult['zipcode'];
	$mobilePhone = $objResult['mobilePhone'];
	$telephone = $objResult['telephone'];
	$username = $objResult['username'];
?>

<div class="row-fluid">
  <div class="span12">
    <h3 class="heading">แก้ไขข้อมูล</h3>
    <div class="row-fluid">
      <div class="span8">
        <form class="form-horizontal">
          <div class="control-group formSep">
            <label for="u_fname" class="control-label">หมายเลขประชาชน :</label>
            <div class="controls text_line">
              <input type="text" class="input-xlarge" name="chkCitizen" id="chkCitizen" disabled="disabled" maxlength="13" value="<?=$citizenId?>" />
              <font id="chkIdFont"><i>
              <div id="chkID"></div>
              </i></font> </div>
          </div>
        </form>
        <form id="formInfo" class="form-horizontal form_validation_ttip" method="post" enctype="multipart/form-data">
          <fieldset>
            <div class="control-group formSep">
              <label for="fileinput" class="control-label">รูปประจำตัวผู้ขับ</label>
              <div class="controls">
                <div data-provides="fileupload" class="fileupload fileupload-new">
                  <input type="hidden" />
                  <div style="width: 80px; height: 80px;" class="fileupload-new thumbnail"><img id="driverImg" src="<?=$imgSrc?>" alt="" /></div>
                  <div style="width: 80px; height: 80px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                  <span id="btnUppic" class="btn btn-file"><span class="fileupload-new">เลือกไฟล์รูป</span><span class="fileupload-exists">Change</span>
                  <input type="file" id="fileinput" name="fileinput" />
                  </span> <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a> </div>
                <span id="picHelp" class="help-block">ความกว้าง-ยาวของรูป ห้ามมีขนาดเกิน 1024x1024</span> </div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อจริง* :</label>
              <div class="controls text_line">
                <input type="text" name="fName" id="fName" class="input-xlarge" value="<?=$firstName?>" onchange="chkThai(this.id,this.value)" />
                <font color="#FF0000"><i>
                <div id="fNamechk"></div>
                </i></font> </div>
              <br />
              <label for="u_fname" class="control-label">นามสกุล* :</label>
              <div class="controls">
                <input type="text" name="lName" id="lName" class="input-xlarge" value="<?=$lastName?>" onchange="chkThai(this.id,this.value)" />
                <font color="#FF0000"><i>
                <div id="lNamechk"></div>
                </i></font> </div>
              <br />
              <label for="u_fname" class="control-label">วัน เดือน ปี เกิด* :</label>
              <div class="controls date" id="dp2" data-date-format="dd/mm/yyyy"> <span class="add-on">
                <input class="input-xlarge" type="text" id="birthDay" name="birthDay" readonly="readonly" value="<?=$driverBirthday?>" />
                </span><span class="help-block">คลิกเพื่อเลือกวันที่จากปฏิทิน</span></div>
              <br />
              <label for="u_fname" class="control-label">เลขใบขับขี่* :</label>
              <div class="controls">
                <input type="text" name="dLicense" id="dLicense" class="input-xlarge" value="<?=$licenseNumber?>" onchange="numberOrNot(this.id,this.value)" />
              </div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">Username</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="userName" id="userName" value="<?=$username?>" maxlength="20" disabled="disabled" />              </div><br />
                <label for="u_password" class="control-label">Password</label>
                <div class="controls">
                  <div class="sepH_b"> <a href="#changePW" data-toggle="modal" title="เปลี่ยนรหัสผ่าน" >เปลี่ยนรหัสผ่านใหม่</a> </div>
                </div>
            </div>
            <div class="control-group formSep">
              <label class="control-label">ที่อยู่* :</label>
              <div class="controls">
                <textarea class="input-xlarge" name="txtAddress_add" id="txtAddress" placeholder="(บ้านเลขที่ ซอย ถนน)"><?=$address?>
</textarea>
              </div>
              <br />
              <label class="control-label">จังหวัด* :</label>
              <div class="controls">
                <div class="span6">
                  <select name="province_add" id="province">
                    <option value="" <? if($province_ss==""){echo "selected=\"selected\""; } ?> >กรุณาเลือกจังหวัด</option>
                    <?PHP				  	
									
					$sql = "SELECT * FROM province ORDER BY provinceName";		
                    $exe = mysql_query($sql);
                    while($result = mysql_fetch_array($exe)){	?>
                    <option value="<?=$result['provinceId']?>" <? if($province_ss==$result['provinceId']){echo "selected=\"selected\""; } ?> >
                    <?=$result['provinceName']?>
                    </option>
                    <?  }  ?>
                  </select>
                </div>
              </div>
              <br />
              <br />
              <label class="control-label">อำเภอ* :</label>
              <div class="controls">
                <div class="span6">
                  <div id="genamphur">
                    <select name="amphur_add" id="amphur">
                      <option value="">กรุณาเลือกอำเภอ</option>
                    </select>
                  </div>
                </div>
              </div>
              <br />
              <br />
              <label class="control-label">ตำบล* :</label>
              <div class="controls">
                <div class="span6">
                  <div id="gendistrict">
                    <select name="district_add" id="district">
                      <option value="">กรุณาเลือกตำบล</option>
                    </select>
                  </div>
                </div>
              </div>
              <br />
              <br />
              <label class="control-label">รหัสไปรษณีย์* :</label>
              <div class="controls">
                <input type="text" name="txtZipcode_add" id="txtZipcode" class="input-xlarge" value="<?=$zipcode?>" onchange="numberOrNot(this.id,this.value,'รหัสไปรษณีย์ไม่ถูกต้อง')" />
                <font color="#FF0000"><i>
                <div id="txtZipcodechk" ></div>
                </i></font> </div>
              <br />
              <label for="u_email" class="control-label">เบอร์โทรศัพท์มือถือ* :</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="txtMobilePhone" id="txtMobilePhone" value="<?=$mobilePhone?>" maxlength="10" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i>
                <div id="txtMobilePhonechk" ></div>
                </i></font> </div>
              <br />
              <label for="u_email" class="control-label">เบอร์โทรศัพท์บ้าน</label>
              <div class="controls">
                <input type="text" name="txtTel" id="txtTel" class="input-xlarge" value="<?=$telephone?>" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i>
                <div id="txtTelchk" ></div>
                </i></font> </div>
            </div>
            <div id="fixGarage" style="visibility:hidden" class="control-group formSep">
              <label class="control-label">อู่สำหรับผู้ขับนี้</label>
              <div class="controls">
                <select class="input-xlarge" name="selGarage" id="selGarage">
                	<option value="0">ไม่สังกัดอู่ใด</option>
                  <?PHP									
					$sql = "SELECT * FROM majoradmin WHERE garageId ='".$u_garage."'";		
                    $exe = mysql_query($sql);
                    $result = mysql_fetch_array($exe)
					?>
                  <option value="<?=$result['garageId']?>">
                  <?=$result['thaiCompanyName']?>
                  </option>
                </select>
              </div>
            </div>
            <div id="allGarage" style="visibility:hidden" class="control-group formSep">
              <label class="control-label">เลือกอู่สำหรับผู้ขับนี้</label>
              <div class="controls">
                <select class="input-xlarge" name="selGarage2" id="selGarage2">
                  <option value="0" >ไม่สังกัดอู่ใด</option>
                  <?PHP									
					$sql = "SELECT * FROM majoradmin ORDER BY thaiCompanyName";		
                    $exe = mysql_query($sql);
                    while($result = mysql_fetch_array($exe)){	?>
                  <option value="<?=$result['garageId']?>">
                  <?=$result['thaiCompanyName']?>
                  </option>
                  <?  }  ?>
                </select>
              </div>
            </div>
            <div class="control-group">
            <div class="controls">
              <button class="btn btn-gebo" type="submit">บันทึกการแก้ไขข้อมูล</button>
              <input type="button" class="btn" value="ยกเลิก" onclick="reloadPage()" />
            </div>
          </fieldset>
          <input type="hidden" name="p" value="<?=$p?>" />
          <input type="hidden" name="menu" value="<?=$menu?>" />
          <input type="hidden" name="citizenId" id="citizenId" value="<?=$citizenId?>" />
          <input type="hidden" name="act" value="saveedit" />
          <input type="hidden" name="current_page" id="current_page" value="<?=$current_page?>" />
        </form>
      </div>
    </div>
  </div>
</div>

<!-- POP UP --> 
<!-- Change Username Password -->
<div class="modal hide fade" id="changePW" style="text-align:center; width:500px;">
  <div class="alert alert-block alert-error fade in">
    <h4 class="alert-heading">เปลี่ยนรหัสผ่านใหม่สำหรับUsernameของ "
      <?=$firstName?>
      <?=$lastName?>
      "</h4>
    <br />
      <input type="password" class="input-xlarge" name="u_password" id="u_password" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" onchange="chk1stPW(this.id,this.value,8)" />
      <font color="#FF0000"><i>
      <div id="u_passwordchk"></div>
      </i></font> <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span>
    <input type="password" class="input-xlarge" name="u_password2" id="u_password2" placeholder="พิมพ์พาสเวิร์ดเดิมอีกครั้ง" maxlength="20" onkeyup="chk2ndPW(this.value)" />
    <font color="#FF0000"><i>
    <div id="u_password2chk"></div>
    </i></font>
  <a href="#" onclick="">
  <button id="btnPWConfirm" name="btnPWConfirm" disabled="disabled" class="btn btn-success" onclick="chgPW()">เปลี่ยนรหัสผ่าน</button>
  </a> หรือ <a href="#" class="btn" onclick="resetmodal()" data-dismiss="modal"><i class="splashy-error_x"></i> ยกเลิก</a> </div>
</div>
</div>
<script type="text/javascript">
var oldpwtemp=null;

function checkID(tagid,id) {
//ตรวจว่าป้อนถูกตามรูปแบบที่กำหนดมั้ย x-xxxx-xxxxx-xx-x
	var temp;
	$('#chkID').text("");	
 	if(id.length == 13) 
	{
		for(i=0, sum=0; i < 12; i++)
			sum += parseFloat(id.charAt(i))*(13-i); 
		if((11-sum%11)%10!=parseFloat(id.charAt(12)))
		{
			$('#chkID').attr("style","color:#FF0000");
			$('#chkID').text("รหัสบัตรประชาชนไม่ถูกต้อง");	
			$('#'+tagid+'').val("");	
		}
		else
		{	
			
			jQuery.ajax({
				url :'modules/mod_driver/managedriver/JSON/driver.add.chkCitizenId.php',
				type : 'GET',
				data : 'citizenId='+id+'&u_type='+u_type+'',
				dataType: 'jsonp',
				dataCharset: 'jsonp',
				success: function (data){
					console.log(data.status);
					console.log(data.exist);
					if(data.exist==true)
					{
						if(data.g_exist==true && u_type != '1')
							$('#chkID').html(''+data.response+'');
						else
						{
							$('#chkID').html(''+data.response+'');							
							$('#'+tagid+'').attr("readonly","readonly");
							$('#citizenId').val($('#'+tagid+'').val());	
							$('#statusAdd').val("old");
							$('#formInfo').attr("style","visibility:visible");	
							$('#fName').val(data.fName);
							$('#lName').val(data.lName);							
							$('#driverImg').attr("src","stored/driver/"+data.driverImg+"");					
							$('#birthDay').val(data.birthDay);
							$('#dLicense').val(data.dLicense);
							$('#userName').val(data.userName);
							$('#userName').attr("disabled",true);
							$('#spanUN').text("");
							$('#pwChg').fadeOut();
							$('#txtAddress').val(data.txtAddress);
							$('#txtZipcode').val(data.txtZipcode);
							$('#txtMobilePhone').val(data.txtMobilePhone);
							$('#txtTel').val(data.txtTel);
							$('#province').val(data.province_ss);
							fn_callamphur(data.province_ss,data.amphur_ss);
							fn_calldistrict(data.amphur_ss,data.district_ss);
							if(u_type == '1')
							{
								$('#allGarage').attr("style","visibility:visible")
								$('#fixGarage').fadeOut();
							}
							if(u_type != '1')
							{
								$('#fixGarage').attr("style","visibility:visible")
								$('#allGarage').fadeOut();
							}
							console.log("grageId = "+data.garageId);
							$('#selGarage2').val(data.garageId);	
						}
					}
					else if(data.exist==false)
					{
						$('#'+tagid+'').attr("disabled",true);
						$('#citizenId').val($('#'+tagid+'').val());	
						$('#statusAdd').val("new");
						$('#formInfo').attr("style","visibility:visible");				
						$('#chkID').text("");
						if(u_type == '1')
						{
							$('#allGarage').attr("style","visibility:visible")
							$('#fixGarage').fadeOut();
						}
						if(u_type != '1')
						{
							$('#fixGarage').attr("style","visibility:visible")
							$('#allGarage').fadeOut();
						}						
					}
				}		
			});		
		}
	}
}

//function ใส่ จังหวัด อำเภอ ตำบล	
$(document).ready( function () {
	var u_type = '<?=$u_type?>';
	var province_ss = '<?=$province_ss?>';	
	var amphur_ss = '<?=$amphur_ss?>';
	var district_ss = '<?=$district_ss?>';
	
	if(u_type == '1')
	{
		$('#allGarage').attr("style","visibility:visible")
		$('#fixGarage').fadeOut();
	}
	if(u_type != '1')
	{
		$('#fixGarage').attr("style","visibility:visible")
		$('#allGarage').fadeOut();
	}
	
	if ($('#province').val() != ''){
		fn_callamphur(province_ss, amphur_ss);
		fn_calldistrict(amphur_ss, district_ss);
	}
	
	$('#province').change(function () {
		fn_callamphur($('#province').val(), 0);
		fn_calldistrict(0, 0);
	});

});

function alertPopup(msgid,alertid,message){
	$('#'+msgid+'').text(''+message+'');
	$('#'+alertid+'').fadeIn(500, function() {
		clearTimeout(delayAlert);  
		delayAlert=setTimeout(function(){  
//				alertFadeOut(''+alertid+'');
			$('#'+alertid+'').fadeOut(500);
			delayAlert=null;  
		},2000);  
	});
}

function fn_callamphur(province, amphur){
	//alert(id);
	$.post('modules/mod_user/major/get.amphur.php', {provinceId:province, amphurId:amphur} , function(data) {
  		$('#genamphur').html(data);	
	});	
}

function fn_calldistrict(amphur, district){
	//alert(id);
	$.post('modules/mod_user/major/get.district.php', {amphurId:amphur, districtId:district} , function(data) {
  		$('#gendistrict').html(data);	
	});	
}

function chgPW(type) {
	var customerId = '<?=$driverId?>';
	var modalId = 'changePW';
	var type = 1;
	var newPW = $('#newPW2nd').val();
		
	jQuery.ajax({
	url :'modules/mod_driver/managedriver/JSON/driver.edit.chgPW.php',
	type: 'GET',
	data: '&newPW='+newPW+'&driverId='+driverId+'',
	dataType: 'jsonp',
	dataCharset: 'jsonp',
		success: function (data){
				alertPopup('msg3','alert3',''+data.message+'');
				$('#'+modalId+'').modal('toggle');	
				oldpwtemp = data.savpw;
		}
	});	
	
	switch (type) {
		case 1:
			$('#newPW1st').val("");
			$('#newPW2nd').val("");
			$('#btnPWConfirm').attr("disabled",true);
			break;
	}
}


function trim(s)
{
   var l=0; var r=s.length -1;
   while(l < s.length && s[l] == ' ')
   {   l++; }
   while(r > l && s[r] == ' ')
   {   r-=1;   }
   return s.substring(l, r+1);
}

function chkEmail(email) {	
	if(email!='-')
	{
		if ( !(/^.+@.+\..{2,3}$/.test(email))) {
			$('#chkEmail').text("กรุณากรอก E-mail ให้ถูกต้อง ถ้าไม่มีให้ใส่เครื่องหมาย -");	
			$('#txtEmail').val("")	;
		}	
		else
			$('#chkEmail').text("");		
	}
	else
			$('#chkEmail').text("");
}

function trimString(id,str) {
	$('#'+id).val(jQuery.trim(str));
}

function chkThai(id,str) {
	$('#'+id).val(jQuery.trim(str));

	var newstr = jQuery.trim(str);
	if (/[^ก-๙ ]/.test(newstr))
	{	$('#'+id+"chk").text("กรุณากรอกแต่ภาษาไทยเท่านั้น");
		$('#'+id).val("");		}
	else
		$('#'+id+"chk").text("");			
}

function chkEngNum(id,str,long) {
	console.log(id,str,long);
	$('#'+id).val(jQuery.trim(str));

	var newstr = jQuery.trim(str);	
	if ( /[^A-Za-z0-9 ]/.test(newstr))
	{	$('#'+id+"chk").text("กรุณากรอกแต่ภาษาอังกฤษหรือตัวเลขเท่านั้น");
		$('#'+id).val("");
		return false;		}
	else if(long != 0 && newstr.length<long)
	{	$('#'+id+"chk").text("กรุณากรอกมากกว่า "+long+" ตัวอักษร");	
		$('#'+id).val("");		
		return false; }	
	else
		$('#'+id+"chk").text("");
}

function chkValid(id,str,long) {
	console.log(id,str,long);
	$('#'+id).val(jQuery.trim(str));

	var newstr = jQuery.trim(str);	
	if ( /[^A-Za-z0-9]/.test(newstr))
	{	$('#'+id+"chk").text("กรุณากรอกแต่ภาษาอังกฤษหรือตัวเลขเท่านั้น");
		$('#'+id).val("");
		return false;		}
	else if(long != 0 && newstr.length<long)
	{	$('#'+id+"chk").text("กรุณากรอกมากกว่า "+long+" ตัวอักษร");	
		$('#'+id).val("");		
		return false; }	
	else
		$('#'+id+"chk").text("");
}

function chk1stPW(id,str,long) {
	$('#'+id).val(jQuery.trim(str));
	$('#u_password2').val("");
	$('#btnPWConfirm').attr("disabled",true);		

	var newstr = jQuery.trim(str);	
	if ( /[^A-Za-z0-9]/.test(newstr))
	{	$('#'+id+"chk").text("กรุณากรอกแต่ภาษาอังกฤษหรือตัวเลขเท่านั้น");
		$('#'+id).val("");		}
	else if(long != 0 && newstr.length<long)
	{	$('#'+id+"chk").text("กรุณากรอกมากกว่า "+long+" ตัวอักษร");	
		$('#'+id).val("");		}	
	else
		$('#'+id+"chk").text("");				
}

function chk2ndPW(pw2) {
	if(pw2!=$('#u_password').val())
	{
		$('#btnPWConfirm').attr("disabled",true);		
	}
	else
	{
		$('#btnPWConfirm').attr("disabled",false);
	}
}

function numberOrNot(id,number){
	
	number = jQuery.trim(number)
	if ( /[^0-9-]/.test(number))
	{	$('#'+id+"chk").text("กรุณาใส่เฉพาะตัวเลข");
		$('#'+id).val("");		
	}
	else
		$('#'+id+"chk").text("");
}

</script> 
<script src="js/jquery.min.js"></script> 

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

<!-- hidden elements width/height --> 
<script src="js/jquery.actual.min.js"></script> 
<!-- js cookie plugin --> 
<script src="js/jquery.cookie.min.js"></script> 
<!-- tooltips --> 
<script src="lib/qtip2/jquery.qtip.min.js"></script> 
<!-- sticky messages --> 
<script src="lib/sticky/sticky.min.js"></script> 
<!-- fix for ios orientation change --> 
<script src="js/ios-orientationchange-fix.js"></script> 
<!-- scrollbar --> 
<script src="lib/antiscroll/antiscroll.js"></script> 
<script src="lib/antiscroll/jquery-mousewheel.js"></script> 
<!-- lightbox --> 
<script src="lib/colorbox/jquery.colorbox.min.js"></script> 

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