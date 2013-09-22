<?
//จาก driverhistory
?>

<? if ($founddata2 > 0) { ?>
       
 <table id="mytable" class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อผู้โดยสาร</th>
            <th>สถานที่เรียก</th>
            <th>สถานที่ปลายทาง</th>
            <th>วันที่</th>
            <th>คะแนน</th>  
            <th>สถานะการรับผู้โดยสาร</th>            
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
            <td style="background-color:<?=$bgcolor?>;">Summer Throssell</td>
        </tr>        
    </tbody>
</table>
<? } else {  ?>
    <div style="text-align:center;">
        <strong>ไม่พบข้อมูลการรับผู้โดยสารในวันนี้!</strong>
    </div>
<? } ?>