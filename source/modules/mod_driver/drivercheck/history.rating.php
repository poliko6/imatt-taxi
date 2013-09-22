<?
//จาก driverhistory รวมคะแนน

$sql_Punctual = "SELECT SUM(driverPunctual) as sumPunctual FROM driverhistory WHERE driverId='".$driverId."'";
$rs_Punctual = mysql_query($sql_Punctual) or trigger_error(mysql_error(),E_USER_ERROR);
$sum_Punctual =  mysql_result ($rs_Punctual,0);

$sql_Courtesy = "SELECT SUM(driverCourtesy) as sumCourtesy FROM driverhistory WHERE driverId='".$driverId."'";
$rs_Courtesy = mysql_query($sql_Courtesy) or trigger_error(mysql_error(),E_USER_ERROR);
$sum_Courtesy =  mysql_result ($rs_Courtesy,0);

$sql_Collaborate = "SELECT SUM(driverPunctual) as sumCollaborate FROM driverhistory WHERE driverId='".$driverId."'";
$rs_Collaborate = mysql_query($sql_Collaboratel) or trigger_error(mysql_error(),E_USER_ERROR);
$sum_Collaborate =  mysql_result ($rs_Collaborate,0);
?>
<div class="row-fluid">
 	<div class="span3"></div>
     <div class="span6 chat_sidebar">
         <div class="chat_heading clearfix"> รายละเอียดคะแนน </div>      
         <table id="mytable" class="table table-striped table-bordered table-condensed">
        
            <tr>
                <th>คะแนนความตรงต่อเวลาที่ผู้ขับให้ลูกค้า</th>
                <td><?=$sum_Punctual?></td>
            </tr>
            <tr>
                <th>คะแนนการให้ความร่วมมือที่ผู้ขับให้ลูกค้า</th>
                <td><?=$sum_Courtesy?></td>
            </tr>
            <tr>
                <th>คะแนนความตรงต่อเวลาที่ลูกค้าให้ผู้ขับ</th>
                <td><?=$sum_Punctual?><  /td>
            </tr>
            <tr>
                <th>คะแนนสภาพรถแท๊กซี่ที่ลูกค้าให้ผู้ขับ</th>
                <td>0</td>
             </tr>
            <tr>
                <th>คะแนนมารยาทของผู้ขับที่ลูกค้าให้</th>  
                <td>0</td>
            </tr>
            <tr>
                <th>คะแนนเรื่องการขับขี่ที่ลูกค้าให้ผู้ขับ</th> 
                <td>0</td>           
            </tr>   
           
        </table>
    </div>
    <div class="span3"></div>
</div>
