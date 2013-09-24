<?
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	
	$TableName = 'customer';
	$data = array(
		'lock'=>$status
	);
	$sql = update_db($TableName, array('customerId='=>$customerId), $data);
	$rs = mysql_query($sql);
	//echo $sql;
	if($rs){
				
		if ($status == 0) {
			?>
			<a href="#" class="ttip_t" title="สถานะล๊อค" onclick="fn_changeLock('<?=$driverId?>',1);"><i class="splashy-lock_large_locked"></i></a>
			<?
		} else {
			?>
			<a href="#" class="ttip_t" title="สถานะไม่ล๊อค" onclick="fn_changeLock('<?=$driverId?>',0);"><i class="splashy-lock_large_unlocked"></i></a>
			<?
		}
		
	} else {
		
		if ($status == 0) {
			?>
			<a href="#" class="ttip_t" title="สถานะล๊อค" onclick="fn_changeLock('<?=$driverId?>',0);"><i class="splashy-lock_large_unlocked"></i></a>
			<?
		} else {
			?>
			<a href="#" class="ttip_t" title="สถานะไม่ล๊อค" onclick="fn_changeLock('<?=$driverId?>',1);"><i class="splashy-lock_large_locked"></i></a>
			<?
		}
	}
					
?>