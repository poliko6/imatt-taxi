<?php
session_start();
include("var.php");
$mysqli = new mysqli($MYSQLHOST,$MYSQLUSER,$MYSQLPASS,$MYSQLDB);
$mysqli->set_charset("utf8");

?>
<!DOCTYPE html> 
<html> 
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<style type="text/css"> 
 html { height: 100% }  
  body { height: 100%; margin: 0px; padding: 0px }  
  #map_canvas { height: 100% }  
</style> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>
<meta charset="utf-8">
</head> 


<?php
$custid=$_GET['custid'];
?>

<?php
// update สถานะของลูกค้า 
$sql="update likit_cust_select_car set flag='2' where custid='$custid' ";
$mysqli->query($sql);
?>

<?php
// แสดง พิกัด ของลูกค้า
$sql="select latitude,longitude from likit_cust_select_car where custid='$custid' and flag='2' ";
$result=$mysqli->query($sql);
$row=$result->fetch_array();
$cust_latitude = $row['latitude'];
$cust_longitude = $row['cust_longitude'];
?>



<body onload="initialize()"> 



<?php
$sql="select b.carId,a.mobileId,a.cust_latitude,a.cust_longitude,a.latitude,a.longitude from likit_calc_distance a left join transportsection b on (a.mobileId=b.mobileId) order by distance asc limit 0,$var_car_show_count ";
$result=$mysqli->query($sql);
while($row=$result->fetch_array()){
	$mobileId = $row['mobileId'];
	$cust_latitude = $row['cust_latitude'];
	$cust_longitude = $row['cust_longitude'];
	$latitude = $row['latitude'];
	$longitude = $row['longitude'];
	$carId= $row['carId'];

		$sql2="select carRegistration from car where carId='$carId' ";
		$result2=$mysqli->query($sql2);
		$row2=$result2->fetch_array();
		$carRegistration=$row2['carRegistration'];
}

$sql1="select latitude,longitude from likit_calc_distance order by distance asc limit 0,1 ";
$result1=$mysqli->query($sql1);
$row1=$result1->fetch_array();
$car1_lat =$row1['latitude'];
$car1_long =$row1['longitude'];

$sql2="select latitude,longitude from likit_calc_distance order by distance asc limit 1,1 ";
$result2=$mysqli->query($sql2);
$row2=$result2->fetch_array();
$car2_lat =$row2['latitude'];
$car2_long =$row2['longitude'];

$sql3="select latitude,longitude from likit_calc_distance order by distance asc limit 2,1 ";
$result3=$mysqli->query($sql3);
$row3=$result3->fetch_array();
$car3_lat =$row3['latitude'];
$car3_long =$row3['longitude'];

?>
<br><br>
<a href='1_cust_req.php'>Call center คลิกไป หน้าแรก เพื่อสมมุติเหตุการณ์ ที่ลูกค้าเรียกรถแท๊กซี่</a>
<br><br>


<img src='2.jpg' border='0'> ลูกค้า&nbsp;&nbsp;&nbsp;<img src='1.jpg' border='0'> รถแท๊กซี่<br>

<div id="map_canvas" style="width:100%; height:70%"> </div> 



<script type="text/javascript"> 
 function initialize() {  
    var latlng = new google.maps.LatLng(<?=$cust_latitude;?>,<?=$cust_longitude;?>);  
    var myOptions = {  
      zoom: 15,  
      center: latlng,  
      mapTypeId: google.maps.MapTypeId.ROADMAP  ,
		navigationControl:true,
    }

    var map = new google.maps.Map(document.getElementById("map_canvas"),  
        myOptions);  

	var marker = new google.maps.Marker({
		position : new google.maps.LatLng(<?=$cust_latitude;?>,<?=$cust_longitude;?>), 
			map:map,
			icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/blank.png',

	});



	var places=[];

	places.push(new google.maps.LatLng(<?=$car1_lat;?>,<?=$car1_long;?>));
	places.push(new google.maps.LatLng(<?=$car2_lat;?>,<?=$car2_long;?>));
	places.push(new google.maps.LatLng(<?=$car3_lat;?>,<?=$car3_long;?>));

	for(var i = 0 ; i< places.length; i++){
		j=i+1;
		var marker = new google.maps.Marker({
			position: places[i],
				map:map,
				title: ''
		});

		(function(j, marker) { 
		   
		  google.maps.event.addListener(marker, 'click', function() { 
			
			xx = j+1;

			var infowindow = new google.maps.InfoWindow({ 
			  content: 'Place number ' + j
			}); 
			//infowindow.open(map, marker); 
			document.getElementById('carid').value = xx;
		  }); 
		})(i, marker); 
	}
  }  
</script> 

<style>
.info{
	width:250px;
}
</style>

<form method="post" action="3_cust_c_1.php">
เรียกรถแท๊กซี่ คันที่ <input type="text" name="carid_no" value="" id="carid">
<input type='hidden' name='custid' value="<?=$custid?>">
&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit">
</form>
</body> 
</html> 