 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
 }
 //pre($_FILES);
 //pre($_SESSION);
 //pre(error_get_last());
 
 $upload_dir = "stored/taxi/";
 $upload_dir_thumb = "stored/taxi/thumbnail/";
 $uploadlimit = 2 * 1024 * 1024;
 $twidth = "100";   // Maximum Width For Thumbnail Images
 $theight = "100";   // Maximum Height For Thumbnail Images	
 $find_chk = 0;
	
 switch ($act){
	case 'addtaxi':	
		include('modules/mod_taxi/taximanage/formAdd.php');		
	 	break;		
		
	case 'edittaxi':
		include('modules/mod_taxi/taximanage/formEdit.php');
		break;	
		
	case 'saveedit':

		if ((trim($carRegistration) == trim($carRegistrationTmp)) && (trim($provinceId) == trim($provinceIdTmp))){
			$find_chk = 0;
		} else {
			//Check ป้ายทะเบียนซ้ำ	
			$find_chk = count_data_mysql('carId','car',"carRegistration = '".trim($carRegistration)."' and provinceId = '".$provinceId."'");
		}		

		
		if ($find_chk) {
			
			$message = "ไม่สามารถแก้ไขได้ เนื่องจากข้อมูลรถแท๊กซี่คันนี้มีแล้วในระบบ";
			//$act = 'edittaxi';
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg2','alert2','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_taxi/taximanage/formEdit.php');
		
		} else {	
					
			if($_FILES["fileinput"]["name"] != ""){	
			
				if ($_FILES["fileinput"]["size"] > $uploadlimit){
					$message = "ไฟล์มีขนาดใหญ่เกินไป";	
					?>
					<script type="text/javascript">			
                    $(document).ready(function() {
                        alertPopup('msg2','alert2','<?=$message?>',0);
                    });			
                    </script>
                    <?
										
				} else { 
					//Upload Image		
					$dt = $_SESSION['u_garage']."_".date('YmdHis');
					$file_tmp = $_FILES["fileinput"]["tmp_name"];
					$file = $_FILES['fileinput']['name'];			
					$File_type_all = $_FILES["fileinput"]["type"];
							
					switch($File_type_all){
						case "image/pjpeg" :
						case "image/jpeg" :
						case "image/jpg" :
						case "image/gif":						
						case "image/png":
						case "image/x-png":						
						case "image/bmp":
							$isImage = true;
							break;
						default : 
							$isImage = false;
					}
						
						
					if ($isImage){				
				
						$copy = copy($file_tmp, "$upload_dir" .$dt."_".$file);   // Move Image From Temporary Location To Permanent Location
					
						if ($copy) {
										
							//$size=GetimageSize($file);
							//print_r($size);
							switch($File_type_all){
								case "image/pjpeg" :
								case "image/jpeg" :
								case "image/jpg" :
									$simg = imagecreatefromjpeg("$upload_dir" . $dt."_".$file);
									break;
								case "image/gif":
									$simg = imagecreatefromgif("$upload_dir" . $dt."_".$file);
									break;
								case "image/png":
								case "image/x-png":
									$simg = imagecreatefrompng("$upload_dir" . $dt."_".$file);
									break;
								case "image/bmp":
									$simg = imagecreatefromwbmp("$upload_dir" . $dt."_".$file);
									break;
							}
		
			
							$currwidth = imagesx($simg);  
							$currheight = imagesy($simg); 
							
							if ($currheight > $currwidth) {   
								$zoom = $twidth / $currheight;  
								$newheight = $theight;  
								$newwidth = $currwidth * $zoom;   
							} else {   
								$zoom = $twidth / $currwidth;   
								$newwidth = $twidth;  
								$newheight = $currheight * $zoom;  
							}
						
							#echo "<br>".$newwidth ."|" . $newheight;
							
							$dimg = imagecreatetruecolor($newwidth, $newheight);	
							
							imagecopyresized($dimg, $simg, 0, 0, 0, 0, $newwidth, $newheight, $currwidth, $currheight);
							
							switch($File_type_all){
								case "image/pjpeg" :
								case "image/jpeg" :
								case "image/jpg" :
									imagejpeg($dimg,"$upload_dir_thumb".$dt."_".$file);
									break;
								case "image/gif":
									imagegif($dimg,"$upload_dir_thumb".$dt."_".$file);
									break;
								case "image/png":
								case "image/x-png":
									imagepng($dimg,"$upload_dir_thumb".$dt."_".$file);
									break;
								case "image/bmp":
									imagewbmp($dimg,"$upload_dir_thumb".$dt."_".$file);
									break;
							}
		
							imagedestroy($simg);
							imagedestroy($dimg);
										
							$filename = $dt."_".$file;
						
						} else { //if ($copy)		
					
							$message = "มีข้อผิดพลาดในการอัพโหลด";		
							$filename = '' ;				
							?>
							<script type="text/javascript">			
							$(document).ready(function() {
								alertPopup('msg2','alert2','<?=$message?>',0);
							});			
							</script>
							<?
						}
							
					} else { //if ($isImage)
						
						$message = "ไฟล์ที่ได้รับไม่ใช่รูปภาพ";	
						$filename = '' ;					
						?>
						<script type="text/javascript">			
						$(document).ready(function() {
							alertPopup('msg2','alert2','<?=$message?>',0);
						});			
						</script>
						<?
					}
				}
			} else { $filename = '' ; }
		
	
			if ($filename == '') { 
				$filename = $tmpimage; 
			} else {
				@unlink('stored/taxi/'.$tmpimage);
				@unlink('stored/taxi/thumbnail/'.$tmpimage);
			}
			
	
			$TableName = 'car';
			$data = array(
				'carRegistration'=>trim($carRegistration),
				'provinceId'=>$provinceId,			
				'carTypeId'=>$carTypeId,
				'carBannerId'=>$carBannerId,
				'carModelId'=>$carModelId,
				'carColorId'=>$carColorId,
				'carFuelId'=>$carFuelId,
				'carYear'=>$carYear,
				'carGasId'=>$carGasId,
				'dateUpdate'=>date('Y-m-d H:i:s'),
				'carImage'=>trim($filename)
			);
			$sql = update_db($TableName, array('carId='=>$carId), $data);
			mysql_query($sql);	
			//echo $sql;
			//exit;
			
			$message = "แก้ไขข้อมูลรถแท๊กซี่เรียบร้อยแล้วค่ะ";
			
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg3','alert3','<?=$message?>',0);			
			});		
			</script>
			<?
			include('modules/mod_taxi/taximanage/taxiShow.php');
		}
		break;
		
		
		
		
		
	case 'saveadd':	
		
		//Check ป้ายทะเบียนซ้ำ			
		$find_chk = count_data_mysql('carId','car',"carRegistration = '".trim($carRegistration)."' and provinceId = '".$provinceId."'");
			
		if ($find_chk) {
			
			$message = "ข้อมูลรถแท๊กซี่คันนี้มีแล้วในระบบ";
			$act = 'addtaxi';
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg2','alert2','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_taxi/taximanage/formAdd.php');
			
		} else {
		
			if($_FILES["fileinput"]["name"] != ""){
				if ($_FILES["fileinput"]["size"] > $uploadlimit){
					$message = "ไฟล์มีขนาดใหญ่เกินไป";	
					?>
					<script type="text/javascript">			
                    $(document).ready(function() {
                        alertPopup('msg2','alert2','<?=$message?>',0);
                    });			
                    </script>
                    <?
										
				} else { 
					//Upload Image		
					$dt = $_SESSION['u_garage']."_".date('YmdHis');
					$file_tmp = $_FILES["fileinput"]["tmp_name"];
					$file = $_FILES['fileinput']['name'];			
					$File_type_all = $_FILES["fileinput"]["type"];
							
					switch($File_type_all){
						case "image/pjpeg" :
						case "image/jpeg" :
						case "image/jpg" :
						case "image/gif":						
						case "image/png":
						case "image/x-png":						
						case "image/bmp":
							$isImage = true;
							break;
						default : 
							$isImage = false;
					}
						
						
					if ($isImage){				
				
						$copy = copy($file_tmp, "$upload_dir" .$dt."_".$file);   // Move Image From Temporary Location To Permanent Location
					
						if ($copy) {	
							//$size=GetimageSize($file);
							//print_r($size);
							switch($File_type_all){
								case "image/pjpeg" :
								case "image/jpeg" :
								case "image/jpg" :
									$simg = imagecreatefromjpeg("$upload_dir" . $dt."_".$file);
									break;
								case "image/gif":
									$simg = imagecreatefromgif("$upload_dir" . $dt."_".$file);
									break;
								case "image/png":
								case "image/x-png":
									$simg = imagecreatefrompng("$upload_dir" . $dt."_".$file);
									break;
								case "image/bmp":
									$simg = imagecreatefromwbmp("$upload_dir" . $dt."_".$file);
									break;
							}
		
			
							$currwidth = imagesx($simg);  
							$currheight = imagesy($simg); 
							
							if ($currheight > $currwidth) {   
								$zoom = $twidth / $currheight;  
								$newheight = $theight;  
								$newwidth = $currwidth * $zoom;   
							} else {   
								$zoom = $twidth / $currwidth;   
								$newwidth = $twidth;  
								$newheight = $currheight * $zoom;  
							}
						
							#echo "<br>".$newwidth ."|" . $newheight;
							
							$dimg = imagecreatetruecolor($newwidth, $newheight);	
							
							imagecopyresized($dimg, $simg, 0, 0, 0, 0, $newwidth, $newheight, $currwidth, $currheight);
							
							switch($File_type_all){
								case "image/pjpeg" :
								case "image/jpeg" :
								case "image/jpg" :
									imagejpeg($dimg,"$upload_dir_thumb".$dt."_".$file);
									break;
								case "image/gif":
									imagegif($dimg,"$upload_dir_thumb".$dt."_".$file);
									break;
								case "image/png":
								case "image/x-png":
									imagepng($dimg,"$upload_dir_thumb".$dt."_".$file);
									break;
								case "image/bmp":
									imagewbmp($dimg,"$upload_dir_thumb".$dt."_".$file);
									break;
							}
		
							imagedestroy($simg);
							imagedestroy($dimg);		 
				
							$filename = $dt."_".$file;
						
						} else { //if ($copy)		
					
							$message = "มีข้อผิดพลาดในการอัพโหลด";		
							$filename = '' ;				
							?>
							<script type="text/javascript">			
							$(document).ready(function() {
								alertPopup('msg2','alert2','<?=$message?>',0);
							});			
							</script>
							<?
						}
							
					} else { //if ($isImage)
						
						$message = "ไฟล์ที่ได้รับไม่ใช่รูปภาพ";	
						$filename = '' ;					
						?>
						<script type="text/javascript">			
						$(document).ready(function() {
							alertPopup('msg2','alert2','<?=$message?>',0);
						});			
						</script>
						<?
					}
				}
	
			} else { $filename = '' ; }
	
		
			
		
			$act = '';
			$TableName = 'car';
			$data = array(
				'garageId'=>$garageId,
				'carRegistration'=>trim($carRegistration),
				'provinceId'=>$provinceId,			
				'carTypeId'=>$carTypeId,
				'carBannerId'=>$carBannerId,
				'carModelId'=>$carModelId,
				'carColorId'=>$carColorId,
				'carFuelId'=>$carFuelId,
				'carYear'=>$carYear,
				'carGasId'=>$carGasId,
				'carStatusId'=>3,
				'carImage'=>trim($filename)
			);
			$sql = insert_db($TableName, $data);
			mysql_query($sql);	
			
			$message = "เพิ่มข้อมูลรถแท๊กซี่ทะเบียน ".$carRegistration." เรียบร้อยแล้วค่ะ";
			
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg3','alert3','<?=$message?>',0);
			});		
			</script>
			<?
			include('modules/mod_taxi/taximanage/taxiShow.php');
		}		
			
		break;	
		
		
		
		
	default:
		include('modules/mod_taxi/taximanage/taxiShow.php');
 }
 
 
 ?>


<form action="index.php?p=taxi.taximanage&menu=main_taxi" name="fmReload" id="fmReload" method="post">
	<input type="hidden" name="garageId" value="<?=$garageId?>" />
    <input type="hidden" name="current_page" id="current_pageLoad" value="<?=$current_page?>" />
</form>
 
 

<script type="text/javascript">
	var delayAlert=null; 
	var find_chk = <?=$find_chk?>;
	
	$(document).ready(function(){	
		//console.log(find_chk);	
		
		if (find_chk == 1){
			$('#errRegistration').show();
		} else {
			$('#errRegistration').hide();
		}
		/*var carRegistration = '<?=$carRegistration?>';
		if (carRegistration != ''){
			//fn_formAdd();
		}*/
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
		//window.location = 'index.php?p=taxi.taximanage&menu=main_taxi&garageId=<?=$garageId?>'; 
		$('#fmReload').submit();
	}
	
	function fn_goToPage(page){
		//console.log(page);	
		if (page == 'add'){	
			$("#fm_selectmajor").attr("action", 'index.php?p=taxi.taximanage&menu=main_taxi&act=addtaxi');
			$('#fm_selectmajor').submit();		
		}
	}
	
	
	
	function alertPopup(msgid,alertid,message,newload){
		$('#'+msgid+'').text(''+message+'');
		$('#'+alertid+'').fadeIn(500, function() {
			clearTimeout(delayAlert);  
			delayAlert=setTimeout(function(){  
				alertFadeOut(''+alertid+'');
				if (newload == 1){
					reloadPage();  
				}
				delayAlert=null;  
			},2000);  
		});
	}
	
	
	
	function fn_callModel(id){
		//alert(id);
		$.post('modules/mod_taxi/taximanage/get_model.php', {id:id} , function(data) {
			if (data != '') {
				$('#carModelId').html(data);
			} else {
				$('#carModelId').html('<option value="">กรุณาเลือกรุ่นรถ</option>');
			}
		});	
	}
	
	
	
	function fn_chkRegisDuplicate(act){
		var provinceId = $('#provinceId').val();
		var carRegistration = $('#carRegistration').val();
		
		if (act == 'add'){
			datatag = 'act=add&carRegistration='+carRegistration+'&provinceId='+provinceId+'';
		}
		if (act == 'edit'){
			var provinceIdTmp = $('#provinceIdTmp').val();
			var carRegistrationTmp = $('#carRegistrationTmp').val();
			datatag = 'act=edit&carRegistration='+carRegistration+'&provinceId='+provinceId+'&carRegistrationTmp='+carRegistrationTmp+'&provinceIdTmp='+provinceIdTmp+'';
		}
		
		jQuery.ajax({
			url :'modules/mod_taxi/taximanage/chkRegisDuplicate.php',
			type: 'GET',
			data: datatag,
			dataType: 'jsonp',
			dataCharset: 'jsonp',
			success: function (data){
				console.log(data.success);
				if (data.success){ 
					$('#errRegistration').hide();
				} else {
					$('#errRegistration').fadeIn(200);
				}				
			}
		});	
	}
</script>