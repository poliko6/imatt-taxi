 <!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script>

 <div class="row-fluid search_page">
	<div class="span12">
    	<?
		if ($u_garage == 1) {
			if ($garageid == ''){
				$garageid  = '';
				$car_data = select_db('car',"order by dateAdd desc");
			} else {
				$car_data = select_db('car',"where garageId = '".$garageid."' order by dateAdd desc");
			}
			
			
		} else {
			$car_data = select_db('car',"where garageId = '".$u_garage."' order by dateAdd desc");
			$garageid  = $u_garage;
		}
		$total = count($car_data);
		
		
		///=====Data Major
		if ($garageid == ''){ 
			$major_name = 'ทั้งหมด';
		} else {
			$major_data = select_db('majoradmin',"where garageId = '".$garageid."'");
			$major_name = $major_data[0]['thaiCompanyName'];
			$garageid = $major_data[0]['garageId'];
		}
		
		$major_data_list = select_db('majoradmin',"order by dateAdded desc");
		
		?>
        
        <input type="hidden" name="hide_garageid" id="hide_garageid" value="<?=$garageid?>" />
        
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการรถแท๊กซี่ของ "<span style="color:#C30; font-weight:bold;"><?=$major_name?></span>" มีจำนวน <strong><?=$total?></strong></div>
               	
                
                              	
                <form action="" name="fm_selectmajor" id="fm_selectmajor" method="post">                	
                	<div class="pull-right"> 
                    
						<? if ($u_garage == 1) { ?> 
                        <select name="garageid" id="garageid" onchange="fm_selectmajor.submit();" style="width:250px;">
                            <option value="">ทั้งหมด</option>
							<? foreach($major_data_list as $valMajor){?>
                                <option value="<?=$valMajor['garageId']?>" <? if ($garageid == $valMajor['garageId']) { echo "selected=\"selected\""; } ?> ><?=$valMajor['thaiCompanyName']?></option>
                            <? } ?>
                        </select>	        
                        <? } ?>			
    
                        <input type="button" class="btn btn-success" name="btnSubmit" id="btnSubmit" onClick="fn_goToPage('add','');" value="เพิ่มรถแท๊กซี่">

              	 	</div>
              
                </form>
            </div>
        </div>
        
  		
  		
  
		<? if ($total != 0){ ?>
        
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px;">ลำดับ</th>
                        <th style="width:80px;">รูปรถ</th>
                        <th style="width:200px;">ชื่ออู่รถ</th>
                        <th style="width:150px;">ทะเบียนรถ</th>
                        <th style="width:200px;">รายละเอียดรถ</th>
                        <th style="width:60px;">สถานะ</th>
                        <th style="width:150px;">วันที่เพิ่ม</th>
                        <th style="width:80px;">เครื่องมือ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                        
                    
                    <? 
                    $i = 0;
                    while ($i < $total) {                 
                        ?>
                        <tr>                   
                            <td style="text-align:center;"><?=$i+1?></td>
                            <td>
                            	<?
								
								//gallery/Image10_tn.jpg
                                if (trim($car_data[$i]['carImage']) == ''){
									$pathimage  = 'gallery/Image10_tn.jpg'; 	
								} else {
									$pathimage  = 'stored/taxi/'.$car_data[$i]['carImage'];
									if (file_exists($pathimage)) {  //check file			
										$pathimage  = 'stored/taxi/'.$car_data[$i]['carImage'];
									} else { 						
										$pathimage  = 'gallery/Image10_tn.jpg'; 	
									}
								}
								?>
                            	<a href="<?=$pathimage?>" title="<?=$car_data[$i]['carRegistration']?>" class="cbox_single thumbnail">
                                    <img alt="" src="<?=$pathimage?>" style="height:50px;width:80px">
                                </a>
							</td>
                             <td>
								<?
                                $this_major = select_db('majoradmin',"where garageId = '".$car_data[$i]['garageId']."'");
								$this_major_name1 = $this_major[0]['thaiCompanyName'];
								$this_major_name2 = $this_major[0]['englishCompanyName'];
								?>
                                <div><?=$this_major_name1?></div>
                                <div style="font-style:italic; color:#999; font-size:11px;"><?=$this_major_name2?></div>
                                
                            </td>
                            <td>
								<?
                                $province_data = select_db('province',"where provinceId = '".$car_data[$i]['provinceId']."'");
								$province_name = $province_data[0]['provinceName'];
								?>
								<div><?=$car_data[$i]['carRegistration']?></div>
                                <div><?=$province_name?></div>
                                
                            </td>
                            <td>
                            	<?
                                $type_data = select_db('cartype',"where carTypeId = '".$car_data[$i]['carTypeId']."'");
								$type_name = $type_data[0]['carTypeName'];
								
								$banner_data = select_db('carbanner',"where carBannerId = '".$car_data[$i]['carBannerId']."'");
								$banner_name = $banner_data[0]['carBannerNameEng'];
								
								$model_data = select_db('carmodel',"where carModelId = '".$car_data[$i]['carModelId']."'");
								$model_name = $model_data[0]['carModelName'];
								
								$gas_data = select_db('cargas',"where carGasId = '".$car_data[$i]['carGasId']."'");
								$gas_name = $gas_data[0]['carGasName'];
								
								$fuel_data = select_db('carfuel',"where carFuelId = '".$car_data[$i]['carFuelId']."'");
								$fuel_name = $fuel_data[0]['carFuelName'];
								
								$color_data = select_db('carcolor',"where carColorId = '".$car_data[$i]['carColorId']."'");
								$color_name = $color_data[0]['carColorName'];
						
								?>
                                <div>ยี่ห้อ :<?=$banner_name?></div>
             					<div>รุ่น :<?=$model_name?></div>
                            </td>
                            <td style="text-align:center;">								
                                <?
                                $status_data = select_db('carstatus',"where carStatusId = '".$car_data[$i]['carStatusId']."'");
								$status_name = $status_data[0]['carStatusName'];
								?>
                                <div><?=$status_name?></div>
                                
                                <? if ($car_data[$i]['carStatusId'] == 1) { ?>
                                <i class="splashy-marker_rounded_green"></i>                       
                                <? } ?>
                                <? if ($car_data[$i]['carStatusId'] == 2) { ?>
                                <i class="splashy-marker_rounded_red"></i>
                                <? } ?>
                                <? if ($car_data[$i]['carStatusId'] == 3) { ?>
                                <i class="splashy-marker_rounded_light_blue"></i>  
                                <? } ?>
                            </td>
                            <td><?=Thai_date($car_data[$i]['dateAdd'])?></td>
                            <td>
                            	<!--<a data-toggle="modal" data-backdrop="static" href="#myModalAdd"> -->
                                <!--<a href="index.php?p=car.type&menu=main_car&act=edit&id=<?=$car_data[$i]['carId']?>" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a> -->
                               	<a href="#" class="ttip_t" title="Edit" onClick="fn_goToPage('edit','<?=$car_data[$i]['carId']?>');" ><i class="icon-pencil"></i></a>
                                
                                <a href="#myModalDel<?=$car_data[$i]['carId']?>" class="ttip_t" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$car_data[$i]['carId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบข้อมูลรถแท๊กซี่ทะเบียน "<?=$car_data[$i]['carRegistration']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$car_data[$i]['carId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
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
                <strong>ยังไม่มีข้อมูลรถแท๊กซี่!</strong>
            </div>
            
         <? } ?>

        
    </div>
 </div>
 
 
 
<script type="text/javascript">

	function fn_formDel(id){
		jQuery.ajax({
			url :'modules/mod_taxi/taximanage/deltaxi.php',
			type: 'GET',
			data: 'act=deltaxi&id='+id+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.success);
				if (data.success){ 
					$('#msg3').text(data.message);
					$('#alert3').fadeIn(500, function() {
						clearTimeout(delayAlert);  
						delayAlert=setTimeout(function(){  
							alertFadeOut('alert3');
							reloadPage(); 
							delayAlert=null;  
						},2000);  
					});
				} else {
					$('#msg2').text(data.message);
					$('#alert2').fadeIn(500, function() {
						clearTimeout(delayAlert);  
						delayAlert=setTimeout(function(){  
							alertFadeOut('alert2'); 
							delayAlert=null;  
						},2000);  
					});
				}
				
				
				$('#myModalDel'+id+'').modal('toggle');
			}
		});	
	}
	

	
	function fn_formEdit(id,process){
		//console.log(id);
		
		if (process == 'select') {
			$.post("modules/mod_car/model/getmodel.php", { 
					process: process,
					id: id
				}, 
				function(data){
					$("#model_name_edit").val(data);
					$("#temp").val(data);
					$("#modelid").val(id);
				}
			);
			
			$('#myModalEdit').modal('toggle');
		}
		
		
		
		
		
		if (process == 'update') {
			
			var id = $("#modelid").val();
			
			
			if ($('#model_name_edit').val() == ''){
				$('#model_name_edit').closest('div').addClass("f_error");
				$('#errtxt_edit').fadeIn(500);
			
			} else {
				
				jQuery.ajax({
					url :'modules/mod_car/model/editmodel.php',
					type: 'GET',
					data: 'act=update&model_name='+$('#model_name_edit').val()+'&model_name_temp='+$('#temp').val()+'&id='+id+'',
					dataType: 'jsonp',
					dataCharset: 'jsonp',
					success: function (data){
						console.log(data.success);
						if (data.success){
							$('#msg3').text(data.message);
							$('#alert3').fadeIn(500, function() {
								clearTimeout(delayAlert);  
								delayAlert=setTimeout(function(){  
									alertFadeOut('alert3');
									reloadPage(); 
									delayAlert=null;  
								},2000);  
							});
						} else {
							$('#msg1').text(data.message);
							$('#alert1').fadeIn(500, function() {
								clearTimeout(delayAlert);  
								delayAlert=setTimeout(function(){  
									alertFadeOut('alert1'); 
									delayAlert=null;  
								},2000);  
							});
						}
						
						
						$('#myModalEdit').modal('toggle');
					}
				});	
			}
			
		}
		

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

 