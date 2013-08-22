

 <div class="row-fluid search_page">
	<div class="span12">
    	<?
		if ($u_garage == 1) {
			$car_data = select_db('car',"order by dateAdd desc");
			
			if ($garageid == ''){
				$garageid  = $u_garage;
			}
			
		} else {
			$car_data = select_db('car',"where garageId = '".$u_garage."' order by dateAdd desc");
			$garageid  = $u_garage;
		}
		$total = count($car_data);
		
		
		///=====Data Major
		$major_data = select_db('majoradmin',"where garageId = '".$garageid."'");
		$major_name = $major_data[0]['thaiCompanyName'];
		$garageid = $major_data[0]['garageId'];
		
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
                            <? foreach($major_data_list as $valMajor){?>
                                <option value="<?=$valMajor['garageId']?>" <? if ($garageid == $valMajor['garageId']) { echo "selected=\"selected\""; } ?> ><?=$valMajor['thaiCompanyName']?></option>
                            <? } ?>
                        </select>	        
                        <? } ?>			
    
                        <input type="button" class="btn btn-success" name="btnSubmit" id="btnSubmit" onClick="fn_goToPage('add');" value="เพิ่มรถแท๊กซี่">

              	 	</div>
              
                </form>
            </div>
        </div>
        
  		
  		
  
		<? if ($total != 0){ ?>
        
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px">ลำดับ</th>
                        <th style="width:60px">รูปรถ</th>
                        <th>ทะเบียนรถ</th>
                        <th>รายละเอียดรถ</th>
                        <th>สถานะ</th>
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
                            <td>
                            	<a href="gallery/Image10.jpg" title="Image 10" class="cbox_single thumbnail">
                                    <img alt="" src="gallery/Image10_tn.jpg" style="height:50px;width:50px">
                                </a>
							</td>
                            <td><?=$car_data[$i]['carRegistration']?></td>
                            <td>
                            
                            	<?=$car_data[$i]['carTypeId']?>
								<?=$car_data[$i]['carBannerId']?>
                                <?=$car_data[$i]['carModelId']?>
                                <?=$car_data[$i]['carGasId']?>
                                <?=$car_data[$i]['carFuelId']?>
                                <?=$car_data[$i]['carColorId']?>
                                <?=$car_data[$i]['carYear']?>
                            </td>
                            <td><?=$car_data[$i]['carStatusId']?></td>
                            <td><?=Thai_date($car_data[$i]['dateAdd'])?></td>
                            <td>
                            	<!--<a data-toggle="modal" data-backdrop="static" href="#myModalAdd"> -->
                                <!--<a href="index.php?p=car.type&menu=main_car&act=edit&id=<?=$car_data[$i]['carId']?>" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a> -->
                               	<a href="#" data-toggle="modal" data-backdrop="static" title="Edit" onclick="fn_formEdit(<?=$car_data[$i]['carId']?>, 'select');"><i class="icon-pencil"></i></a>
                                
                                <a href="#myModalDel<?=$car_data[$i]['carId']?>" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                            </td>
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
			url :'modules/mod_car/model/delmodel.php',
			type: 'GET',
			data: 'act=delmodel&id='+id+'',
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
	
	
	
	function fn_formAdd(){		
		if ($('#model_name').val() == ''){
			$('#model_name').closest('div').addClass("f_error");
			$('#errtxt').fadeIn(500);
		} else {
			
			var bannerid = $('#hide_bannerid').val();
					
			jQuery.ajax({
   				url :'modules/mod_car/model/addmodel.php',
   				type: 'GET',
  				data: 'act=addmodel&model_name='+$('#model_name').val()+'&bannerid='+bannerid+'',
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
					
					
					$('#myModalAdd').modal('toggle');
					$('#model_name').val('');
   				}
			});	
			
		}
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

 


<!-- POP UP -->
<div class="modal hide fade" id="myModalEdit">
    <div class="modal-header">
        <h3>แก้ไขรุ่นรถยนต์ (ยี่ห้อ <?=$banner_name?>)</h3>
    </div>
    <form action="" name="fm_editmodel" id="fm_editmodel">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อรุ่นรถยนต์</label>
            <input type="text" name="model_name_edit" id="model_name_edit" value="<?=$model_name_edit?>" />
            <span class="help-inline">ตัวอย่าง : Corolla</span>
            <span class="help-block" id="errtxt_edit" style="color:#900; display:none;">กรุณาป้อนรุ่นรถยนต์</span>
        </div> 
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    <input type="hidden" name="temp" id="temp" value="" />
    <input type="hidden" name="modelid" id="modelid" value="" />
    </form>
</div>

 