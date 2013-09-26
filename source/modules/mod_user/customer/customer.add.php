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
              <input type="text" class="input-xlarge" name="chkCitizen" id="chkCitizen" value="" onkeyup="checkID(this.id,this.value)" maxlength="13" />
              <font id="chkIdFont"><i>
              <div id="chkCitizenchk" ></div>
              </i></font> </div>
          </div>
        </form>
        <form id="formInfo" class="form-horizontal form_validation_ttip" action="" style="visibility:hidden" method="post">
          <fieldset>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อจริง :</label>
              <div class="controls text_line">
                <input type="text" name="fName" id="fName" class="input-xlarge" value="" onchange="trimString(this.id,this.value)" />
                <font color="#FF0000"><i>
                <div id="fNamechk"></div>
                </i></font> </div>
              <br />
              <label for="u_fname" class="control-label">นามสกุล :</label>
              <div class="controls">
                <input type="text" name="lName" id="lName" class="input-xlarge" value="" onchange="trimString(this.id,this.value)" />
                <font color="#FF0000"><i>
                <div id="lNamechk"></div>
                </i></font> </div>
              <br />
              <label for="u_fname" class="control-label">เพศ :</label>
              <div class="controls">
                <label class="uni-radio">
                  <input type="radio" class="uni_style" style="opacity: 0;" name="radSex" value="female" id="radSex_0" />
                  หญิง</label>
                <label class="uni-radio">
                  <input type="radio" class="uni_style" style="opacity: 0;" name="radSex" value="male" id="radSex_1" />
                  ชาย</label>
                <label class="uni-radio">
                  <input type="radio" class="uni_style" style="opacity: 0;" checked="checked" name="radSex" value="" id="radSex_2" />
                  ยังไม่ระบุ</label>
                  </div>

              <br />
              <label for="u_fname" class="control-label">วัน เดือน ปี เกิด :</label>
              <div class="controls date" id="dp2" data-date-format="dd/mm/yyyy"> <span class="add-on">
                <input class="input-xlarge" type="text" id="birthDay" name="birthDay" readonly="readonly" value="" />
                </span><span class="help-block">คลิกเพื่อเลือกวันที่จากปฏิทิน</span></div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">E-mail :</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="txtEmail" id="txtEmail" value="" onkeyup="reType(this.id)" onchange="chkEmail(this.value)" />
                <font color="#006600"><i>
                <div id="okEmail"></div>
                </i></font> <font color="#FF0000"><i>
                <div id="txtEmailchk"></div>
                </i></font> <span id="spanUN" class="help-block">E-mail จะใช้แทน Username ในการล็อคอินเข้าสู่ระบบสำหรับลูกค้า</span> </div>
              <div id="pwChg"> <br />
                <label for="u_password" class="control-label">Password :</label>
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
            </div>
            <div class="control-group formSep">
              <label class="control-label">ที่อยู่ :</label>
              <div class="controls">
                <textarea class="input-xlarge" name="txtAddress_add" id="txtAddress" placeholder="(บ้านเลขที่ ซอย ถนน)"></textarea>
              </div>
              <br />
              <label for="u_email" class="control-label">เบอร์โทรศัพท์ :</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="txtMobilePhone" id="txtMobilePhone" value="" maxlength="10" onchange="mobOrNot(this.id,this.value)" />
                <font color="#FF0000"><i>
                <div id="txtMobilePhonechk" ></div>
                </i></font> <span class="help-block">ตัวอย่างการกรอกเบอร์โทรศัพท์ : 0812345678</span></div>
              <br />
            </div>
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
          <input type="hidden" name="current_page" id="current_page" value="<?=$current_page?>" />
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
	$('#chkCitizenchk').text("");	
 	if(id.length == 13) 
	{
		for(i=0, sum=0; i < 12; i++)
			sum += parseFloat(id.charAt(i))*(13-i); 
		if((11-sum%11)%10!=parseFloat(id.charAt(12)))
		{
			$('#chkCitizenchk').attr("style","color:#FF0000");
			$('#chkCitizenchk').text("รหัสบัตรประชาชนไม่ถูกต้อง");	
			$('#'+tagid+'').val("");	
		}
		else
		{	
			var u_type = '<?=$u_type?>';
			jQuery.ajax({
				url :'modules/mod_user/customer/JSON/customer.add.chkCitizenId.php',
				type : 'GET',
				data : 'citizenId='+id+'',
				dataType: 'jsonp',
				dataCharset: 'jsonp',
				success: function (data){
					console.log(data.status);
					console.log(data.exist);
					if(data.exist==true)
					{
						$('#chkCitizenchk').attr("style","color:#333333");
						$('#chkCitizenchk').html(data.response);
						$('#'+tagid+'').val("");
					}
					else if(data.exist==false)
					{
						$('#'+tagid+'').attr("disabled",true);
						$('#citizenId').val($('#'+tagid+'').val());	
						$('#statusAdd').val("new");
						$('#formInfo').attr("style","visibility:visible");				
						$('#chkCitizenchk').text("");
					}
				}		
			});		
		}
	}
}

//function ใส่ จังหวัด อำเภอ ตำบล	
$(document).ready( function () {
	


});


function trim(s)
{
   var l=0; var r=s.length -1;
   while(l < s.length && s[l] == ' ')
   {   l++; }
   while(r > l && s[r] == ' ')
   {   r-=1;   }
   return s.substring(l, r+1);
}

function datePickIt(id) {
	$('#'+id+'').datepicker();
}

function reType(id) {
	if($('#'+id+'').length == 1 )
	{ 	$('#'+id+'chk').text(""); }
}

function chkEmail(email) {	
	if ( !(/^.+@.+\..{2,3}$/.test(email))) {
		$('#txtEmailchk').text("กรุณากรอก E-mail ให้ถูกต้อง");	
		$('#txtEmail').val("");
		$('#okEmail').text("");
	}	
	else
	{
		$('#txtEmailchk').text("");
		newemail = $('#txtEmail').val();
		jQuery.ajax({
			url :'modules/mod_user/customer/JSON/customer.add.chkEmail.php',
			type : 'GET',
			data : 'email='+newemail+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.status);
				console.log(data.exist);
				if(data.exist==true)
				{
					$('#txtEmailchk').text(data.response);
					$('#txtEmail').val("");
					$('#okEmail').text("");
				}
				else if(data.exist==false)
				{					
					$('#txtEmailchk').val("");
					$('#okEmail').text(data.response);
				}
			}		
		});				
	}
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

function mobOrNot(id,number){
	
	number = jQuery.trim(number)
	if ( /^(0)[0-9-]/.test(number) && number.length == 10)
	{	$('#'+id+"chk").text("");	}
	else
	{
		$('#'+id+"chk").text("รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง");
		$('#'+id).val("");
	}
}

function telOrNot(id,number){
	
	number = jQuery.trim(number)
	if ( /^(0)[0-9-]/.test(number))
	{	$('#'+id+"chk").text("");	}
	else
	{
		$('#'+id+"chk").text("รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง ถ้าไม่มีให้เว้นไว้");
		$('#'+id).val("");
	}
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