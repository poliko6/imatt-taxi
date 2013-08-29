<?php 
$cls_dri = new driver_taxi();
$cls_dri->show_alldriver();

?>


<table class="table table-striped table-bordered dTableR" id="dt_a">
 <thead>
<tr>
<th>ลำดับ</th>
<th>รูป</th>
<th>ชื่อ</th>
<th>นามสกุล</th>
<th>รหัสใบขับขี่</th>
<th>โืทรศัพท์</th>
<th>มือถือ</th>
<th>ที่อยู่</th>
<th>แก้ไข</th>
<th>ลบ</th>
</tr>
 </thead>
 <tbody>
<?php 
for($i = 1 ;$i <= $cls_dri->get_row() ;$i++)
{
?>
<tr>

<td class=""><?php echo $i;?></td>
<td>
		<?php 
		
               if ($cls_dri->get_driverImage($i) == ''){
									$pathimage  = 'gallery/Image10_tn.jpg'; 	
								} else {
									$pathimage  = 'stored/driver/'.$cls_dri->get_driverImage($i);
									if (file_exists($pathimage)) {  //check file			
										$pathimage  = 'stored/driver/'.$cls_dri->get_driverImage($i);
									} else { 						
										$pathimage  = 'gallery/Image10_tn.jpg'; 	
									}
									
									
									$pathimage2  = 'stored/driver/thumbnail/'.$cls_dri->get_driverImage($i);
									if (file_exists($pathimage2)) {  //check file			
										$pathimage2  = 'stored/driver/thumbnail/'.$cls_dri->get_driverImage($i);
									} else { 						
										$pathimage2  = 'gallery/Image10_tn.jpg'; 	
									}
									
									
								}
								

?>


<a href="<?=$pathimage?>" title="<?php echo $cls_dri->get_driverImage($i)?>" class="cbox_single thumbnail">
   <img alt="" src="<?=$pathimage2?>" style="height:50px;width:80px">
   </a>
   </td>
<td><?php echo $cls_dri->get_firstName($i);?></td>
<td><?php echo $cls_dri->get_lastname($i);?></td>
<td><?php echo $cls_dri->get_licenseNumber($i);?></td>
<td><?php echo $cls_dri->get_telephone($i);?></td>
<td><?php echo $cls_dri->get_mobilePhone($i);?></td>
<td><?php echo $cls_dri->get_address($i);?></td>
<td><a href="#" data-toggle="modal" data-backdrop="static" title="Edit" onclick="fn_formEdit(<?=$car_type[$i]['carTypeId']?>, 'select');"><i class="icon-pencil"></i></a></td>
<td>
	
    <a href="#myModalDel<?=$car_type[$i]['carTypeId']?>" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
</td>
 <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$car_type[$i]['carTypeId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบข้อมูลประเภทรถ "<?=$car_type[$i]['carTypeName']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <!--<a href="index.php?p=car.type&menu=main_car&act=del&id=<?=$car_type[$i]['carTypeId']?>" class="btn btn-inverse"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a>  -->
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$car_type[$i]['carTypeId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
                                หรือ 
                                <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a></p>
                            </div>
                        </div>
</tr>
<?php } ?>
</tbody>
</table>


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
