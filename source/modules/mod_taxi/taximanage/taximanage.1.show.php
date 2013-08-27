 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
 }
 //pre($_FILES);
 //pre($_SESSION);
 
 $upload_dir = "stored/taxi/";
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
			} else { $filename = '' ; }
		
	
			if ($filename == '') { 
				$filename = $tmpimage; 
			} else {
				@unlink('stored/taxi/'.$tmpimage);
			}
			
	
			$TableName = 'car';
			$data = array(
				'carRegistration'=>$carRegistration,
				'provinceId'=>$provinceId,			
				'carTypeId'=>$carTypeId,
				'carBannerId'=>$carBannerId,
				'carModelId'=>$carModelId,
				'carColorId'=>$carColorId,
				'carFuelId'=>$carFuelId,
				'carYear'=>$carYear,
				'carGasId'=>$carGasId,
				'carImage'=>$filename
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
	
			} else { $filename = '' ; }
	
		
			
		
			$act = '';
			$TableName = 'car';
			$data = array(
				'garageId'=>$garageId,
				'carRegistration'=>$carRegistration,
				'provinceId'=>$provinceId,			
				'carTypeId'=>$carTypeId,
				'carBannerId'=>$carBannerId,
				'carModelId'=>$carModelId,
				'carColorId'=>$carColorId,
				'carFuelId'=>$carFuelId,
				'carYear'=>$carYear,
				'carGasId'=>$carGasId,
				'carStatusId'=>3,
				'carImage'=>$filename
			);
			$sql = insert_db($TableName, $data);
			mysql_query($sql);	
			
			$message = "เพิ่มข้อมูลรถแท๊กซี่ทะเบียน '".$carRegistration."' เรียบร้อยแล้วค่ะ";
			
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
</form>
 
 

<script type="text/javascript">
	var delayAlert=null; 
	var find_chk = <?=$find_chk?>;
	
	$(document).ready(function(){	
		console.log(find_chk);	
		
		if (find_chk == 1){
			$('#errRegistration').show();
		} else {
			$('#errRegistration').hide();
		}
		/*var carRegistration = '<?=$carRegistration?>';
		if (carRegistration != ''){
			//fn_formAdd();
		}*/
	});
	
	function alertFadeOut(id){
		$('#'+id+'').fadeOut(1000); 
	}
	
	function reloadPage(){
		//window.location = 'index.php?p=taxi.taximanage&menu=main_taxi&garageId=<?=$garageId?>'; 
		$('#fmReload').submit();
	}
	
	function fn_goToPage(page){
		console.log(page);	
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
</script>