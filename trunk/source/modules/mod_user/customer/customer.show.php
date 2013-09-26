<!-- datatable -->
<link rel="stylesheet" type="text/css" href="lib/datatables/css/demo_table_jui.css"/>
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<?php
		//Case Supervisor
		$strSQL = "SELECT * FROM customer";
		$strQuery = mysql_query($strSQL);
		$total = mysql_num_rows($strQuery);

		if (empty($current_page)){ $current_page = 0;}
		?>

<script type="text/javascript" charset="utf-8">

	var current_page = <?=$current_page?>;	
	
	 $.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
      {
        return {
          "iStart":         oSettings._iDisplayStart,
          "iEnd":           oSettings.fnDisplayEnd(),
          "iLength":        oSettings._iDisplayLength,
          "iTotal":         oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
          "iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
        };
      };
	  
	$(document).ready(function() {
		var oTable = $('#example').dataTable( {			
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "modules/mod_user/customer/scripts/server_processing.php",
			
			
			"sPaginationType" : "full_numbers",// แสดงตัวแบ่งหน้า
			"bLengthChange": true, // แสดงจำนวน record ที่จะแสดงในตาราง
			"iDisplayLength": 10, // กำหนดค่า default ของจำนวน record 
			"bFilter": true, // แสดง search box
			"iDisplayStart" : current_page,
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
			 },
			 
			 "fnDrawCallback": function (oSettings) {
				//console.log( '_iDisplayStart : '+ oSettings._iDisplayStart );
				//console.log( 'Now on page : '+ this.fnPagingInfo().iPage );
				//$('#current_pageAdd').val(oSettings._iDisplayStart);
				$('#current_pageEdit').val(oSettings._iDisplayStart);	
				$('#current_pageLoad').val(oSettings._iDisplayStart);	
			}
			 
		});
		
		var oSettings = oTable.fnSettings();
            oSettings._iDisplayStart = current_page;
	});
</script>


<div class="row-fluid search_page">
  <div class="span12">
    <h3 class="heading">รายชื่อข้อมูลลูกค้า</h3>
    <div class="well clearfix"  style="padding-bottom:0px;">
      <div class="pull-left" style="margin-right:5px;">รายการข้อมูลมีจำนวน <strong>
        <?=$total?>
        </strong> รายการ</div>
      <div class="pull-right">
        <form action="" method="post">
          <input type="hidden" name="act" value="add" />
          <input class="btn btn-success" type="submit" value="เพิ่มข้อมูลลูกค้า" />
        </form>
      </div>
    </div>
    <!--<table cellpadding="0" cellspacing="0" border="0" class="display" id="example"> -->
    <table class="table table-striped table-bordered display" id="example" style="font-size:12px;">
      <thead>
        <tr>
          <th style="text-align:center;" width="5%">ลำดับ</th>
          <th style="text-align:center" width="12%">ชื่อ - นามสกุล</th>
          <th style="text-align:center" width="8%">E-mail</th>
          <th style="text-align:center;" width="10%">เลขประจำตัวประชาชน</th>
          <th style="text-align:center" width="9%">เครดิตคงเหลือ</th>
          <th style="text-align:center;" width="9%">เบอร์โทรศัพท์</th>
          <th style="text-align:center;" width="10%">วันที่เพิ่มข้อมูล</th>
          <th style="text-align:center;" width="5%">การจัดการ</th>
          <th style="text-align:center" width="4%">สถานะล็อค</th>
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

<!-- POP UP --> 
<!-- POP UP ADD CREDIT -->
<div class="modal hide fade" id="myModalAddCre" style="text-align:center; width:500px;">
  <div class="alert alert-block alert-error fade in"> <font color="#000000">
    <h4 class="alert-heading">คุณต้องการเพิ่มเครดิตของผู้ขับชื่อ "<span id="addCreName"></span>"</h4>
    </font>
    <div style="height:50px;"></div>
    <center>
    <font color="#003300"><b>จำนวนเครดิตที่ต้องการ : </b></font>
    <input type="text" id="credits_val" onchange="chkCreditVal(this.id,this.value)" />
    <font color="#FF0000"><i><div id="credits_valchk"></div></i></font>
    <br /><br />
      <font color="#FF0000"><b>
      <h4>
        <div id="rannumadd"></div>
      </h4>
      </b></font><i class="help-block">กรุณากรอกตัวเลข 4 ตัวด้านบน เพื่อยืนยันการเพิ่มเครดิต</i>
      <input type="text" style="text-align:center" id="txtAddConfirm" maxlength="4" onkeyup="chkNumAddCredit(this.value)" on />
    </center>
    <input type="hidden" name="customerId_addCre" id="customerId_addCre" value="" />
    <br />
    <a href="#" onclick="addCredits()">
    <button id="confirmAddCreBtn" name="confirmAddCreBtn" disabled="disabled" class="btn btn-danger"><i class="splashy-error"></i> ยืนยันการเพิ่มเครดิต</button>
    </a> หรือ <a href="#" id="cancelAddCreBtn" onclick="reset_addmodal()" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a> </div>
</div>

<form action="index.php?p=user.customer&menu=main_user" method="post" name="fm_Edit" id="fm_Edit">
	<input type="hidden" name="current_page" id="current_pageEdit" value="" />
    <input type="hidden" name="customerId" id="customerId_edit" value="" />
    <input type="hidden" name="garageId" id="garageId_edit"  value="" />
    <input type="hidden" name="act" value="edit" />    
</form>

<script>
var w,x,y,z,numstr;


function fn_Edit(id,garageid){
	//console.log(id+' '+garageid);
	$('#customerId_edit').val(id);
	$('#garageId_edit').val(garageid);
	$('#fm_Edit').submit();
}

// >>>>>>>>>>>>>>>>> Function Add Credits Part <<<<<<<<<<<<<
function fn_addCredit(id,text) {
	//console.log(id+' '+text);
	$('#customerId_addCre').val(id);
	$('#addCreName').text(text);
	genNumForAdd();
	reset_addmodal();
	$('#myModalAddCre').modal('toggle');	
}
function reset_addmodal() {
	$('#txtAddConfirm').val("");
	$('#txtAddConfirm').attr("disabled",false);
	$('#confirmAddCreBtn').attr("disabled",true);
	$('#cancelAddCreBtn').attr("disabled",false);
	$('#credits_val').val("");
	$('#credits_valchk').text("");
}
function addCredits() {
	$('#confirmAddCreBtn').attr("disabled",true);
	$('#cancelAddCreBtn').attr("disabled",true);
	customerId = $('#customerId_addCre').val();
	credits_val = $('#credits_val').val();
		jQuery.ajax({
			url :'modules/mod_user/customer/addCredits.php',
			type: 'GET',
			data: 'customerId='+customerId+'&credits='+credits_val+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.success);
				if (data.success){ 
					reloadPage();
				} else {
					reloadPage();					
				}	
				$('#myModalDel').modal('toggle');
			}
		});		
	
}
function genNumForAdd()
{	
	//generate 4 digit(w-z) in format number 1-9 
	w = Math.floor(Math.random()*10);
	x = Math.floor(Math.random()*10);
	y = Math.floor(Math.random()*10);
	z = Math.floor(Math.random()*10);
	$('#rannumadd').text(w+' '+x+' '+y+' '+z);
	numstr = w+''+x+''+y+''+z;
	console.log(numstr);
}
function chkNumAddCredit(value) {
	if(value==numstr && $('#credits_val').val() != '') {	
		$('#confirmAddCreBtn').attr("disabled",false);
		$('#txtAddConfirm').attr("disabled",true);
	}
	else
		$('#confirmAddCreBtn').attr("disabled",true);
}
function chkCreditVal(id,value) {
	$('#confirmAddCreBtn').attr("disabled",true);	
	var chkFormat = numberOrNot(id,value);
	if($('#txtAddConfirm').val() ==numstr && chkFormat != false && $('#'+id+'').val() != '')	
	{
		$('#confirmAddCreBtn').attr("disabled",false);
	}
}
/////////////////////////////////////////////////////

function numberOrNot(id,number){
	
	number = jQuery.trim(number)
	if ( /[^0-9-]/.test(number))
	{	$('#'+id+"chk").text("กรุณาใส่เฉพาะตัวเลข");
		$('#'+id).val("");
		return false;		
	}
	else
	{
		$('#'+id+"chk").text("");
		return true;
	}
}

function fn_changeLock(id,sval){
	$.post('modules/mod_user/customer/edit.statuslock.php', {status:sval, id:id} , function(data) {			  
		//window.location = 'index.php?p=mobile.managemobile&menu=main_mobile&garageId=<?=$garageId?>'; 
		reloadPage();
	});	
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
