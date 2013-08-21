<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$car_banner_chk = select_db('carbanner',"where carBannerId = '".$id."'");
 	$banner_name_eng = $car_banner_chk[0]['carBannerNameEng'];
	$banner_name_thai = $car_banner_chk[0]['carBannerNameThai'];
	
	echo $banner_name_eng.",".$banner_name_thai;
?>