 <!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script>

 <div class="row-fluid search_page">
	<div class="span12">
    	<?
		//Select Minor Data
		$minor_data = select_db('minoradmin',"where garageId = '".$u_garage."' order by dateAdded desc");
		$total = count($minor_data);
		
		$major_data = select_db('majoradmin',"where garageId = '".$u_garage."'");
		$major_name = $major_data[0]['thaiCompanyName'];
		?>
 
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">พนักงานของ "<span style="color:#C30; font-weight:bold;"><?=$major_name?></span>" มีจำนวน <strong><?=$total?></strong></div>
     	
                <form action="" name="fm_addminor" id="fm_addminor" method="post">   
                	<input type="hidden" name="act" value="addminor" />             	
                	<div class="pull-right">                  
                        <input type="submit" class="btn btn-success" name="btnSubmit" id="btnSubmit" value="เพิ่มพนักงาน">
              	 	</div>              
                </form>
                
            </div>
        </div>
        
  		
  		
  
		<? if ($total != 0){ ?>
        
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px;">ลำดับ</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>อีเมล์</th>
                        <th>ตำแหน่งงาน</th>
                        <th>วันที่เพิ่ม</th>
                        <th>เครื่องมือ</th>
                    </tr>
                </thead>
                <tbody>
                    
                        
                    
                    <? 
                    $i = 0;
                    while ($i < $total) {                 
                        ?>
                        <tr>                   
                            <td style="text-align:center;"><?=$i+1?></td>
                            <td><?=$minor_data[$i]['firstName']?>  <?=$minor_data[$i]['lastName']?></td>
                            <td>
                            	<?
                                $province_data = select_db('province',"where provinceId = '".$minor_data[$i]['provinceId']."'");
								$province_name = $province_data[0]['provinceName'];		
								
								$amphur_data = select_db('amphur',"where amphurId = '".$minor_data[$i]['amphurId']."'");
								$amphur_name = $amphur_data[0]['amphurName'];	
								
								$district_data = select_db('district',"where districtId = '".$minor_data[$i]['districtId']."'");
								$district_name = $district_data[0]['districtName'];			
								?>  
                                                            
								<?=$minor_data[$i]['address']?> <?=$district_name?> <?=$amphur_name?> <?=$province_name?>, <?=$minor_data[$i]['zipcode']?>
                            </td>
                            <td><?=$minor_data[$i]['telephone']?></td>
                            <td><?=$minor_data[$i]['email']?></td>
                            <td>
                            	<?
                                $type_data = select_db('minortype',"where minorTypeId = '".$minor_data[$i]['minorTypeId']."'");
								$type_name = $type_data[0]['minorType'];						
								?>                               
                                <div><?=$type_name?></div>
                            </td>                            
                            <td><?=Thai_date($minor_data[$i]['dateAdded'])?></td>
                            <td>                            	
                                <div style="float:left; margin-right:5px;">
                                <form action="" method="post" name="fmEdit<?=$i?>" id="fmEdit<?=$i?>">
                                	<input type="hidden" name="minorId" value="<?=$minor_data[$i]['minorId']?>" />
                                    <input type="hidden" name="act" value="editminor" />
                               		<a href="#" class="ttip_t" title="Edit" onClick="fmEdit<?=$i?>.submit();" ><i class="icon-pencil"></i></a>
                                </form>
                                </div>
                                <div style="float:left;">
                                	<a href="#myModalDel<?=$minor_data[$i]['minorId']?>" class="ttip_t" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                                </div>
                                <div id="div_lock<?=$minor_data[$i]['minorId']?>" style="float:left; margin-left:5px;">
                                <?
								if ($minor_data[$i]['lock'] == 0) {
									?>
									<a href="#" class="ttip_t" title="สถานะล๊อค" onclick="fn_changeLock('<?=$minor_data[$i]['minorId']?>',1);"><i class="splashy-thumb_down"></i></a>
									<?
								} else {
									?>
									<a href="#" class="ttip_t" title="สถานะไม่ล๊อค" onclick="fn_changeLock('<?=$minor_data[$i]['minorId']?>',0);"><i class="splashy-thumb_up"></i></a>
									<?
								}
								?>
                                </div>
                            </td>
                          
                        </tr>
                        
                        <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$minor_data[$i]['minorId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบข้อมูลพนักงาน "<?=$minor_data[$i]['firstName']?>  <?=$minor_data[$i]['lastName']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$minor_data[$i]['minorId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
                                หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a>
                               	</p>
                            </div>
                        </div>
                        
                        <? 
                        $i++;
                    } ?>
                   
                </tbody>
            </table>

         <? } else {  ?>
         
            <div style="text-align:center;">
                <strong>ยังไม่มีข้อมูลพนักงาน!</strong>
            </div>
            
         <? } ?>

        
    </div>
 </div>
 
 
 
<script type="text/javascript">

	function fn_formDel(id){
		jQuery.ajax({
			url :'modules/mod_user/minor/delminor.php',
			type: 'GET',
			data: 'act=delminor&id='+id+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.success);
				if (data.success){ 
					alertPopup('msg3','alert3',''+data.message+'',1);
				} else {
					alertPopup('msg2','alert2',''+data.message+'',0);
				}				
				
				$('#myModalDel'+id+'').modal('toggle');
			}
		});	
	}
	
	
	function fn_changeLock(id,sval){
		$.post('modules/mod_user/minor/edit.statuslock.php', {status:sval, id:id} , function(data) {
			$('#div_lock'+id+'').html(data);	
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


 