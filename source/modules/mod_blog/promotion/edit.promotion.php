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
	
	
	$promotionTopic = trim($promotionTopic);
	$promotionDetail = trim($promotionDetail);
	
	$TableName = 'newspromotion';
	$data = array(
		'promotionTopic'=>$promotionTopic,
		'promotionDetail'=>$promotionDetail,
		'dateUpdate'=>date('Y-m-d H:i:s')
	);
	$sql = update_db($TableName, array('promotionId='=>$id), $data);
	//echo $sql;
	$rs = mysql_query($sql);
	
	if($rs){
		$data['success'] = true;
		$data['message'] = 'ปรับปรุงโปรโมชั่น "'.$promotionTopic.'" เรียบร้อยแล้ว';
		
	} else {		
		$data['success'] = false;
		$data['message'] = 'มีข้อผิดพลาดในการแก้ไขโปรโมชั่น';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>