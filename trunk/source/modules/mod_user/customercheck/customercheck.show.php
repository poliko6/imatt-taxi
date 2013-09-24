<?
$data_search = select_db('customer',"where customerId = '".$customerId."'"); 
$firstName = $data_search[0]['firstName'];
$lastName = $data_search[0]['lastName'];
$citizenId = $data_search[0]['citizenId'];
$location = $data_search[0]['location'];
$birthday = $data_search[0]['birthday'];
$telephone = $data_search[0]['telephone'];
$gender = $data_search[0]['gender'];
$username = $data_search[0]['email'];
$lock = $data_search[0]['lock'];


//B Day
$p_bday = explode('/',$birthday);	

$thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
				 "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");	


if ($gender == 'female'){
	$gender = 'หญิง';
} else {
	$gender = 'ชาย';
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



<?
//Dsta EX
$customerId = 1;
if (empty($dateSearch)) {
	//$dateSearch = date('Y-m-d');;
	$dateSearch = '2013-09-05';
}
?>


<form action="" name="fmReload" id="fmReload" method="post">
	<input type="hidden" name="customerId" value="<?=$customerId?>" />
    <input type="hidden" name="dateSearch" id="dateSearch" value="<?=$dateSearch?>" />
</form>



<!-- datatable -->
<link rel="stylesheet" type="text/css" href="lib/datatables/css/demo_table_jui.css"/> 
<script src="lib/datatables/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(function(){
	$('#dateShow').change(function () {
		//console.log($('#dateShow').val());
		var thisdate = $('#dateShow').val();
	    $('#dateSearch').val(thisdate);
		$('#fmReload').submit();
	});
});
</script>



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
              
            </div><!--chat_content -->
        
            <div class="span4 pull-right" style="padding-top:10px;">                    
                <div><strong>เลือกวันที่ต้องการดู </strong>: &nbsp;</div>
                <div class="controls input-append date" id="dp2" data-date-format="yyyy-mm-dd">                    	
                    <input type="text" id="dateShow" name="dateShow" readonly="readonly" value="<?=$dateSearch?>" />
                    <span class="add-on"><i class="splashy-calendar_day"></i></span>
                </div>                
            </div>  
            
            <div style="clear:both;"></div>
        
            <div class="tabbable" style="margin-top:10px; margin-bottom:10px;">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">ประวัติการเดินทาง</a></li>
                    <li><a href="#tab2" data-toggle="tab">ประวัติการโดยสาร</a></li>
                </ul>
                
                <div class="tab-content">               
                    <div class="tab-pane active" id="tab1">
                        <div class="row-fluid">
                            <? include('modules/mod_user/customercheck/history.transport.php'); ?>
                        </div>
                    </div>
                    
                    
                    <div class="tab-pane" id="tab2">
                        <div class="row-fluid">
                            <? include('modules/mod_user/customercheck/history.passenger.php'); ?>
                        </div>
                    </div>             
                </div> <!--tab-content -->
            </div> <!--tabbable -->
        
        
        </div>  <!--span8 --> 
         
         
            
        <div class="span4">
            <div class="chat_sidebar">
                <div class="chat_heading clearfix"> รายละเอียดส่วนตัว </div>
                <table class="table table-striped table-bordered" style="margin-bottom:0px; border:none;">           
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
                    <th>เพศ : </th>
                    <td><?=$gender?></td>
                  </tr>
                  <tr>
                    <th>วันเกิด : </th>
                    <td><?=$p_bday[0].' '.$thMonth[$p_bday[1]-1].' '.$p_bday[2];?></td>
                  </tr>          
                  <tr>
                    <th>ที่อยู่ : </th>
                    <td><?=$location?></td>
                  </tr>                    
                  <tr>
                    <th>เบอร์โทรศัพท์ : </th>
                    <td><?=$telephone?></td>
                  </tr>
                  
                 
                  <? if ($u_garage == 1){ ?>             
                  <tr>
                    <th>สถานะ : </th>
                    <td id="div_lock">
                    
                        <?
                        if ($lock == 0) {
                            ?>
                            <a href="#" class="ttip_t" title="สถานะล๊อค" onclick="fn_changeLock('<?=$customerId?>',1);"><i class="splashy-lock_large_locked"></i></a>
                            <?
                        } else {
                            ?>
                            <a href="#" class="ttip_t" title="สถานะไม่ล๊อค" onclick="fn_changeLock('<?=$customerId?>',0);"><i class="splashy-lock_large_unlocked"></i></a>
                            <?
                        }
                        ?>
                      
                    </td>
                  </tr>
                  <? } ?>
                  
                </table> 
            
            </div>    
              
                 
                 
            <?
            $sql_Punctual = "SELECT SUM(customerPunctual) as sumPunctual FROM driverhistory WHERE customerId='".$customerId."'";
			$rs_Punctual = mysql_query($sql_Punctual) or trigger_error(mysql_error(),E_USER_ERROR);
			$sum_Punctual =  mysql_result ($rs_Punctual,0);
			
			//driverCourtesy คะแนนมารยาทของผู้ขับที่ลูกค้าให้
			$sql_Collaborate= "SELECT SUM(customerCollaborate) as sumCollaborate FROM driverhistory WHERE customerId='".$customerId."'";
			$rs_Collaborate = mysql_query($sql_Collaborate) or trigger_error(mysql_error(),E_USER_ERROR);
			$sum_Collaborate =  mysql_result ($rs_Collaborate,0);
			?>          
            <div class="chat_box" style="border:#CCC 1px solid; border-radius: 5px; margin-top:10px;">
                <div class="chat_heading clearfix"> รายละเอียดคะแนน </div>      
                <table id="mytable" class="table table-striped table-bordered table-condensed" style="border:none; margin-bottom:0px;">
                    <tr>
                        <th>คะแนนความตรงต่อเวลาที่ผู้ขับให้ลูกค้า</th>
                        <td><?=$sum_Punctual?></td>
                    </tr>
                    <tr>
                        <th>คะแนนการให้ความร่วมมือที่ผู้ขับให้ลูกค้า</th>
                        <td><?=$sum_Collaborate?></td>
                    </tr>                  
                </table>
            </div>       
        </div>
        
    </div>
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
