<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$mobile_banner_chk = select_db('mobilebanner',"where mobileBannerId = '".$id."'");
 	$banner_name_eng = $mobile_banner_chk[0]['mobileBannerNameEng'];
	$banner_name_thai = $mobile_banner_chk[0]['mobileBannerNameThai'];
	
	echo $banner_name_eng.",".$banner_name_thai;
?>