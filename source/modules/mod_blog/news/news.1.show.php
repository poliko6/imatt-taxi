 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
 }
 

 $news_data = select_db('news',"where garageId = '".$u_garage."' order by dateAdd");
 $total = count($news_data);
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
			url :'modules/mod_blog/news/del.news.php',
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
			url :'modules/mod_blog/news/show.news.php',
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
		if ($('#newsTopic').val() == ''){
			$('#newsTopic').closest('div').addClass("f_error");
			$('#errtxt').fadeIn(500);
		} else {
			//$('#fm_add').submit();
			var editor_data = CKEDITOR.instances.newsDetail.getData();	
			var newsTopic = $('#newsTopic').val();		
			//console.log(editor_data);
			jQuery.ajax({
   				url :'modules/mod_blog/news/add.news.php',
   				type: 'GET',
  				data: 'newsTopic='+newsTopic+'&newsDetail='+editor_data+'&garageId=<?=$u_garage?>',
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
					$('#newsTopic').val('');
   				}
			});	
			
		}
	}
	
	
	
	
	function fn_formEdit(id,process){
		//console.log(id);
		
		if (process == 'select') {
			jQuery.ajax({
				url :'modules/mod_blog/news/get.news.php',
				type: 'GET',
				data: 'act=getnews&id='+id+'',
				dataType: 'jsonp',
				dataCharset: 'jsonp',
				success: function (data){
					//console.log(data.success);
					//var editor = $('#newsDetail_edit').ckeditor().editor;
					//alert( editor.checkDirty() );					
					$("#newsTopic_edit").val(data.topic);
					//$("textarea#newsDetail_edit").val(data.detail);
					CKEDITOR.instances['newsDetail_edit'].setData(data.detail);
					$("#newsId").val(id);				
					$('#myModalEdit').modal('toggle');
				}
			});	
		
		}
		
		
		
		
		
		if (process == 'update') {
			
			var id = $("#newsId").val();
			
			
			if ($('#newsTopic_edit').val() == ''){
				$('#newsTopic_edit').closest('div').addClass("f_error");
				$('#errtxt_edit').fadeIn(500);
			
			} else {
				var editor_data = CKEDITOR.instances.newsDetail_edit.getData();	
				var newsTopic = $('#newsTopic_edit').val();		
				jQuery.ajax({
					url :'modules/mod_blog/news/edit.news.php',
					type: 'GET',
					data: 'act=update&newsTopic='+newsTopic+'&newsDetail='+editor_data+'&id='+id+'',
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
        <h3>เพิ่มข่าวสาร</h3>
    </div>
    <form action="" name="fm_add" id="fm_add">
    <div class="modal-body">
        <div class="formSep">
            <label>หัวข้อข่าวสาร</label>
            <input class="span6" type="text" name="newsTopic" id="newsTopic" value="" />
            <span class="help-inline">ตัวอย่าง : ระบบรถแท๊กซี่มีเครื่องติดตามแล้ววันนี้</span>
            <span class="help-block" id="errtxt" style="color:#900; display:none;">กรุณาป้อนหัวข้อข่าวสาร</span>
        </div> 
        
        <div class="formSep">
            <label>รายละเอียดข่าวสาร</label>
            <textarea name="newsDetail" id="newsDetail" cols="50" rows="10"></textarea>
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
	CKEDITOR.replace('newsDetail', {  });  
});
</script>


<!-- POP UP EDIT -->
<div class="modal hide fade" id="myModalEdit" style="width:auto;">
    <div class="modal-header">
        <h3>แก้ไขข่าวสาร</h3>
    </div>
    <form action="" name="fm_edit" id="fm_edit">
    <div class="modal-body">
        <div class="formSep">
            <label>หัวข้อข่าวสาร</label>
            <input class="span6" type="text" name="newsTopic_edit" id="newsTopic_edit" value="" />
            <span class="help-inline">ตัวอย่าง : ระบบรถแท๊กซี่มีเครื่องติดตามแล้ววันนี้</span>
            <span class="help-block" id="errtxt_edit" style="color:#900; display:none;">กรุณาป้อนหัวข้อข่าวสาร</span>
        </div> 
        
        <div class="formSep">
            <label>รายละเอียดข่าวสาร</label>
            <textarea name="newsDetail_edit" id="newsDetail_edit" cols="50" rows="10"></textarea>
        </div> 
    </div>
    <div class="modal-footer">        
    	<!--<input type="submit" name="submit_add" id="submit_add"  class="btn btn-primary" value="บันทึก" /> -->
        <a class="btn btn-primary" onclick="fn_formEdit('','update');"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
    <input type="hidden" name="newsId" id="newsId" value="" />
    </form>
</div>

<script type="text/javascript">
$(document).ready(function () { 
	CKEDITOR.replace('newsDetail_edit', {  });  
});
</script>

 
 <div class="row-fluid search_page">
	<div class="span12">
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการข่าวสารทั้งหมด <strong><?=$total?></strong></div>
                <div class="pull-right">
                  <a data-toggle="modal" data-backdrop="static" href="#myModalAdd">
                  	<button class="btn btn-success" onClick="">เพิ่มข่าวสาร</button></a>  
                </div>
            </div>
        </div>
        
  
  		
  
		<? if ($total != 0){ ?>
            <table class="table table-striped table-bordered dTableR" id="dt_a">
                <thead>
                    <tr>
                        <th style="width:10px">ลำดับ</th>
                        <th style="width:250px">หัวข้อข่าวสาร</th>
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
                            	<a href="#myModalDetail<?=$news_data[$i]['newsId']?>" data-toggle="modal" class="ttip_t" title="รายละเอียดข่าว">
									<?=$news_data[$i]['newsTopic']?>
                                </a>
                            </td>
                            <td><?=Thai_date($news_data[$i]['dateAdd'])?></td>
                            <td>
                            	
                                <div id="divShow<?=$news_data[$i]['newsId']?>" style="float:left; margin-right:5px; cursor:pointer;">
								<? if ($news_data[$i]['statusShow'] == 1) { ?>
                                	<a class="sepV_a ttip_t" title="ซ่อน" onClick="fn_formShow(<?=$news_data[$i]['newsId']?>,'hide')"><i class="icon-eye-open"></i></a>
                                <? } else { ?>
                                	<a class="sepV_a ttip_t" title="แสดง" onClick="fn_formShow(<?=$news_data[$i]['newsId']?>,'show')"><i class="icon-eye-close"></i></a>
                                <? } ?>
                               	</div>
                                
                                <a href="#" class="ttip_t" data-toggle="modal" data-backdrop="static" title="Edit" onclick="fn_formEdit(<?=$news_data[$i]['newsId']?>, 'select');"><i class="icon-pencil"></i></a>
                                
                                <a href="#myModalDel<?=$news_data[$i]['newsId']?>" data-toggle="modal" class="ttip_t" title="Delete"><i class="icon-trash"></i></a>
                            
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- POP UP Delete -->
                        <div class="modal hide fade" id="myModalDel<?=$news_data[$i]['newsId']?>" style="text-align:center; width:500px;">
                            <div class="alert alert-block alert-error fade in">
                                <h4 class="alert-heading">คุณต้องการลบข่าว "<?=$news_data[$i]['newsTopic']?>"</h4>
                                <div style="height:50px;"></div>
                                <p>
                                <a href="#" class="btn btn-inverse" onclick="fn_formDel(<?=$news_data[$i]['newsId']?>);"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> 
                                หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a>
                               	</p>
                            </div>
                        </div>
                        
                        
                        <!-- POP UP Detail -->
                        <div id="myModalDetail<?=$news_data[$i]['newsId']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel"><?=$news_data[$i]['newsTopic']?></h3>
                          </div>
                          <div class="modal-body">
                            <p><?=$news_data[$i]['newsDetail']?></p>
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
