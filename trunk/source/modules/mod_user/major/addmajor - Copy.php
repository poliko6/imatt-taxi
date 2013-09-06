<?
function full_copy( $source, $target ) {
	if ( is_dir( $source ) ) {
		@mkdir( $target );
		@chmod( $target,0777 );
		$d = dir( $source );
		while ( FALSE !== ( $entry = $d->read() ) ) {
			if ( $entry == '.' || $entry == '..' ) {
				continue;
			}
			$Entry = $source . '/' . $entry; 
			if ( is_dir( $Entry ) ) {
				full_copy( $Entry, $target . '/' . $entry );
				continue;
			}
			copy( $Entry, $target . '/' . $entry );
		}
 
		$d->close();
	}else {
		copy( $source, $target );
	}
}

 function full_delete($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir") 
           full_delete($dir."/".$object); 
        else unlink   ($dir."/".$object);
      }
    }
    reset($objects);
    rmdir($dir);
  }
 }

//Set majorTypeId
if($radMjtype=='company')
	$majortype = 2;
else
	$majortype = 1;

//copy all file from old folder
$chkShortName = "SELECT garageShortName FROM garagelist WHERE garageId ='".$garageId."'";
$chkShortNameQuery = mysql_query($chkShortName);
$shortNameResult = mysql_fetch_object($chkShortNameQuery);

$newShortName = "company/".$shortName;
$oldShortName = "company/".$shortNameResult->garageShortName;
full_copy($oldShortName,$newShortName);

//delete old folder
full_delete($oldShortName);

//Find last garageId
$strSQL = "SELECT garageId AS lastId FROM garagelist order by garageId DESC Limit 1";
$strQuery = mysql_query($strSQL); 
$result = mysql_fetch_object($strQuery); 
$last_id = $result->lastId; 	

//เพิ่มข้อมูลตาราง majoradmin
/*$dataMJ = array(
        'thaiCompanyName'=>$thName,
        'englishCompanyName'=>$engName,
        'managerName'=>$managerName,
		'username'=>$userName,
		'password'=>sha1($u_password),
		'businessType'=>$typeBus,
		'address'=>$txtAddress,
		'zipcode'=>$txtZipcode,
		'provinceId'=>$province_add,
		'amphurId'=>$amphur_add,
		'districtId'=>$district_add,		
		'mobilePhone'=>$txtMobilePhone,
		'telephone'=>$txtTel,
		'fax'=>$txtFax,
		'callCenter'=>$txtCallcenter,
		'email'=>$txtEmail,
		
		'majorTypeId'=>$majortype,
		'garageId'=>$last_id,
);
$addMJ = insert_db('majoradmin', $dataMJ);
mysql_query($addMJ) or die ("Can't insert user");*/

/*chmod("company",0777);
$tempMain = "company//".$shortName;
$imgfold = $tempMain."/img";

mkdir($tempMain,0777);
mkdir($imgfold,0777);

$tempfile = "company/default/index.php";
$newfile = $tempMain."/index.php";
copy($tempfile,$newfile);*/


$act="";
?>
<SCRIPT language="JavaScript">
	window.location="index.php?p=user.major&menu=main_user";
</SCRIPT>