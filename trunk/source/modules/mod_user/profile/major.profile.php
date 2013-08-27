
<div class="row-fluid">
  <div class="span12">
    <h3 class="heading">แก้ไขข้อมูล</h3>
    <div class="row-fluid">
      <div class="span8">
<? 
	  	$strSQL = "SELECT majortype.majorType,garagelist.garageShortName,";
		$strSQL .= "majoradmin.majorId,majoradmin.thaiCompanyName,majoradmin.englishCompanyName,majoradmin.username,majoradmin.garageId ";
		$strSQL .= "FROM garagelist,majoradmin,majortype WHERE majoradmin.garageId=garagelist.garageId && majoradmin.majorTypeId=majortype.majorTypeId";
		//$strSQL2 = "SELECT  FROM garagelist,majoradmin WHERE garagelist.garageId=majoradmin.garageId";
		mysql_query("SET NAMES UTF8");
		$objQuery = mysql_query($strSQL) or die (mysql_error());
		$total = mysql_num_rows($objQuery);
	  pre($_SESSION); 
?>
        <form class="form-horizontal" action="addmajor.php" method="post">
          <fieldset>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อย่อบริษัท* :</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="shortName" value="<?php echo $shortName; ?>" maxlength="15" disabled="disabled" />
                <font color="#FF0000"><i>
                <div id="chkExist"></div>
                </i></font> <span class="help-block">ภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาวไม่เกิน 15 ตัวอักษร</span> <span class="help-block">*สำคัญ สำหรับใช้ระบุใน URL ของหน้าเว็บบริษัทของท่าน โปรดตรวจสอบให้แน่ใจก่อนทำการบันทึก</span> </div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อบริษัทภาษาไทย :</label>
              <div class="controls">
                <input type="text" id="thName" class="input-xlarge" value="" onchange="chkThai(this.id,this.value,0)" />
                <font color="#FF0000"><i><div id="thNamechk"></div></i></font> 
              </div>
              <br />
              <label for="u_fname" class="control-label">ชื่อบริษัทภาษาอังกฤษ :</label>
              <div class="controls">
                <input type="text" id="engName" class="input-xlarge" value="" onchange="chkValid(this.id,this.value,0)" />
                <font color="#FF0000"><i><div id="engNamechk"></div></i></font>                
              </div>
              <br />
              <label for="u_fname" class="control-label">ชื่อผู้บริหาร :</label>
              <div class="controls">
                <input type="text" id="managerName" class="input-xlarge" value="" onchange="trimString(this.id,this.value)" />
              </div>
              <br />
              <label for="u_fname" class="control-label">ประเภทของธุรกิจ :</label>
              <div class="controls">
                <input type="text" id="typeBus" class="input-xlarge" value="" onchange="trimString(this.id,this.value)" />
              </div>
            </div>
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">Username</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="userName" value="" maxlength="20" onchange="chkUsername(this.value)" />
                <font color="#FF0000"><i>
                <div id="chkUsername"></div>
                </i></font> <span class="help-block">ตัวอักษรภาษาอังกฤษเท่านั้น ความยาวไม่เกิน 20 ตัวอักษร</span> </div>
              <br />
              <label for="u_password" class="control-label">Password</label>
              <div class="controls">
                <div class="sepH_b">
                  <input type="password" class="input-xlarge" id="u_password" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" onchange="chkValid(this.id,this.value,8)" />
                <font color="#FF0000"><i><div id="u_passwordchk"></div></i></font>                  
                  <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span> </div>
                <input type="password" class="input-xlarge" id="u_password2" placeholder="พิมพ์พาสเวิร์ดเดิมอีกครั้ง" maxlength="20" />
              </div>
              <br />
              <br />
              <label for="u_password" class="control-label">Garage Password</label>
              <div class="controls">
                <div class="sepH_b">
                  <input type="password" class="input-xlarge" id="g_password" placeholder="ความยาวอย่างน้อย 8 ตัวอักษร" maxlength="20" />
                  <span class="help-block">ตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น ความยาว 8-20 ตัวอักษร</span> <span class="help-block">พาสเวิร์ดสำหรับใช้ระบุตัวตนของ Username ว่าอยู่บริษัทไหน</span></div>
                <input type="password" class="input-xlarge" id="g_password2" placeholder="พิมพ์พาสเวิร์ดเดิมอีกครั้ง" maxlength="20" />
              </div>
            </div>
            <div class="control-group formSep">
              <label class="control-label">ที่อยู่</label>
              <div class="controls">
                <textarea class="input-xlarge" id="txtMobile" placeholder="(บ้านเลขที่ ซอย ถนน)"></textarea>
              </div>
              <br />
              <label class="control-label">จังหวัด</label>
              <div class="controls">
                <div class="span6">
                  <select name="province_ss" id="province">
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
                    <select name="amphur_ss" id="amphur">
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
                    <select name="district_ss" id="district">
                      <option>กรุณาเลือกตำบล</option>
                    </select>
                  </div>
                </div>
              </div>
              <br />
              <br />              
              <label class="control-label">รหัสไปรษณีย์</label>
              <div class="controls">
                <input type="text" id="txtZipcode" class="input-xlarge" value="" placeholder="" />
              </div>
            </div>
            
            <div class="control-group formSep">
              <label for="u_email" class="control-label">เบอร์โทรศัพท์มือถือ</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="txtMobile" value="" maxlength="10" />
              </div>
              <br />
              <label for="u_email" class="control-label">เบอร์สำนักงาน</label>
              <div class="controls">
                <input type="text" id="txtTel" class="input-xlarge" value="" />
              </div>
              <br />
              <label for="u_email" class="control-label">แฟกซ์</label>
              <div class="controls">
                <input type="text" id="txtFax" class="input-xlarge" value="" />
              </div>
              <br />
              <label for="u_email" class="control-label">Call Center</label>
              <div class="controls">
                <input type="text" id="txtCallcenter" class="input-xlarge" value="" />
              </div>
              <br />
              <label for="u_email" class="control-label">E-mail</label>
              <div class="controls">
                <input type="text" id="txtEmail" class="input-xlarge" value="" onchange="chkEmail(this.value)" />
                <font color="#FF0000"><i>
                <div id="chkEmail"></div>
                </i></font>                
              </div>
            </div>
            <div class="control-group formSep">
              <label class="control-label">ประเภทของ Username</label>
              <div class="controls">
                <label class="radio inline">
                  <input type="radio" value="supervisor" id="radMjtype" name="radMjtype" checked="checked" />
                  Supervisor Admin</label>
                <label class="radio inline">
                  <input type="radio" value="company" id="radMjtype" name="radMjtype" />
                  Company Admin</label>
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
                <a href="index.php?p=user.major&menu=main_user">
                <button class="btn">ยกเลิก</button>
                </a> </div>
              <input type="hidden" name="saveadd" value="1" />
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

	
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

function chkEmail(email) {	
	if (email.indexOf(' ')==-1 && email.indexOf(' ')==0) {
		$('#chkEmail').text("กรุณากรอก E-mail ให้ถูกต้อง");	
	}	
}

function trimString(id,str) {
	$('#'+id).val(jQuery.trim(str));
}

function chkThai(id,str) {
	$('#'+id).val(jQuery.trim(str));

	var newstr = jQuery.trim(str);
	if (/[^ก-๙]/.test(newstr))
	{	$('#'+id+"chk").text("กรุณากรอกแต่ภาษาไทยเท่านั้น");
		$('#'+id).val("");		}
	else
		$('#'+id+"chk").text("");			
}

function chkValid(id,str,long) {
	$('#'+id).val(jQuery.trim(str));

	var newstr = jQuery.trim(str);	
	if ( /[^A-Za-z0-9]/.test(newstr))
	{	$('#'+id+"chk").text("กรุณากรอกแต่ภาษาอังกฤษหรือตัวเลขเท่านั้น");
		$('#'+id).val("");		}
	else if(long != 0 && str.length<long)
	{	$('#'+id+"chk").text("กรุณากรอกมากกว่า "+long+" ตัวอักษร");	
		$('#'+id).val("");		}	
	else
		$('#'+id+"chk").text("");
}	


function chkUsername(str) {
	if( /[^A-Za-z0-9]/.test(str))
	{	$('#chkUsername').text("กรุณากรอกแต่ภาษาอังกฤษหรือตัวเลขเท่านั้น");
		$('#userName').val("");		}
	else
		$('#chkUsername').text("");
}

function numberOrNot (number){
	number = jQuery.trim(number)
	
}
</script> 