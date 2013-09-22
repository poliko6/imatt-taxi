
 <div class="row-fluid">
 	<div class="span3"></div>
    <div class="span6"  style="margin-top:10px;">
        <form class="form-horizontal well" method="post"  id="fm_search">
            <fieldset>
                <p class="f_legend">ค้นหาคนขับรถ</p>
                
                <div class="control-group">
                    <label class="control-label">เลือกการค้นหา</label>
                    <div class="controls">                        
                        <label class="uni-radio">
                            <input type="radio" checked="" value="option1" id="uni_r1a" name="uni_r" class="uni_style" />
                            ค้นหาตามรายชื่อ
                        </label>
                        <label class="uni-radio">
                            <input type="radio" value="option2" id="uni_r1b" name="uni_r" class="uni_style" />
                            หมายเลขบัตรประชาชน
                        </label>                          
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Keyword</label>
                    <div class="controls">
                        <input type="text" name="search_text" id="search_text" class="span10" />
                        <div class="help-block" style="font-style:italic; color:#F00; display:none;" id="search_text_err">กรุณากรอกชื่อหรือหมายเลขบัตรประชาชนที่ต้องการค้นหา</div>
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <input class="btn btn-danger" type="button" value="ค้นหาพนักงานขับรถ" onClick="submitSearch();">
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="act" value="searchsubmit" />
            <input type="hidden" name="p" value="<?=$p?>" />
            <input type="hidden" name="menu" value="<?=$menu?>" />
        </form>
    </div>
   <div class="span3"></div>
</div>


 

	
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