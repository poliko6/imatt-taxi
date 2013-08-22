 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
 }
 //pre($_FILES);
 
 $upload_dir = "stored/taxi/";
 $uploadlimit = 2 * 1024 * 1024;
 $twidth = "100";   // Maximum Width For Thumbnail Images
 $theight = "100";   // Maximum Height For Thumbnail Images	
	
 switch ($act){
	case 'addtaxi':	
		include('modules/mod_taxi/taximanage/formAdd.php');		
	 	break;		
		
	case 'edittaxi':
		include('modules/mod_taxi/taximanage/formEdit.php');
		break;
		
	case 'saveadd':
		
		
		break;
		
		
	default:
		include('modules/mod_taxi/taximanage/taxiShow.php');
 }
 
 
 
 
 if ($saveadd == 1){
 	if($_FILES["fileinput"]["name"] != "")
	{
				
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
					$('#msg2').text('<?=$message?>');
					$('#alert2').fadeIn(500, function() {
						clearTimeout(delayAlert);  
						delayAlert=setTimeout(function(){  
						alertFadeOut('alert2'); 
						delayAlert=null;  
					},2000);  
					});
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
				$('#msg2').text('<?=$message?>');
				$('#alert2').fadeIn(500, function() {
					clearTimeout(delayAlert);  
					delayAlert=setTimeout(function(){  
					alertFadeOut('alert2'); 
					delayAlert=null;  
				},2000);  
				});
			});
	
			</script>
			<?
		}
	} else { $filename = '' ; }
	
	
	
	//Check ป้ายทะเบียนซ้ำ		
	
	
	$car_chk = select_db('car',"where carRegistration = '".trim($carRegistration)."' and provinceId = '".$provinceId."'");
	
	if ($find_chk) {
		$message = "ข้อมูลรถแท๊กซี่คันนี้มีแล้วในระบบ";
		?>
		<script type="text/javascript">
		
		$(document).ready(function() {
			$('#msg3').text('<?=$message?>');
			$('#alert3').fadeIn(500, function() {
				clearTimeout(delayAlert);  
				delayAlert=setTimeout(function(){  
				alertFadeOut('alert2');
				reloadPage();  
				delayAlert=null;  
			},2000);  
			});
		});
	
		</script>
		<?
		
	} else {
	
	
		$TableName = 'car';
		$data = array(
			'garageId'=>$garageid,
			'carRegistration'=>$carRegistration,
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
		
		$message = "เพิ่มข้อมูลรถแท๊กซี่เรียบร้อยแล้วค่ะ";
		
		?>
		<script type="text/javascript">
		
		$(document).ready(function() {
			$('#msg3').text('<?=$message?>');
			$('#alert3').fadeIn(500, function() {
				clearTimeout(delayAlert);  
				delayAlert=setTimeout(function(){  
				alertFadeOut('alert2');
				reloadPage();  
				delayAlert=null;  
			},2000);  
			});
		});
	
		</script>
		<?
	}
 }
 
 ?>
 
 
<script type="text/javascript">
	var delayAlert=null; 
	$(document).ready(function(){
		var carRegistration = '<?=$carRegistration?>';
		if (carRegistration != ''){
			//fn_formAdd();
		}
		console.log(carRegistration);
	});
	
	function alertFadeOut(id){
		$('#'+id+'').fadeOut(1000); 
	}
	
	function reloadPage(){
		window.location = 'index.php?p=taxi.taximanage&menu=main_taxi&garageid=<?=$garageid?>'; 
	}
	
	function fn_goToPage(page){
		console.log(page);
		if (page == 'add'){
			window.location = 'index.php?p=taxi.taximanage&menu=main_taxi&garageid=<?=$garageid?>&act=addtaxi'; 
		}
	}
	
	
</script>