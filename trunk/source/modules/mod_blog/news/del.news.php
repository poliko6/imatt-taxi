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
	
	$news_chk = select_db('news',"where newsId = '".$id."'");
 	$newsTopic = $news_chk[0]['newsTopic'];
	
	$TableName = 'news';
	$sql = delete_db($TableName, array('newsId='=>$id));
		//echo $sql;
	$rs = mysql_query($sql);

	if ($rs){		
		$data['success'] = true;
		$data['message'] = 'ลบข่าว "'.$newsTopic.'" เรียบร้อยแล้ว';
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ผิดพลาดในการลบข่าวสาร กรุณาลองอีกครั้ง';
	}

	echo $_GET['callback'].'('.$json->encode($data).')';
?>