<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	$car_model = select_db('carmodel',"where carBannerId = '".$id."'");
?>

<? foreach($car_model as $valModel) { ?>
	<option value="<?=$valModel['carModelId']?>" <? if($carModelId == $valModel['carModelId']){echo "selected=\"selected\""; } ?> ><?=$valModel['carModelName']?></option>
<? } ?>                
