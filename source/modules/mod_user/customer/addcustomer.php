<?
$cusData = array(
	'citizenId'=>$citizenId,
	'firstName'=>$fName,
	'lastName'=>$lName,
	'birthDay'=>$birthDay,
	'email'=>$txtEmail,
	'password'=>sha1($u_password),
	'location'=>$txtAddress_add,
	'telephone'=>$txtMobilePhone,
	'gender'=>$radSex,
);
$addCustomer = insert_db('customer',$cusData)."   ";
mysql_query($addCustomer) or die ("Can't Insert Data into customer");

// Get lastest CustomerId to use with table mobilecustomer
$strSQL = "SELECT customerId FROM customer WHERE email = '".$txtEmail."'";
$strQuery = mysql_query($strSQL);
$strResult = mysql_fetch_array($strQuery);
$lastCusId = $strResult['customerId'];

//เพิ่มข้อมูลตาราง mobilecustomer
$mobData = array(
	'customerId'=>$lastCusId,
	'mobileNumber'=>$txtMobilePhone,
);
$addMobCus = insert_db('mobilecustomer',$mobData);
mysql_query($addMobCus) or die ("Can't Insert Data into mobilecustomer");

$act="";
?>
<SCRIPT language="JavaScript">
	window.location="index.php?p=user.customer&menu=main_user";
</SCRIPT>