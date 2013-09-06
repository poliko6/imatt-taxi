<?
	pre($_SESSION);

	$strSQL = "SELECT majortype.majorType,garagelist.garageShortName,garagelist.garagePassword,";
	$strSQL .= "majoradmin.majorId,majoradmin.thaiCompanyName,majoradmin.englishCompanyName,majoradmin.username,majoradmin.garageId ";
	$strSQL .= "FROM garagelist,majoradmin,majortype WHERE majoradmin.garageId=garagelist.garageId && majoradmin.majorTypeId=majortype.majorTypeId ";
	$strSQL .= "&& majoradmin.username != '".$_SESSION['u_username']."'";
	//$strSQL2 = "SELECT  FROM garagelist,majoradmin WHERE garagelist.garageId=majoradmin.garageId";
	mysql_query("SET NAMES UTF8");
	$objQuery = mysql_query($strSQL) or die (mysql_error());
	$total = mysql_num_rows($objQuery);
	//$objQuery2 = mysql_query($strSQL2) or die (mysql_error());
?>
<script type="text/javascript">
	var delayAlert=null; 
	
	function alertPopup(msgid,alertid,message,newload){
		$('#'+msgid+'').text(''+message+'');
		$('#'+alertid+'').fadeIn(500, function() {
			clearTimeout(delayAlert);  
			delayAlert=setTimeout(function(){  
//				alertFadeOut(''+alertid+'');
				$('#'+alertid+'').fadeOut(500);
				if (newload == 1){
					reloadPage();  
				}
				delayAlert=null;  
			},2000);  
		});
	}
	
	function reloadPage(){
		window.location = 'index.php?p=user.major&menu=main_user'; 
		//$('#fmReload').submit();
	}	
	
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
			
	function chkConfirmDel(garageId,garagePW) {
		
		jQuery.ajax({
			url  :'modules/mod_user/major/JSON/major.show.chkConfirmDel.php',
			type :'GET',
			data: 'garagePassword='+garagePW+'&garageId='+garageId+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data) {
				if(data.correct==true)	
				{	
					console.log(data.correct);
					$("#confirmBtn"+garageId).attr("disabled",false);
					$('#chk_confirm'+garageId).text("รหัสผ่านถูกต้อง");
				}
				else	
				{
					console.log(data.correct);					
					$("#confirmBtn"+garageId).attr("disabled",true);
					$('#chk_confirm'+garageId).text("รหัสผ่านไม่ถูกต้อง");
				}
			}			
		});
	}
			
	function delMJ(username) {
			console.log("In Show Info");		
			jQuery.ajax({
			url :'modules/mod_user/major/delMajor.php',
			type: 'GET',
			data: 'username='+username+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.success);
				if (data.success){ 
					alertPopup('msg3','alert3',''+data.message+'',1);
				} else {
					alertPopup('msg2','alert2',''+data.message+'',0);
				}				
				$('#myModalDel'+username+'').modal('toggle');
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
<!--    <div class="pull-right"> <a href="index.php?p=user.major&menu=main_user">
      <button class="btn btn-success" onClick="">เพิ่มข้อมูล</button>      
      </a></div>-->
	<form action="" method="post">
                    <input type="hidden" name="act" value="add" />   
                    <div class="pull-right">
                    <input class="btn btn-success" type="submit" value="เพิ่มข้อมูล" />        
                    </div>
    </form>          
    <br />
    <br />
    <table class="table table-bordered table-striped table_vam" id="dt_a">
      <thead>
        <tr>
          <th style="text-align:center">ลำดับที่</th>
          <th width="400px">ชื่อภาษาไทย-ชื่อภาษาอังกฤษ</th>
          <th>ชื่อย่อ</th>
          <th>Username</th>
          <th>ประเภทของ Username</th>
          <th>รหัสผ่านของอู่</th>
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
      <td><?=$objResult['garagePassword']?></td>
      <td>
        <a href="index.php?p=user.major&menu=main_user&act=edit&mjId=<?=$objResult['majorId']?>" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a> 

        <a href="#myModalDel<?=$objResult['majorId']?>" data-toggle="modal" title="ลบ"><i class="icon-trash"></i><? echo $objResult['majorId']; ?></a>
      </td>          
    </tr>          
        <!-- POP UP -->
        <div class="modal hide fade" id="myModalDel<?=$objResult['majorId']?>" style="text-align:center; width:500px;">
            <div class="alert alert-block alert-error fade in">
                <h4 class="alert-heading">คุณต้องการลบข้อมูลอู่บัญชี "<?=$objResult['username']?>"</h4>
                <div style="height:50px;"></div>
                <p><center>
	              	<label for="u_fname" class="control-label"><font color="#FF0000"><i>กรุณากรอกรหัสผ่านของอู่ <b><?=$objResult['username']?></b> เพื่อยืนยันการลบ</i></font></label>	
                  	<div class="controls">
              		<input type="password" name="confirmGPW" id="confirmGPW" class="input-xlarge" value="" onchange="chkConfirmDel('<?=$objResult['garageId']?>',this.value)" />
                    <font color="#666666"><i><div id="chk_confirm<?=$objResult['garageId']?>"></div></i></font>                  
              		</div>
              <br />                         
                <!--<a href="#" class="btn btn-inverse" onclick="delMJ('<?=$objResult['username']?>');"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> -->
                <a href="#" onclick="delMJ('<?=$objResult['username']?>');"><button id="confirmBtn<?=$objResult['garageId']?>" name="confirmBtn" disabled="disabled" class="btn btn-danger"><i class="splashy-error"></i> ยืนยันการลบข้อมูล</button></a>
                หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_x"></i> ยกเลิก</a>
                </p>
            </div>
        </div>
                                  
        <? $i++; ?>
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


<!-- sticky messages -->
<script src="lib/sticky/sticky.min.js"></script>
<!-- fix for ios orientation change -->
<script src="js/ios-orientationchange-fix.js"></script>
<!-- scrollbar -->
<script src="lib/antiscroll/antiscroll.js"></script>
<script src="lib/antiscroll/jquery-mousewheel.js"></script>
<!-- common functions -->
<script src="js/gebo_common.js"></script>

<!-- colorbox -->
<script src="lib/colorbox/jquery.colorbox.min.js"></script>
<!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- additional sorting for datatables -->
<script src="lib/datatables/jquery.dataTables.sorting.js"></script>
<!-- tables functions -->
<script src="js/gebo_tables.js"></script>

<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script>

<script>
    $(document).ready(function() {
        //* show all elements & remove preloader
        setTimeout('$("html").removeClass("js")',1000);
    });
</script>