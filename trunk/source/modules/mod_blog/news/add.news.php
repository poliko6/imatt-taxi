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
	
	$TableName = 'news';
	$data = array(
		'newsTopic'=>$newsTopic,
		'newsDetail'=>$newsDetail,
		'statusShow'=>0,
		'garageId'=>$garageId
	);
	$sql = insert_db($TableName, $data);
	$rs = mysql_query($sql);
	
	if ($rs) {
		$data['success'] = true;
		$data['message'] = 'เพิ่มข่าว "'.$newsTopic.'" เรียบร้อยแล้ว';

	} else {		
		
		$data['success'] = false;
		$data['message'] = 'มีข้อผิดพลาดในการเพิ่มกรุณาลองใหม่';
	}
	
	
	echo $_GET['callback'].'('.$json->encode($data).')';
	
?>