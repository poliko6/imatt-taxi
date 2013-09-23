<?
foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
}

switch ($act) {
	case 'calltaxi':
		include('modules/mod_taxi/calltaxi/calltaxiSelect.php');		
		break;
	
	case 'selecttaxi':
		$TableName = 'driverhistory';
		$data = array(
			'mobileId'=>trim($mobileId),
			'carId'=>trim($carId),			
			'driverId'=>trim($driverId),
			'garageId'=>trim($garageId),
			'statusWork'=>'wait',
			'driveTime'=>date('Y-m-d H:i:s')
		);
		$sql = update_db($TableName, array('historyId='=>$historyId), $data);
		mysql_query($sql);	
		//echo $sql;
		//exit;
		
		$customer_data = select_db('customer',"where customerId = '".$customerId."'");
		$firstName = $customer_data[0]['firstName'];
		$lastName = $customer_data[0]['lastName'];
		
		$message = "เรียกแท๊กซี่ให้กับลูกค้า $firstName $lastName เรียบร้อยแล้วค่ะ";
		
		?>
		<script type="text/javascript">			
		$(document).ready(function() {
			alertPopup('msg3','alert3','<?=$message?>',0);			
		});		
		</script>
		<?
			
		include('modules/mod_taxi/calltaxi/calltaxiShow.php');		
		break;
	
	default:
		include('modules/mod_taxi/calltaxi/calltaxiShow.php');
		break;
}
?>



<script type="text/javascript">
	var delayAlert=null; 
	function alertPopup(msgid,alertid,message,newload){
		$('#'+msgid+'').text(''+message+'');
		$('#'+alertid+'').fadeIn(500, function() {
			clearTimeout(delayAlert);  
			delayAlert=setTimeout(function(){  
				$('#'+alertid+'').fadeOut(1000);
				if (newload == 1){
					reloadPage();  
				}
				delayAlert=null;  
			},2000);  
		});
	}
</script>
