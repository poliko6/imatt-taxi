<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");


	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}

 	$sql_gensub = "select * from district where amphurId = '".$amphurId."' order by districtName";		
    $rs_gensub = mysql_query($sql_gensub);
	#echo $sql_gensub;
	
?>
 	<select name="district_add" id="district">
 		<option value="" <? if($district_ss==""){echo "selected=\"selected\""; } ?> >--กรุณาเลือกตำบล--</option>
     	<? while ($data_gensub = @mysql_fetch_object($rs_gensub)) { ?>
          	<option value="<?=$data_gensub->districtId?>" <? if($district_ss==$data_gensub->districtId){echo "selected=\"selected\""; } ?> ><?=$data_gensub->districtName?></option>
        <? } ?>                
    </select>