<?php
//include("var.php");
include("../../../include/class.mysqldb.php");
include("../../../include/config.inc.php");
include("../../../include/class.function.php");

foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
}

$var_car_number=10;
function parseToXML($htmlStr) 
{ 
	$xmlStr=str_replace('<','&lt;',$htmlStr); 
	$xmlStr=str_replace('>','&gt;',$xmlStr); 
	$xmlStr=str_replace('"','&quot;',$xmlStr); 
	$xmlStr=str_replace("'",'&#39;',$xmlStr); 
	$xmlStr=str_replace("&",'&amp;',$xmlStr); 
	return $xmlStr; 
} 

/*$connection = mysql_connect ($MYSQLHOST, $MYSQLUSER, $MYSQLPASS);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db($MYSQLDB, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}*/

$k = $_REQUEST['k'];
$vpost = $_REQUEST['vpost'];
$vkind = $_REQUEST['vkind'];
$province = $_REQUEST['province'];
$amphur = $_REQUEST['amphur'];
$distict = $_REQUEST['distict'];
$price1 = $_REQUEST['price1'];
$price2 = $_REQUEST['price2'];

$sql = "SELECT * FROM mobile limit 0,$var_car_number";
$result = mysql_query($sql);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}


header("Content-type: text/xml");
echo '<markers>';
while ($row = @mysql_fetch_assoc($result)){
	$id=$row['mobileId'];
	$sql2="select b.carStatusId,b.carRegistration from transportsection a,car b where a.carId=b.carId  and a.mobileId='$id'";
	$result2=mysql_query($sql2);
	$row2=mysql_fetch_array($result2);
	$carStatus=$row2['carStatusId'];
	$carName=$row2['carRegistration'];
	$car_Name_=$carName;

  echo '<marker ';
  echo 'name="' . parseToXML($title) . '" ';
  echo 'address="' . parseToXML($address) . '" ';
  echo 'lat="' . $row['latitude'] . '" ';
  echo 'lng="' . $row['longitude'] . '" ';
  echo 'v_post="' . $id . '" ';
  echo 'v_kind="' . $carStatus . '" ';  
  echo 'pic="' . $pic . '" ';  
  echo 'id="' . $car_Name_ . '" ';  
  echo '/>';
}

echo '</markers>';

?>
