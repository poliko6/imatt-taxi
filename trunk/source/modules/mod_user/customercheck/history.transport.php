<?
$sql_history = "SELECT * FROM customermap ";
$sql_history .= "WHERE timeServer LIKE '".$dateSearch."%' AND customerId = '".$customerId."' ";
$rs_history = mysql_query($sql_history);
$founddata1 = mysql_num_rows($rs_history);
//echo $sql_history ;
?>



<script type="text/javascript" charset="utf-8">
	  
	$(document).ready(function() {
		var oTable1 = $('#example1').dataTable( {			
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "modules/mod_user/customercheck/scripts/server_processing.php?customerId=<?=$customerId?>&dateSearch=<?=$dateSearch?>",
			
			
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




<? if ($founddata1 > 0) { ?>
      
        <table class="table table-striped table-bordered display" id="example1">
            <thead>
                <tr>
                    <th width="10%">ลำดับ</th>
                    <th>ชื่อลูกค้า</th>
                    <th>สถานที่อยู่</th>
                    <th>วันที่</th>   
                    <th>เวลา</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="dataTables_empty">กำลังโหลดข้อมูล</td>
                </tr>
            </tbody>	
         </table>          
	
<? } else {  ?>
    <div style="text-align:center;">
        <strong>ไม่พบข้อมูลการเดินทางในวันนี้!</strong>
    </div>
<? } ?>