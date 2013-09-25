<?
$cus_data = select_db('customer',"where customerId = '".$u_id."'");
$email = $cus_data[0]['email'];
$firstName = $cus_data[0]['firstName'];
$lastName = $cus_data[0]['lastName'];
$citizenId = $cus_data[0]['citizenId'];
$telephone = $cus_data[0]['telephone'];
$birthday = $cus_data[0]['birthday'];

?>
<div class="row-fluid">
  <div class="span12">
    <h3 class="heading">แก้ไขข้อมูล</h3>
    <div class="row-fluid">
        <form id="profileEdit" class="form-horizontal form_validation_ttip" action="" method="post">
         
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อจริง :</label>
              <div class="controls text_line">
                <input type="text" id="firstName" name="firstName" class="input-xlarge" value="<?=$firstName?>" onchange="trimString(this.id,this.value)" />
                <font color="#FF0000"><i><div id="thNamechk"></div></i></font> 
              </div>
              <br />
              <label for="u_fname" class="control-label">ชื่อบริษัทภาษาอังกฤษ :</label>
              <div class="controls">
                <input type="text" name="lastName" id="lastName" class="input-xlarge" value="<?=$lastName?>" onchange="trimString(this.id,this.value)" />
                <font color="#FF0000"><i><div id="engNamechk"></div></i></font>                
              </div>
              <br />
              <label for="u_fname" class="control-label">รหัสประชาชน :</label>
              <div class="controls">
                <input type="text" name="citizenId" id="citizenId" class="input-xlarge" value="<?=$citizenId?>" maxlength="13" onchange="numberOrNot(this.id,this.value)" />
                <font color="#FF0000"><i><div id="citizenIdchk" ></div></i></font>
              </div>
              <label for="u_fname" class="control-label">วัน เดือน ปี เกิด :</label>
              <div class="controls date" id="dp2" data-date-format="dd/mm/yyyy"> <span class="add-on">
                <input class="input-xlarge" type="text" id="dateShow" name="dateShow" readonly="readonly" value="<?=$birthday?>" />
                </span>
              </div>              
              <br />
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">E-mail</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="userName" id="userName" value="<?=$mj_username?>" disabled="disabled" /></div><br />
              <label for="u_password" class="control-label">Password</label>
              <div class="controls">
                <div class="sepH_b">
                <a href="#changePW" data-toggle="modal" title="เปลี่ยนรหัสผ่าน" >เปลี่ยนรหัสผ่าน</a>
				</div>                 
              </div>
            </div>
            </div>
            <div class="control-group formSep">
              <label class="control-label">ที่อยู่</label>
              <div class="controls">
                <textarea class="input-xlarge" name="txtAddress_add" id="txtAddress" placeholder="(บ้านเลขที่ ซอย ถนน)"><?=$objResult['address']?></textarea>
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
                      <option>กรุณาเลือกอำเภอ</option>
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
                      <option>กรุณาเลือกตำบล</option>
                    </select>
                  </div>
                </div>
              </div>
              <br />
              <br />              
              <label class="control-label">รหัสไปรษณีย์</label>
              <div class="controls">
                <input type="text" name="txtZipcode_add" id="txtZipcode" class="input-xlarge" value="<?=$objResult['zipcode']?>" onchange="numberOrNot(this.id,this.value,'รหัสไปรษณีย์ไม่ถูกต้อง')" />
                <font color="#FF0000"><i><div id="txtZipcodechk" ></div></i></font>
              </div>
            </div>
            
            <div class="control-group formSep">
              <label for="u_email" class="control-label">เบอร์โทรศัพท์มือถือ</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="txtMobilePhone" id="txtMobilePhone" value="<?=$objResult['mobilePhone']?>" maxlength="10" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i><div id="txtMobilePhonechk" ></div></i></font>
              </div>
              <br />
              <label for="u_email" class="control-label">เบอร์สำนักงาน</label>
              <div class="controls">
                <input type="text" name="txtTel" id="txtTel" class="input-xlarge" value="<?=$objResult['telephone']?>" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i><div id="txtTelchk" ></div></i></font>                
              </div>
              <br />
              <label for="u_email" class="control-label">แฟกซ์</label>
              <div class="controls">
                <input type="text" name="txtFax" id="txtFax" class="input-xlarge" value="<?=$objResult['fax']?>" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')" />
                <font color="#FF0000"><i><div id="txtFaxchk" ></div></i></font> 
              </div>
              <br />
              <label for="u_email" class="control-label">Call Center</label>
              <div class="controls">
                <input type="text" name="txtCallcenter" id="txtCallcenter" class="input-xlarge" value="<?=$objResult['callCenter']?>" onchange="numberOrNot(this.id,this.value,'กรอกข้อมูลไม่ถูกต้อง กรุณากรอกใหม่')"/>
                <font color="#FF0000"><i><div id="txtCallcenter" ></div></i></font> 
              </div>
              <br />
              <label for="u_email" class="control-label">E-mail</label>
              <div class="controls">
                <input type="text" name="txtEmail" id="txtEmail" class="input-xlarge" value="<?=$objResult['email']?>" onchange="chkEmail(this.value)" />
                <font color="#FF0000"><i><div id="chkEmail"></div></i></font>                
              </div>
            </div>
            
<?php /*?><!--            <div class="control-group formSep">
              <label class="control-label">ประเภทของ Username</label>
              <div class="controls">
                <label class="radio inline">
                  <input type="radio" value="company" id="radMjtype" name="radMjtype" <? if($objResult['majorTypeId']==2) echo 'checked=\"checked\"' ?> />
                  Company Admin</label>              
                <label class="radio inline">
                  <input type="radio" value="supervisor" id="radMjtype" name="radMjtype" <? if($objResult['majorTypeId']==1) echo 'checked=\"checked\"' ?> />
                  Supervisor Admin</label>
              </div>
            </div>--><?php */?>
            
            <div class="control-group">
              <div class="controls">
                <button class="btn btn-gebo" type="button" onclick="saveEdit()">บันทึกการเพิ่มข้อมูล</button>
				<input type="button" class="btn" value="ยกเลิก" onclick="reloadPage()" />
                </div>
            </div>

          			<!-- sent value to select and update -->
          			<input type="hidden" name="garageId" value="<?=$objResult['garageId']?>" />
          		
                    <input type="hidden" name="p" value="<?=$p?>" />
                    <input type="hidden" name="menu" value="<?=$menu?>" />
                    <input type="hidden" name="act" value="saveedit" />           
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
            <h4 class="alert-heading">แก้ไขรหัสผ่าน Username "<?=$mj_username?>"</h4><br />
            <label for="u_fname" class="control-label"><font color="#666666">กรุณากรอกรหัสผ่านเดิมของ <b><?=$objResult['username']?></b></font></label>
            <div class="controls">
            <input type="password" name="oldPW" id="oldPW" class="input-xlarge" value="" onchange="chkOldPW(this.id,this.value)" />
            <font color="#FF0000"><i><div id="oldPWchk"></div></i></font>
            <font color="#009900"><i><div id="oldPWok"></div></i></font>
            </div><br />   
            <label for="u_fname" class="control-label"><font color="#666666">กรุณากรอกรหัสผ่านใหม่สำหรับ <b><?=$objResult['username']?></b></font></label>
            <div class="controls">
            <input type="password" name="newPW1st" id="newPW1st" class="input-xlarge" disabled="disabled" value="" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" onchange="chk1stPW(this.id,this.value,8)" />
            <font color="#FF0000"><i><div id="newPW1stchk"></div></i></font>
            <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span>
            <input type="password" name="newPW2nd" id="newPW2nd" class="input-xlarge" value="" disabled="disabled" placeholder="พิมพ์รหัสผ่านเดิมอีกครั้ง" maxlength="20" onchange="chk2ndPW(this.value)" />
            <font color="#FF0000"><i><div id="newPW2ndchk"></div></i></font><br />   
			<a href="#" onclick=""><button id="btnPWConfirm" name="btnPWConfirm" disabled="disabled" class="btn btn-success" onclick="chgPWorGPW('PW')">เปลี่ยนรหัสผ่าน</button></a>
            หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_x"></i> ยกเลิก</a>                                           
            </div>                             
        </div>
    </div>
    
    <!-- Change Garage Password -->   
    <div class="modal hide fade" id="changeGPW" style="text-align:center; width:500px;">
        <div class="alert alert-block alert-error fade in">
            <h4 class="alert-heading">แก้ไขรหัสผ่าน สำหรับอู่ "<?=$shortName?>"</h4>
            <label for="u_fname" class="control-label"><font color="#666666">กรอกรหัสผ่านเดิมของอู่</b></font></label>
            <div class="controls">
            <input type="password" name="oldGPW" id="oldGPW" class="input-xlarge" value="" onchange="chkOldGPW(this.id,this.value)" />
            <font color="#FF0000"><i><div id="oldGPWchk"></div></i></font>
            <font color="#009900"><i><div id="oldGPWok"></div></i></font>
            </div><br />
            <label for="u_fname" class="control-label"><font color="#666666">กรุณากรอกรหัสผ่านใหม่ที่ต้องการ</b></font></label>
            <div class="controls">
            <input type="password" name="newGPW1st" id="newGPW1st" class="input-xlarge" value="" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" disabled="disabled" onchange="chkGPW(this.id)" />
            <font color="#FF0000"><i><div id="newGPW1stchk"></div></i></font>
            <font color="#009900"><i><div id="newGPW1stok"></div></i></font>
            <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span>
            <input type="password" name="newGPW2nd" id="newGPW2nd" class="input-xlarge" value="" placeholder="พิมพ์รหัสผ่านเดิมอีกครั้ง" maxlength="20" disabled="disabled" onchange="chk2ndGPW(this.value)" />
            <font color="#FF0000"><i><div id="newPW2ndchk"></div></i></font><br />     
			<a href="#" onclick=""><button id="btnGPWConfirm" name="btnGPWConfirm" disabled="disabled" class="btn btn-success" onclick="chgPWorGPW('GPW')">เปลี่ยนรหัสผ่าน</button></a>
            หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_x"></i> ยกเลิก</a>                                       
            </div>                             
        </div>
    </div>     
<? //////////////////////////////////////////////////////////////////////////////////////////////////////////////?>        
        
        
        
<script type="text/javascript">	
var delayAlert=null; 

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

function reloadPage(){
	window.location = 'index.php?p=user.profile&menu=main_user'; 
	//$('#fmReload').submit();
}

function reloadPage2(){
	window.location = 'index.php?p=user.profile&menu=main_user&sav=yes'; 
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
	
	$(document).on("keydown.NewActionOnF5", function(e){
        var charCode = e.which || e.keyCode;
        switch(charCode){
            case 116: // F5
                e.preventDefault();
                window.location = "index.php?p=user.profile&menu=main_user";
                break;
        }
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

function saveEdit() {
	jQuery.ajax({
	url :'modules/mod_user/profile/JSON/major.profile.saveEdit.php',
	type: 'GET',
	data: $('#profileEdit').serialize(),
	dataType: 'jsonp',
	dataCharset: 'jsonp',
		success: function (data){
			reloadPage2();
		}
	});	
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

function chkOldPW(id,value) {
	var pwtemp = '<?=$objResult['password']?>'; // pw from database
	console.log("pwtemp here "+pwtemp);
	var pwtochk;
	jQuery.ajax({
		url :'modules/mod_user/major/JSON/major.edit.chkOldPW.php',
		type: 'GET',
		data: 'oldPW='+value+'',
		dataType: 'jsonp',
		dataCharset: 'jsonp',
		success: function (data){
			pwtochk = data.shaPW;
			if(pwtochk == pwtemp)
			{
				$('#'+id+'chk').text("");
				$('#'+id+'ok').text("รหัสผ่านถูกต้อง");
				$('#newPW1st').attr("disabled",false);
				$('#newPW2nd').attr("disabled",false);
				$('#'+id).attr("disabled",true);
			}
			else
			{
				$('#'+id+'ok').text("");
				$('#'+id+'chk').text("รหัสผ่านเดิมไม่ถูกต้องกรุณากรอกใหม่");
				$('#'+id).val("");
			}
		}
	});		
}

function chkOldGPW(id,value) {
	var gpwtochk = "<?=$objResult['garagePassword']?>";
	
	if(gpwtochk == value)
	{
		$('#'+id+'chk').text("");
		$('#'+id+'ok').text("รหัสผ่านถูกต้อง");
		$('#newGPW1st').attr("disabled",false);
		$('#newGPW2nd').attr("disabled",false);
		$('#'+id).attr("disabled",true);
	}
	else
	{
		$('#'+id+'ok').text("");
		$('#'+id+'chk').text("รหัสผ่านเดิมของอู่ไม่ถูกต้อง กรุณากรอกใหม่");
		$('#'+id).val("");
	}
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

function chk1stGPW(id,str,long) {
	console.log(id,str,long);
	$('#'+id).val(jQuery.trim(str));
	$('#newGPW2nd').val("");

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
	if(pw2!=$('#newPW1st').val())
	{
		$('#newPW2ndchk').text("พาสเวิร์ดไม่ตรงกัน กรุณากรอกใหม่");
		$('#newPW2nd').val("");
		$('#btnPWConfirm').attr("disabled",true);
	}
	else
	{
		$('#newPW2ndchk').text("");
		$('#btnPWConfirm').attr("disabled",false);
	}
}

function chk2ndGPW(pw2) {
	if(pw2!=$('#newGPW1st').val())
	{
		$('#newGPW2ndchk').text("พาสเวิร์ดไม่ตรงกัน กรุณากรอกใหม่");
		$('#newGPW2nd').val("");
		$('#btnGPWConfirm').attr("disabled",true);
	}
	else
	{
		$('#newGPW2ndchk').text("");
		$('#btnGPWConfirm').attr("disabled",false);
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