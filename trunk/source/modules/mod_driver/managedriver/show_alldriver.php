<?php
		//Case Supervisor
		if ($u_garage == 1) {
			
			if ($garageId == ''){
				$strSQL = "SELECT * FROM drivertaxi ORDER BY driverId";
				$strQuery = mysql_query($strSQL) or die (mysql_error());
			} else {
				$strSQL = "SELECT * FROM drivertaxi WHERE garageId = '".$garageId."' ORDER BY driverId";
				$strQuery = mysql_query($strSQL) or die (mysql_error());
			}			
			
		} 
		else { //Case Garage
			if ($garageId == ''){
				$strSQL = "SELECT * FROM drivertaxi ORDER BY driverId";
				$strQuery = mysql_query($strSQL) or die (mysql_error());
			} else {
				$strSQL = "SELECT * FROM drivertaxi WHERE garageId = '".$garageId."' ORDER BY driverId";
				$strQuery = mysql_query($strSQL) or die (mysql_error());
			}	
		}
		$total = mysql_num_rows($strQuery);
		
		
		///=====Data Major
		if ($garageId == ''){ 
			$major_name = 'ทั้งหมด';
		} 
		else if($garageId == '0') {
			$major_name = 'ที่ไม่มีสังกัดอยู่';
		}
		else {
			$major_data = select_db('majoradmin',"where garageId = '".$garageId."'");
			$major_name = $major_data[0]['thaiCompanyName'];
			$garageId = $major_data[0]['garageId'];
		}
		?>

<input type="hidden" name="hide_garageid" id="hide_garageid" value="<?=$garageid?>" />
<div class="row-fluid">
  <div class="span12">
    <h3 class="heading">รายชื่อข้อมูลคนขับ "<span style="color:#C30; font-weight:bold;">
      <?=$major_name?>
      </span>"</h3>
    <div class="well clearfix"><br />
      <div class="pull-left">รายการข้อมูลมีจำนวน <strong>
        <?=$total?>
        </strong> รายการ</div>
      <div class="pull-right">
        <form action="" method="post">
          <input type="hidden" name="act" value="add" />
          <input class="btn btn-success" type="submit" value="เพิ่มข้อมูลคนขับ" />
        </form>
      </div>
      <div class="pull-right">
        <form action="index.php?p=driver.managedriver&menu=main_driver" name="fm_selectmajor" id="fm_selectmajor" method="post">
          <? 
            if ($u_garage != 0) { 
				$selMajor = "SELECT * FROM majoradmin ORDER BY dateAdded DESC";
				$selMJQuery = mysql_query($selMajor);
				//$selResult = mysql_fetch_array($selMJQuery);
                //$major_data_list = select_db('majoradmin',"order by dateAdded desc");
                ?>
          <select name="garageId" id="garageId" onchange="fm_selectmajor.submit();" style="width:250px;">
            <option value="">ทั้งหมด</option>
            <option value="0" <? if ($garageId == '0') { echo "selected=\"selected\""; } ?> >คนขับที่ไม่มีสังกัดอยู่</option>
            <? while($selResult = mysql_fetch_array($selMJQuery)){ ?>
            <option value="<?=$selResult['garageId']?>" <? if ($garageId == $selResult['garageId']) { echo "selected=\"selected\""; } ?> >
            <?=$selResult['thaiCompanyName']?>
            </option>
            <? } ?>
          </select>
          <? } else { ?>
          <input type="hidden" name="garageId" value="<?=$garageId?>" />
          <? } ?>
        </form>
      </div>
    </div>
    <table class="table table-striped table-bordered dTableR" id="dt_a">
      <thead>
        <tr>
          <th style="text-align:center">ลำดับ</th>
          <th style="text-align:center">รูป</th>
          <th style="text-align:center">ชื่อ - นามสกุล</th>
          <th style="text-align:center">สังกัดอู่</th>
          <th style="text-align:center">Username</th>
          <th style="text-align:center">เลขประจำตัวประชาชน</th>
          <th style="text-align:center">รหัสใบขับขี่</th>
          <th style="text-align:center">เครดิต</th>
          <th style="text-align:center">เบอร์โทรศัพท์มือถือ</th>
          <th style="text-align:center">การจัดการ</th>
        </tr>
      </thead>
      <tbody>
        <?
    $i=1;
		
    while($objResult = mysql_fetch_array($strQuery))
    { ?>
        <tr>
          <td style="text-align:center"><?php echo $i;?></td>
          <td><?php 
		
               if ($objResult['driverImage'] == '')
			   {
				   $pathimage  = 'gallery/Image10_tn.jpg'; 	
			   } 
			   else {
					$pathimage  = 'stored/driver/'.$objResult['driverImage'];
					if (file_exists($pathimage)) {  //check file			
						$pathimage  = 'stored/driver/'.$objResult['driverImage'];
					} 
					else { 						
						$pathimage  = 'gallery/Image10_tn.jpg'; 	
					}
										
					$pathimage2  = 'stored/driver/thumbnail/'.$objResult['driverImage'];
					if (file_exists($pathimage2)) {  //check file			
						$pathimage2  = 'stored/driver/thumbnail/'.$objResult['driverImage'];
					} 
					else { 						
						$pathimage2  = 'gallery/Image10_tn.jpg'; 	
					}					
				}
								

		?>
            <a href="<?=$pathimage?>" title="รูปภาพของ <?=$objResult['firstName'].' '.$objResult['lastName']?>" class="cbox_single thumbnail"> <img alt="" src="<?=$pathimage2?>" style="height:50px;width:80px"> </a></td>
          <td><a href="#" class="ttip_t" title="ดูข้อมูลทั้งหมด" onclick="fn_showInfo(<?=$objResult['driverId']?>);">
            <?=$objResult['firstName']?>
            <?=' '.$objResult['lastName']?>
            </a></td>
          <td><?
		  	if($objResult['garageId']==0)
				echo "ไม่มีสังกัด";
			else 
			{	
				$getName = "SELECT majoradmin.thaiCompanyName,majoradmin.englishCompanyName ";
				$getName .= "FROM majoradmin WHERE majoradmin.garageId = '".$objResult['garageId']."'";
				$nameQuery = mysql_query($getName);
				$nameResult = mysql_fetch_array($nameQuery);
				
				echo $nameResult['thaiCompanyName'];
				echo "<br/>";
				echo $nameResult['englishCompanyName'];
			}
		  ?></td>
          <td><?=$objResult['username']?></td>
          <td><?=$objResult['citizenId']?></td>
          <td><?=$objResult['licenseNumber']?></td>
          <td></td>
          <td><?=$objResult['mobilePhone']?></td>
          <td style="text-align:center; vertical-align:middle">
          <?php if($u_type==1 || $u_garage == $objResult['garageId'] || $objResult['garageId'] == 0) { ?>
          <a href="index.php?p=driver.managedriver&menu=main_driver&act=edit&dvId=<?=$objResult['driverId']?>" data-toggle="modal" data-backdrop="static" title="Edit"><i class="icon-pencil"></i></a>&nbsp; <a id="<?=$objResult['driverId']?>" href="#myModalDel<?=$objResult['driverId']?>" data-toggle="modal" title="Delete" onclick="genNumForDel(this.id)"><i class="icon-trash"></i></a>&nbsp; <a href=""><img src="img/gCons/dollar.png" alt="" style="width:20px; height:20px" title="Buy Credit"/></a></td>
          <? } ?>
          <!-- POP UP -->
          <div class="modal hide fade" id="myModalDel<?=$objResult['driverId']?>" style="text-align:center; width:500px;">
            <div class="alert alert-block alert-error fade in">
              <font color="#000000"><h4 class="alert-heading">คุณต้องการลบข้อมูลผู้ขับ "<?=$objResult['firstName'].' '.$objResult['lastName']?>" ?</h4></font>
              <br />              
              <center><font color="#FF0000"><b><h4><div id="rannum<?=$objResult['driverId']?>"></div></h4></b></font>
              กรุณากรอกตัวเลข 4 ตัวด้านบน เพื่อยืนยันการลบ
              <input type="text" id="txtDelConfirm" maxlength="4" onkeyup="chkNumDelete('<?=$objResult['driverId']?>',this.value)" on />
              </center>
              <p> <a href="#" onclick=""><button id="confirmDelBtn<?=$objResult['driverId']?>" name="confirmDelBtn" disabled="disabled" class="btn btn-danger"><i class="splashy-error"></i> ยืนยันการลบข้อมูล</button></a> หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a></p>
            </div>
          </div>
        </tr>
        <? $i++; ?>
        <?	} ?>
      </tbody>
    </table>
  </div>
</div>

<!-- ShowInfo POP UP -->
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
        <center>
          <img src="" style="height:70px;width:100px"/>
        </center>
        <br />
        <table class="table10">
          <tr>
            <th>รหัสผู้ขับ : </th>
            <td><div id="txtDriverId"></div></td>
          </tr>
          <tr>
            <th>ชื่อ - นามสกุล : </th>
            <td><div id="txtFullname"></div></td>
          </tr>
          <tr>
            <th>Username : </th>
            <td><div id="txtUsername"></div></td>
          </tr>
          <tr>
            <th>อู่ที่สังกัดอยู่ : </th>
            <td><div id="txtGarage"></div></td>
          </tr>
          <tr>
            <th>รหัสประจำตัวประชาชน : </th>
            <td><div id="txtCitizen"></div></td>
          </tr>
          <tr>
            <th>รหัสใบขับขี่ : </th>
            <td><div id="txtDlicense"></div></td>
          </tr>
          <tr>
            <th>วันเกิด : </th>
            <td><div id="txtBirth"></div></td>
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
            <th>เบอร์โทรศัพท์บ้าน - สำนักงาน : </th>
            <td><div id="txtTelephone"></div></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="modal-footer"> 
      <!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> --> 
      <!--        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>บันทึก</a>-->
      <center>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ปิดหน้าต่าง</a>
      </center>
    </div>
  </form>
</div>

<script>
var w,x,y,z,numstr;
function genNumForDel(id)
{	
	//generate 4 digit(w-z) in format number 1-9 
	w = Math.floor(Math.random()*10);
	x = Math.floor(Math.random()*10);
	y = Math.floor(Math.random()*10);
	z = Math.floor(Math.random()*10);
	$('#rannum'+id+'').text(w+' '+x+' '+y+' '+z);
	numstr = w+''+x+''+y+''+z;
	console.log(numstr);
}

function chkNumDelete(id,value) {
	if(value==numstr){	
		$('#confirmDelBtn'+id+'').attr("disabled",false);
		$('#txtDelConfirm').attr("disabled",true);
	}
	else
		$('#confirmDelBtn'+id+'').attr("disabled",true);
}
</script> 

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
<!-- additional sorting for datatables --> 
<script src="lib/datatables/jquery.dataTables.sorting.js"></script> 
<!-- tables functions --> 
<script src="js/gebo_tables.js"></script> 
<script>
    $(document).ready(function() {
        //* show all elements & remove preloader
        setTimeout('$("html").removeClass("js")',1000);
    });
</script> 
