<!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script>

 <div class="row-fluid search_page">
	<div class="span12">
    	<?
		//Case Supervisor
		if ($u_garage == 1) {
			
			if ($garageId == ''){
				$mobile_data = select_db('mobile',"order by dateAdd desc");
			} else {
				$mobile_data = select_db('mobile',"where garageId = '".$garageId."' order by dateAdd desc");
			}			
			
		} else { //Case Garage
			$mobile_data = select_db('mobile',"where garageId = '".$u_garage."' order by dateAdd desc");
			$garageId  = $u_garage;
		}
		$total = count($mobile_data);
		
		
		///=====Data Major
		if ($garageId == ''){ 
			$major_name = 'ทั้งหมด';
		} else {
			$major_data = select_db('majoradmin',"where garageId = '".$garageId."'");
			$major_name = $major_data[0]['thaiCompanyName'];
			$garageId = $major_data[0]['garageId'];
		}
		?>
        
        <input type="hidden" name="hide_garageid" id="hide_garageid" value="<?=$garageId?>" />
        
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการโทรศัพท์ของ "<span style="color:#C30; font-weight:bold;"><?=$major_name?></span>" มีจำนวน <strong><?=$total?></strong></div>
               	
                
                              	
                <form action="index.php?p=mobile.managemobile&menu=main_mobile" name="fm_selectmajor" id="fm_selectmajor" method="post">                	
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
    
                        <input type="button" class="btn btn-success" name="btnSubmit" id="btnSubmit" onClick="fn_goToPage('add');" value="เพิ่มโทรศัพท์">

              	 	</div>
              
                </form>
            </div>
        </div>
        
  		
  		
  
		<? if ($total != 0){ ?>
        
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px;">ลำดับ</th>
                        <th>เบอร์โทรศัพท์</th>                        
                        <th>Emi/Msi</th>
                        <th>เครือข่าย</th>
                        <th>ชื่ออู่รถ</th>
                        <th>รายละเีอียดโทรศัพท์</th>                       
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
                            <td><?=$mobile_data[$i]['mobileNumber']?></td>                                
                            <td><?=$mobile_data[$i]['EmiMsi']?></td>                 
                            <td>
								<?
                                $this_network = select_db('mobilenetwork',"where mobileNetworkId = '".$mobile_data[$i]['mobileNetworkId']."'");
								$this_network_name = $this_network[0]['mobileNetworkName'];
								?>
                                <div><?=$this_network_name?></div>                                     
                            </td>
                          
                            <td>
								<?
                                $this_major = select_db('majoradmin',"where garageId = '".$mobile_data[$i]['garageId']."'");
								$this_major_name1 = $this_major[0]['thaiCompanyName'];
								$this_major_name2 = $this_major[0]['englishCompanyName'];
								?>
                                <div><?=$this_major_name1?></div>
                                <div style="font-style:italic; color:#999; font-size:11px;"><?=$this_major_name2?></div>
                                
                            </td>  
                            
                            <td>                            
                                <div><strong>ยี่ห้อ</strong> :<?=$mobile_data[$i]['mobileBanner']?></div>
                                <div><strong>รุ่น</strong> :<?=$mobile_data[$i]['mobileModel']?></div>
                            </td>                           
                            <td><?=Thai_date($mobile_data[$i]['dateAdd'])?></td>
                            <td>                            	
                                <div style="float:left; margin-right:5px;">
                                <form action="" method="post" name="fmEdit<?=$i?>" id="fmEdit<?=$i?>">
                                	<input type="hidden" name="mobileId" value="<?=$mobile_data[$i]['mobileId']?>" />
                                    <input type="hidden" name="garageId" value="<?=$mobile_data[$i]['garageId']?>" />
                                    <input type="hidden" name="act" value="editmobile" />
                               		<a href="#" class="ttip_t" title="Edit" onClick="fmEdit<?=$i?>.submit();" ><i class="icon-pencil"></i></a>
                                </form>
                                </div>
                                <div style="float:left;">
                                	<a href="#myModalDel<?=$mobile_data[$i]['mobileId']?>" class="ttip_t" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$mobile_data[$i]['mobileId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบข้อมูลรถโทรศัพท์หมายเลข "<?=$mobile_data[$i]['mobileNumber']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$mobile_data[$i]['mobileId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
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
                <strong>ยังไม่มีข้อมูลโทรศัพท์!</strong>
            </div>
            
         <? } ?>

        
    </div>
 </div>
 
 
 
<script type="text/javascript">

	function fn_formDel(id){
		jQuery.ajax({
			url :'modules/mod_mobile/managemobile/delmobile.php',
			type: 'GET',
			data: 'act=delmobile&id='+id+'',
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