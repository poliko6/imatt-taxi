<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	


	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}

 	$sql_gen = "select * from amphur where provinceId = '".$provinceId."' order by amphurName";		
	$rs_gen = mysql_query($sql_gen);
	#echo $sql_gen;

?>
 	<select name="amphur_add" id="amphur" onchange="fn_calldistrict(this.value,'')" >
     	<option value="" <? if($amphur_ss==""){echo "selected=\"selected\""; } ?> >--กรุณาเลือกอำเภอ--</option>
      		<? while ($data_gen = @mysql_fetch_object($rs_gen)) { ?>
  				<option value="<?=$data_gen->amphurId?>" <? if($amphur_ss==$data_gen->amphurId){echo "selected=\"selected\""; } ?> ><?=$data_gen->amphurName?></option>
      		<? } ?>                
   	</select>