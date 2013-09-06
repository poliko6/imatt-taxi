<?
//Set majorTypeId
if($radMjtype=='company')
	$majortype = 2;
else
	$majortype = 1;

//rename old folder

$chkShortName = "SELECT garageShortName FROM garagelist WHERE garageId ='".$garageId."'";
$chkShortNameQuery = mysql_query($chkShortName);
$shortNameResult = mysql_fetch_object($chkShortNameQuery);
if($shortName != $shortNameResult->garageShortName)	{
	$newShortName = "company/".$shortName."";
	$oldShortName = "company/".$shortNameResult->garageShortName."";
	rename($oldShortName,$newShortName);
}
//Find garageId
$strSQL = "SELECT garageId FROM majoradmin WHERE garageId ='".$garageId."'";
$strQuery = mysql_query($strSQL); 
$result = mysql_fetch_object($strQuery); 
$select_id = $result->garageId; 

date_default_timezone_set('Asia/Bangkok');
$today = date("Y-m-d H:i:s");

//แก้ไขข้อมูลตาราง garagelist
$dataGarage = array(
		'garageShortName'=>$shortName,
		'dateUpdated'=>$today
);		

$udGarage = update_db('garagelist', array('garageId ='=>$garageId), $dataGarage);
$garageResult = mysql_query($udGarage);	

//เพิ่มข้อมูลตาราง majoradmin
$dataMJ = array(
        'thaiCompanyName'=>$thName,
        'englishCompanyName'=>$engName,
        'managerName'=>$managerName,
		'businessType'=>$typeBus,
		'address'=>$txtAddress_add,
		'zipcode'=>$txtZipcode_add,
		'provinceId'=>$province_add,
		'amphurId'=>$amphur_add,
		'districtId'=>$district_add,		
		'mobilePhone'=>$txtMobilePhone,
		'telephone'=>$txtTel,
		'fax'=>$txtFax,
		'callCenter'=>$txtCallcenter,
		'email'=>$txtEmail,
		
		'majorTypeId'=>$majortype,
		'garageId'=>$garageId,
		'dateUpdated'=>$today
);
$udMJ = update_db('majoradmin', array('garageId = '=>$garageId), $dataMJ);
mysql_query($udMJ) or die ("Can't insert user");

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