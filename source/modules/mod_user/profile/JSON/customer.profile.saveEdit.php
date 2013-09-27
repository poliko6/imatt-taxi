<?

	include("../../../../include/class.mysqldb.php");
	include("../../../../include/config.inc.php");
	include("../../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		//echo $key ."=". $value."<br>";
	}
	
date_default_timezone_set('Asia/Bangkok');
$today = date("Y-m-d H:i:s");

$dataCus = array(
	'firstName'=>$firstName,
	'lastName'=>$lastName,
	'citizenId'=>$citizenId,
	'telephone'=>$telephone_profile,
	'location'=>$location,
	'birthDay'=>$birthday,
	'dateUpdated'=>$today
);
$udCustomer = update_db('customer', array('customerId ='=>$customerId), $dataCus); 
$cusResult = mysql_query($udCustomer) or die ("Can't Update User");	

$dataMobCus = array(
	'mobileNumber'=>$telephone_profile,
);
$udMobCus = update_db('mobilecustomer', array('customerId ='=>$customerId), $dataMobCus);
mysql_query($udMobCus) or die ("Can't Update Customer");


?>
<SCRIPT language="JavaScript">
	window.location="../../../../index.php?p=user.profile&menu=main_user&sav=yes";
</SCRIPT>
