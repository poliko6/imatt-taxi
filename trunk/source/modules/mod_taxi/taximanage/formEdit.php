<?
$major_data = select_db('majoradmin',"where garageId = '".$garageId."'");
$major_name = $major_data[0]['thaiCompanyName'];

$car_data = select_db('car',"where carId = '".$carId."'");
$carRegistration = $car_data[0]['carRegistration'];
$provinceId = $car_data[0]['provinceId'];

$carYear = $car_data[0]['carYear'];
$carImage = $car_data[0]['carImage'];
$garageId = $car_data[0]['garageId'];
$carTypeId = $car_data[0]['carTypeId'];
$carBannerId = $car_data[0]['carBannerId'];
$carModelId = $car_data[0]['carModelId'];
$carGasId = $car_data[0]['carGasId'];
$carFuelId = $car_data[0]['carFuelId'];
$carColorId = $car_data[0]['carColorId'];
$carStatusId = $car_data[0]['carStatusId'];

$pathimage  = 'stored/taxi/thumbnail/'.$carImage;

if (file_exists($pathimage)) {  //check file			
	$pathimage  = 'stored/taxi/thumbnail/'.$carImage;
} else { 						
	$pathimage  = ''; 	
}

if (file_exists($pathimage)) {  //check file			
	$pathimage  = 'stored/taxi/thumbnail/'.$carImage;
} else { 						
	$pathimage  = ''; 	
}
?>


<script type="text/javascript">
$(document).ready( function () {
	
	if ($('#carBannerId').val() != ''){
		fn_callModel($('#carBannerId').val());
	}
	
	$('#carBannerId').change(function () {
		fn_callModel($('#carBannerId').val());
	});

});




function fn_callModel(id){
	//alert(id);
	$.post('modules/mod_taxi/taximanage/get_model.php', {id:id} , function(data) {
  		$('#carModelId').html(data);	
	});	
}
</script>




<div class="row-fluid">
    <div class="span12">
        <h3 class="heading" style="font-size:12px; text-align:center;">เพิ่มรถแท๊กซี่ในระบบ ของอู่ "<span style="color:#06C;"><?=$major_name?></span>"</h3>
        <div class="row-fluid">
            <div class="span8">
                <form class="form-horizontal form_validation_ttip" enctype="multipart/form-data" method="post">
                    <fieldset>
   						<div class="formSep">
                        	<div class="row-fluid">
                                <div class="span12">
                                    <label for="fileinput" class="control-label">ทะเบียนรถ <span class="f_req">*</span></label>
                                    <div class="controls text_line">
                                    	<div class="help-block" id="errRegistration" style="display:none; color:#C00;">หมายเลขทะเบียนซ้ำ</div>
                                        <input type="text" name="carRegistration" id="carRegistration" class="span5"  value="<?=$carRegistration?>"  />
                                        <span class="help-block">ตัวอย่าง : กก 0001</span>
                                        <input type="hidden" name="carRegistrationTmp" id="carRegistrationTmp" value="<?=$carRegistration?>"  />
                                    </div>
                            	</div>
                            </div>
                        </div>
                        
                         <div class="control-group formSep">
                            <label for="provinceId" class="control-label">จังหวัด</label>
                            <div class="controls">
                            	<? $province_data = select_db('province',"order by provinceId"); ?>                                
                                <input type="hidden" name="provinceIdTmp" id="provinceIdTmp" value="<?=$provinceId?>"  />
                                <select class="span3" name="provinceId" id="provinceId">
                                	<? foreach($province_data as $valProvince){?>
                                    <option value="<?=$valProvince['provinceId']?>" <? if ($provinceId == $valProvince['provinceId']) { echo "selected=\"selected\""; } ?> ><?=$valProvince['provinceName']?></option>
                                    <? } ?>                                    
                                </select>
                            </div>                           	
                         </div>
                        
                        
                        <div class="control-group formSep">
                            <label for="fileinput" class="control-label">รูปรถแท๊กซี่</label>
                            <div class="controls">
                                <div data-provides="fileupload" class="fileupload fileupload-new">
                                    <input type="hidden" />
                                    <input type="hidden" name="tmpimage" id="tmpimage" value="<?=$carImage?>" />
                                  	
                                    <? if ($pathimage != '') { ?>
                                        <a href="<?=$pathimage?>" title="<?=$car_data[$i]['carRegistration']?>" class="cbox_single thumbnail">
                                            <img alt="" src="<?=$pathimage?>" style="height:80px;">
                                        </a>
                                    <? } ?>
                                    
                                    <div style="width: 80px; height: 80px;" class="fileupload-new thumbnail"><img src="http://www.placehold.it/80x80/EFEFEF/AAAAAA" alt="" /></div>
                                    <div style="width: 80px; height: 80px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                    <span class="btn btn-file"><span class="fileupload-new">เลือกไฟล์รูป</span><span class="fileupload-exists">Change</span><input type="file" id="fileinput" name="fileinput" /></span>
                                    <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                </div>	
                            </div>
                        </div>
                        
                        
                         <div class="control-group formSep">
                            <label for="carTypeId" class="control-label">ประเภทรถยนต์</label>
                            <div class="controls">
                            	<? $type_data = select_db('cartype',"order by carTypeId"); ?>
                                <select class="span3" name="carTypeId" id="carTypeId">
                                	<? foreach($type_data as $valType){?>
                                    <option value="<?=$valType['carTypeId']?>" <? if ($carTypeId == $valType['carTypeId']) { echo "selected=\"selected\""; } ?> ><?=$valType['carTypeName']?></option>
                                    <? } ?>                                    
                                </select>
                            </div>                           	
                        </div>
         
                        <div class="control-group formSep">
                            <label for="carBannerId" class="control-label">ยี่ห้อรถ</label>
                            <div class="controls">
                            	<? $banner_data = select_db('carbanner',"order by carBannerId"); ?>
                                <select class="span3" name="carBannerId" id="carBannerId">
                                	<? foreach($banner_data as $valBanner){?>
                                    <option value="<?=$valBanner['carBannerId']?>" <? if ($carBannerId == $valBanner['carBannerId']) { echo "selected=\"selected\""; } ?> ><?=$valBanner['carBannerNameEng']?></option>
                                    <? } ?>                                    
                                </select>
                            </div>                           	
                        </div>
                        
                        <div class="control-group formSep">
                            <label for="carModelId" class="control-label">รุ่นรถรถ</label>
                            <div class="controls">                            	
                                <select class="span3" name="carModelId" id="carModelId">
                                	<option></option>                                
                                </select>
                            </div>                           	
                        </div>
                        
                        
                        <div class="control-group formSep">
                            <label for="carYear" class="control-label">ปีรถ</label>
                            <div class="controls">                            	
                                <select class="span3" name="carYear" id="carYear">
                                	<? 
									$thisyear = date('Y');
									$toyear = date('Y')-30;
									for ($year = $thisyear; $year > $toyear; $year--){ ?>
                                		<option value="<?=$year?>" <? if ($carYear == $year) { echo "selected=\"selected\""; } ?> ><?=$year?></option>  
                                    <? } ?>                         
                                </select>
                            </div>                           	
                        </div>
                        
                        
                         <div class="control-group formSep">
                            <label for="carColorId" class="control-label">สีรถ</label>
                            <div class="controls">
                            	<? $color_data = select_db('carcolor',"order by carColorId"); ?>
                                <select class="span3" name="carColorId" id="carColorId">
                                	<? foreach($color_data as $valColor){?>
                                    <option value="<?=$valColor['carColorId']?>" <? if ($carColorId == $valColor['carColorId']) { echo "selected=\"selected\""; } ?> ><?=$valColor['carColorName']?></option>
                                    <? } ?>                                    
                                </select>
                            </div>                           	
                        </div>
                        
                        <div class="control-group formSep">
                            <label for="carFuelId" class="control-label">ประเภทเชื้อเพลิง</label>
                            <div class="controls">
                            	<? $fuel_data = select_db('carfuel',"order by carFuelId"); ?>
                                <select class="span3" name="carFuelId" id="carFuelId">
                                	<? foreach($fuel_data as $valFuel){?>
                                    <option value="<?=$valFuel['carFuelId']?>" <? if ($carFuelId == $valFuel['carFuelId']) { echo "selected=\"selected\""; } ?> ><?=$valFuel['carFuelName']?></option>
                                    <? } ?>                                    
                                </select>
                            </div>                           	
                        </div>
                        
                         <div class="control-group formSep">
                            <label for="carGasId" class="control-label">ประเภทแก๊สรถยนต์</label>
                            <div class="controls">
                            	<? $gas_data = select_db('cargas',"order by carGasId"); ?>
                                <select class="span3" name="carGasId" id="carGasId">
                                	<option value="0">ไม่ได้ติดแก๊ส</option>
                                	<? foreach($gas_data as $valGas){?>
                                    	<option value="<?=$valGas['carGasId']?>" <? if ($carGasId == $valGas['carGasId']) { echo "selected=\"selected\""; } ?> ><?=$valGas['carGasName']?></option>
                                    <? } ?>                                    
                                </select>
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

<script src="js/jquery.min.js"></script>
<!-- smart resize event -->
<script src="js/jquery.debouncedresize.min.js"></script>
<!-- hidden elements width/height -->
<script src="js/jquery.actual.min.js"></script>
<!-- js cookie plugin -->
<script src="js/jquery.cookie.min.js"></script>
<!-- main bootstrap js -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- tooltips -->
<script src="lib/qtip2/jquery.qtip.min.js"></script>
<!-- jBreadcrumbs -->
<script src="lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
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
 