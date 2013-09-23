<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	$mobile_model = select_db('mobilemodel',"where mobileBannerId = '".$id."'");
?>

<? foreach($mobile_model as $valModel) { ?>
	<option value="<?=$valModel['mobileModelId']?>" <? if($mobileModelId == $valModel['mobileModelId']){echo "selected=\"selected\""; } ?> ><?=$valModel['mobileModelName']?></option>
<? } ?>                
