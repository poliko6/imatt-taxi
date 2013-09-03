<?
$major_data = select_db('majoradmin',"where garageId = '".$u_garage."'");
$major_name = $major_data[0]['thaiCompanyName'];
?>

<div class="row-fluid">
  <div class="span12">
    <h3 class="heading" style="font-size:12px; text-align:center;">เพิ่มพนักงานในระบบ ของอู่ "<span style="color:#06C;"><?=$major_name?></span>"</h3>
    <div class="row-fluid">
      <div class="span8">
        <form class="form-horizontal form_validation_ttip" action="" method="post" name="fm_add" id="fm_add">
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
              </div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อจริง <span class="f_req">*</span> :</label>
              <div class="controls text_line">
                <input type="text" id="firstName" name="firstName" class="input-xlarge" value=""  /> 
              </div>
              <br />
              <label for="u_fname" class="control-label">นามสกุล <span class="f_req">*</span> :</label>
              <div class="controls">
                <input type="text" name="lastName" id="lastName" class="input-xlarge" value="" />              
              </div>
              <br />             
            </div>
            
            
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">Username <span class="f_req">*</span> :</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="userName" id="userName" value="" maxlength="20" onchange="chkUNandGPW(this.id)" />
                <div class="help-block" id="errUsername" style="display:none; color:#C00;">Username ซ้ำในระบบ</div>
                <font color="#006600"><div id="usernameOK"></div></font>
                <font color="#FF0000"><i><div id="userNamechk"></div>
                </i></font> <span class="help-block">ตัวอักษรภาษาอังกฤษเท่านั้น ความยาวไม่เกิน 20 ตัวอักษร</span> </div>
              <br />
              <label for="u_password" class="control-label">Password <span class="f_req">*</span> :</label>
              <div class="controls">
                <div class="sepH_b">
                  <input type="password" class="input-xlarge" name="u_password" id="u_password" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" onchange="chk1stPW(this.id,this.value,8)" />
                <font color="#FF0000"><i><div id="u_passwordchk"></div></i></font>                  
                  <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span> </div>
                <input type="password" class="input-xlarge" name="u_password2" id="u_password2" placeholder="พิมพ์พาสเวิร์ดเดิมอีกครั้ง" maxlength="20" onchange="chk2ndPW(this.value)" />
                <font color="#FF0000"><i><div id="u_password2chk"></div></i></font>                  
              </div>              
            </div>
            
            <div class="control-group formSep">
              <label class="control-label">ที่อยู่ <span class="f_req">*</span> :</label>
              <div class="controls">
                <textarea class="input-xlarge" name="txtAddress_add" id="txtAddress" placeholder="(บ้านเลขที่ ซอย ถนน)"></textarea>
              </div>
              <br />
              <label class="control-label">จังหวัด <span class="f_req">*</span> :</label>
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
                         
              <label class="control-label">อำเภอ <span class="f_req">*</span> :</label>
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
              
              <label class="control-label">ตำบล <span class="f_req">*</span> :</label>
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
                          
              <label class="control-label">รหัสไปรษณีย์ <span class="f_req">*</span> :</label>
              <div class="controls">
                <input type="text" name="txtZipcode_add" id="txtZipcode" class="input-xlarge" value="" onchange="numberOrNot(this.id,this.value,'รหัสไปรษณีย์ไม่ถูกต้อง')" />
                <font color="#FF0000"><i><div id="txtZipcodechk" ></div></i></font>
              </div>
            </div>
            
            <div class="control-group formSep">
              <label for="u_email" class="control-label">เบอร์โทรศัพท์</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="txtPhone" id="txtPhone" value="" maxlength="10" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i><div id="txtPhonechk" ></div></i></font>
              </div>
              <br />  
              
              <label for="u_email" class="control-label">เบอร์โทรศัพท์มือถือ</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="txtMobilePhone" id="txtMobilePhone" value="" maxlength="10" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i><div id="txtMobilePhonechk" ></div></i></font>
              </div>
              <br />            
             
              <label for="u_email" class="control-label">E-mail</label>
              <div class="controls">
                <input type="text" name="txtEmail" id="txtEmail" class="input-xlarge" value="" onchange="chkEmail(this.value)" />
                <font color="#FF0000"><i><div id="chkEmail"></div></i></font>                
              </div>
            </div>
            
            <div class="control-group">
              <div class="controls">
                <button class="btn btn-gebo" type="submit">บันทึกการเพิ่มข้อมูล</button>
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


<style type="text/css">
label.valid {
  width: 24px;
  height: 24px;
  background: url(bootstrap/img/valid.png) center center no-repeat;
  display: inline-block;
  text-indent: -9999px;
}
label.error {
	font-weight: bold;
	color: red;
	padding: 2px 8px;
	margin-top: 2px;
}
</style>

<script type="text/javascript">

$(document).ready(function(){

	// Validate
	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	// http://docs.jquery.com/Plugins/Validation/
	// http://docs.jquery.com/Plugins/Validation/validate#toptions

		$('#fm_add').validate({
	    rules: {
	      txtPhone: {
	        minlength: 2,
	        required: true
	      },
	      email: {
	        required: true,
	        email: true
	      },
	      subject: {
	      	minlength: 2,
	        required: true
	      },
	      message: {
	        minlength: 2,
	        required: true
	      }
	    },
			highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}
	  });

}); // end document.ready

	
//function ใส่ จังหวัด อำเภอ ตำบล	
$(document).ready( function () {
	
	var province_ss = '<?=$province_ss?>';	
	var amphur_ss = '<?=$amphur_ss?>';
	var district_ss = '<?=$district_ss?>';
	
	//alert(car_ss_gensub);

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


function chkUNandGPW(id) {
	var username = $('#userName').val();
	
	$('#usernameOK').text("");
	$('#g_passwordOK').text("");
	
	if(id=="g_password")
		var chkGaragePW = chk1stGPW("g_password",$('#g_password').val(),8);

	if(id=="userName")
		var chkUsername = chkValid("userName",$('#userName').val(),8);


	if(chkUsername != false && chkGaragePW != false)
	{	console.log("Go Checking");
		jQuery.ajax({
			url :'modules/mod_user/minor/chkRegisDuplicate.php',
			type : 'GET',
			data : 'username='+username+'&u_garage=<?=$u_garage?>',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.message);
				console.log(data.success);

				if(data.success==true)
				{
					$('#userNamechk').text(username+" ถูกใช้งานไปแล้ว กรุณาใช้ชื่อื่น");
					$('#userName').val("");
					$('#usernameOK').text("");						
				}
				else
				{
					$('#usernameOK').text("Username นี้สามารถใช้งานได้");
					$('#userNamechk').text("");						
				}						
			}		
		});
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


function trimString(id,str) {
	$('#'+id).val(jQuery.trim(str));
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

function chk1stGPW(id,str,long) {
	console.log(id,str,long);
	$('#'+id).val(jQuery.trim(str));
	$('#g_password2').val("");

	var newstr = jQuery.trim(str);	
	if ( /[^A-Za-z0-9]/.test(newstr))
	{	$('#'+id+"chk").text("กรุณากรอกแต่ภาษาอังกฤษหรือตัวเลขเท่านั้น");
		$('#'+id).val("");
		return false;		}
	else if(long != 0 && newstr.length<long)
	{	$('#'+id+"chk").text("กรุณากรอกมากกว่า "+long+" ตัวอักษร");	
		$('#'+id).val("");
		return false;		}	
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

function chk2ndGPW(pw2) {
	if(pw2!=$('#g_password').val())
	{
		$('#g_password2chk').text("พาสเวิร์ดไม่ตรงกัน กรุณากรอกใหม่");
		$('#g_password2').val("");
	}
	else
		$('#g_password2chk').text("");
		
}

function numberOrNot(id,number,errortxt){
	
	number = jQuery.trim(number)
	if ( /[^0-9-]/.test(number))
	{	$('#'+id+"chk").text(""+errortxt+' ถ้าไม่มีให้ใส่เครื่องหมาย -');
		$('#'+id).val("");		
	}
	else
		$('#'+id+"chk").text("");
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