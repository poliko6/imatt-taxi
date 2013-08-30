<?
$major_data = select_db('majoradmin',"where garageId = '".$garageId."'");
$major_name = $major_data[0]['thaiCompanyName'];

$mobile_data = select_db('mobile',"where mobileId = '".$mobileId."'");
$mobileNumber = $mobile_data[0]['mobileNumber'];
$mobileNetworkId = $mobile_data[0]['mobileNetworkId'];

$EmiMsi = $mobile_data[0]['EmiMsi'];
$mobileBanner = $mobile_data[0]['mobileBanner'];
$mobileModel = $mobile_data[0]['mobileModel'];
?>

<div class="row-fluid">
    <div class="span12">
        <h3 class="heading" style="font-size:12px; text-align:center;">แก้ไขโทรศัพท์่ในระบบ ของอู่ "<span style="color:#06C;"><?=$major_name?></span>"</h3>
        <div class="row-fluid">
            <div class="span8">
               
                <form class="form-horizontal form_validation_ttip" method="post">
                    <fieldset>
   						<div class="formSep">
                        	<div class="row-fluid">
                                <div class="span12">
                                    <label for="fileinput" class="control-label">หมายเลขโทรศัพท์ <span class="f_req">*</span></label>
                                    <div class="controls text_line">
                                    	<div class="help-block" id="errNumber" style="display:none; color:#C00;">หมายเลขโทรศัพท์ซ้ำ</div>
                                        <input type="text" name="mobileNumber" id="mobileNumber" class="span5"  value="<?=$mobileNumber?>"  />
                                        <span class="help-block">ตัวอย่าง : 0845123xxx</span>                                        
                                    </div>
                            	</div>
                            </div>
                        </div>
                        
                         <div class="formSep">
                        	<div class="row-fluid">
                                <div class="span12">
                                    <label for="fileinput" class="control-label">Emi/Msi <span class="f_req">*</span></label>
                                    <div class="controls text_line">
                                    	<div class="help-block" id="errEmiMsi" style="display:none; color:#C00;">Emi/Msi ซ้ำ</div>
                                        <input type="text" name="EmiMsi" id="EmiMsi" class="span5"  value="<?=$EmiMsi?>"  />
                                        <span class="help-block">ตัวอย่าง : xxxxxxxxxx</span>                                        
                                    </div>
                            	</div>
                            </div>
                         </div>                        
                                                
        
                        
                         <div class="control-group formSep">
                           
                           	<div class="row-fluid">
                                <div class="span12">
                                    <label for="carTypeId" class="control-label">เครือข่าย <span class="f_req">*</span></label>
                                    <div class="controls">
                                        <? $network_data = select_db('mobilenetwork',"order by mobileNetworkId"); ?>
                                        <select class="span3" name="mobileNetworkId" id="mobileNetworkId">
                                            <option value="">กรุณาเลือกเครือข่าย</option>
                                            <? foreach($network_data as $valNetwork){?>
                                            <option value="<?=$valNetwork['mobileNetworkId']?>" <? if ($mobileNetworkId == $valNetwork['mobileNetworkId']) { echo "selected=\"selected\""; } ?> ><?=$valNetwork['mobileNetworkName']?></option>
                                            <? } ?>                                    
                                        </select>
                                    </div>  
                               	</div>
                    		</div>    
                            
                           
                           	<div class="row-fluid">
                                <div class="span12">
                           		 	<label for="fileinput" class="control-label">ยี่ห้อโทรศัพท์ <span class="f_req">*</span></label>
                                    <div class="controls text_line">
                                  		<input type="text" name="mobileBanner" id="mobileBanner" class="span5"  value="<?=$mobileBanner?>"  />
                                        <span class="help-inline">ตัวอย่าง : Samsung</span>                                        
                                    </div>
                                 </div>
                            </div>
                            
                            
                           	<div class="row-fluid">
                                <div class="span12">
                           		 	<label for="fileinput" class="control-label">รุ่นโทรศพท์ <span class="f_req">*</span></label>
                                    <div class="controls text_line">                                    	
                                        <input type="text" name="mobileModel" id="mobileModel" class="span5"  value="<?=$mobileModel?>"  />
                                        <span class="help-inline">ตัวอย่าง : Galaxy s4</span>                                        
                                    </div>
                                 </div>
                            </div>                          
                         	
                         </div>                       
                       
                        <div class="control-group">
                            <div class="controls">
                                <button class="btn btn-gebo" type="submit">Save changes</button>
                            	<input type="button" class="btn" onClick="reloadPage()" value="Cancel">
                            </div>
                        </div>
                    </fieldset>
					<input type="hidden" name="carId" value="<?=$carId?>" />
                    <input type="hidden" name="p" value="<?=$p?>" />
                    <input type="hidden" name="menu" value="<?=$menu?>" />
                    <input type="hidden" name="garageId" value="<?=$garageId?>" />        
                    <input type="hidden" name="act" value="saveedit" />
                </form>
            </div>
        </div>
    </div>
</div>


<!-- sticky messages -->
<script src="lib/sticky/sticky.min.js"></script>
<!-- fix for ios orientation change -->
<script src="js/ios-orientationchange-fix.js"></script>
<!-- scrollbar -->
<script src="lib/antiscroll/antiscroll.js"></script>
<script src="lib/antiscroll/jquery-mousewheel.js"></script>
<!-- lightbox -->
<script src="lib/colorbox/jquery.colorbox.min.js"></script>
<!-- common functions -->
<script src="js/gebo_common.js"></script>

<!-- validation -->
<script src="lib/validation/jquery.validate.min.js"></script>
<!-- validation functions -->
<script src="js/gebo_validation.js"></script>

<script>
	$(document).ready(function() {
		//* show all elements & remove preloader
		setTimeout('$("html").removeClass("js")',1000);
	});
</script>
 