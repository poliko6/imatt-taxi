 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
 }
 //pre($menuname_subarr);
 //pre($menuname_arr);

 $menu_count = count($menuname_subarr);
 $user_type = select_db('minortype','where garageId = '.$u_garage.' order by minorTypeId');
 $total = count($user_type);
 ?>
 
 
 
 
<!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script>  
 
 
 
 

<style type="text/css">
.columns {
	-moz-column-count: 3;
	-webkit-column-count: 3;
}
</style>



<!-- POP UP -->
<div class="modal hide fade" id="myModalAdd">
    <div class="modal-header">
        <h3>เพิ่มประเภทพนักงาน</h3>
    </div>
    <form action="" name="fm_addtype" id="fm_addtype">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อประเภทพนักงาน</label>
            <input type="text" name="type_name" id="type_name" value="" />
            <span class="help-inline">ตัวอย่าง : ตรวจสอบการเดินรถ</span>
            <span class="help-block" id="errtxt" style="color:#900; display:none;">กรุณาป้อนประเภทพนักงาน</span>
        </div> 
        <div class="formSep">
        	<div style="float:right; margin-right:57px;">
            	<input type="checkbox" id="CheckAll" name="CheckAll" onclick="checkAll_a('CheckAll','check_a')"  />
				เลือกเมนูทั้งหมด
            </div>
            <? 
			$i = 0;
			foreach($menuname_arr as $valmenu){ ?>
            	<div style="padding-top:5px; margin-bottom:10px;"> 
            	<h5 class="heading" style="margin-bottom:5px; color:#06C;"><?=$lang_menu[$valmenu]?></h5>  
				<div class="columns">    				
					<?
                    $sql_thismenu = "SELECT * FROM menulist WHERE SUBSTR(menuName,1, INSTR(menuName,'.')-1) = '".$valmenu."'";
                    $rs_thismenu = mysql_query($sql_thismenu);		
        			
                    while($data_thismenu = @mysql_fetch_object($rs_thismenu)){ 
                    //echo $data_thismenu->menuName;					
                        if (checkArray($data_thismenu->menuName,$menuname_subarr)){
							$data_menuid = select_db('menulist','where menuName = "'.$data_thismenu->menuName.'"');
							#echo $data_menuid[0]['menuId'];
							$i++;
							?>    
							<div>  	
							<label class="uni-checkbox">
								<input type="checkbox" id="check_a<?=$i?>" name="check_a<?=$i?>" value="<?=$data_menuid[0]['menuId']?>" onclick="checkAll_b('CheckAll','check_a')" />
								<?=$lang_menu[$data_thismenu->menuName]?>
							</label>
							</div>
							<? 
                        } 
                    }
                    ?>  
          		</div>
                </div>
            <? } ?>
            
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
        <h3>แก้ไขประเภทพนักงาน</h3>
    </div>
    <form action="" name="fm_edittype" id="fm_edittype">
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อประเภทพนักงาน</label>
            <input type="text" name="type_name_edit" id="type_name_edit" value="<?=$type_name_edit?>" />
            <span class="help-inline">ตัวอย่าง : ตรวจสอบการเดินรถ</span>
            <span class="help-block" id="errtxt_edit" style="color:#900; display:none;">กรุณาป้อนประเภทพนักงาน</span>
        </div> 
        
        <div class="formSep">
        	<div style="float:right; margin-right:57px;">
            	<input type="checkbox" id="CheckAll_edit" name="CheckAll_edit" onclick="checkAll_a('CheckAll_edit','check_edit')"  />
				เลือกเมนูทั้งหมด
            </div>
            <? 
			$i = 0;
			foreach($menuname_arr as $valmenu){ ?>
            	<div style="padding-top:5px; margin-bottom:10px;"> 
            	<h5 class="heading" style="margin-bottom:5px; color:#06C;"><?=$lang_menu[$valmenu]?></h5>  
				<div class="columns">    				
					<?
                    $sql_thismenu = "SELECT * FROM menulist WHERE SUBSTR(menuName,1, INSTR(menuName,'.')-1) = '".$valmenu."'";
                    $rs_thismenu = mysql_query($sql_thismenu);		
        			
                    while($data_thismenu = @mysql_fetch_object($rs_thismenu)){ 
                    //echo $data_thismenu->menuName;					
                        if (checkArray($data_thismenu->menuName,$menuname_subarr)){
							$data_menuid = select_db('menulist','where menuName = "'.$data_thismenu->menuName.'"');
							#echo $data_menuid[0]['menuId'];
							$i++;
							?>    
							<div>  	
							<label class="uni-checkbox">
								<input type="checkbox" id="check_edit<?=$i?>" name="check_edit<?=$i?>" value="<?=$data_menuid[0]['menuId']?>" onclick="checkAll_b('CheckAll_edit','check_edit')" />
								<?=$lang_menu[$data_thismenu->menuName]?>
							</label>
							</div>
							<? 
                        } 
                    }
                    ?>  
          		</div>
                </div>
            <? } ?>
            
        </div>
        
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    <input type="hidden" name="temp" id="temp" value="" />
    <input type="hidden" name="temp_menu" id="temp_menu" value="" />
    <input type="hidden" name="typeid" id="typeid" value="" />
    </form>
</div>



 
 <div class="row-fluid search_page">
	<div class="span12">
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการประเภทพนักงานทั้งหมด <strong><?=$total?></strong></div>
                <div class="pull-right">
                  <a data-toggle="modal" data-backdrop="static" href="#myModalAdd">
                  	<button class="btn btn-success" onClick="">เพิ่มประเภท</button></a>  
                </div>
            </div>
        </div>
        
  
  		
  
		<? if ($total != 0){ ?>
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px">ลำดับ</th>
                        <th style="width:250px">ชื่อประเภท</th>
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
                            <td><?=$user_type[$i]['minorType']?></td>
                            <td><?=Thai_date($user_type[$i]['dateAdded'])?></td>
                            <td>                           
                               	<a href="#" data-toggle="modal" data-backdrop="static" title="Edit" onclick="fn_formEdit(<?=$user_type[$i]['minorTypeId']?>, 'select');"><i class="icon-pencil"></i></a>
                                <a href="#myModalDel<?=$user_type[$i]['minorTypeId']?>" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- POP UP -->
                        <div class="modal hide fade" id="myModalDel<?=$user_type[$i]['minorTypeId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบข้อมูลประเภทพนักงาน "<?=$user_type[$i]['minorType']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$user_type[$i]['minorTypeId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
                                หรือ 
                                <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a></p>
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




<script type="text/javascript">
	var delayAlert=null; 
	
	var total_checkbox_all = <?=$menu_count?>;	
	var v_menu = [];	
	
	$(document).ready(function(){
		
	});
	
	function alertFadeOut(id){
		$('#'+id+'').fadeOut(1000); 
	}	
	
	function reloadPage(){
		window.location = 'index.php?p=user.type&menu=main_user'; 
	}
		
		
	function alertPopup(msgid,alertid,message,newload){
		$('#'+msgid+'').text(''+message+'');
		$('#'+alertid+'').fadeIn(500, function() {
			clearTimeout(delayAlert);  
			delayAlert=setTimeout(function(){ 
				$('#'+alertid+'').fadeOut(1000);  			
				if (newload == 1){
					reloadPage();  
				}
				delayAlert=null;  
			},2000);  
		});
	}	
	
	
	
	function fn_formDel(id){
		jQuery.ajax({
			url :'modules/mod_user/type/deltype.php',
			type: 'GET',
			data: 'act=deltype&id='+id+'',
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
	
	
	
	
	function fn_formAdd(){		
		if ($('#type_name').val() == ''){
			$('#type_name').closest('div').addClass("f_error");
			$('#errtxt').fadeIn(500);
		} else {
			//$('#fm_addtype').submit();			
			jQuery.ajax({
   				url :'modules/mod_user/type/addtype.php',
   				type: 'GET',
  				data: 'act=addtype&type_name='+$('#type_name').val()+'&u_garage=<?=$u_garage?>&v_menu='+v_menu+'',
   				dataType: 'jsonp',
   				dataCharset: 'jsonp',
   				success: function (data){
					console.log(data.success);
      				if (data.success){
						alertPopup('msg3','alert3',''+data.message+'',1);					
					} else {
						alertPopup('msg2','alert2',''+data.message+'',0);
					}	
					
					
					$('#myModalAdd').modal('toggle');
					$('#type_name').val('');
   				}
			});	
			
		}
	}
	
	
	
	
	function fn_formEdit(id,process){
		//console.log(id);
		
		if (process == 'select') {
			$.post("modules/mod_user/type/gettype.php", { 
					process: process,
					id: id
				}, 
				function(data){
					var str = data.split("|");
					$("#type_name_edit").val(str[0]);
					var arrmenu = str[1].split(',');					
					$.each( arrmenu, function( key, value ) {
					    //console.log( key + ": " + value );
					  	for (n=1; n<= total_checkbox_all; n++) {
							if ($('input[name=check_edit'+n+']').val() == value){
								$('input[name=check_edit'+n+']').attr('checked', true);	
							}
						}// for	
					});
					checkAll_b('CheckAll_edit','check_edit');
					
					$("#temp").val(str[0]);
					$("#temp_menu").val(str[1]);
					$("#typeid").val(id);
				}
			);
			
			$('#myModalEdit').modal('toggle');
		}
		
		
		
		
		
		if (process == 'update') {
			
			var id = $("#typeid").val();
			
			
			
			if ($('#type_name_edit').val() == ''){
				$('#type_name_edit').closest('div').addClass("f_error");
				$('#errtxt_edit').fadeIn(500);
			
			} else {
				
				var temp = $('#temp').val();
				var tempmenu = $('#temp_menu').val();
				checkAll_b('CheckAll_edit','check_edit');
				jQuery.ajax({
					url :'modules/mod_user/type/edittype.php',
					type: 'GET',
					data: 'act=update&type_name='+$('#type_name_edit').val()+'&type_name_temp='+temp+'&id='+id+'&u_garage=<?=$u_garage?>&v_menu='+v_menu+'&temp_menu='+tempmenu+'',
					dataType: 'jsonp',
					dataCharset: 'jsonp',
					success: function (data){
						console.log(data.success);
						if (data.success){
							alertPopup('msg3','alert3',''+data.message+'',1);					
						} else {
							alertPopup('msg2','alert2',''+data.message+'',0);
						}							
						
						$('#myModalEdit').modal('toggle');
					}
				});	
			}
			
		}
		

	}
	
	
	
	

	function checkAll_a(varid,varchoice) {
		//console.log(total_checkbox_all);
		if($('input[name='+varid+']').is(':checked')){
			for (i = 1; i <= total_checkbox_all; i++) {
				//console.log(i);
				$('input[name='+varchoice+''+i+']').attr('checked', true);
			}
		} else {
			for (i = 1; i <= total_checkbox_all; i++){
				$('input[name='+varchoice+''+i+']').attr('checked', false);
			}
		}
		
		addArray(varchoice);
		//console.log(v_menu);
	}


	
	
	function checkAll_b(varid,varchoice) {
		count_i = 0;
	
		for (i = 1; i <= total_checkbox_all; i++) {
			if ($('input[name='+varchoice+''+i+']').is(':checked')){
				count_i++;
				//alert(count_i);
			}
		}
		
		if (count_i != total_checkbox_all){
			$('input[name='+varid+']').attr('checked', false);
		} else {
			$('input[name='+varid+']').attr('checked', true);
		}
		
		addArray(varchoice);
		//console.log(v_menu);
		//alert(v_menu);
		//alert(count_i + " : " +total_checkbox_all);
	}
	
	
	
	function addArray(varchoice){
		v_menu = [];	
		i1 = 0;
		for (i2=1; i2<= total_checkbox_all; i2++) {
			if ($('input[name='+varchoice+''+i2+']').is(':checked')){
				v_menu[i1] = $('#'+varchoice+''+i2+'').val();
				i1++;
			} // if						
		}	// for	
		//alert(v_menu);
		console.log(v_menu);
	}
</script>



 
<!-- fix for ios orientation change -->
<script src="js/ios-orientationchange-fix.js"></script>
<!-- scrollbar -->
<script src="lib/antiscroll/antiscroll.js"></script>
<script src="lib/antiscroll/jquery-mousewheel.js"></script>
<!-- lightbox -->
<script src="lib/colorbox/jquery.colorbox.min.js"></script>
<!-- common functions -->
<script src="js/gebo_common.js"></script>

<script src="lib/jquery-ui/jquery-ui-1.8.23.custom.min.js"></script>
<!-- touch events for jquery ui-->
<script src="js/forms/jquery.ui.touch-punch.min.js"></script>
<!-- masked inputs -->
<script src="js/forms/jquery.inputmask.min.js"></script>
<!-- autosize textareas -->
<script src="js/forms/jquery.autosize.min.js"></script>
<!-- textarea limiter/counter -->
<script src="js/forms/jquery.counter.min.js"></script>
<!-- datepicker -->
<script src="lib/datepicker/bootstrap-datepicker.min.js"></script>
<!-- timepicker -->
<script src="lib/datepicker/bootstrap-timepicker.min.js"></script>
<!-- tag handler -->
<script src="lib/tag_handler/jquery.taghandler.min.js"></script>
<!-- input spinners -->
<script src="js/forms/jquery.spinners.min.js"></script>
<!-- styled form elements -->
<script src="lib/uniform/jquery.uniform.min.js"></script>
<!-- animated progressbars -->
<script src="js/forms/jquery.progressbar.anim.js"></script>
<!-- multiselect -->
<script src="lib/multiselect/js/jquery.multi-select.min.js"></script>
<!-- enhanced select (chosen) -->
<script src="lib/chosen/chosen.jquery.min.js"></script>
<!-- TinyMce WYSIWG editor -->
<script src="lib/tiny_mce/jquery.tinymce.js"></script>
<!-- plupload and all it's runtimes and the jQuery queue widget (attachments) -->
<script type="text/javascript" src="lib/plupload/js/plupload.full.js"></script>
<script type="text/javascript" src="lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.full.js"></script>
<!-- colorpicker -->
<script src="lib/colorpicker/bootstrap-colorpicker.js"></script>
<!-- password strength checker -->
<script src="lib/complexify/jquery.complexify.min.js"></script>
<!-- form functions -->
<script src="js/gebo_forms.js"></script>

<script>
$(document).ready(function() {
    //* show all elements & remove preloader
    setTimeout('$("html").removeClass("js")',1000);
});
</script>