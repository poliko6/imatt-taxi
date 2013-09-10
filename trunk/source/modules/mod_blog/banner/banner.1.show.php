<?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
 }
 
 //pre($_FILES);
 ?>

<!--<link rel="stylesheet" href="lib/ckeditor/contents.css" /> -->
<script src="lib/ckeditor/ckeditor.js"></script>
<?

//-------------------------- Major Data
$sql_major = "SELECT * FROM majoradmin INNER JOIN garagelist ON majoradmin.garageId = garagelist.garageId ";
$sql_major .= "WHERE majoradmin.garageId = '".$u_garage."'";
$rs_major = mysql_query($sql_major);
$data_major = mysql_fetch_object($rs_major);
$major_name = $data_major->thaiCompanyName;
$major_shotname = $data_major->garageShortName;


//-------------------------- Default Path
$thispath = "company/".$major_shotname."/";
$upload_dir = $thispath."img/";
$uploadlimit = 2 * 1024 * 1024;

$twidth_logo = "200";   // Maximum Width For Thumbnail Images
$theight_logo = "150";   // Maximum Height For Thumbnail Images	

$twidth_banner = "200";   // Maximum Width For Thumbnail Images
$theight_banner = "150";   // Maximum Height For Thumbnail Images	

//-------------------------- Action Check

if (!empty($act)) {
	switch ($act) {
		
		case 'savelogo':
		
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
								$zoom = $twidth_logo / $currheight;  
								$newheight = $theight_logo;  
								$newwidth = $currwidth * $zoom;   
							} else {   
								$zoom = $twidth_logo / $currwidth;   
								$newwidth = $twidth_logo;  
								$newheight = $currheight * $zoom;  
							}
						
							#echo "<br>".$newwidth ."|" . $newheight;
							
							$dimg = imagecreatetruecolor($newwidth, $newheight);	
							
							imagecopyresized($dimg, $simg, 0, 0, 0, 0, $newwidth, $newheight, $currwidth, $currheight);
							
							switch($File_type_all){
								case "image/pjpeg" :
								case "image/jpeg" :
								case "image/jpg" :
									imagejpeg($dimg,"$upload_dir"."thumb_".$dt."_".$file);
									break;
								case "image/gif":
									imagegif($dimg,"$upload_dir"."thumb_".$dt."_".$file);
									break;
								case "image/png":
								case "image/x-png":
									imagepng($dimg,"$upload_dir"."thumb_".$dt."_".$file);
									break;
								case "image/bmp":
									imagewbmp($dimg,"$upload_dir"."thumb_".$dt."_".$file);
									break;
							}
		
							imagedestroy($simg);
							imagedestroy($dimg);
										
							$filename = $dt."_".$file;
							
							if ($chk_logo != 0){
								@unlink($upload_dir.$tmpimage);
								@unlink($upload_dir.'thumb_'.$tmpimage);
							}
							
							$Table_Name = 'garageinterface';
							$data = array(
								'interfaceLogo'=>$filename	
							);
							$sql = update_db($Table_Name, array('garageId='=>$u_garage), $data);
							mysql_query($sql);
							
							$message = "แก้ไขโลโก้เรียบร้อยแล้วค่ะ";
			
							?>
							<script type="text/javascript">			
							$(document).ready(function() {
								alertPopup('msg3','alert3','<?=$message?>',0);			
							});		
							</script>
							<?
							
						
						} else { //if ($copy)		
							//copy ไม่สำเร็จ
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
						
						//ไม่ใช่รูปภาพ
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
				
			} else { 
			
				//ไม่มีไฟล์อยู่
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
			
			break;
		


		case 'savebanner':
		
			if($_FILES["fileinput_banner"]["name"] != ""){	
			
				if ($_FILES["fileinput_banner"]["size"] > $uploadlimit){
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
					$file_tmp = $_FILES["fileinput_banner"]["tmp_name"];
					$file = $_FILES['fileinput_banner']['name'];			
					$File_type_all = $_FILES["fileinput_banner"]["type"];
							
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
								$zoom = $twidth_banner / $currheight;  
								$newheight = $theight_banner;  
								$newwidth = $currwidth * $zoom;   
							} else {   
								$zoom = $twidth_banner / $currwidth;   
								$newwidth = $twidth_banner;  
								$newheight = $currheight * $zoom;  
							}
						
							#echo "<br>".$newwidth ."|" . $newheight;
							
							$dimg = imagecreatetruecolor($newwidth, $newheight);	
							
							imagecopyresized($dimg, $simg, 0, 0, 0, 0, $newwidth, $newheight, $currwidth, $currheight);
							
							switch($File_type_all){
								case "image/pjpeg" :
								case "image/jpeg" :
								case "image/jpg" :
									imagejpeg($dimg,"$upload_dir"."thumb_".$dt."_".$file);
									break;
								case "image/gif":
									imagegif($dimg,"$upload_dir"."thumb_".$dt."_".$file);
									break;
								case "image/png":
								case "image/x-png":
									imagepng($dimg,"$upload_dir"."thumb_".$dt."_".$file);
									break;
								case "image/bmp":
									imagewbmp($dimg,"$upload_dir"."thumb_".$dt."_".$file);
									break;
							}
		
							imagedestroy($simg);
							imagedestroy($dimg);
										
							$filename = $dt."_".$file;
							
							if ($chk_logo != 0){
								@unlink($upload_dir.$tmpimage_banner);
								@unlink($upload_dir.'thumb_'.$tmpimage_banner);
							}
							
							$Table_Name = 'garageinterface';
							$data = array(
								'interfaceBanner'=>$filename	
							);
							$sql = update_db($Table_Name, array('garageId='=>$u_garage), $data);
							mysql_query($sql);
							
							$message = "แก้ไขป้ายโฆษณาเรียบร้อยแล้วค่ะ";
			
							?>
							<script type="text/javascript">			
							$(document).ready(function() {
								alertPopup('msg3','alert3','<?=$message?>',0);			
							});		
							</script>
							<?
							
						
						} else { //if ($copy)		
							//copy ไม่สำเร็จ
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
						
						//ไม่ใช่รูปภาพ
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
				
			} else { 
			
				//ไม่มีไฟล์อยู่
				$message = "ไฟล์ที่อัพโหลดหายไป";		
				$filename = '' ;				
				?>
				<script type="text/javascript">			
				$(document).ready(function() {
					alertPopup('msg2','alert2','<?=$message?>',0);
				});			
				</script>
				<?
			}
						
			break;
			
			
		
		case 'savelink':
			
			$Table_Name = 'garageinterface';
			$data = array(
				'interfaceFacebook'=>$interfaceFacebook,
				'interfaceTwitter'=>$interfaceTwitter,
				'interfaceGoogle'=>$interfaceGoogle
			);
			$sql = update_db($Table_Name, array('garageId='=>$u_garage), $data);
			mysql_query($sql);
			$message = "แก้ไขลิงค์เรียบร้อยแล้วค่ะ";
			
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg3','alert3','<?=$message?>',0);
			});		
			</script>
			<?
			
			break;
			
			
		case 'saveinfo':
			
			$Table_Name = 'garageinterface';
			$data = array(
				'garageAbout'=>$wysiwg_full				
			);
			$sql = update_db($Table_Name, array('garageId='=>$u_garage), $data);
			mysql_query($sql);
			$message = "แก้ไขข้อมูลเกี่ยวกับอู่เรียบร้อยแล้วค่ะ";
			
			?>
			<script type="text/javascript">			
			$(document).ready(function() {
				alertPopup('msg3','alert3','<?=$message?>',0);
			});		
			</script>
			<?
			
			break;
			
			
	}
}



//-------------------------- Check Folder
if(!@mkdir($thispath,0,true)){ 
	//มีอยู่แล้ว
	//die('Failed to create folders...'); 
	if(!@mkdir($upload_dir,0,true)){
		//echo "have folder";
	} else {
		$imgfold = $thispath."/img";
		mkdir($imgfold,0777);
	}
} else {
	$tempfile = "company/default/index.php";
	$newfile = $thispath."/index.php";
	copy($tempfile,$newfile);
	
	$imgfold = $thispath."/img";
	mkdir($imgfold,0777);
	
	/*$test = "company/test";
	$newtest = $tempMain."/test";
	full_copy($test,$newtest);*/
}


//-------------------------- Check Interface Data
$sql_chk_interface = "select count(interfaceId) as totaldata from garageinterface where garageId = '".$u_garage."'";
$rs_chk_interface = mysql_query($sql_chk_interface);
$data_chk_interface = mysql_fetch_object($rs_chk_interface);
$chk_rowdata = $data_chk_interface->totaldata;

if($chk_rowdata == 0){	
	$Table_Name = 'garageinterface';
	$data = array(
        'interfaceLogo'=>'logo.png',
        'interfaceBanner'=>'banner.jpg',
        'interfaceFacebook'=>'https://www.facebook.com/',
		'interfaceTwitter'=>'https://twitter.com/',
		'interfaceGoogle'=>'https://plus.google.com/',
		'garageId'=>$u_garage
	);
	$sql = insert_db($Table_Name, $data);
	mysql_query($sql);
}


//-------------------------- Call Interface Data
$sql_interface = "select * from garageinterface where garageId = '".$u_garage."'";
$rs_interface = mysql_query($sql_interface);
$data_interface = mysql_fetch_object($rs_interface);
$interfaceLogo = $data_interface->interfaceLogo;
$interfaceBanner = $data_interface->interfaceBanner;
$interfaceFacebook = $data_interface->interfaceFacebook;
$interfaceTwitter = $data_interface->interfaceTwitter;
$interfaceGoogle = $data_interface->interfaceGoogle;
$garageAbout = $data_interface->garageAbout;


//-------------------------- Check Logo
$chk_logo = 0;
$pathLogo  = $upload_dir.$interfaceLogo;
if (file_exists($pathLogo)) {  //check file			
	$pathLogo  = $upload_dir.$interfaceLogo;
	$chk_logo = 1;
} else { 						
	$pathLogo  = 'gallery/noimage.gif'; 	
}


//-------------------------- Check ฺBanner
$chk_banner = 0;
$pathBanner  = $upload_dir.$interfaceBanner;
if (file_exists($pathBanner)) {  //check file			
	$pathBanner  = $upload_dir.$interfaceBanner;
	$chk_banner = 1;
} else { 						
	$pathBanner  = 'gallery/banner_noimage.gif'; 	
}
	
	
?>

<div class="row-fluid">
    <div style="padding:10px;">
        <!--<h3 class="heading">Bordered tabs</h3> -->
        <div class="tabbable tabbable-bordered">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_br1" data-toggle="tab">ปรับแต่งโลโก้</a></li>
                <li><a href="#tab_br2" data-toggle="tab">ปรับแต่งป้ายโฆษณา</a></li>
                <li><a href="#tab_br3" data-toggle="tab">ปรับแต่งลิงค์</a></li>
                <li><a href="#tab_br4" data-toggle="tab">ข้อมูลเกี่ยวกับอู่</a></li>
            </ul>
            <div class="tab-content">
                
                
                <div class="tab-pane active" id="tab_br1">
                    <div class="span6">
                        <form class="form-horizontal well" style="background:#FBFBFB;" id="fm_logo" action="" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <p class="f_legend">ปรับแต่งโลโก้</p>
                                
                                <div class="control-group" style="text-align:center">
                                	<span class="help-block" style="color:#F00;">ควรมีขนาด 200 x 150 Pixel</span>
                                    <div data-provides="fileupload" class="fileupload fileupload-new">
                                    	<input type="hidden" name="chk_logo" value="<?=$chk_logo?>">
                                        <input type="hidden" name="tmpimage" value="<?=$interfaceLogo?>">
                                        <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
                                        	<img src="<?=$pathLogo?>" alt="" />
                                        </div>
                                        <div style="max-width: 200px; max-height: 150px; line-height: 0px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-file">
                                                <span class="fileupload-new">เลือกภาพโลโก้</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" name="fileinput" id="fileinput" />
                                            </span>
                                            <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                        </div>
                                    </div>
                                    <div class="help-block" style="color:#F00; display:none;" id="err_logo">กรุณาเลือกโลโก้ที่ต้องการเปลี่ยน</div>
                                </div>
                                
                               <div class="form-actions" style="text-align:center; padding-left:0px;">
								   	<input class="btn btn-primary" type="button" value="บันทึกโลโก้" onClick="fm_editLogo();" />
									<input type="button" class="btn" value="ยกเลิก" onClick="reloadPage();" />
							   </div>                                
                               
                            </fieldset>
                            
                            <input type="hidden" name="p" value="<?=$p?>" />
                            <input type="hidden" name="menu" value="<?=$menu?>" />
                            <input type="hidden" name="act" value="savelogo" />     
                        </form>
                    </div>
                </div>
                
                
                
                <div class="tab-pane" id="tab_br2">
                    <div class="span12">
                        <form class="form-horizontal well" style="background:#FBFBFB;" id="fm_banner" action="" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <p class="f_legend">ปรับแต่งป้ายโฆษณา</p>
                                
                                <div class="control-group" style="text-align:center">
                                	<span class="help-block" style="color:#F00;">ควรมีขนาด 879 x 520 Pixel</span>
                                    <div data-provides="fileupload" class="fileupload fileupload-new">
                                    	<input type="hidden" name="chk_banner" value="<?=$chk_banner?>">
                                        <input type="hidden" name="tmpimage_banner" value="<?=$interfaceBanner?>">
                                        <div style="width: 879px; height: 520px;" class="fileupload-new thumbnail">
                                        	<img src="<?=$pathBanner?>" alt="" />
                                        </div>
                                        <div style="max-width: 879px; max-height: 520px; line-height: 0px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-file">
                                                <span class="fileupload-new">เลือกภาพป้ายโฆษณา</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" name="fileinput_banner" id="fileinput_banner" />
                                            </span>
                                            <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                        </div>
                                    </div>
                                    <div class="help-block" style="color:#F00; display:none;" id="err_banner">กรุณาเลือกป้ายโฆษณาที่ต้องการเปลี่ยน</div>
                                </div>
                                
                               <div class="form-actions" style="text-align:center; padding-left:0px;">
								   	<input class="btn btn-primary" type="button" value="บันทึกโลโก้" onClick="fm_editBanner();" />
									<input type="button" class="btn" value="ยกเลิก" onClick="reloadPage();" />
							   </div>                                
                               
                            </fieldset>
                            
                            <input type="hidden" name="p" value="<?=$p?>" />
                            <input type="hidden" name="menu" value="<?=$menu?>" />
                            <input type="hidden" name="act" value="savebanner" />     
                        </form>
                    </div>
                </div>  
                
                
                <div class="tab-pane" id="tab_br3">
                    <div class="span8">
                        <form class="form-horizontal well" style="background:#FBFBFB;" id="fm_link" action="" method="post">
                            <fieldset>
                                <p class="f_legend">ปรับแต่งลิงค์</p>
                                
                                <div class="control-group">
                                    <label class="control-label">Facebook Link : </label>
                                    <div class="controls">
                                        <input type="text" class="span8" name="interfaceFacebook" id="interfaceFacebook" value="<?=$interfaceFacebook?>" />
                                        <span class="help-block">ตัวอย่าง: https://www.facebook.com/</span>
                                        <div class="help-block" style="color:#F00; display:none;" id="interfaceFacebook_err">กรุณาป้อนข้อมูล Facebook หรือถ้าไม่มีให้เติม https://www.facebook.com/</div>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Twitter Link : </label>
                                    <div class="controls">
                                        <input type="text" class="span8" name="interfaceTwitter" id="interfaceTwitter" value="<?=$interfaceTwitter?>" />
                                        <span class="help-block">ตัวอย่าง: https://twitter.com/</span>
                                        <div class="help-block" style="color:#F00; display:none;" id="interfaceTwitter_err">กรุณาป้อนข้อมูล Twitter หรือถ้าไม่มีให้เติม https://twitter.com/</div>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Text input</label>
                                    <div class="controls">
                                        <input type="text" class="span8" name="interfaceGoogle" id="interfaceGoogle" value="<?=$interfaceGoogle?>" />
                                        <span class="help-block">ตัวอย่าง: https://plus.google.com/</span>
                                        <div class="help-block" style="color:#F00; display:none;" id="interfaceGoogle_err">กรุณาป้อนข้อมูล Google Plus หรือถ้าไม่มีให้เติม https://plus.google.com/</div>
                                    </div>
                                </div>
                                
                               <div class="form-actions" style="text-align:center; padding-left:0px;">
								   	<input class="btn btn-primary" type="button" value="บันทึกลิงค์" onClick="fm_editLink();" />
									<input type="button" class="btn" value="ยกเลิก" onClick="reloadPage();" />
							   </div>                                
                               
                            </fieldset>
                            
                            <input type="hidden" name="p" value="<?=$p?>" />
                            <input type="hidden" name="menu" value="<?=$menu?>" />
                            <input type="hidden" name="act" value="savelink" />     
                        </form>
                    </div>
                </div>  
                
                
                <div class="tab-pane" id="tab_br4">
                	<div class="span12">
                        <form class="form-horizontal well" style="background:#FBFBFB;" id="fm_info" action="" method="post">
                            <fieldset>
                                <p class="f_legend">ปรับแต่งข้อมูล</p>
                                
                                 <div class="control-group" style="text-align:center"> 
                                 	<div  style="border:1px #CCC solid;">                                   
                                    	<textarea name="wysiwg_full" id="wysiwg_full" cols="50" rows="10"><?=$garageAbout?></textarea>
                                    </div>
                                </div>
                                <div class="form-actions" style="text-align:center; padding-left:0px;">
								   	<input class="btn btn-primary" type="button" value="บันทึกข้อมูล" onClick="fm_editInfo();" />
									<input type="button" class="btn" value="ยกเลิก" onClick="reloadPage();" />
							   </div>                                
                               
                            </fieldset>
                            
                            <input type="hidden" name="p" value="<?=$p?>" />
                            <input type="hidden" name="menu" value="<?=$menu?>" />
                            <input type="hidden" name="act" value="saveinfo" />
                        </form>
                    </div>
                </div>
                
                             
            </div>
        </div>
    </div>
 </div>
 
 

 
 <script type="text/javascript">
    $(document).ready(function () { 
 		CKEDITOR.replace('wysiwg_full', {  });  
  	});
  </script>
 
 
 <script type="text/javascript">
	var delayAlert=null; 
		
	$(document).ready(function(){	
		//console.log(find_chk);
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
		window.location = 'index.php?p=blog.banner&menu=main_blog'; 
	}	
	
	function alertPopup(msgid,alertid,message,newload){
		$('#'+msgid+'').text(''+message+'');
		$('#'+alertid+'').fadeIn(500, function() {
			clearTimeout(delayAlert);  
			delayAlert=setTimeout(function(){  
				//alertFadeOut(''+alertid+'');
				$('#'+alertid+'').fadeOut(1000);
				if (newload == 1){
					reloadPage();  
				}
				delayAlert=null;  
			},2000);  
		});
	}
	
	function checkData(id){
		if ($('#'+id+'').val() == ''){ 
			$('#'+id+'').closest('div').addClass("f_error");
			$('#'+id+'_err').fadeIn(1000);
			return 0;
		} else {
			$('#'+id+'').closest('div').removeClass("f_error");
			$('#'+id+'_err').fadeOut(100);
			return 1;
		}
	}
	
	function fm_editLogo(){
		if ($('#fileinput').val() == ''){
			$('#err_logo').fadeIn(500);
		} else {
			$('#err_logo').hide();
			$('#fm_logo').submit();
		}
	}
	
	function fm_editBanner(){
		if ($('#fileinput_banner').val() == ''){
			$('#err_banner').fadeIn(500);
		} else {
			$('#err_banner').hide();
			$('#fm_banner').submit();
		}
	}
	
	function fm_editLink(){
		var pass = 1;
		if (checkData('interfaceFacebook') == 0){ pass = 0 }
		if (checkData('interfaceTwitter') == 0){ pass = 0 }
		if (checkData('interfaceGoogle') == 0){ pass = 0 }	
		
		console.log(pass);
		if (pass){
			$('#fm_link').submit();
		}		
	}
	
	
	function fm_editInfo(){
		$('#fm_info').submit();
	}
	
</script>