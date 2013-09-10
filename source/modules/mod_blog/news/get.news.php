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

	$newsId = trim($id);
		
	$news_data = select_db('news',"where newsId = '".$newsId."'");
	
	$data['topic'] = $news_data[0]['newsTopic'];
	$data['detail'] = $news_data[0]['newsDetail'];	

	echo $_GET['callback'].'('.$json->encode($data).')';
?>