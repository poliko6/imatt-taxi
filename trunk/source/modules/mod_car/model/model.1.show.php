 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
 }
 ?>
<!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script>  


 <div class="row-fluid search_page">
	<div class="span12">
    	<?
		$car_banner = select_db('carbanner','order by carBannerId');
		$total_banner = count($car_banner);

		if ($total_banner > 0){
			
			if ($bannerid != '') {
				$car_banner_name = select_db('carbanner',"where carBannerId = '".$bannerid."'");
			} else {
				$car_banner_name = select_db('carbanner',"order by carBannerId limit 0,1");
				$bannerid = $car_banner_name[0]['carBannerId'];	
			}
			
			$banner_name = $car_banner_name[0]['carBannerNameEng'];	
			$car_model = select_db('carmodel','where carBannerId = "'.$bannerid.'" order by carModelId');
 			$total = count($car_model);
		?>
        
        <input type="hidden" name="hide_bannerid" id="hide_bannerid" value="<?=$bannerid?>" />
        
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการรุ่นรถยี่ห้อ "<span style="color:#C30; font-weight:bold;"><?=$banner_name?></span>" มีจำนวน <strong><?=$total?></strong></div>
               	
                <form action="" name="fm_selectbanner" id="fm_selectbanner" method="post">
                <div class="pull-right">                	
                   
                <select name="bannerid" id="bannerid" onchange="fm_selectbanner.submit();" style="width:170px;">
                    <? foreach($car_banner as $valBanner){?>
                        <option value="<?=$valBanner['carBannerId']?>" <? if ($bannerid == $valBanner['carBannerId']) { echo "selected=\"selected\""; } ?> ><?=$valBanner['carBannerNameEng']?></option>
                    <? } ?>
                </select>				 
                  
                  <a data-toggle="modal" data-backdrop="static" href="#myModalAdd">
                  	<button class="btn btn-success" onClick="">เพิ่มรุ่นรถ</button></a>  
                </div>
                </form>
                
            </div>
        </div>
        
  
  		
  
		<? if ($total != 0){ ?>
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px">ลำดับ</th>
                        <th style="width:250px">ชื่อรุ่นรถยนต์</th>
                        <th style="width:120px">วันที่เพิ่ม</th>
                        <th style="width:100px">เครื่องมือ</th>
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
                            <td><?=$car_model[$i]['carModelName']?></td>
                            <td><?=Thai_date($car_model[$i]['dateAdd'])?></td>
                            <td>
                            	<!--<a data-toggle="modal" data-backdrop="static" href="#myModalAdd"> -->
                                <!--<a href="index.php?p=car.type&menu=main_car&act=edit&id=<?=$car_model[$i]['carModelId']?>" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a> -->
                               	<a href="#" data-toggle="modal" data-backdrop="static" title="Edit" onclick="fn_formEdit(<?=$car_model[$i]['carModelId']?>, 'select');"><i class="icon-pencil"></i></a>
                                
                                <a href="#myModalDel<?=$car_model[$i]['carModelId']?>" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$car_model[$i]['carModelId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบข้อมูลรุ่นรถ "<?=$car_model[$i]['carModelName']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$car_model[$i]['carModelId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
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
                <strong>ยังไม่มีข้อมูล!</strong>
            </div>
            
         <? } ?>
        
       
	   <? }  else { // End if Banner ?> 
       
       		<div style="text-align:center;">
                <div><strong>ยังไม่มีข้อมูลยี่ห้อรถ!</strong></div>
                <a href="index.php?p=car.banner&menu=main_car">
                	<div class="btn btn-gebo" style="margin:10px;"> เพิ่มยี่ห้อรถ </div>
               	</a>
            </div>
       
       <? } // End if Banner ?>
        
    </div>
 </div>
 
 
 
<script type="text/javascript">
	var delayAlert=null; 
	$(document).ready(function(){
		
	});
	
	function alertFadeOut(id){
		$('#'+id+'').fadeOut(1000); 
	}
	
	function reloadPage(){
		window.location = 'index.php?p=car.model&menu=main_car&bannerid=<?=$bannerid?>'; 
	}
	
	
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
<div class="modal hide fade" id="myModalAdd">
    <div class="modal-header">
        <h3>เพิ่มรุ่นรถยนต์ (ยี่ห้อ <?=$banner_name?>)</h3>
    </div>
    <form action="" name="fm_addmodel" id="fm_addmodel">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อรุ่นรถยนต์</label>
            <input type="text" name="model_name" id="model_name" value="" />
            <span class="help-inline">ตัวอย่าง : Corolla</span>
            <span class="help-block" id="errtxt" style="color:#900; display:none;">กรุณาป้อนรุ่นรถยนต์</span>
        </div> 
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formAdd();"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    </form>
</div>


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

 