<?
/*//เพิ่มข้อมูลตาราง garagelist
$dataGarage = array(
		'garagePassword'=>$g_password,
		'garageShortName'=>$shortName
);		
$addGarage = insert_db('garagelist', $dataGarage);
$garageResult = mysql_query($addGarage);*/

//echo $citizenId;

//Get garageId

	if($u_type == 1)
		$newGarageId = $selGarage2;
	else
		$newGarageId = $u_garage;
	
	
	$upload_dir = "stored/driver/";
	$upload_dir_thumb = "stored/driver/thumbnail/";
	$uploadlimit = 2 * 1024 * 1024;
	$twidth = "100";   // Maximum Width For Thumbnail Images
	$theight = "100";   // Maximum Height For Thumbnail Images	
	
	
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
	//echo "Filename = ".$filename;
	
	//เพิ่มข้อมูลตาราง majoradmin	
	$dataAdd = array(
			'driverImage'=>trim($filename),
			'firstName'=>$fName,
			'lastName'=>$lName,
			'driverBirthday'=>$birthDay,
			'citizenId'=>$citizenId,
			'username'=>$userName,
			'password'=>sha1($u_password),
			'licenseNumber'=>$dLicense,
			'address'=>$txtAddress_add,
			'zipcode'=>$txtZipcode_add,
			'provinceId'=>$province_add,
			'amphurId'=>$amphur_add,
			'districtId'=>$district_add,		
			'mobilePhone'=>$txtMobilePhone,
			'telephone'=>$txtTel,		
			'garageId'=>$newGarageId
	);
if($statusAdd=="new")
{
	$addMJ = insert_db("drivertaxi", $dataAdd);
	//echo $addMJ;
	mysql_query($addMJ) or die ("Can't insert user");
}
else
{
	$dataUp = array(
			'firstName'=>$fName,
			'lastName'=>$lName,
			'driverBirthday'=>$birthDay,
			'citizenId'=>$citizenId,			
			'licenseNumber'=>$dLicense,
			'address'=>$txtAddress_add,
			'zipcode'=>$txtZipcode_add,
			'provinceId'=>$province_add,
			'amphurId'=>$amphur_add,
			'districtId'=>$district_add,		
			'mobilePhone'=>$txtMobilePhone,
			'telephone'=>$txtTel,		
			'garageId'=>$newGarageId
	);		
	$strWhere = "";	
	
	$strUp = update_db('drivertaxi',array('citizenId ='=>$citizenId),$dataUp);
	mysql_query($strUp) or die ("Can't update user");
	
	if($filename != '')
	{
		$uppic = array(
			'driverImage'=>trim($filename),
			'citizenId'=>$citizenId			
		);	
		$strUppic = update_db('drivertaxi',array('citizenId ='=>$citizenId),$uppic);
		mysql_query($strUppic) or die ("Can't update user");	
	}
}

$act="";
?>
<SCRIPT language="JavaScript">
	window.location="index.php?p=driver.managedriver&menu=main_user";
</SCRIPT>