<?
//$data_historsy = select_db('drivertaxi',"where driverId = '".$driverId."'"); 
//เลือกวัน
//ค้นหา transportsection -> mobileId
//เอาข้อมูลจาก taxiposition -> date + mobileId 

$sql_history = "SELECT * FROM taxiposition ";
$sql_history .= "INNER JOIN transportsection ON taxiposition.mobileId = transportsection.mobileId ";
$sql_history .= "WHERE taxiposition.timeServer LIKE '".$dateSearch."%' AND transportsection.driverId = '".$driverId."' ";

$rs_history = mysql_query($sql_history);
$founddata1 = mysql_num_rows($rs_history);

//$data_driver = select_db('drivertaxi',"Where driverId = '".$driverId."'");
//$nameDriver = $data_driver[0]['firstName'].'  '.$data_driver[0]['lastName'];
?>



<script type="text/javascript" charset="utf-8">
	  
	$(document).ready(function() {
		var oTable1 = $('#example1').dataTable( {			
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "modules/mod_driver/drivercheck/scripts/server_processing.php?driverId=<?=$driverId?>&dateSearch=<?=$dateSearch?>",
			
			
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
                    <th>ชื่อคนขับ</th>
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
         
        <!--<table id="mytable" class="table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อคนขับ</th>
                    <th>สถานที่อยู่</th>
                    <th>วันที่</th>
                    <th>เวลา</th>            
                </tr>
            </thead>
            <tbody>
                <?
                /*$i = 0; 
                while ($data_history = mysql_fetch_object($rs_history)){
                    $i++;
                    $bgcolor = (($i%2)==0)?"#F8F8F8":"#FFFFFF";
                    $datenow = $data_history->timeServer;
                    $pTime = explode(' ',$datenow);
                    $thisTime = $pTime[1];*/
                    ?>
                    <tr>
                        <td style="background-color:<?=$bgcolor?>;"><?=$i?></td>
                        <td style="background-color:<?=$bgcolor?>;"><?=$nameDriver?></td>
                        <td style="background-color:<?=$bgcolor?>;"><?=$data_history->latitude?>, <?=$data_history->longitude?></td>
                        <td style="background-color:<?=$bgcolor?>;"><?=Thai_date($data_history->timeServer);?></td>
                        <td style="background-color:<?=$bgcolor?>;"><?=$thisTime?></td>
                    </tr>  
                <? // } ?>      
            </tbody>
        </table> -->

<? } else {  ?>
    <div style="text-align:center;">
        <strong>ไม่พบข้อมูลการเดินทางในวันนี้!</strong>
    </div>
<? } ?>