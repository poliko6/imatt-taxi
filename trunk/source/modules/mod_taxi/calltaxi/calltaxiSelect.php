<?
	include('modules/mod_taxi/calltaxi/likit_google_map_distance.php');

	$sql= " SELECT transportsection.mobileId, mobile.latitude, mobile.longitude
			FROM transportsection
			JOIN mobile ON mobile.mobileId = transportsection.mobileId
			WHERE transportsection.statusWork = 'online'";
	$result = mysql_query($sql);
	
	$arr_distance = array();
	$i = 0;
	
	while($row = mysql_fetch_array($result)){
		
		$mobileId = $row['mobileId'];
		$latitude = $row['latitude'];
		$longitude = $row['longitude'];
	
		$distance = likit_google_map_distance($custLat,$custLong,$latitude,$longitude);
		
		$arr_distance[$i]['customerId'] = $customerId;
		$arr_distance[$i]['mobileId'] = $mobileId;
		$arr_distance[$i]['distance'] = $distance;
		$arr_distance[$i]['custLat'] = $custLat;
		$arr_distance[$i]['custLong'] = $custLong;
		$arr_distance[$i]['latitude'] = $latitude;
		$arr_distance[$i]['longitude'] = $longitude;
		$i++;
	}
	

	array_sort_by_column($arr_distance, 'distance');
	//pre($arr_distance);
	
	
	//echo pre($arr_distance[0]);
	
	//จุดของลูกค้า
	$cust_latitude = $custLat;
	$cust_longitude = $custLong;
	
	$car1_lat = $arr_distance[0]['latitude'];
	$car1_long = $arr_distance[0]['longitude'];
	$car2_lat = $arr_distance[1]['latitude'];
	$car2_long = $arr_distance[1]['longitude'];
	$car3_lat = $arr_distance[2]['latitude'];
	$car3_long = $arr_distance[2]['longitude'];
	
?>



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


<script type="text/javascript">
window.onload = function()
{
	initialize();	
};
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
