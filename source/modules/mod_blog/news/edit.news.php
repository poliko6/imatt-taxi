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
	
	
	$newsTopic = trim($newsTopic);
	$newsDetail = trim($newsDetail);
	
	$TableName = 'news';
	$data = array(
		'newsTopic'=>$newsTopic,
		'newsDetail'=>$newsDetail,
		'dateUpdate'=>date('Y-m-d H:i:s')
	);
	$sql = update_db($TableName, array('newsId='=>$id), $data);
	//echo $sql;
	$rs = mysql_query($sql);
	
	if($rs){
		$data['success'] = true;
		$data['message'] = 'ปรับปรุงข่าวสาร "'.$newsTopic.'" เรียบร้อยแล้ว';
		
	} else {		
		$data['success'] = false;
		$data['message'] = 'มีข้อผิดพลาดในการแก้ไขข่าวสาร';
	}

	
	echo $_GET['callback'].'('.$json->encode($data).')';
?>