<?
	$strSQL = "SELECT majortype.majorType,garagelist.garageShortName,";
	$strSQL .= "majoradmin.majorId,majoradmin.thaiCompanyName,majoradmin.englishCompanyName,majoradmin.username,majoradmin.garageId ";
	$strSQL .= "FROM garagelist,majoradmin,majortype WHERE majoradmin.garageId=garagelist.garageId && majoradmin.majorTypeId=majortype.majorTypeId";
	//$strSQL2 = "SELECT  FROM garagelist,majoradmin WHERE garagelist.garageId=majoradmin.garageId";
	mysql_query("SET NAMES UTF8");
	$objQuery = mysql_query($strSQL) or die (mysql_error());
	$total = mysql_num_rows($objQuery);
	//$objQuery2 = mysql_query($strSQL2) or die (mysql_error());
?>
<script type="text/javascript">
	function fn_showInfo(id){
		//console.log(id);
				$('#showInfo').modal('toggle');	
							
				jQuery.ajax({
					url :'modules/mod_user/major/gettoshow.php',
					type: 'GET',
					data: 'majorId='+id+'',
					dataType: 'jsonp',
					dataCharset: 'jsonp',
					success: function (data){
						console.log(data.thaiCompanyName);
						$('#txtThainame').text(data.thaiCompanyName);
						$('#txtEngname').text(data.englishCompanyName);
						$('#txtManager').text(data.managerName);						
						$('#txtUsername').text(data.username);
						$('#txtBtype').text(data.businessType);
						$('#txtAddress').text(data.fullAddress);
						$('#txtMobile').text(data.mobilePhone);
						$('#txtTelephone').text(data.telephone);
						$('#txtFax').text(data.fax);
						$('#txtCallcenter').text(data.callCenter);
						$('#txtEmail').text(data.email);
						$('#txtMtype').text(data.majorType);
						$('#txtShortName').text(data.garageShortName);
//						$('#showInfo').modal('toggle');
					}
				});	
			}	
</script>

<div class="row-fluid">
  <div class="span12">
    <h3 class="heading">รายชื่อข้อมูลบริษัททั้งหมด</h3>
    <div class="pull-left">รายการข้อมูลทั้งหมด <strong>
      <?=$total?>
      </strong> รายการ</div>
    <div class="pull-right"> <a href="index.php?p=user.major&menu=main_user&ACTION=add">
      <button class="btn btn-success" onClick="">เพิ่มข้อมูล</button>
      </a></div>
    <br />
    <br />
    <table class="table table-bordered table-striped table_vam" >
      <thead>
        <tr>
          <th style="text-align:center">ลำดับที่</th>
          <th width="400px">ชื่อภาษาไทย-ชื่อภาษาอังกฤษ</th>
          <th>ชื่อย่อ</th>
          <th>Username</th>
          <th>ประเภทของ Username</th>
          <th>รหัสอู่</th>
          <th>การจัดการ</th>
        </tr>
      </thead>
      <tbody>
        <?
								$i=1;
								while($objResult = mysql_fetch_array($objQuery))
								{ ?>
        <tr>
          <td style="text-align:center"><?=$i?></td>
          <td><a href="#" class="ttip_t" title="ดูข้อมูลทั้งหมด" onclick="fn_showInfo(<?=$objResult['majorId']?>);">
            <?=$objResult['thaiCompanyName']?>
            <br/>
            <?=$objResult['englishCompanyName']?>
            </a></td>
          <td><?=$objResult['garageShortName']?></td>
          <td><?=$objResult['username']?></td>
          <td><?=$objResult['majorType']?></td>
          <td><?=$objResult['garageId']?></td>
          <td><a href="" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a> <a href="#" title="Delete"><i class="icon-trash"></i></a></td>
          <? $i++; ?>
        </tr>
        <?	} ?>
      </tbody>
    </table>
  </div>
</div>
<input type="hidden" name="act" value="" />

<!-- POP UP -->
<style type="text/css">
.table10 td{border:none;}
.table10 th{border:none;}
.table10 tr{border:none;}
</style>
<div class="modal hide fade" id="showInfo">
  <div class="modal-header">
    <h3>รายละเอียดข้อมูลทั้งหมด</h3>
  </div>
  <form action="" name="fm_edittype">
    <div class="modal-body">
      <div class="formSep">
        <table class="table10">
          <tr>
            <th>ชื่อจริงภาษาไทย : </th>
            <td><div id="txtThainame"></div></td>
          </tr>
          <tr class="table10">
            <th>ชื่อภาษาอังกฤษ : </th>
            <td><div id="txtEngname"></div></td>
          </tr>
          <tr>
            <th>ชื่อผู้บริหาร : </th>
            <td><div id="txtManager"></div></td>
          </tr>
          <tr>
            <th>Username : </th>
            <td><div id="txtUsername"></div></td>
          </tr>
          <tr>
            <th>ประเภทธุรกิจ : </th>
            <td><div id="txtBtype"></div></td>
          </tr>
          <tr>
            <th>ที่อยู่ : </th>
            <td><div id="txtAddress"></div></td>
          </tr>
          <tr>
            <th>เบอร์มือถือ : </th>
            <td><div id="txtMobile"></div></td>
          </tr>
          <tr>
            <th>เบอร์สำนักงาน : </th>
            <td><div id="txtTelephone"></div></td>
          </tr>
          <tr>
            <th>แฟกซ์ : </th>
            <td><div id="txtFax"></div></td>
          </tr>
          <tr>
            <th>Call Center : </th>
            <td><div id="txtCallcenter"></div></td>
          </tr>
          <tr>
            <th>E-mail : </th>
            <td><div id="txtEmail"></div></td>
          </tr>
          <tr>
            <th>ประเภทของ User : </th>
            <td><div id="txtMtype"></div></td>
          </tr>
          <tr>
            <th>รหัสอู่ : </th>
            <td><div id="txtShortName"></div></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="modal-footer"> 
      <!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> --> 
      <!--        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>บันทึก</a>-->
      <center>
      <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ปิดหน้าต่าง</a> </div>
    </center>
  </form>
</div>
