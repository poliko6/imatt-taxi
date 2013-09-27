<?
$cus_data = select_db('customer',"where customerId = '".$customerId."'");
$cusId = $cus_data[0]['customerId'];
$email = $cus_data[0]['email'];
$oldPW = $cus_data[0]['password'];
$firstName = $cus_data[0]['firstName'];
$lastName = $cus_data[0]['lastName'];
$gender = $cus_data[0]['gender'];
$citizenId = $cus_data[0]['citizenId'];
$telephone = $cus_data[0]['telephone'];
$birthday = $cus_data[0]['birthday'];
$address = $cus_data[0]['location'];

?>
<div class="row-fluid">
  <div class="span12">
    <h3 class="heading">แก้ไขข้อมูล</h3>
    <div class="row-fluid">
        <form id="profileEdit" class="form-horizontal form_validation_ttip" action="" method="post">
         
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อจริง* :</label>
              <div class="controls text_line">
                <input type="text" id="firstName" name="firstName" class="input-xlarge" value="<?=$firstName?>" onchange="trimString(this.id,this.value)" />
                <font color="#FF0000"><i><div id="firstNamechk"></div></i></font> 
              </div>
              <br />
              <label for="u_fname" class="control-label">นามสกุล* :</label>
              <div class="controls">
                <input type="text" name="lastName" id="lastName" class="input-xlarge" value="<?=$lastName?>" onchange="trimString(this.id,this.value)" />
                <font color="#FF0000"><i><div id="lastNamechk"></div></i></font>                
              </div>
              <label for="u_fname" class="control-label">เพศ :</label>
              <div class="controls">
                <label class="uni-radio">
                  <input type="radio" class="uni_style" name="radSex" value="female" id="radSex_0"
                  <? if($gender == "female") echo "checked=\"checked\""; ?> />
                  หญิง</label>
                <label class="uni-radio">
                  <input type="radio" class="uni_style" name="radSex" value="male" id="radSex_1"
                  <? if($gender == "male") echo "checked=\"checked\""; ?> />
                  ชาย</label>
                <label class="uni-radio">
                  <input type="radio" class="uni_style" name="radSex" value="" id="radSex_2"
                  <? if($gender != 'female' && $gender != 'male') echo "checked=\"checked\""; ?> />
                  ยังไม่ระบุ</label>
                  </div>
              
              <br />
              <label for="u_fname" class="control-label">รหัสประชาชน* :</label>
              <div class="controls">
                <input type="text" name="citizenId" id="citizenId" class="input-xlarge" value="<?=$citizenId?>" maxlength="13" onchange="checkID(this.id,this.value)" onkeyup="numberOrNot(this.id,this.value)" />
                <font color="#FF0000"><i><div id="citizenIdchk" ></div></i></font>
              </div>
              <br />
              <label for="u_fname" class="control-label">วัน เดือน ปี เกิด* :</label>
              <div class="controls text_line date" id="dp2" data-date-format="dd/mm/yyyy"> <span class="add-on">
                <input class="input-xlarge" type="text" id="birthday" name="birthday" readonly="readonly" value="<?=$birthday?>" />
                </span>
              <span class="help-block">คลิกเพื่อเลือกวันที่จากปฏิทิน</span>                                        
              </div>              
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">E-mail :</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="emailCus" id="emailCus" value="<?=$email?>" disabled="disabled" /></div><br />
              <label for="u_password" class="control-label">Password :</label>
              <div class="controls">
                <div class="sepH_b">
                <a href="#changePW" data-toggle="modal" title="เปลี่ยนรหัสผ่าน" onclick="resetModal()">เปลี่ยนรหัสผ่าน</a>
				</div>                 
              </div>
            </div>
            <div class="control-group formSep">
              <label class="control-label">ที่อยู่* :</label>
              <div class="controls">
                <textarea class="input-xlarge" required="required" name="location" id="location" placeholder="(บ้านเลขที่ ซอย ถนน)"><?=$address?></textarea>
              </div> 
            </div>
            
            <div class="control-group formSep">
              <label for="u_email" class="control-label">เบอร์โทรศัพท์มือถือ* :</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="telephone" id="telephone" value="<?=$telephone?>" maxlength="10" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i><div id="txtMobilePhonechk" ></div></i></font>
              </div>
            </div>
            
            <div class="control-group">
              <div class="controls">
                <button class="btn btn-gebo" type="submit">บันทึกการเพิ่มข้อมูล</button>
				<input type="button" class="btn" value="ยกเลิก" onclick="reloadPage()" />
                </div>
            </div>

          			<!-- sent value to select and update -->
          			<input type="hidden" name="customerId" value="<?=$cusId?>" />          		
                    <input type="hidden" name="p" value="<?=$p?>" />
                    <input type="hidden" name="menu" value="<?=$menu?>" />
                    <input type="hidden" name="act" value="saveedit" />
                    <input type="hidden" name="current_page" id="current_page" value="<?=$current_page?>" />
        </form>
      </div>
    </div>
  </div>
</div>

<? //////////////////////////////////////////////////////////////////////////////////////////////////////////////?>
    <!-- POP UP -->
    <!-- Change Username Password -->    
    <div class="modal hide fade" id="changePW" style="text-align:center; width:500px;">
        <div class="alert alert-block alert-error fade in">
            <h4 class="alert-heading">แก้ไขรหัสผ่าน Username "<?=$email?>"</h4><br />
            <label for="u_fname" class="control-label"><font color="#666666">กรุณากรอกรหัสผ่านเดิม</font></label>
            <div class="controls">
            <input type="password" name="oldPW" id="oldPW" class="input-xlarge" value="" onkeyup="chkOldPW(this.id,this.value)" />
            <font color="#FF0000"><i><div id="oldPWchk"></div></i></font>
            <font color="#009900"><i><div id="oldPWok"></div></i></font>
            </div><br />   
            <label for="u_fname" class="control-label"><font color="#666666">กรุณากรอกรหัสผ่านใหม่</font></label>
            <div class="controls">
            <input type="password" name="newPW1st" id="newPW1st" class="input-xlarge" disabled="disabled" value="" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" onchange="chk1stPW(this.id,this.value,8)" />
            <font color="#FF0000"><i><div id="newPW1stchk"></div></i></font>
            <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span>
            <input type="password" name="newPW2nd" id="newPW2nd" class="input-xlarge" value="" disabled="disabled" placeholder="พิมพ์รหัสผ่านเดิมอีกครั้ง" maxlength="20" onkeyup="chk2ndPW(this.value)" />
            <font color="#FF0000"><i><div id="newPW2ndchk"></div></i></font><br />   
			<a href="#" onclick=""><button id="btnPWConfirm" name="btnPWConfirm" disabled="disabled" class="btn btn-success" onclick="chgPW()">เปลี่ยนรหัสผ่าน</button></a>
            หรือ <a href="#" class="btn" data-dismiss="modal" onclick="resetModal()"><i class="splashy-error_x"></i> ยกเลิก</a>                                           
            </div>                             
        </div>
    </div>
<? //////////////////////////////////////////////////////////////////////////////////////////////////////////////?>        
        
    
<script type="text/javascript">	
var delayAlert=null; 
var oldpwtemp=null;

function alertPopup(msgid,alertid,message){
	$('#'+msgid+'').text(''+message+'');
	$('#'+alertid+'').fadeIn(500, function() {
		clearTimeout(delayAlert);  
		delayAlert=setTimeout(function(){  
//				alertFadeOut(''+alertid+'');
			$('#'+alertid+'').fadeOut(500);
			reloadPage();
			delayAlert=null;  
		},2000);  
	});
}

function reloadPage(){
	window.location = 'index.php?p=user.customer&menu=main_user'; 
	//$('#fmReload').submit();
}

function reloadPage2(){
	window.location = 'index.php?p=user.customer&menu=main_user&sav=yes'; 
	//$('#fmReload').submit();
}

function resetModal() {
	$('#oldPW').val("");
	$('#oldPWok').text("");
	$('#oldPW').attr("disabled",false);
	$('#newPW1st').val("");
	$('#newPW1st').attr("disabled",true);
	$('#newPW2nd').val("");
	$('#newPW2nd').attr("disabled",true);
	$('#btnPWConfirm').attr("disabled",true);	
}

//function ใส่ จังหวัด อำเภอ ตำบล	
$(document).ready( function () {
	
	$(document).on("keydown.NewActionOnF5", function(e){
        var charCode = e.which || e.keyCode;
        switch(charCode){
            case 116: // F5
                e.preventDefault();
                window.location = "index.php?p=user.customer&menu=main_user";
                break;
        }
    });	

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

function chgPW(type) {
	var customerId = '<?=$cusId?>';
	var modalId = 'changePW';
	var type = 1;
	var newPW = $('#newPW2nd').val();
		
	jQuery.ajax({
	url :'modules/mod_user/customer/JSON/customer.edit.chgPW.php',
	type: 'GET',
	data: '&newPW='+newPW+'&customerId='+customerId+'',
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
			$('#oldPW').val("");
			$('#oldPWok').text("");
			$('#oldPW').attr("disabled",false);
			$('#newPW1st').val("");
			$('#newPW1st').attr("disabled",true);
			$('#newPW2nd').val("");
			$('#newPW2nd').attr("disabled",true);
			$('#btnPWConfirm').attr("disabled",true);
			break;
	}
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

function checkID(tagid,id) {
//ตรวจว่าป้อนถูกตามรูปแบบที่กำหนดมั้ย x-xxxx-xxxxx-xx-x
	var temp;
	$('#'+tagid+'chk').text("");	
 	if(id.length == 13) 
	{
		for(i=0, sum=0; i < 12; i++)
			sum += parseFloat(id.charAt(i))*(13-i); 
		if((11-sum%11)%10!=parseFloat(id.charAt(12)))
		{
			$('#'+tagid+'chk').attr("style","color:#FF0000");
			$('#'+tagid+'chk').text("รหัสบัตรประชาชนไม่ถูกต้อง");	
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
						$('#'+tagid+'chk').attr("style","color:#333333");
						$('#'+tagid+'chk').html(data.response);
						$('#'+tagid+'').val("");
					}
					else if(data.exist==false)
					{
						$('#'+tagid+'').val($('#'+tagid+'').val());	
						$('#'+tagid+'chk').text("");
					}
				}		
			});		
		}
	}
	else
	{
		$('#'+tagid+'chk').attr("style","color:#FF0000");	
		$('#'+tagid+'chk').text("กรุณากรอกรหัสประชาชนให้ถูกต้อง");
		$('#'+tagid+'').val("");	
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

function chkOldPW(id,value) {
	if(oldpwtemp==null)
		var pwtemp = '<?=$oldPW?>'; // pw from database
	else 
		var pwtemp = oldpwtemp;
	console.log("pwtemp here "+pwtemp);
	var pwtochk;
	jQuery.ajax({
		url :'modules/mod_user/customer/JSON/customer.edit.chkOldPW.php',
		type: 'GET',
		data: 'oldPW='+value+'',
		dataType: 'jsonp',
		dataCharset: 'jsonp',
		success: function (data){
			pwtochk = data.shaPW;
			if(pwtochk == pwtemp)
			{
				$('#'+id+'ok').text("รหัสผ่านถูกต้อง");
				$('#newPW1st').attr("disabled",false);
				$('#newPW2nd').attr("disabled",false);
				$('#'+id).attr("disabled",true);
			}
		}
	});		
}

function chk1stPW(id,str,long) {
	$('#'+id).val(jQuery.trim(str));
	$('#newPW2nd').val("");

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
	if(pw2!=$('#newPW1st').val())
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
	{	$('#'+id+"chk").text("กรุณากรอกเฉพาะตัวเลข");
		$('#'+id).val("");		
	}
	else
		$('#'+id+"chk").text("");
}


</script> 

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