<?
//$data_historsy = select_db('drivertaxi',"where driverId = '".$driverId."'"); 
//เลือกวัน
//ค้นหา transportsection -> mobileId
//เอาข้อมูลจาก taxiposition -> date + mobileId 
?>


 <? if ($founddata1 > 0) { ?>
       
 <table id="mytable" class="table table-striped table-bordered table-condensed">
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
    	<? $bgcolor = (($i%2)==0)?"#F8F8F8":"#FFFFFF";  ?>
        <tr>
            <td style="background-color:<?=$bgcolor?>;">134</td>
            <td style="background-color:<?=$bgcolor?>;">Summer Throssell</td>
            <td style="background-color:<?=$bgcolor?>;">summert@example.com</td>
            <td style="background-color:<?=$bgcolor?>;">Summer Throssell</td>
            <td style="background-color:<?=$bgcolor?>;">Summer Throssell</td>
        </tr>        
    </tbody>
</table>
<? } else {  ?>
    <div style="text-align:center;">
        <strong>ไม่พบข้อมูลการเดินทางในวันนี้!</strong>
    </div>
<? } ?>