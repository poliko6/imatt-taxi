<?
    require_once '../../../../include/Zend/JSON.php';
    $json = new Services_JSON();
	
	include("../../../../include/class.mysqldb.php");
	include("../../../../include/config.inc.php");
	include("../../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
		$TableName = 'minoradmin';
		
		if (trim($txtpassword) != ''){
			$txtpassword = trim($txtpassword);
			
			$data = array(
				//'garageId'=>$u_garage,
				'firstName'=>trim($firstName),
				'lastName'=>trim($lastName),			
				//'username'=>trim($txtuserName),
				'minorTypeId'=>$minorTypeId,			 
				'password'=>sha1($txtpassword),
				'address'=>trim($address),
				'provinceId'=>$provinceId,
				'amphurId'=>$amphurId,
				'districtId'=>$districtId,
				'telephone'=>trim($telephone),
				'mobilePhone'=>trim($mobilePhone),				
				'email'=>trim($txtemail),
				'zipcode'=>trim($zipcode),
				'dateUpdated'=>date('Y-m-d H:i:s'),
			);	
		} else {		
			$data = array(
				//'garageId'=>$u_garage,
				'firstName'=>trim($firstName),
				'lastName'=>trim($lastName),			
				//'username'=>trim($txtuserName),
				'minorTypeId'=>$minorTypeId,			 
				//'password'=>sha1($txtpassword),
				'address'=>trim($address),
				'provinceId'=>$provinceId,
				'amphurId'=>$amphurId,
				'districtId'=>$districtId,
				'telephone'=>trim($telephone),
				'mobilePhone'=>trim($mobilePhone),				
				'email'=>trim($txtemail),
				'zipcode'=>trim($zipcode),
				'dateUpdated'=>date('Y-m-d H:i:s'),
			);	
		}
		
		$sql = update_db($TableName, array('minorId='=>$minorId), $data);
		mysql_query($sql);	
		#echo $sql;
		//exit;

	$data['success'] = true;
	$data['message'] = "บันทึกการแก้ไขข้อมูลเรียบร้อยแล้ว";

echo $_GET['callback'].'('.$json->encode($data).')';
?>
