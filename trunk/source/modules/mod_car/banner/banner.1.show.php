 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
 }
 

 $car_banner = select_db('carbanner','order by carBannerId');
 $total = count($car_banner);
 //pre($car_banner);
 ?>
 
<!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script> 

<!-- fix for ios orientation change -->
<script src="js/ios-orientationchange-fix.js"></script>
<!-- scrollbar -->
<script src="lib/antiscroll/antiscroll.js"></script>
<script src="lib/antiscroll/jquery-mousewheel.js"></script>
<!-- lightbox -->
<script src="lib/colorbox/jquery.colorbox.min.js"></script>
<!-- common functions -->
<script src="js/gebo_common.js"></script>
 
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
		window.location = 'index.php?p=car.banner&menu=main_car'; 
	}
	
	
	function fn_formDel(id){
		jQuery.ajax({
			url :'modules/mod_car/banner/delbanner.php',
			type: 'GET',
			data: 'act=delbanner&id='+id+'',
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
		var pass = 1;
		
		if ($('#banner_name_eng').val() == ''){
			$('#banner_name_eng').closest('div').addClass("f_error");
			$('#errtxt1').fadeIn(500);
			pass = 0;
		} else {
			$('#banner_name_eng').closest('div').removeClass("f_error");
			$('#errtxt1').fadeOut(500);
		}
		
		if ($('#banner_name_thai').val() == ''){
			$('#banner_name_thai').closest('div').addClass("f_error");
			$('#errtxt2').fadeIn(500);
			pass = 0;
		} else {
			$('#banner_name_thai').closest('div').removeClass("f_error");
			$('#errtxt2').fadeOut(500);
		}
		
		if (pass) {
			
			jQuery.ajax({
   				url :'modules/mod_car/banner/addbanner.php',
   				type: 'GET',
  				data: 'act=addbanner&banner_name_eng='+$('#banner_name_eng').val()+'&banner_name_thai='+$('#banner_name_thai').val()+'',
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
					$('#banner_name').val('');
   				}
			});	
			
		}
	}
	
	
	
	
	function fn_formEdit(id,process){
		console.log(id);
		
		if (process == 'select') {
			$.post("modules/mod_car/banner/getbanner.php", { 
					process: process,
					id: id
				}, 
				function(data){
					var data_banner = data.split(",");
					$("#banner_name_engedit").val(data_banner[0]);
					$("#banner_name_thaiedit").val(data_banner[1]);
					$("#banner_name_editeng_tmp").val(data_banner[0]);
					$("#banner_name_editthai_tmp").val(data_banner[1]);

					$("#bannerid").val(id);
				}
			);
			
			$('#myModalEdit').modal('toggle');
		}
		
		
		
		
		
		if (process == 'update') {
			
			var id = $("#bannerid").val();
			var pass = 1;
			
			if ($('#banner_name_engedit').val() == ''){
				$('#banner_name_engedit').closest('div').addClass("f_error");
				$('#errtxt_edit1').fadeIn(500);
				pass = 0;
			} else {
				$('#banner_name_engedit').closest('div').removeClass("f_error");
				$('#errtxt_edit1').fadeOut(500);
			}
			
			if ($('#banner_name_thaiedit').val() == ''){
				$('#banner_name_thaiedit').closest('div').addClass("f_error");
				$('#errtxt_edit2').fadeIn(500);
				pass = 0;
			} else {
				$('#banner_name_thaiedit').closest('div').removeClass("f_error");
				$('#errtxt_edit2').fadeOut(500);				
			}

			if (pass){
				
				var bannereng = $('#banner_name_engedit').val();
				var bannerthai = $('#banner_name_thaiedit').val();
				var bannereng_tmp = $('#banner_name_editeng_tmp').val();				
	 	   		var bannerthai_tmp = $('#banner_name_editthai_tmp').val();
				
				jQuery.ajax({
					url :'modules/mod_car/banner/editbanner.php',
					type: 'GET',
					data: 'act=update&bannereng='+bannereng+'&bannerthai='+bannerthai+'&bannereng_temp='+bannereng_tmp+'&bannerthai_temp='+bannerthai_tmp+'&id='+id+'',
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
        <h3>เพิ่มยี่ห้อรถยนต์</h3>
    </div>
    <form action="" name="fm_addbanner" id="fm_addbanner">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อยี่ห้อรถยนต์ (อังกฤษ)</label>
            <input type="text" name="banner_name_eng" id="banner_name_eng" value="" />
            <span class="help-inline">ตัวอย่าง : Toyota</span>
            <span class="help-block" id="errtxt1" style="color:#900; display:none;">กรุณาป้อนยี่ห้อรถภาษาอังกฤษ</span>
        </div> 
        
        <div class="formSep">
            <label>ชื่อยี่ห้อรถยนต์ (ภาษาไทย)</label>
            <input type="text" name="banner_name_thai" id="banner_name_thai" value="" />
            <span class="help-inline">ตัวอย่าง : โตโยต้า</span>
            <span class="help-block" id="errtxt2" style="color:#900; display:none;">กรุณาป้อนยี่ห้อรถภาษาไทย</span>
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
        <h3>แก้ไขยี่ห้อรถยนต์</h3>
    </div>
    <form action="" name="fm_editbanner" id="fm_editbanner">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อยี่ห้อรถยนต์ (ภาษาอังกฤษ)</label>
            <input type="text" name="banner_name_engedit" id="banner_name_engedit" value="<?=$banner_name_engedit?>" />
            <span class="help-inline">ตัวอย่าง : Toyota</span>
            <span class="help-block" id="errtxt_edit1" style="color:#900; display:none;">กรุณาป้อนยี่ห้อรถภาษาอังกฤษ</span>
        </div> 
        
        <div class="formSep">
            <label>ชื่อยี่ห้อรถยนต์ (ภาษาไทย)</label>
            <input type="text" name="banner_name_thaiedit" id="banner_name_thaiedit" value="<?=$banner_name_thaiedit?>" />
            <span class="help-inline">ตัวอย่าง : โตโยต้า</span>
            <span class="help-block" id="errtxt_edit2" style="color:#900; display:none;">กรุณาป้อนยี่ห้อรถภาษาไทย</span>
        </div> 
        
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    <input type="hidden" name="banner_name_editeng_tmp" id="banner_name_editeng_tmp" value="" />
    <input type="hidden" name="banner_name_editthai_tmp" id="banner_name_editthai_tmp" value="" />
    <input type="hidden" name="bannerid" id="bannerid" value="" />
    </form>
</div>



 
 <div class="row-fluid search_page">
	<div class="span12">
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการยี่ห้อรถยนต์ทั้งหมด <strong><?=$total?></strong></div>
                <div class="pull-right">
                  <a data-toggle="modal" data-backdrop="static" href="#myModalAdd">
                  	<button class="btn btn-success" onClick="">เพิ่มยี่ห้อ</button></a>  
                </div>
            </div>
        </div>
        
  
  		
  
		<? if ($total != 0){ ?>
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px">ลำดับ</th>
                        <th style="width:180px">ชื่อยี่ห้อรถ (อังกฤษ)</th>
                        <th style="width:180px">ชื่อยี่ห้อรถ (ไทย)</th>
                        <th style="width:80px">จำนวนรุุ่น</th>
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
                            <td>
								<a class="ttip_t" title="รุ่นรถยนต์ยี่ห้อ <?=$car_banner[$i]['carBannerNameEng']?>" href="index.php?p=car.model&menu=main_car&bannerid=<?=$car_banner[$i]['carBannerId']?>">
									<?=$car_banner[$i]['carBannerNameEng']?>
                                </a>
                            </td>
                            <td>
                                <a class="ttip_t" title="รุ่นรถยนต์ยี่ห้อ <?=$car_banner[$i]['carBannerNameThai']?>" href="index.php?p=car.model&menu=main_car&bannerid=<?=$car_banner[$i]['carBannerId']?>">
                                	<?=$car_banner[$i]['carBannerNameThai']?>
                                </a>
                            </td>
                            <td style="text-align:center;">
								<?
								$total_model = count_data_mysql('carModelId','carmodel','carBannerId ='.$car_banner[$i][carBannerId].'');
                                ?>
                                <a class="ttip_t" title="รุ่นรถยนต์ยี่ห้อ <?=$car_banner[$i]['carBannerNameThai']?>" href="index.php?p=car.model&menu=main_car&bannerid=<?=$car_banner[$i]['carBannerId']?>">
                                	<?=$total_model;?>
                                </a>

                            </td>
                            <td><?=Thai_date($car_banner[$i]['dateAdd'])?></td>
                            <td>
                            	<!--<a data-toggle="modal" data-backdrop="static" href="#myModalAdd"> -->
                                <!--<a href="index.php?p=car.type&menu=main_car&act=edit&id=<?=$car_banner[$i]['carBannerId']?>" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a> -->
                               	<a href="#" data-toggle="modal" data-backdrop="static" title="Edit" onclick="fn_formEdit(<?=$car_banner[$i]['carBannerId']?>, 'select');"><i class="icon-pencil"></i></a>
                                
                                <a href="#myModalDel<?=$car_banner[$i]['carBannerId']?>" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$car_banner[$i]['carBannerId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบข้อมูลยี่ห้อรถยนต์ "<?=$car_banner[$i]['carBannerNameEng']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$car_banner[$i]['carBannerId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
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