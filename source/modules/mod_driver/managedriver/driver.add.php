<?
	//echo pre($_SESSION);
?>

<div class="row-fluid">
  <div class="span12">
    <h3 class="heading">เพิ่มข้อมูล</h3>
    <div class="row-fluid">
      <div class="span8">
        <form class="form-horizontal">
          <div class="control-group formSep">
            <label for="u_fname" class="control-label">หมายเลขประชาชน :</label>
            <div class="controls text_line">
              <input type="text" class="input-xlarge" name="chkCitizen" id="chkCitizen" onkeyup="checkID(this.id,this.value)" maxlength="13" />
              <font color="#FF0000"><i>
              <div id="chkID"></div>
              </i></font> </div>
          </div>
        </form>
        <form id="formInfo" class="form-horizontal form_validation_ttip" action="" method="post" enctype="multipart/form-data">
          <fieldset>
            <div class="control-group formSep">
              <label for="fileinput" class="control-label">รูปประจำตัวผู้ขับ</label>
              <div class="controls">
                <div data-provides="fileupload" class="fileupload fileupload-new">
                  <input type="hidden" />
                  <div style="width: 80px; height: 80px;" class="fileupload-new thumbnail"><img src="http://www.placehold.it/80x80/EFEFEF/AAAAAA" alt="" /></div>
                  <div style="width: 80px; height: 80px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                  <span class="btn btn-file"><span class="fileupload-new">เลือกไฟล์รูป</span><span class="fileupload-exists">Change</span>
                  <input type="file" id="fileinput" name="fileinput" />
                  </span> <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a> </div>
              </div>
            </div>
            
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อจริง :</label>
              <div class="controls text_line">
                <input type="text" name="fName" id="fName" class="input-xlarge" value="" onchange="chkThai(this.id,this.value)" />
                <font color="#FF0000"><i>
                <div id="fNamechk"></div>
                </i></font> </div>
              <br />
              <label for="u_fname" class="control-label">นามสกุล :</label>
              <div class="controls">
                <input type="text" name="lName" id="lName" class="input-xlarge" value="" onchange="chkThai(this.id,this.value)" />
                <font color="#FF0000"><i>
                <div id="lNamechk"></div>
                </i></font> </div>
              <br />
              <label for="u_fname" class="control-label">วัน เดือน ปี เกิด :</label>
              <div class="controls date" id="dp2" data-date-format="dd/mm/yyyy"> <span class="add-on">
                <input class="input-xlarge" type="text" id="dateShow" name="dateShow" readonly="readonly" value="" />
                </span> </div>
              <br />
              <label for="u_fname" class="control-label">เลขใบขับขี่ :</label>
              <div class="controls">
                <input type="text" name="dLicense" id="dLicense" class="input-xlarge" value="" onchange="numberOrNot(this.id,this.value)" />
              </div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">Username</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="userName" id="userName" value="" maxlength="20" onchange="chkUN(this.id)" />
                <font color="#006600">
                <div id="userNameOK"></div>
                </font> <font color="#FF0000"><i>
                <div id="userNamechk"></div>
                </i></font> <span class="help-block">ตัวอักษรภาษาอังกฤษเท่านั้น ความยาวไม่เกิน 20 ตัวอักษร</span> </div>
              <br />
              <label for="u_password" class="control-label">Password</label>
              <div class="controls">
                <div class="sepH_b">
                  <input type="password" class="input-xlarge" name="u_password" id="u_password" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" onchange="chk1stPW(this.id,this.value,8)" />
                  <font color="#FF0000"><i>
                  <div id="u_passwordchk"></div>
                  </i></font> <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span> </div>
                <input type="password" class="input-xlarge" name="u_password2" id="u_password2" placeholder="พิมพ์พาสเวิร์ดเดิมอีกครั้ง" maxlength="20" onchange="chk2ndPW(this.value)" />
                <font color="#FF0000"><i>
                <div id="u_password2chk"></div>
                </i></font> </div>
            </div>
            <div class="control-group formSep">
              <label class="control-label">ที่อยู่</label>
              <div class="controls">
                <textarea class="input-xlarge" name="txtAddress_add" id="txtAddress" placeholder="(บ้านเลขที่ ซอย ถนน)"></textarea>
              </div>
              <br />
              <label class="control-label">จังหวัด</label>
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
              <label class="control-label">อำเภอ</label>
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
              <label class="control-label">ตำบล</label>
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
              <label class="control-label">รหัสไปรษณีย์</label>
              <div class="controls">
                <input type="text" name="txtZipcode_add" id="txtZipcode" class="input-xlarge" value="" onchange="numberOrNot(this.id,this.value,'รหัสไปรษณีย์ไม่ถูกต้อง')" />
                <font color="#FF0000"><i>
                <div id="txtZipcodechk" ></div>
                </i></font> </div>
            </div>
            <div class="control-group formSep">
              <label for="u_email" class="control-label">เบอร์โทรศัพท์มือถือ</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="txtMobilePhone" id="txtMobilePhone" value="" maxlength="10" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i>
                <div id="txtMobilePhonechk" ></div>
                </i></font> </div>
              <br />
              <label for="u_email" class="control-label">เบอร์โทรศัพท์บ้าน</label>
              <div class="controls">
                <input type="text" name="txtTel" id="txtTel" class="input-xlarge" value="" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i>
                <div id="txtTelchk" ></div>
                </i></font> </div>
            </div>
            <div id="selGarage" class="control-group formSep">
              <label class="control-label">เลือกอู่สำหรับผู้ขับนี้</label>
              <div class="controls">
                  <select class="input-xlarge" name="selGarage" id="selGarage">
                    <option value="" >กรุณาเลือกอู่รถ</option>
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
            
            <!--            <div class="control-group formSep">
              <label class="control-label">เลือกประเภทของ Username : </label>
              <div class="controls">
                <label class="checkbox inline">
                  <input type="checkbox" value="newsletter" id="email_newsletter" name="email_receive" />
                  Supervisor Admin </label>
                <label class="checkbox inline">
                  <input type="checkbox" value="sys_messages" id="email_sysmessages" name="email_receive" checked="checked" />
                  Company Admin</label>
              </div>
            </div>-->
            
            <div class="control-group">
            <div class="controls">
              <button class="btn btn-gebo" type="submit">บันทึกการเพิ่มข้อมูล</button>
              <input type="button" class="btn" value="ยกเลิก" onclick="reloadPage()" />
            </div>
          </fieldset>
          <input type="hidden" name="p" value="<?=$p?>" />
          <input type="hidden" name="menu" value="<?=$menu?>" />
          <input type="hidden" name="citizenId" id="citizenId" />
          <input type="hidden" name="act" value="saveadd" />
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function reloadPage(){
	window.location = 'index.php?p=user.major&menu=main_user'; 
	//$('#fmReload').submit();
}

function checkID(tagid,id) {
//ตรวจว่าป้อนถูกตามรูปแบบที่กำหนดมั้ย x-xxxx-xxxxx-xx-x
	var temp;
 	if(id.length != 13) 
 		$('#chkID').text("รหัสบัตรประชาชนไม่ถูกต้อง");
	for(i=0, sum=0; i < 12; i++)
		sum += parseFloat(id.charAt(i))*(13-i); 
	if((11-sum%11)%10!=parseFloat(id.charAt(12)))
		$('#chkID').text("รหัสบัตรประชาชนไม่ถูกต้อง");
	else
	{	
		$('#'+tagid+'').attr("readonly","readonly");
		$('#chkID').text("รหัสบัตรประชาชนถูกต้อง");
		$('#formInfo').fadeIn();
		$('#citizenId').val($('#'+tagid+'').val());
		
	}
}
	
//function ใส่ จังหวัด อำเภอ ตำบล	
$(document).ready( function () {
	
	var province_ss = '<?=$province_ss?>';	
	var amphur_ss = '<?=$amphur_ss?>';
	var district_ss = '<?=$district_ss?>';
	
	//alert(car_ss_gensub);
	$('#formInfo').fadeOut();
	
	if(<?=$u_type?> != 1)
		$('#selGarage').attr("style","visibility:hidden");

	if ($('#province').val() != ''){
		fn_callamphur(province_ss, amphur_ss);
		fn_calldistrict(amphur_ss, district_ss);
	}
	
	$('#province').change(function () {
		fn_callamphur($('#province').val(), 0);
		fn_calldistrict(0, 0);
	});

});



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

function trim(s)
{
   var l=0; var r=s.length -1;
   while(l < s.length && s[l] == ' ')
   {   l++; }
   while(r > l && s[r] == ' ')
   {   r-=1;   }
   return s.substring(l, r+1);
}

function chkUN(id) {
	var username = $('#'+id+'').val();
	
	$('#'+id+'OK').text("");

	if(id=="userName")
		var chkUsername = chkValid("userName",$('#'+id+'').val(),8);


	if(chkUsername != false)
	{	console.log("Go Checking");
		jQuery.ajax({
			url :'modules/mod_driver/managedriver/JSON/driver.add.chkUN.php',
			type : 'GET',
			data : 'username='+username+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.status);
				console.log(data.exist);
				if(data.exist==true)
				{
						$('#'+id+'chk').text(username+" ถูกใช้งานไปแล้ว กรุณาใช้ชื่ออื่น");
						$('#'+id).val("");
						$('#'+id+'OK').text("");						
				}
				else if(data.exist==false)
				{
						$('#'+id+'OK').text("Username นี้สามารถใช้งานได้");
						$('#'+id+'chk').text("");						
				}
			}		
		});
	}
}
function datePickIt(id) {
	$('#'+id+'').datepicker();
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
		$('#u_password2chk').text("พาสเวิร์ดไม่ตรงกัน กรุณากรอกใหม่");
		$('#u_password2').val("");
	}
	else
		$('#u_password2chk').text("");
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
<!-- main bootstrap js --> 
<script src="bootstrap/js/bootstrap.min.js"></script> 
<!-- tooltips --> 
<script src="lib/qtip2/jquery.qtip.min.js"></script> 
<!-- jBreadcrumbs --> 
<script src="lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script> 
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