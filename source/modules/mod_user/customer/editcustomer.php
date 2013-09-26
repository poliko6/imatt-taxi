<?
date_default_timezone_set('Asia/Bangkok');
$today = date("Y-m-d H:i:s");

$dataCus = array(
	'firstName'=>$firstName,
	'lastName'=>$lastName,
	'citizenId'=>$citizenId,
	'telephone'=>$telephone,
	'location'=>$location,
	'birthDay'=>$birthday,
	'dateUpdated'=>$today
);
$udCustomer = update_db('customer', array('customerId ='=>$customerId), $dataCus); 
mysql_query($udCustomer) or die ("Can't Update Customer");	

$dataMobCus = array(
	'mobileNumber'=>$telephone,
);
$udMobCus = update_db('mobilecustomer', array('customerId ='=>$customerId), $dataMobCus);
mysql_query($udMobCus) or die ("Can't Update Customer");

?>
<SCRIPT language="JavaScript">
	window.location="index.php?p=user.customer&menu=main_user&done=yes&current_page="+<?=$current_page?>;
</SCRIPT>
