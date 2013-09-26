<?
//จาก driverhistory
$sql_passenger = "SELECT * FROM driverhistory ";
$sql_passenger .= "INNER JOIN drivertaxi ON drivertaxi.driverId = driverhistory.driverId ";
$sql_passenger .= "WHERE (callTime BETWEEN '".$dateStart."' AND '".$dateEnd."') AND customerId = '".$customerId."' ";

$rs_passenger = mysql_query($sql_passenger);
$founddata2 = mysql_num_rows($rs_passenger);
//echo $sql_passenger;
?>


<script type="text/javascript" charset="utf-8">
	  
	$(document).ready(function() {
		var oTable2 = $('#example2').dataTable( {			
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "modules/mod_user/customercheck/scripts/server_processing2.php?customerId=<?=$customerId?>&dateStart=<?=$dateStart?>&dateEnd=<?=$dateEnd?>",
			
			
			"sPaginationType" : "full_numbers",// แสดงตัวแบ่งหน้า
			"bLengthChange": true, // แสดงจำนวน record ที่จะแสดงในตาราง
			"iDisplayLength": 10, // กำหนดค่า default ของจำนวน record 
			"bFilter": true, // แสดง search box
			//"iDisplayStart" : current_page,
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

	});
</script>


<style type="text/css">
.dataTables_paginate{
	padding:10px;
}
</style>



<? if ($founddata2 > 0) { ?>
       
	<table class="table table-striped table-bordered display" id="example2">
        <thead>
            <tr>
                <th width="10%">ลำดับ</th>
                <th>ชื่อคนขับ</th>
                <th>สถานเริ่มต้น</th>
                <th>สถานปลายทาง</th>
                <th>ความคิดเห็นของคนขับ</th>
                <th>วันที่</th>   
                <th>เวลา</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" class="dataTables_empty">กำลังโหลดข้อมูล</td>
            </tr>
        </tbody>	
     </table>      
     
<? } else {  ?>
    <div style="text-align:center;">
        <strong>ไม่พบข้อมูลการโดยสารในวันนี้!</strong>
    </div>
<? } ?>