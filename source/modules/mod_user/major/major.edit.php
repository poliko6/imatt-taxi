<?
	$strSQL = "SELECT majortype.majorTypeId,garagelist.garageShortName,garagelist.garagePassword,garagelist.garageId,";
	$strSQL .= "majoradmin.* FROM garagelist,majortype,majoradmin WHERE majoradmin.majorId ='".$majorId."' && ";
	$strSQL .= "majoradmin.garageId = garagelist.garageId && majoradmin.majorTypeId = majortype.majorTypeId";
	$objQuery = mysql_query($strSQL) or die (mysql_error());
	
	$objResult = mysql_fetch_array($objQuery);
	
	//majoradmin data
	$thName = $objResult['thaiCompanyName'];
	$engName = $objResult['englishCompanyName'];
	$managerName = $objResult['managerName'];
	$busType = $objResult['businessType'];
	$mj_username = $objResult['username'];
	$old_pw = $objResult['password'];
	$address = $objResult['address'];
	$zipcode = $objResult['zipcode'];
	$province_ss = $objResult['provinceId'];
	$amphur_ss = $objResult['amphurId'];
	$district_ss = $objResult['districtId'];
	$mobileNO = $objResult['mobilePhone'];
	$teleNO = $objResult['telephone'];
	$fax = $objResult['fax'];
	$callcenter = $objResult['callCenter'];
	$email = $objResult['email'];
	
	//garagelist data
	$shortName = $objResult['garageShortName'];
	$old_gpw = $objResult['garagePassword'];
	
	//majortype data 
	$majorTypeId = $objResult['majorTypeId']; // 1 = supervisor admin 2 = company admin
?>
<div class="row-fluid">
  <div class="span12">
    <h3 class="heading">แก้ไขข้อมูล</h3>
    <div class="row-fluid">
      <div class="span8">
        <form class="form-horizontal form_validation_ttip" action="" method="post">
          <fieldset>
         
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อย่อบริษัท* :</label>
              <div class="controls text_line">
                <input type="text" class="input-xlarge" name="shortName" id="shortName" onchange="fn_chkShortName(this.value)" value="<?=$shortName?>" maxlength="15" />
                <font color="#FF0000"><i>
                <div id="chkExist"></div>
                </i></font> <span class="help-block">ภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาวไม่เกิน 15 ตัวอักษร</span> <span class="help-block">*สำคัญ สำหรับใช้ระบุใน URL ของหน้าเว็บบริษัทของท่าน โปรดตรวจสอบให้แน่ใจก่อนทำการบันทึก</span> </div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อบริษัทภาษาไทย :</label>
              <div class="controls text_line">
                <input type="text" id="thName" name="thName" class="input-xlarge" value="<?=$thName?>" onchange="chkThai(this.id,this.value,0)" />
                <font color="#FF0000"><i><div id="thNamechk"></div></i></font> 
              </div>
              <br />
              <label for="u_fname" class="control-label">ชื่อบริษัทภาษาอังกฤษ :</label>
              <div class="controls">
                <input type="text" name="engName" id="engName" class="input-xlarge" value="<?=$engName?>" onchange="chkEngNum(this.id,this.value,0)" />
                <font color="#FF0000"><i><div id="engNamechk"></div></i></font>                
              </div>
              <br />
              <label for="u_fname" class="control-label">ชื่อผู้บริหาร :</label>
              <div class="controls">
                <input type="text" name="managerName" id="managerName" class="input-xlarge" value="<?=$managerName?>" onchange="trimString(this.id,this.value)" />
              </div>
              <br />
              <label for="u_fname" class="control-label">ประเภทของธุรกิจ :</label>
              <div class="controls">
                <input type="text" name="typeBus" id="typeBus" class="input-xlarge" value="<?=$busType?>" onchange="trimString(this.id,this.value)" />
              </div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">Username</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="userName" id="userName" value="<?=$mj_username?>" disabled="disabled" /></div><br />
              <label for="u_password" class="control-label">Password</label>
              <div class="controls">
                <div class="sepH_b">
                <a href="#changePW" data-toggle="modal" title="เปลี่ยนรหัสผ่าน" >เปลี่ยนรหัสผ่านของ Username</a>
				</div>                 
              </div>
              <br />
              <label for="u_password" class="control-label">Garage Password</label>
              <div class="controls">
                <div class="sepH_b">
                  <a href="#changeGPW" data-toggle="modal" title="เปลี่ยนรหัสผ่าน" >เปลี่ยนรหัสผ่านของอู่</a>
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
            <div class="control-group formSep">
              <label class="control-label">ประเภทของ Username</label>
              <div class="controls">
                <label class="radio inline">
                  <input type="radio" value="company" id="radMjtype" name="radMjtype" <? if($objResult['majorTypeId']==2) echo 'checked=\"checked\"' ?> />
                  Company Admin</label>              
                <label class="radio inline">
                  <input type="radio" value="supervisor" id="radMjtype" name="radMjtype" <? if($objResult['majorTypeId']==1) echo 'checked=\"checked\"' ?> />
                  Supervisor Admin</label>
              </div>
            </div>
            
            <div class="control-group">
              <div class="controls">
                <button class="btn btn-gebo" type="submit">บันทึกการเพิ่มข้อมูล</button>
				<input type="button" class="btn" value="ยกเลิก" onclick="reloadPage()" />
                </div>
            </div>
          </fieldset>
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
				else if(data.exist==true && data.canPass==true && $('#shortName').val() != '<?=$shortName?>')
				{
					$('#chkExist').text($('#shortName').val()+" ชื่อย่อนี้ถูกใช้ไปแล้ว กรุณาใช้ชื่ออื่น");
					$('#shortName').val("");
				}
				else
					$('#chkExist').text("");
			}
		});	
}

function chkGPW(id) {
	var username = $('#userName').val();
	var garagePW = $('#g_password').val();

	$('#newGPW1stok').text("");
	
	if(id=="newGPW1st")
		var chkGaragePW = chk1stGPW("newGPW1st",$('#newGPW1st').val(),8);

	if(chkGaragePW != false)
	{	console.log("Go Checking");
		jQuery.ajax({
			url :'modules/mod_user/major/add.validation/chkUNandGPW.php',
			type : 'GET',
			data : 'username='+username+'&garagePassword='+garagePW+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){

				console.log(data.garagePassword);
				console.log(data.garagePW_exist);	
						
				if(data.garagePW_exist==true)					
				{
					$('#newGPW1stchk').text("รหัสนี้ถูกใช้งานไปแล้ว กรุณาตั้งใหม่");
					$('#newGPW1st').val("");					
					$('#newGPW1stok').text("");					
				}
				else if(data.garagePW_exist == false && data.garagePassword !="" )
				{
					$('#newGPW1stok').text("รหัสนี้สามารถใช้งานได้");
					$('#newGPW1stchk').text("");					
				}			
			}		
		});
	}
}

function chgPWorGPW(type) {
	var garageId = '<?=$objResult['garageId']?>';
	
	if(type == 'PW')
	{
		var modalId = 'changePW';
		var type = 1;
		var newPW = $('#newPW2nd').val();
	}
	else
	{
		var modalId = 'changeGPW';
		var type = 2;
		var newPW = $('#newGPW2nd').val();
	}
		
	jQuery.ajax({
	url :'modules/mod_user/major/JSON/major.edit.chgPWorGPW.php',
	type: 'GET',
	data: 'type='+type+'&newPW='+newPW+'&garageId='+garageId+'',
	dataType: 'jsonp',
	dataCharset: 'jsonp',
		success: function (data){
				alertPopup('msg3','alert3',''+data.message+'');
				$('#'+modalId+'').modal('toggle');	
		}
	});
	
		
	switch (type) {
		case 1:
			$('#oldPW').val("");
			$('#oldGPWok').text("");
			$('#oldPW').attr("disabled",false);
			$('#newPW1st').val("");
			$('#newPW2nd').val("");
			$('#btnPWConfirm').attr("disabled",true);
			break;
		case 2:
			$('#oldGPW').val("");
			$('#oldGPWok').text("");
			$('#oldGPW').attr("disabled",false);
			$('#newGPW1stok').text("");
			$('#newGPW1st').val("");
			$('#newGPW2nd').val("");
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

<script src="js/jquery.min.js"></script>
<!-- smart resize event -->
<script src="js/jquery.debouncedresize.min.js"></script>
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