
<div class="row-fluid">
  <div class="span12">
    <h3 class="heading">เพิ่มข้อมูล</h3>
    <div class="row-fluid">
      <div class="span8">
        <form class="form-horizontal form_validation_ttip" action="" method="post">
          <fieldset>
         
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อย่อบริษัท* :</label>
              <div class="controls text_line">
                <input type="text" class="input-xlarge" name="shortName" id="shortName" onchange="fn_chkShortName(this.value)" value="" maxlength="15" />
                <font color="#FF0000"><i>
                <div id="chkExist"></div>
                </i></font> <span class="help-block">ภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาวไม่เกิน 15 ตัวอักษร</span> <span class="help-block">*สำคัญ สำหรับใช้ระบุใน URL ของหน้าเว็บบริษัท โปรดตรวจสอบให้แน่ใจก่อนทำการบันทึก</span> </div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อบริษัทภาษาไทย :</label>
              <div class="controls text_line">
                <input type="text" id="thName" name="thName" class="input-xlarge" value="" onchange="chkThai(this.id,this.value,0)" />
                <font color="#FF0000"><i><div id="thNamechk"></div></i></font> 
              </div>
              <br />
              <label for="u_fname" class="control-label">ชื่อบริษัทภาษาอังกฤษ :</label>
              <div class="controls">
                <input type="text" name="engName" id="engName" class="input-xlarge" value="" onchange="chkEngNum(this.id,this.value,0)" />
                <font color="#FF0000"><i><div id="engNamechk"></div></i></font>                
              </div>
              <br />
              <label for="u_fname" class="control-label">ชื่อผู้บริหาร :</label>
              <div class="controls">
                <input type="text" name="managerName" id="managerName" class="input-xlarge" value="" onchange="trimString(this.id,this.value)" />
              </div>
              <br />
              <label for="u_fname" class="control-label">ประเภทของธุรกิจ :</label>
              <div class="controls">
                <input type="text" name="typeBus" id="typeBus" class="input-xlarge" value="" onchange="trimString(this.id,this.value)" />
              </div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">Username</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="userName" id="userName" value="" maxlength="20" onchange="chkUNandGPW(this.id)" />
                <font color="#006600"><div id="usernameOK"></div></font>
                <font color="#FF0000"><i><div id="userNamechk"></div>
                </i></font> <span class="help-block">ตัวอักษรภาษาอังกฤษเท่านั้น ความยาวไม่เกิน 20 ตัวอักษร</span> </div>
              <br />
              <label for="u_password" class="control-label">Password</label>
              <div class="controls">
                <div class="sepH_b">
                  <input type="password" class="input-xlarge" name="u_password" id="u_password" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" onchange="chk1stPW(this.id,this.value,8)" />
                <font color="#FF0000"><i><div id="u_passwordchk"></div></i></font>                  
                  <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span> </div>
                <input type="password" class="input-xlarge" name="u_password2" id="u_password2" placeholder="พิมพ์พาสเวิร์ดเดิมอีกครั้ง" maxlength="20" onchange="chk2ndPW(this.value)" />
                <font color="#FF0000"><i><div id="u_password2chk"></div></i></font>                  
              </div>
              <br />
              <br />
              <label for="u_password" class="control-label">Garage Password</label>
              <div class="controls">
                <div class="sepH_b">
                  <input type="password" class="input-xlarge" name="g_password" id="g_password" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" onchange="chkUNandGPW(this.id)" />
                  <font color="#FF0000"><i><div id="g_passwordchk"></div></i></font>
                <font color="#006600"><div id="g_passwordOK"></div></font>                  
                  <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span> <span class="help-block">พาสเวิร์ดสำหรับใช้ระบุตัวตนของ Username ว่าอยู่บริษัทไหน</span></div>

                <input type="password" class="input-xlarge" name="g_password2" id="g_password2" placeholder="พิมพ์พาสเวิร์ดเดิมอีกครั้ง" maxlength="20" onchange="chk2ndGPW(this.value)" />
                 <font color="#FF0000"><i><div id="g_password2chk"></div></i></font>
              </div>
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
                <font color="#FF0000"><i><div id="txtZipcodechk" ></div></i></font>
              </div>
            </div>
            
            <div class="control-group formSep">
              <label for="u_email" class="control-label">เบอร์โทรศัพท์มือถือ</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="txtMobilePhone" id="txtMobilePhone" value="" maxlength="10" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i><div id="txtMobilePhonechk" ></div></i></font>
              </div>
              <br />
              <label for="u_email" class="control-label">เบอร์สำนักงาน</label>
              <div class="controls">
                <input type="text" name="txtTel" id="txtTel" class="input-xlarge" value="" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i><div id="txtTelchk" ></div></i></font>                
              </div>
              <br />
              <label for="u_email" class="control-label">แฟกซ์</label>
              <div class="controls">
                <input type="text" name="txtFax" id="txtFax" class="input-xlarge" value="" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i><div id="txtFaxchk" ></div></i></font> 
              </div>
              <br />
              <label for="u_email" class="control-label">Call Center</label>
              <div class="controls">
                <input type="text" name="txtCallcenter" id="txtCallcenter" class="input-xlarge" value="" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')"/>
                <font color="#FF0000"><i><div id="txtCallcenter" ></div></i></font> 
              </div>
              <br />
              <label for="u_email" class="control-label">E-mail</label>
              <div class="controls">
                <input type="text" name="txtEmail" id="txtEmail" class="input-xlarge" value="" onchange="chkEmail(this.value)" />
                <font color="#FF0000"><i><div id="chkEmail"></div></i></font>                
              </div>
            </div>
            <div class="control-group formSep">
              <label class="control-label">ประเภทของ Username</label>
              <div class="controls">
                <label class="radio inline">
                  <input type="radio" value="company" id="radMjtype" name="radMjtype" checked="checked"  />
                  Company Admin</label>              
                <label class="radio inline">
                  <input type="radio" value="supervisor" id="radMjtype" name="radMjtype" />
                  Supervisor Admin</label>
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

function fn_chkShortName(shortName){
		//console.log(id);		
		shortName = jQuery.trim(shortName);
		$('#shortName').val(jQuery.trim(shortName));
									
				jQuery.ajax({
					url :'modules/mod_user/major/add.validation/chkShortName.php',
					type: 'GET',
					data: 'garageShortName='+shortName+'',
					dataType: 'jsonp',
					dataCharset: 'jsonp',
					success: function (data){
						console.log(data.garageShortName);
						console.log(data.canPass);
						if(data.canPass!=true)
						{	$('#chkExist').text("กรุณากรอกแต่ภาษาอังกฤษหรือตัวเลขเท่านั้น");
							$('#shortName').val("");
						}
						else if(data.exist==true && data.canPass==true)
						{
							$('#chkExist').text($('#shortName').val()+" ชื่อย่อนี้ถูกใช้ไปแล้ว กรุณาใช้ชื่ออื่น");
							$('#shortName').val("");
						}
						else
							$('#chkExist').text("");
					}
				});	
}

function chkUNandGPW(id) {
	var username = $('#userName').val();
	var garagePW = $('#g_password').val();
	
	$('#usernameOK').text("");
	$('#g_passwordOK').text("");
	
	if(id=="g_password")
		var chkGaragePW = chk1stGPW("g_password",$('#g_password').val(),8);

	if(id=="userName")
		var chkUsername = chkValid("userName",$('#userName').val(),8);


	if(chkUsername != false && chkGaragePW != false)
	{	console.log("Go Checking");
		jQuery.ajax({
			url :'modules/mod_user/major/add.validation/chkUNandGPW.php',
			type : 'GET',
			data : 'username='+username+'&garagePassword='+garagePW+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.username);
				console.log(data.username_exist);
				console.log(data.garagePassword);
				console.log(data.garagePW_exist);
				if(data.username_exist==true)
				{
						$('#userNamechk').text(username+" ถูกใช้งานไปแล้ว กรุณาใช้ชื่อื่น");
						$('#userName').val("");
						$('#usernameOK').text("");						
				}
				else if(data.username_exist==false && data.username != "")
				{
						$('#usernameOK').text("Username นี้สามารถใช้งานได้");
						$('#userNamechk').text("");						
				}
						
						
				if(data.garagePW_exist==true)					
				{
					$('#g_passwordchk').text("รหัสนี้ถูกใช้งานไปแล้ว กรุณาตั้งใหม่");
					$('#g_password').val("");					
					$('#g_passwordOK').text("");					
				}
				else if(data.garagePW_exist == false && data.garagePassword !="" )
				{
					$('#g_passwordOK').text("รหัสนี้สามารถใช้งานได้");
					$('#g_passwordchk').text("");					
				}
				console.log(data.garagePassword.length);
				console.log(data.username.length);				
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

<!-- smart resize event -->
<script src="js/jquery.debouncedresize.min.js"></script>
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