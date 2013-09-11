<?
 	require_once '../../include/Zend/JSON.php';
    $json = new Services_JSON();
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	$sendTo = trim($send_mail);
	$sendName = trim($sendName);
	$sendEmail = trim($sendEmail).' [ '.$sendName.' ]';
	$sendDetail = trim($sendDetail);

	$strSubject = "ติดต่อสอบถาม";
	$strMessage = $sendDetail;

	$flgSend = @mail($sendTo,$strSubject,$strMessage,$sendEmail);  // @ = No Show Error //
	
	if ($flgSend) {	
		
		$data['success'] = true;
		$data['message'] = 'ส่งอีเมล์เรียบร้อยแล้ว';
		
	} else {

		$data['success'] = false;
		$data['message'] = 'ผิดพลาด! กรุณาลองอีกครั้ง';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
	
?>