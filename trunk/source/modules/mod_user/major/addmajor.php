
<?

function full_copy( $source, $target ) {
	if ( is_dir( $source ) ) {
		@mkdir( $target );
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

//Set majorTypeId
if($radMjtype=='company')
	$majortype = 2;
else
	$majortype = 1;

//เพิ่มข้อมูลตาราง garagelist
$dataGarage = array(
		'garagePassword'=>$g_password,
		'garageShortName'=>$shortName
);		
$addGarage = insert_db('garagelist', $dataGarage);
$garageResult = mysql_query($addGarage);

//Find last garageId
$strSQL = "SELECT garageId AS lastId FROM garagelist order by garageId DESC Limit 1";
$strQuery = mysql_query($strSQL); 
$result = mysql_fetch_object($strQuery); 
$last_id = $result->lastId; 	

//เพิ่มข้อมูลตาราง majoradmin
$dataMJ = array(
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
echo $addMJ = insert_db('majoradmin', $dataMJ);

mysql_query($addMJ) or die ("Can't insert user");

chmod("company",0777);
$tempMain = "company//".$shortName;
$imgfold = $tempMain."/img";

echo $tempMain."\n";
echo $imgfold;
echo "In addfile";
mkdir($tempMain,0777);
mkdir($imgfold,0777);

$tempfile = "company/default/index.php";
$newfile = $tempMain."/index.php";
copy($tempfile,$newfile);

$test = "company/test";
$newtest = $tempMain."/test";
full_copy($test,$newtest);

$act="";
?>
<SCRIPT language="JavaScript">
	window.location="index.php?p=user.major&menu=main_user";
</SCRIPT>