<?
	
	include("../../../../include/class.mysqldb.php");
	include("../../../../include/config.inc.php");
	include("../../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}

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
		
		'garageId'=>$garageId,
		'dateUpdated'=>$today
);
$udMJ = update_db('majoradmin', array('garageId = '=>$garageId), $dataMJ);
mysql_query($udMJ) or die ("Can't insert user");

?>
<SCRIPT language="JavaScript">
	window.location="../../../../index.php?p=user.profile&menu=main_user&sav=yes";
</SCRIPT>
