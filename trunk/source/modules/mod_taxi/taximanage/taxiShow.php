<!-- datatable -->
<link rel="stylesheet" type="text/css" href="lib/datatables/css/demo_table_jui.css"/> 
<script src="lib/datatables/jquery.dataTables.min.js"></script>


<?
//Case Supervisor
if ($u_garage == 1) {
						
	if ($garageId == ''){
		$car_data = count_data_mysql('carId','car','1');
	} else {
		$car_data = count_data_mysql('carId','car',"garageId = '".$garageId."'");
	}			
	
} else { //Case Garage
	$car_data = count_data_mysql('carId','car',"garageId = '".$u_garage."'");
	$garageId  = $u_garage;
}
$total = $car_data;


///=====Data Major
if ($garageId == ''){ 
	$major_name = 'ทั้งหมด';
} else {
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
			"sAjaxSource": "modules/mod_taxi/taximanage/scripts/server_processing.php?garageId=<?=$garageId?>",
			
			
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

 

     <div class="row-fluid search_page">
        <div class="span12">
        
            <div class="well clearfix">
                <div class="row-fluid">
                    <div class="pull-left">รายการรถแท๊กซี่ของ "<span style="color:#C30; font-weight:bold;"><?=$major_name?></span>" มีจำนวน <strong><?=$total?></strong></div>
                        
                    <form action="index.php?p=taxi.taximanage&menu=main_taxi" name="fm_selectmajor" id="fm_selectmajor" method="post">                	
                        <div class="pull-right"> 
                        
                            <? 
                            if ($u_garage == 1) { 
                                $major_data_list = select_db('majoradmin',"order by dateAdded desc");
                                ?> 
                                <select name="garageId" id="garageId" onchange="fm_selectmajor.submit();" style="width:250px;">
                                    <option value="">ทั้งหมด</option>
                                    <? foreach($major_data_list as $valMajor){?>
                                        <option value="<?=$valMajor['garageId']?>" <? if ($garageId == $valMajor['garageId']) { echo "selected=\"selected\""; } ?> ><?=$valMajor['thaiCompanyName']?></option>
                                    <? } ?>
                                </select>	        
                            <? } else { ?>	
                                <input type="hidden" name="garageId" value="<?=$garageId?>" /> 
                            <? } ?>		
        
                            <input type="button" class="btn btn-success" name="btnSubmit" id="btnSubmit" onClick="fn_goToPage('add');" value="เพิ่มรถแท๊กซี่">
    
                        </div>
                  
                    </form>
                </div>
            </div>
            
            <!--<table cellpadding="0" cellspacing="0" border="0" class="display" id="example"> -->
            <table class="table table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th width="10%">รูปรถ</th>
                        <th width="30%">ชื่ออู่รถ</th>
                        <th width="12%">ทะเบียนรถ</th>
                        <th width="18%">รายละเอียดรถ</th>   
                        <th width="7%">สถานะ</th>
                        <th width="13%">วันที่เพิ่ม</th>
                        <th width="10%">เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="dataTables_empty">กำลังโหลดข้อมูล</td>
                    </tr>
                </tbody>	
            </table>
        </div>
     </div>
     
     
     
    <!-- POP UP DEL -->
    <div class="modal hide fade" id="myModalDel" style="text-align:center; width:500px;">
        <div class="alert alert-block alert-error fade in">
            <h4 class="alert-heading">คุณต้องการลบข้อมูลรถแท๊กซี่ทะเบียน "<span id="carReg"></span>"</h4>
            <div style="height:50px;"></div>
            <p>
            <input type="hidden" name="carId" id="carId_del" value="" />
            <a href="#" class="btn btn-inverse" onclick="fn_formDel();"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
            หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a>
            </p>
        </div>
    </div> 
     
     
    <form action="" method="post" name="fm_Edit" id="fm_Edit">
        <input type="hidden" name="carId" id="carId_edit" value="" />
        <input type="hidden" name="garageId" id="garageId_edit"  value="" />
        <input type="hidden" name="act" value="edittaxi" />
    </form>
     
    <script type="text/javascript">
        
        function fn_callDel(id,text){
            //console.log(id+' '+text);
            $('#carId_del').val(id);
            $('#carReg').text(text);
            $('#myModalDel').modal('toggle');
        }
        
        function fn_formDel(){
            //$('#myModalDel').modal('toggle');
            var id = $('#carId_del').val();
            jQuery.ajax({
                url :'modules/mod_taxi/taximanage/deltaxi.php',
                type: 'GET',
                data: 'act=deltaxi&id='+id+'',
                dataType: 'jsonp',
                dataCharset: 'jsonp',
                success: function (data){
                    console.log(data.success);
                    if (data.success){ 
                        alertPopup('msg3','alert3',''+data.message+'',1);
                    } else {
                        alertPopup('msg2','alert2',''+data.message+'',0);
                    }				
                    
                    $('#myModalDel').modal('toggle');
                }
            });	
        }
        
        
        function fn_Edit(id,garageid){
            //console.log(id+' '+garageid);
            $('#carId_edit').val(id);
            $('#garageId_edit').val(garageid);
            $('#fm_Edit').submit();
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