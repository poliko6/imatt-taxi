<!-- datatable -->
<link rel="stylesheet" type="text/css" href="lib/datatables/css/demo_table_jui.css"/> 
<script src="lib/datatables/jquery.dataTables.min.js"></script>


<?
$garageId  = $u_garage;

$cus_calltaxi_data = count_data_mysql('historyId','driverhistory',"statusWork = 'wait' or statusWork = 'waitselect' order by callTime DESC");
$total = $cus_calltaxi_data;

?>

<script type="text/javascript">
	$(document).ready(function(){	

		$(document).on("keydown.NewActionOnF5", function(e){
			var charCode = e.which || e.keyCode;
			switch(charCode){
				case 116: // F5
					e.preventDefault();
					window.location = "index.php?p=<?=$p?>&menu=<?=$menu?>";
					break;
			}
		});	
	});
</script>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var dataTable = $('#example').dataTable( {			
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "modules/mod_taxi/calltaxi/scripts/server_processing.php",
			
			
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
		});
		
	
	 	setInterval(function(){ // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 30 วินาที  
			// 1 วินาที่ เท่า 1000  
			// คำสั่งที่ต้องการให้ทำงาน ทุก ๆ 3 วินาที  
			dataTable.fnDraw(); 
		},3000);      
		
		
	});
	
	
	function callTaxi(cusID,Lat,Lon,historyId){
		//console.log(cusID+','+Lat+','+Lon);		
		//window.location = 'index.php?p=<?=$p?>&menu=<?=$menu?>&act=calltaxi&customerId='+cusID+'&custLat='+Lat+'&custLong='+Lon+'';
		$('#historyId').val(historyId);
		$('#customerId').val(cusID);
		$('#custLat').val(Lat);
		$('#custLong').val(Lon);
		$('#fm_calltaxi').submit();
		
	}
</script>


<form action="" name="fm_calltaxi" id="fm_calltaxi" method="post">
	<input type="hidden" name="customerId" id="customerId" value="" />
    <input type="hidden" name="custLat" id="custLat" value="" />
    <input type="hidden" name="custLong" id="custLong" value="" />
    <input type="hidden" name="historyId" id="historyId" value="" />
    <input type="hidden" name="act" id="act" value="calltaxi" />
</form>

<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td>
        <div class="row-fluid">
            <div class="span12">
                <div class="span1" style="text-align:center;">
                	<div style="border:1px solid #CCC;">
                    	<img src="modules/mod_taxi/images/calltaxi-icon.png" alt="" width="50" height="50"/>
                    </div>
                </div>
                <div class="span4">
                    <div><a href="index.php?p=taxi.calltaxi&menu=main_taxi" style="text-decoration:none;"><?=$lang_menu["taxi.calltaxi"]?></a></div>
                    <div class="normal">เมนูเรียกรถ่ในระบบ ในกับลูกค้า</div>
                </div>
                <div class="span7">
                    <div class="alert" id="alert1" style="display:none; margin-top:5px; margin-bottom:5px;">
                        <a class="close" data-dismiss="alert">×</a>
                        <div id="msg1"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
                    </div>
                    <div class="alert alert-error" id="alert2" style="display:none; margin-top:5px; margin-bottom:5px;">
                        <a class="close" data-dismiss="alert">×</a>
                        <div id="msg2"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
                    </div>
                    <div class="alert alert-success" id="alert3" style="display:none; margin-top:5px; margin-bottom:5px;">
                        <a class="close" data-dismiss="alert">×</a>
                        <div id="msg3"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
                    </div>
                    <div class="alert alert-info" id="alert4" style="display:none; margin-top:5px; margin-bottom:5px;">
                        <a class="close" data-dismiss="alert">×</a>
                        <div id="msg4"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
                    </div>        
                </div>
            </div>
        </div>
	</td>   
  </tr>
  <tr>
  	<td>

    <div class="row-fluid search_page">
        <div class="span12">
            <div class="well clearfix">
                <div class="row-fluid">
                    <div class="pull-left">รายการลุกค้าที่เรียกแท๊กซี่ มีจำนวน <strong><?=$total?></strong></div>
                </div>
            </div>
            
            
             <!--<table cellpadding="0" cellspacing="0" border="0" class="display" id="example"> -->
             <table class="table table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th width="3%">ลำดับ</th>
                        <th width="10%">ชื่อลูกค้า</th>                    
                        <th width="10%">เบอร์โทรติดต่อ</th>  
                        <th width="15%">เวลาเรียก</th> 
                        <th width="32%">ตำแหน่งที่อยู่</th>
                        <th width="15%">สถานะ / รหัสยืนยัน</th>
                        <th width="15%">เครื่องมือ</th>
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

	</td>
  </tr>
</table>   
