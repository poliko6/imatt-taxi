<?
$data_search = select_db('drivertaxi',"where driverId = '".$driverId."'"); 
$firstName = $data_search[0]['firstName'];
$lastName = $data_search[0]['lastName'];
$citizenId = $data_search[0]['citizenId'];
$licenseNumber = $data_search[0]['licenseNumber'];
$driverBirthday = $data_search[0]['driverBirthday'];
$address = $data_search[0]['address'];
$zipcode = $data_search[0]['zipcode'];
$driverImage = $data_search[0]['driverImage'];
$mobilePhone = $data_search[0]['mobilePhone'];
$telephone = $data_search[0]['telephone'];
$districtId = $data_search[0]['districtId'];
$amphurId = $data_search[0]['amphurId'];
$provinceId = $data_search[0]['provinceId'];
$checkDelete = $data_search[0]['checkDelete'];
$username = $data_search[0]['username'];
$garageId = $data_search[0]['garageId'];
$lock = $data_search[0]['lock'];


if ($garageId != 0){
	$data_garage = select_db('majoradmin',"where garageId = '".$garageId."'"); 
	$garageName = $data_garage[0]['thaiCompanyName'];
} else {
	$garageName = 'ไม่มีสังกัด';
}

$data_province = select_db('province',"where provinceId = '".$provinceId."'"); 
$provinceName =  $data_province[0]['provinceName'];

$data_district = select_db('district',"where districtId = '".$districtId."'"); 
$districtName =  $data_district[0]['districtName'];

$data_amphur = select_db('amphur',"where amphurId = '".$amphurId."'"); 
$amphurName =  $data_amphur[0]['amphurName'];

$address_set = $address.' '.$districtName.' '.$amphurName.' '.$provinceName.', '.$zipcode;



//B Day
$p_bday = explode('/',$driverBirthday);	

$thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
				 "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");	
					 



//Image
if ($driverImage == ''){ 
	$pathimage  = 'gallery/Image10_tn.jpg'; 
} else {
	$pathimage  = 'stored/driver/thumbnail/'.$driverImage;
	if (file_exists($pathimage)) {  //check file			
		$pathimage  = $pathimage;
	} else { 						
		$pathimage  = 'gallery/Image10_tn.jpg'; 	
	}
}	
?>
<style type="text/css">
.nanstyle {
	padding:5px;
	border:1px #CCC solid;
}
.table10 td{
	background:#FFC;
	}
.table10 th{
	border-right:none;
	background-color:#FFC;
}
.table10 tr{border:none;}
</style>

<div class="row-fluid">
  <div class="span12">
    <div class="chat_box">
      
      <div class="span8">
        
        
        <div class="chat_content">          
          <div class="chat_heading clearfix">
            <div class="btn-group pull-right"> 
                <a href="#" class="btn btn-mini ttip_t" title="Refresh list">
                <i class="icon-refresh"></i></a> 
            </div>
            ตำแหน่งปัจจุบัน 
          </div>          
          <div class="msg_window"></div>          
        </div> <!--chat_content -->
        
        <div class="tabbable" style="margin-top:10px; margin-bottom:10px;">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">ประวัติการเดินทาง</a></li>
                <li><a href="#tab2" data-toggle="tab">ประวัติการรับผู้โดยสาร</a></li>
            </ul>
            
            <div class="tab-content">
               
                <div class="tab-pane active" id="tab1">
                    <div class="row-fluid">
                        <? include('modules/mod_driver/drivercheck/history.transport.php'); ?>
                    </div>
                </div>
                
                
                <div class="tab-pane" id="tab2">
                    <div class="row-fluid">
                        <? include('modules/mod_driver/drivercheck/history.passenger.php'); ?>
                    </div>
                </div>             
            </div>
        </div>
        
        
      </div> <!--span8 -->  
        
        
        
        
        
     
      <div class="span4">  
        
        <div class="chat_sidebar">
          <div class="chat_heading clearfix"> รายละเอียดส่วนตัว </div>
            <table class="table table-striped table-bordered" style="margin-bottom:0px; border:none;">         
              <tr>
                <th width="35%">รุป : </th>
                <td><img src='<?=$pathimage?>' style="height:50px;width:80px; border:1px #CCCCCC solid; padding:3px;">                    
                </td>
              </tr>
              <tr>
                <th>Username : </th>
                <td><span style="color:#00F;"><?=$username?></span></td>
              </tr> 
              <tr>
                <th>ชื่อ : </th>
                <td><?=$firstName?>  <?=$lastName?></td>
              </tr>  
              <tr>
                <th>หมายเลขบัตรประชาชน : </th>
                <td><?=$citizenId?></td>
              </tr>   
              <tr>
                <th>หมายเลขใบขับขี่ : </th>
                <td><?=$licenseNumber?></td>
              </tr>
              <tr>
                <th>วันเกิด : </th>
                <td><?=$p_bday[0].' '.$thMonth[$p_bday[1]-1].' '.$p_bday[2];?></td>
              </tr>          
              <tr>
                <th>ที่อยู่ : </th>
                <td><?=$address_set?></td>
              </tr>                       
              <tr>
                <th>เบอร์มือถือ : </th>
                <td><?=$mobilePhone?></td>
              </tr>
              <tr>
                <th>เบอร์โทรศัพท์ : </th>
                <td><?=$telephone?></td>
              </tr>
              <tr>
                <th>สังกัดอู่ : </th>
                <td><?=$garageName?></td>
              </tr> 
             
              <? if ($u_garage == 1){ ?>             
              <tr>
                <th>สถานะ : </th>
                <td id="div_lock">
                
					<?
					if ($lock == 0) {
						?>
						<a href="#" class="ttip_t" title="สถานะล๊อค" onclick="fn_changeLock('<?=$driverId?>',1);"><i class="splashy-lock_large_locked"></i></a>
                        <?
					} else {
						?>
						<a href="#" class="ttip_t" title="สถานะไม่ล๊อค" onclick="fn_changeLock('<?=$driverId?>',0);"><i class="splashy-lock_large_unlocked"></i></a>
                        <?
					}
                	?>
                  
                </td>
              </tr>
              <? } ?>
              
            </table>        
        </div><!--chat_sidebar -->
        
        
        <?
		//จาก driverhistory รวมคะแนน
		//driverPunctual คะแนนความตรงต่อเวลาที่ลูกค้าให้ผู้ขับ
		$sql_Punctual = "SELECT SUM(driverPunctual) as sumPunctual FROM driverhistory WHERE driverId='".$driverId."'";
		$rs_Punctual = mysql_query($sql_Punctual) or trigger_error(mysql_error(),E_USER_ERROR);
		$sum_Punctual =  mysql_result ($rs_Punctual,0);
		
		//driverCourtesy คะแนนมารยาทของผู้ขับที่ลูกค้าให้
		$sql_Courtesy = "SELECT SUM(driverCourtesy) as sumCourtesy FROM driverhistory WHERE driverId='".$driverId."'";
		$rs_Courtesy = mysql_query($sql_Courtesy) or trigger_error(mysql_error(),E_USER_ERROR);
		$sum_Courtesy =  mysql_result ($rs_Courtesy,0);
		
		//driverCarLook คะแนนสภาพรถแท๊กซี่ที่ลูกค้าให้ผู้ขับ
		$sql_CarLook = "SELECT SUM(driverCarLook) as sumCarLook FROM driverhistory WHERE driverId='".$driverId."'";
		$rs_CarLook = mysql_query($sql_CarLook) or trigger_error(mysql_error(),E_USER_ERROR);
		$sum_CarLook =  mysql_result ($rs_CarLook,0);
		
		//driverDrivingSkill คะแนนเรื่องการขับขี่ที่ลูกค้าให้ผู้ขับ	
		$sql_DrivingSkill = "SELECT SUM(driverDrivingSkill) as sumDrivingSkill FROM driverhistory WHERE driverId='".$driverId."'";
		$rs_DrivingSkill = mysql_query($sql_DrivingSkill) or trigger_error(mysql_error(),E_USER_ERROR);
		$sum_DrivingSkill =  mysql_result ($rs_DrivingSkill,0);
		?>
	
		 <div class="chat_box" style="border:#CCC 1px solid; border-radius: 5px; margin-top:10px;">
			 <div class="chat_heading clearfix"> รายละเอียดคะแนน </div>      
			 <table id="mytable" class="table table-striped table-bordered table-condensed" style="border:none; margin-bottom:0px;">
			
				<tr>
					<th>คะแนนความตรงต่อเวลาที่ลูกค้าให้ผู้ขับ</th>
					<td><?=$sum_Punctual?></td>
				</tr>
				<tr>
					<th>คะแนนมารยาทของผู้ขับที่ลูกค้าให้</th>
					<td><?=$sum_Courtesy?></td>
				</tr>
				<tr>
					<th>คะแนนสภาพรถแท๊กซี่ที่ลูกค้าให้ผู้ขับ</th>
					<td><?=$sum_CarLook?></td>
				</tr>
				<tr>
					<th>คะแนนเรื่องการขับขี่ที่ลูกค้าให้ผู้ขับ</th>
					<td><?=$sum_DrivingSkill?></td>
				 </tr>           
			</table>
		</div>
        
        
      </div> <!-- span4 -->
      
    </div>
  </div>
</div>






<script src="lib/jquery-ui/jquery-ui-1.8.23.custom.min.js"></script>
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
