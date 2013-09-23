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
	$car1_mobile = $arr_distance[0]['mobileId'];
	
	$car2_lat = $arr_distance[1]['latitude'];
	$car2_long = $arr_distance[1]['longitude'];
	$car2_mobile = $arr_distance[1]['mobileId'];
	
	$car3_lat = $arr_distance[2]['latitude'];
	$car3_long = $arr_distance[2]['longitude'];
	$car3_mobile = $arr_distance[2]['mobileId'];
	
?>

<style type="text/css"> 
  #map_canvas { height: 100% }  
</style> 

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>
<div class="btn-group pull-right" style="padding:5px;"> 
	<a href="index.php?p=taxi.calltaxi&menu=main_taxi"  class="btn btn-info btn-small">กลับหน้าเรียกแท๊กซี่</a>
</div>
<div id='map_canvas' style='height:500px; width:100%; border:#CCCCCC solid 1px;'> </div>

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
				title: 'รถแท๊กซี่'
		});
		
		var mobileId = 0;

		(function(j, marker) { 
		   
		  google.maps.event.addListener(marker, 'click', function() { 
			
			xx = j+1;
			
			if (j == 0){ mobileId = '<?=$car1_mobile?>'; }
			if (j == 1){ mobileId = '<?=$car2_mobile?>'; }
			if (j == 2){ mobileId = '<?=$car3_mobile?>'; }
			
			//console.log(mobileId);
			
			jQuery.ajax({
				url :'modules/mod_taxi/calltaxi/get.taxidata.php',
				type: 'GET',
				data: 'mobileId='+mobileId+'',
				dataType: 'jsonp',
				dataCharset: 'jsonp',
				success: function (data){
													
					var infowindow = new google.maps.InfoWindow({ 
						content: data.carRegistration+' '+data.province+'<div>('+data.major_name+')</div>'
					}); 
					
					infowindow.open(map, marker); 
					document.getElementById('carRegistration').value = data.carRegistration+' '+data.province;
					document.getElementById('driverId').value = data.driverId;
					document.getElementById('carId').value = data.carId;
					document.getElementById('mobileId').value = data.mobileId;
					document.getElementById('garageId').value = data.garageId;
				}
			});	

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


<div class="row-fluid" style="margin-top:10px;">
	<div class="span3"></div>
    <div class="span6">
        <form class="well form-inline" action="" name="fm_selecttaxi" id="fm_selecttaxi" method="post">
            <p class="f_legend">เรียกรถแท๊กซี่ ทะเบียน </p>
            <input type="text" name="carRegistration" id="carRegistration" value=""  disabled="disabled" />
            <input type="hidden" name="customerId" id="customerId" value="<?=$customerId?>" />
            <input type="hidden" name="custLat" id="custLat" value="<?=$custLat?>" />
            <input type="hidden" name="custLong" id="custLong" value="<?=$custLong?>" />
            <input type="hidden" name="historyId" id="historyId" value="<?=$historyId?>" />
            
            <input type="hidden" name="mobileId" id="mobileId" placeholder="mobileId" value="" />
            <input type="hidden" name="carId" id="carId" placeholder="carId" value="" />
            <input type="hidden" name="driverId" id="driverId" placeholder="driverId" value="" />
            <input type="hidden" name="garageId" id="garageId" placeholder="garageId" value="" />
            
            <input type="hidden" name="act" id="act" value="selecttaxi" />
            <input type="submit" class="btn btn-primary" value="เรียกแท๊กซี่">
        </form>
    </div>
    <div class="span3"></div>
</div>


