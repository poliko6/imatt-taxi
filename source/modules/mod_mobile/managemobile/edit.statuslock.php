<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$TableName = 'mobile';
	$data = array(
		'lock'=>$status
	);
	$sql = update_db($TableName, array('mobileId='=>$id), $data);
	$rs = mysql_query($sql);
	//echo $sql;
	if($rs){
				
		if ($status == 0) {
			?>
			<a href="#" class="ttip_t" title="สถานะล๊อค" aria-describedby="ui-tooltip" onclick="fn_changeLock('<?=$id?>',1);"><i class="splashy-thumb_down"></i></a>
			<?
		} else {
			?>
			<a href="#" class="ttip_t" title="สถานะไม่ล๊อค" aria-describedby="ui-tooltip" onclick="fn_changeLock('<?=$id?>',0);"><i class="splashy-thumb_up"></i></a>
			<?
		}
		
	} else {
		
		if ($status == 0) {
			?>
			<a href="#" class="ttip_t" title="สถานะล๊อค" aria-describedby="ui-tooltip" onclick="fn_changeLock('<?=$id?>',0);"><i class="splashy-thumb_up"></i></a>
			<?
		} else {
			?>
			<a href="#" class="ttip_t" title="สถานะไม่ล๊อค" aria-describedby="ui-tooltip" onclick="fn_changeLock('<?=$id?>',1);"><i class="splashy-thumb_down"></i></a>
			<?
		}
	}
					
?>