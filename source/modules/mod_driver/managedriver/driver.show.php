<!-- datatable -->
<link rel="stylesheet" type="text/css" href="lib/datatables/css/demo_table_jui.css"/>
<script src="lib/datatables/jquery.dataTables.min.js"></script>
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
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').dataTable( {			
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "modules/mod_driver/managedriver/scripts/server_processing.php?garageId=<?=$garageId?>&u_garage=<?=$u_garage?>",
			
			
			"sPaginationType" : "full_numbers",// แสดงตัวแบ่งหน้า
			"bLengthChange": true, // แสดงจำนวน record ที่จะแสดงในตาราง
			"iDisplayLength": 10, // กำหนดค่า default ของจำนวน record 
			"bFilter": true, // แสดง search box
			//"sScrollY": "400px", // กำหนดความสูงของ ตาราง

			"oTableTools": {
				"sRowSelect": "single" // คลิกที่ record มีแถบสีขึ้น
			},
 
			
			"oLanguage": {
				"sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
				"sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
				"sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
				"sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
				"sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
				"sSearch": "ค้นหา :"
			 }
		} );
	} );
</script>

<input type="hidden" name="hide_garageid" id="hide_garageid" value="<?=$garageid?>" />

<div class="row-fluid search_page">
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
    <!--<table cellpadding="0" cellspacing="0" border="0" class="display" id="example"> -->
    <table class="table table-striped table-bordered display" id="example">
      <thead>
        <tr>
          <th style="text-align:center; width:50px">ลำดับ</th>
          <th style="text-align:center">ชื่อ - นามสกุล</th>
          <th style="text-align:center">Username</th>
          <th style="text-align:center; width:120px">เลขประจำตัวประชาชน</th>
          <th style="text-align:center">เลขใบขับขี่</th>
          <th style="text-align:center; width:100px">เบอร์โทรศัพท์</th>
          <th style="text-align:center; width:270px">ชื่ออู่ที่สังกัดอยู่</th>
          <th style="text-align:center; width:110px">วันที่เพิ่มข้อมูล</th>
          <th style="text-align:center; width:70px">การจัดการ</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="9" class="dataTables_empty">กำลังโหลดข้อมูล</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Del POP UP --> 
<!-- POP UP DEL -->
<div class="modal hide fade" id="myModalDel" style="text-align:center; width:500px;">
  <div class="alert alert-block alert-error fade in"> <font color="#000000">
    <h4 class="alert-heading">คุณต้องการลบข้อมูลรถแท๊กซี่ทะเบียน "<span id="carReg"></span>"</h4>
    </font>
    <div style="height:50px;"></div>
    <center>
      <font color="#FF0000"><b>
      <h4>
        <div id="rannum"></div>
      </h4>
      </b></font> กรุณากรอกตัวเลข 4 ตัวด้านบน เพื่อยืนยันการลบ
      <input type="text" id="txtDelConfirm" maxlength="4" onkeyup="chkNumDelete(this.value)" on />
    </center>
    <input type="hidden" name="carId" id="carId_del" value="" />
    <br />
    <a href="#" onclick="">
    <button id="confirmDelBtn" name="confirmDelBtn" disabled="disabled" class="btn btn-danger"><i class="splashy-error"></i> ยืนยันการลบข้อมูล</button>
    </a> หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a> </div>
</div>
<script>
var w,x,y,z,numstr;

function fn_callDel(id,text){
	//console.log(id+' '+text);
	$('#carId_del').val(id);
	$('#carReg').text(text);
	genNumForDel();
	$('#myModalDel').modal('toggle');
}
	
function genNumForDel()
{	
	//generate 4 digit(w-z) in format number 1-9 
	w = Math.floor(Math.random()*10);
	x = Math.floor(Math.random()*10);
	y = Math.floor(Math.random()*10);
	z = Math.floor(Math.random()*10);
	$('#rannum').text(w+' '+x+' '+y+' '+z);
	numstr = w+''+x+''+y+''+z;
	console.log(numstr);
}

function chkNumDelete(value) {
	if(value==numstr){	
		$('#confirmDelBtn').attr("disabled",false);
		$('#txtDelConfirm').attr("disabled",true);
	}
	else
		$('#confirmDelBtn').attr("disabled",true);
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
