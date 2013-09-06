<?
/*
act	saveedit
amphur_add	1
callback	jQuery181017730965046212077_1378446816806
district_add	1
engName	Taxi Blue Ocean Deepblue Green Yellow Orange Red Company
garageId	1
managerName	ManyColorful Color
menu	main_user
p	user.profile
province_add	1
radMjtype	supervisor
shortName	superv
thName	บริษัทแท๊กซี่สีฟ้าครามน้ำเงินเขียวเหลืองแสดแดง
txtAddress_add	521
txtCallcenter	1711
txtEmail	taxiwithsomanycolor@taxi.com
txtFax	-
txtMobilePhone	0874451245
txtTel	021547895
txtZipcode_add	10100
typeBus	Supervisor
*/

    require_once '../../../../include/Zend/JSON.php';
    $json = new Services_JSON();
	
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

	$data['success'] = true;
	$data['message'] = "บันทึกการแก้ไขข้อมูลเรียบร้อยแล้ว";

echo $_GET['callback'].'('.$json->encode($data).')';
?>
