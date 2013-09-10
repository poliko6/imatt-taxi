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

	$promotionId = trim($id);
		
	$promotion_data = select_db('newspromotion',"where promotionId = '".$promotionId."'");
	
	$data['topic'] = $promotion_data[0]['promotionTopic'];
	$data['detail'] = $promotion_data[0]['promotionDetail'];	

	echo $_GET['callback'].'('.$json->encode($data).')';
?>