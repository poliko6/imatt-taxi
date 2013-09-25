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
<body onload="initialize()"> 

<div id="map_canvas" style="width:100%; height:80%"> </div> 


<script type="text/javascript"> 
 function initialize() {  
    var latlng = new google.maps.LatLng(18.711100,98.972633);  
    var myOptions = {  
      zoom: 10,  
      center: latlng,  
      mapTypeId: google.maps.MapTypeId.ROADMAP  ,
	  navigationControl: true,
    };

    var map = new google.maps.Map(document.getElementById("map_canvas"),  
        myOptions);  

/*
var route=[
new google.maps.LatLng(37.7671, -122.4206) ,
new google.maps.LatLng(34.0485, -118.2568) ,
new google.maps.LatLng(35.0605, -118.2388)
	];
*/




var route = [
 <?php
$sql="select latitude,longitude from likit_historyroute";
$result=$mysqli->query($sql);
while($row=$result->fetch_array()){
$latitude=$row['latitude'];
$longitude=$row['longitude'];
	?>
   new google.maps.LatLng(<?php echo $latitude ?>, <?php echo $longitude ?>)
   <?php if ($latitude > 0) { ?>, 	<?php } ?>


<?php 
} 
?>
                ];


var polyline = new google.maps.Polyline({
  path: route,
	strokeColor : "#ff0000",
	strokeOpacity: 0.6,
	strokeWeight: 5
});

polyline.setMap(map);

  }  
</script> 


</body> 
</html> 