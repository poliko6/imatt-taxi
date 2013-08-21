 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
 }
 

 $car_gas = select_db('cargas','order by carGasId');
 $total = count($car_gas);
 ?>
 
 
<script type="text/javascript">
	var delayAlert=null; 
	$(document).ready(function(){
		
	});
	
	function alertFadeOut(id){
		$('#'+id+'').fadeOut(1000); 
	}
	
	function reloadPage(){
		window.location = 'index.php?p=car.gas&menu=main_car'; 
	}
	
	
	function fn_formDel(id){
		jQuery.ajax({
			url :'modules/mod_car/gas/delgas.php',
			type: 'GET',
			data: 'act=delgas&id='+id+'',
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
		if ($('#gas_name').val() == ''){
			$('#gas_name').closest('div').addClass("f_error");
			$('#errtxt').fadeIn(500);
		} else {
			//$('#fm_addgas').submit();			
			jQuery.ajax({
   				url :'modules/mod_car/gas/addgas.php',
   				type: 'GET',
  				data: 'act=addgas&gas_name='+$('#gas_name').val()+'',
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
					$('#gas_name').val('');
   				}
			});	
			
		}
	}
	
	
	
	
	function fn_formEdit(id,process){
		//console.log(id);
		
		if (process == 'select') {
			$.post("modules/mod_car/gas/getgas.php", { 
					process: process,
					id: id
				}, 
				function(data){
					$("#gas_name_edit").val(data);
					$("#temp").val(data);
					$("#gasid").val(id);
				}
			);
			
			$('#myModalEdit').modal('toggle');
		}
		
		
		
		
		
		if (process == 'update') {
			
			var id = $("#gasid").val();
			
			
			if ($('#gas_name_edit').val() == ''){
				$('#gas_name_edit').closest('div').addClass("f_error");
				$('#errtxt_edit').fadeIn(500);
			
			} else {
				
				jQuery.ajax({
					url :'modules/mod_car/gas/editgas.php',
					type: 'GET',
					data: 'act=update&gas_name='+$('#gas_name_edit').val()+'&gas_name_temp='+$('#temp').val()+'&id='+id+'',
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
        <h3>เพิ่มประเภทแก๊สรถยนต์</h3>
    </div>
    <form action="" name="fm_addgas" id="fm_addgas">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อประเภทแก๊สรถยนต์</label>
            <input type="text" name="gas_name" id="gas_name" value="" />
            <span class="help-inline">ตัวอย่าง : LPG</span>
            <span class="help-block" id="errtxt" style="color:#900; display:none;">กรุณาป้อนประเภทแก๊สรถยนต์</span>
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
        <h3>แก้ไขประเภทแก๊สรถยนต์</h3>
    </div>
    <form action="" name="fm_editgas" id="fm_editgas">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อประเภทแก๊สรถยนต์</label>
            <input type="text" name="gas_name_edit" id="gas_name_edit" value="<?=$gas_name_edit?>" />
            <span class="help-inline">ตัวอย่าง : LPG</span>
            <span class="help-block" id="errtxt_edit" style="color:#900; display:none;">กรุณาป้อนประเภทแก๊สรถยนต์</span>
        </div> 
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    <input type="hidden" name="temp" id="temp" value="" />
    <input type="hidden" name="gasid" id="gasid" value="" />
    </form>
</div>



 
 <div class="row-fluid search_page">
	<div class="span12">
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการประเภทแก๊สรถยนต์ทั้งหมด <strong><?=$total?></strong></div>
                <div class="pull-right">
                  <a data-toggle="modal" data-backdrop="static" href="#myModalAdd">
                  	<button class="btn btn-success" onClick="">เพิ่มประเภทแก๊ส</button></a>  
                </div>
            </div>
        </div>
        
  
  		
  
		<? if ($total != 0){ ?>
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px">ลำดับ</th>
                        <th style="width:250px">ชื่อประเภทแก๊ส</th>
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
                            <td><?=$car_gas[$i]['carGasName']?></td>
                            <td><?=Thai_date($car_gas[$i]['dateAdd'])?></td>
                            <td>
                            	<!--<a data-toggle="modal" data-backdrop="static" href="#myModalAdd"> -->
                                <!--<a href="index.php?p=car.type&menu=main_car&act=edit&id=<?=$car_gas[$i]['carGasId']?>" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a> -->
                               	<a href="#" data-toggle="modal" data-backdrop="static" title="Edit" onclick="fn_formEdit(<?=$car_gas[$i]['carGasId']?>, 'select');"><i class="icon-pencil"></i></a>
                                
                                <a href="#myModalDel<?=$car_gas[$i]['carGasId']?>" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$car_gas[$i]['carGasId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบข้อมูลประเภทแก๊สรถ "<?=$car_gas[$i]['carGasName']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$car_gas[$i]['carGasId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
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
        
    </div>
</div>