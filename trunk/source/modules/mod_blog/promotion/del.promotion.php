<?
    require_once '../../../include/Zend/JSON.php';
    $json = new Services_JSON();
	
	include("../../../include/class.mysqldb.php");
	include("../../../include/config.inc.php");
	include("../../../include/class.function.php");
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	$promotion_chk = select_db('newspromotion',"where promotionId = '".$id."'");
 	$promotionTopic = $promotion_chk[0]['promotionTopic'];
	
	$TableName = 'newspromotion';
	$sql = delete_db($TableName, array('promotionId='=>$id));
		//echo $sql;
	$rs = mysql_query($sql);

	if ($rs){		
		$data['success'] = true;
		$data['message'] = 'ลบโปรโมชั่น "'.$promotionTopic.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ผิดพลาดในการลบโปรโมชั่น กรุณาลองอีกครั้ง';
	}

	echo $_GET['callback'].'('.$json->encode($data).')';
?>