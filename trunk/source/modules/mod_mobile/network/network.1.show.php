 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
 }
 

 $mobile_network = select_db('mobilenetwork','order by mobileNetworkId');
 $total = count($mobile_network);
 ?>

<!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script> 
 
<script type="text/javascript">
	var delayAlert=null; 
	$(document).ready(function(){
		$(document).on("keydown.NewActionOnF5", function(e){
			var charCode = e.which || e.keyCode;
			switch(charCode){
				case 116: // F5
					e.preventDefault();
					window.location = "index.php?p=<?=$p?>&menu=<?=$menu?>";
					break;
			}
		});	
	});
	
	function alertFadeOut(id){
		$('#'+id+'').fadeOut(1000); 
	}
	
	function reloadPage(){
		window.location = 'index.php?p=mobile.network&menu=main_mobile'; 
	}
	
	
	function fn_formDel(id){
		jQuery.ajax({
			url :'modules/mod_mobile/network/delnetwork.php',
			type: 'GET',
			data: 'act=delnetwork&id='+id+'',
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
		if ($('#network_name').val() == ''){
			$('#network_name').closest('div').addClass("f_error");
			$('#errtxt').fadeIn(500);
		} else {
			//$('#fm_addnetwork').submit();			
			jQuery.ajax({
   				url :'modules/mod_mobile/network/addnetwork.php',
   				type: 'GET',
  				data: 'act=addnetwork&network_name='+$('#network_name').val()+'',
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
					$('#network_name').val('');
   				}
			});	
			
		}
	}
	
	
	
	
	function fn_formEdit(id,process){
		//console.log(id);
		
		if (process == 'select') {
			$.post("modules/mod_mobile/network/getnetwork.php", { 
					process: process,
					id: id
				}, 
				function(data){
					$("#network_name_edit").val(data);
					$("#temp").val(data);
					$("#mobileNetworkId").val(id);
				}
			);
			
			$('#myModalEdit').modal('toggle');
		}
		
		
		
		
		
		if (process == 'update') {
			
			var id = $("#mobileNetworkId").val();
			
			
			if ($('#network_name_edit').val() == ''){
				$('#network_name_edit').closest('div').addClass("f_error");
				$('#errtxt_edit').fadeIn(500);
			
			} else {
				
				jQuery.ajax({
					url :'modules/mod_mobile/network/editnetwork.php',
					type: 'GET',
					data: 'act=update&network_name='+$('#network_name_edit').val()+'&network_name_temp='+$('#temp').val()+'&id='+id+'',
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
        <h3>เพิ่มเครือข่ายมือถือ</h3>
    </div>
    <form action="" name="fm_addnetwork" id="fm_addnetwork">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อเครืือข่ายมือถือ</label>
            <input type="text" name="network_name" id="network_name" value="" />
            <span class="help-inline">ตัวอย่าง : AIS</span>
            <span class="help-block" id="errtxt" style="color:#900; display:none;">กรุณาป้อนชื่อเครือข่าย</span>
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
        <h3>แก้ไขเครือข่ายมือถือ</h3>
    </div>
    <form action="" name="fm_editnetwork" id="fm_editnetwork">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อเครืือข่ายมือถือ</label>
            <input type="text" name="network_name_edit" id="network_name_edit" value="<?=$network_name_edit?>" />
            <span class="help-inline">ตัวอย่าง : AIS</span>
            <span class="help-block" id="errtxt_edit" style="color:#900; display:none;">กรุณาป้อนชื่อเครือข่าย</span>
        </div> 
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    <input type="hidden" name="temp" id="temp" value="" />
    <input type="hidden" name="mobileNetworkId" id="mobileNetworkId" value="" />
    </form>
</div>



 
 <div class="row-fluid search_page">
	<div class="span12">
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการเครือข่ายมือถือทั้งหมด <strong><?=$total?></strong></div>
                <div class="pull-right">
                  <a data-toggle="modal" data-backdrop="static" href="#myModalAdd">
                  	<button class="btn btn-success" onClick="">เพิ่มเครื่อข่ายมือถือ</button></a>  
                </div>
            </div>
        </div>
        
  
  		
  
		<? if ($total != 0){ ?>
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px">ลำดับ</th>
                        <th style="width:250px">ชื่อเครือข่าย</th>
                        <th style="width:120px">วันทีปรับปรุง</th>
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
                            <td><?=$mobile_network[$i]['mobileNetworkName']?></td>
                            <td><?=Thai_date($mobile_network[$i]['dateAdd'])?></td>
                            <td>                            	
                               	<a href="#" data-toggle="modal" data-backdrop="static" title="Edit" onclick="fn_formEdit(<?=$mobile_network[$i]['mobileNetworkId']?>, 'select');"><i class="icon-pencil"></i></a>
                                
                                <a href="#myModalDel<?=$mobile_network[$i]['mobileNetworkId']?>" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$mobile_network[$i]['mobileNetworkId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบข้อมูลเครือข่าย "<?=$mobile_network[$i]['mobileNetworkName']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$mobile_network[$i]['mobileNetworkId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
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