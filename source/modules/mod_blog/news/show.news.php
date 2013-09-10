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
	
	if ($s == 'show') { $status = 1; }
	if ($s == 'hide') { $status = 0; }
	
	$news_chk = select_db('news',"where newsId = '".$id."'");
 	$newsTopic = $news_chk[0]['newsTopic'];
	
	$TableName = 'news';
	$data = array(
		'statusShow'=>$status,
		'dateUpdate'=>date('Y-m-d H:i:s')
	);
	$sql = update_db($TableName, array('newsId='=>$id), $data);
	//echo $sql;
	$rs = mysql_query($sql);

	if ($rs){	
	
		if ($s == 'show') {
			$data['tag'] = "<a class=\"sepV_a ttip_t\" title=\"ซ่อน\" onClick=\"fn_formShow($id,'hide')\"><i class=\"icon-eye-open\"></i></a>";
		}
		if ($s == 'hide') {
			$data['tag'] = "<a class=\"sepV_a ttip_t\" title=\"แสดง\" onClick=\"fn_formShow($id,'show')\"><i class=\"icon-eye-close\"></i></a>";
		}
		
		$data['success'] = true;
		$data['message'] = 'แก้ไขสถานะ "'.$newsTopic.'" เรียบร้อยแล้ว';
		
		
	} else {
		
		$data['success'] = false;
		$data['message'] = 'ผิดพลาดในการแก้ไขสถานะ กรุณาลองอีกครั้ง';
	}

	echo $_GET['callback'].'('.$json->encode($data).')';
?>