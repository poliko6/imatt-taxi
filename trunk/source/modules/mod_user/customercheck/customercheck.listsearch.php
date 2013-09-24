<?
$where_tag = 'WHERE 1 ';

$parttxt = explode(' ',$search_text);

if ($uni_r == 'option1'){
	foreach($parttxt as $val){
		$where_tag = $where_tag." AND firstName LIKE '%".$val."%' OR lastName LIKE '%".$val."%'";
	}
}

if ($uni_r == 'option2'){
	foreach($parttxt as $val){
		$where_tag = $where_tag." AND citizenId LIKE '%".$val."%'";
	}
}

$sql_customer = "SELECT * FROM customer ".$where_tag;
$rs_customer = mysql_query($sql_customer);
$founddata = mysql_num_rows($rs_customer);
#echo $sql_customer;

?>


<div class="row-fluid sepH_c" style="margin-top:10px;">
    <div class="span4">
        <form class="form-horizontal well" method="post" id="fm_search">
            <fieldset>
                <p class="f_legend">ค้นหาลูกค้า</p>
                
                <div class="control-group">
                    <label class="control-label">เลือกการค้นหา</label>
                    <div class="controls">                        
                        <label class="uni-radio"> 
                            <input type="radio" value="option1" id="uni_r1a" name="uni_r" class="uni_style"  <? if ($uni_r == 'option1') { echo "checked"; } ?> />
                            ค้นหาตามรายชื่อ
                        </label>
                        <label class="uni-radio">
                            <input type="radio" value="option2" id="uni_r1b" name="uni_r" class="uni_style"  <? if ($uni_r == 'option2') { echo "checked"; } ?> />
                            หมายเลขบัตรประชาชน
                        </label>                          
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Keyword</label>
                    <div class="controls">
                        <input type="text" name="search_text" id="search_text" class="span10" value="<?=$search_text?>" />
                        <div class="help-block" style="font-style:italic; color:#F00; display:none;" id="search_text_err">กรุณากรอกชื่อหรือหมายเลขบัตรประชาชนที่ต้องการค้นหา</div>
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <input class="btn btn-danger" type="button" value="ค้นหาลูกค้า" onClick="submitSearch();">
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="act" value="searchsubmit" />
            <input type="hidden" name="p" value="<?=$p?>" />
            <input type="hidden" name="menu" value="<?=$menu?>" />
        </form>
    </div>	
    
    
   
    
    <div class="span8">
    	<!--<h3 class="heading">ผลการค้นหา</h3> -->        
        <? if ($founddata > 0) { ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="5%">ลำดับ</th>
                    <th>อีเมล์</th>
                    <th>ชื่อลูกค้า</th>
                    <th>หมายเลขบัตรประชาฃน</th>
                </tr>
            </thead>
            <tbody>
				<?		
				$i=0;
				while ($data_customer = @mysql_fetch_object($rs_customer)){
					$i++;
					$firstName = $data_customer->firstName;
					foreach($parttxt as $val){
						$new = '<strong style="color:#F33;">'.$val.'</strong>';						
						$firstName = str_replace($val,$new,$firstName);
					}
					
					$lastName = $data_customer->lastName;
					foreach($parttxt as $val){
						$new = '<strong style="color:#F33;">'.$val.'</strong>';						
						$lastName = str_replace($val,$new,$lastName);
					}
					
					$citizenId = $data_customer->citizenId;
					foreach($parttxt as $val){
						$new = '<strong style="color:#F33;">'.$val.'</strong>';						
						$citizenId = str_replace($val,$new,$citizenId);
					}
					$email = $data_customer->email;
					$bgcolor = (($i%2)==0)?"#F8F8F8":"#FFFFFF"; 
					?>
					<tr>
						<td style="background-color:<?=$bgcolor?>"><?=$i?></td>
						<td style="background-color:<?=$bgcolor?>;"> <?=$email?></td>
						<td style="background-color:<?=$bgcolor?>"><a href="#" onClick="seeDataSearch(<?=$data_customer->customerId?>)"><?=$firstName?>  <?=$lastName?></a></td>
						<td style="background-color:<?=$bgcolor?>"><a href="#" onClick="seeDataSearch(<?=$data_customer->customerId?>)"><?=$citizenId?></a></td>
					</tr>
                <? } ?>
               
            </tbody>
        </table>
        <? } else {  ?>
         	<div style="text-align:center;">
                <strong>ไม่พบข้อมูลการค้นหา!</strong>
            </div>
        <? } ?>	
    </div>
</div>


<form method="post" id="fm_customerid">
    <input type="hidden" name="customerId" id="customerId" value="" />
    <input type="hidden" name="p" value="<?=$p?>" />
    <input type="hidden" name="menu" value="<?=$menu?>" />
</form>

	
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