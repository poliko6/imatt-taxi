 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
 }
 

 $promo_data = select_db('newspromotion',"where garageId = '".$u_garage."' order by dateAdd");
 $total = count($promo_data);
 ?>
 
<!-- datatable -->
<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/extras/Scroller/media/js/Scroller.min.js"></script>
<!-- datatable functions -->
<script src="js/gebo_datatables.js"></script>
<script src="lib/ckeditor/ckeditor.js"></script>
 
 
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
	
	
	function reloadPage(){
		window.location = 'index.php?p=<?=$p?>&menu=<?=$menu?>';
	}
	
	
	function fn_formDel(id){
		jQuery.ajax({
			url :'modules/mod_blog/promotion/del.promotion.php',
			type: 'GET',
			data: 'act=del&id='+id+'',
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
	
	function fn_formShow(id,status){
		jQuery.ajax({
			url :'modules/mod_blog/promotion/show.promotion.php',
			type: 'GET',
			data: 'act=show&id='+id+'&s='+status+'',
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				//console.log(data.success);
				if (data.success){
					$('#divShow'+id+'').html(data.tag);
					alertPopup('msg3','alert3',''+data.message+'',0);
				} else {
					$('#divShow'+id+'').html(data.tag);
					alertPopup('msg2','alert2',''+data.message+'',0);
				}
			}
		});	
	}
	
	
	
	function fn_formAdd(){		
		if ($('#promotionTopic').val() == ''){
			$('#promotionTopic').closest('div').addClass("f_error");
			$('#errtxt').fadeIn(500);
		} else {
			//$('#fm_add').submit();
			var editor_data = CKEDITOR.instances.promotionDetail.getData();	
			var promotionTopic = $('#promotionTopic').val();		
			//console.log(editor_data);
			jQuery.ajax({
   				url :'modules/mod_blog/promotion/add.promotion.php',
   				type: 'GET',
  				data: 'promotionTopic='+promotionTopic+'&promotionDetail='+editor_data+'&garageId=<?=$u_garage?>',
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
					$('#promotionTopic').val('');
   				}
			});	
			
		}
	}
	
	
	
	
	function fn_formEdit(id,process){
		//console.log(id);
		
		if (process == 'select') {
			jQuery.ajax({
				url :'modules/mod_blog/promotion/get.promotion.php',
				type: 'GET',
				data: 'act=getpromotion&id='+id+'',
				dataType: 'jsonp',
				dataCharset: 'jsonp',
				success: function (data){
					//console.log(data.success);
					//var editor = $('#promotionDetail_edit').ckeditor().editor;
					//alert( editor.checkDirty() );					
					$("#promotionTopic_edit").val(data.topic);
					//$("textarea#promotionDetail_edit").val(data.detail);
					CKEDITOR.instances['promotionDetail_edit'].setData(data.detail);
					$("#promotionId").val(id);				
					$('#myModalEdit').modal('toggle');
				}
			});	
		
		}
		
		
		
		
		
		if (process == 'update') {
			
			var id = $("#promotionId").val();
			
			
			if ($('#promotionTopic_edit').val() == ''){
				$('#promotionTopic_edit').closest('div').addClass("f_error");
				$('#errtxt_edit').fadeIn(500);
			
			} else {
				var editor_data = CKEDITOR.instances.promotionDetail_edit.getData();	
				var promotionTopic = $('#promotionTopic_edit').val();		
				jQuery.ajax({
					url :'modules/mod_blog/promotion/edit.promotion.php',
					type: 'GET',
					data: 'act=update&promotionTopic='+promotionTopic+'&promotionDetail='+editor_data+'&id='+id+'',
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
	
	
</script>

 

<!-- POP UP -->
<div class="modal hide fade" id="myModalAdd" style="width:auto;">
    <div class="modal-header">
        <h3>เพิ่มข่าวโปรโมชั่น</h3>
    </div>
    <form action="" name="fm_add" id="fm_add">
    <div class="modal-body">
        <div class="formSep">
            <label>หัวข้อโปรโมชั่น</label>
            <input class="span6" type="text" name="promotionTopic" id="promotionTopic" value="" />
            <span class="help-inline">ตัวอย่าง : สมัครวันนี้รับสิทธิ์นั่งแท๊กซี่ฟรี</span>
            <span class="help-block" id="errtxt" style="color:#900; display:none;">กรุณาป้อนหัวข้อโปรโมชั่น</span>
        </div> 
        
        <div class="formSep">
            <label>รายละเอียดโปรโมชั่น</label>
            <textarea name="promotionDetail" id="promotionDetail" cols="50" rows="10"></textarea>
        </div> 
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formAdd();"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    </form>
</div>

<script type="text/javascript">
$(document).ready(function () { 
	CKEDITOR.replace('promotionDetail', {  });  
});
</script>


<!-- POP UP EDIT -->
<div class="modal hide fade" id="myModalEdit" style="width:auto;">
    <div class="modal-header">
        <h3>แก้ไขโปรโมชั่น</h3>
    </div>
    <form action="" name="fm_edit" id="fm_edit">
    <div class="modal-body">
        <div class="formSep">
            <label>หัวข้อโปรโมชั่น</label>
            <input class="span6" type="text" name="promotionTopic_edit" id="promotionTopic_edit" value="" />
            <span class="help-inline">ตัวอย่าง : สมัครวันนี้รับสิทธิ์นั่งแท๊กซี่ฟรี</span>
            <span class="help-block" id="errtxt_edit" style="color:#900; display:none;">กรุณาป้อนหัวข้อโปรโมชั่น</span>
        </div> 
        
        <div class="formSep">
            <label>รายละเอียดโปรโมชั่น</label>
            <textarea name="promotionDetail_edit" id="promotionDetail_edit" cols="50" rows="10"></textarea>
        </div> 
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    <input type="hidden" name="promotionId" id="promotionId" value="" />
    </form>
</div>

<script type="text/javascript">
$(document).ready(function () { 
	CKEDITOR.replace('promotionDetail_edit', {  });  
});
</script>

 
 <div class="row-fluid search_page">
	<div class="span12">
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการโปรโมชั่นทั้งหมด <strong><?=$total?></strong></div>
                <div class="pull-right">
                  <a data-toggle="modal" data-backdrop="static" href="#myModalAdd">
                  	<button class="btn btn-success" onClick="">เพิ่มโปรโมชั่น</button></a>  
                </div>
            </div>
        </div>
        
  
  		
  
		<? if ($total != 0){ ?>
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px">ลำดับ</th>
                        <th style="width:250px">หัวข้อโปรโมชั่น</th>
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
                            	<a href="#myModalDetail<?=$promo_data[$i]['promotionId']?>" data-toggle="modal" class="ttip_t" title="รายละเอียดข่าว">
									<?=$promo_data[$i]['promotionTopic']?>
                                </a>
                            </td>
                            <td><?=Thai_date($promo_data[$i]['dateAdd'])?></td>
                            <td>
                            	
                                <div id="divShow<?=$promo_data[$i]['promotionId']?>" style="float:left; margin-right:5px; cursor:pointer;">
								<? if ($promo_data[$i]['statusShow'] == 1) { ?>
                                	<a class="sepV_a ttip_t" title="ซ่อน" onClick="fn_formShow(<?=$promo_data[$i]['promotionId']?>,'hide')"><i class="icon-eye-open"></i></a>
                                <? } else { ?>
                                	<a class="sepV_a ttip_t" title="แสดง" onClick="fn_formShow(<?=$promo_data[$i]['promotionId']?>,'show')"><i class="icon-eye-close"></i></a>
                                <? } ?>
                               	</div>
                                
                                <a href="#" class="ttip_t" data-toggle="modal" data-backdrop="static" title="Edit" onclick="fn_formEdit(<?=$promo_data[$i]['promotionId']?>, 'select');"><i class="icon-pencil"></i></a>
                                
                                <a href="#myModalDel<?=$promo_data[$i]['promotionId']?>" data-toggle="modal" class="ttip_t" title="Delete"><i class="icon-trash"></i></a>
                            
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- POP UP Delete -->
                        <div class="modal hide fade" id="myModalDel<?=$promo_data[$i]['promotionId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบโปรโมชั่น "<?=$promo_data[$i]['promotionTopic']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$promo_data[$i]['promotionId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
                                หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a>
                               	</p>
                            </div>
                        </div>
                        
                        
                        <!-- POP UP Detail -->
                        <div id="myModalDetail<?=$promo_data[$i]['promotionId']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel"><?=$promo_data[$i]['promotionTopic']?></h3>
                          </div>
                          <div class="modal-body">
                            <p><?=$promo_data[$i]['promotionDetail']?></p>
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
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


<script>
    $(document).ready(function() {
        //* show all elements & remove preloader
        setTimeout('$("html").removeClass("js")',1000);
    });
</script>
