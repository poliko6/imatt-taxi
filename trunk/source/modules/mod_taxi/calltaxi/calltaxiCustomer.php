<?
	include('modules/mod_taxi/calltaxi/likit_google_map_distance.php');

	$sql= " SELECT transportsection.mobileId, mobile.latitude, mobile.longitude
			FROM transportsection
			JOIN mobile ON mobile.mobileId = transportsection.mobileId
			JOIN car ON car.carId = car.carId
			WHERE transportsection.statusWork = 'online' AND car.carStatusId = 1";
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

	$cust_data = select_db('customer',"where customerId = '".$customerId."'");
	$cust_name = $cust_data[0]['firstName'].' '.$cust_data[0]['lastName'];
	
?>


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>
<div class="btn-group pull-right" style="padding:5px;"> 
	<a href="index.php?p=taxi.calltaxi&menu=main_taxi"  class="btn btn-info btn-small">กลับหน้าเรียกแท๊กซี่</a>
</div>
<div id='map_canvas' style='height:700px; width:100%; border:#CCCCCC solid 1px;'> </div>

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
	
	
	var infowindow = new google.maps.InfoWindow({ 
		content: '<?=$cust_name?>'
	}); 
	
	infowindow.open(map, marker); 



	var places=[];

	<? for($i=0; $i<10; $i++) { ?>
		places.push(new google.maps.LatLng(<?=$arr_distance[$i]['latitude'];?>,<?=$arr_distance[$i]['longitude'];?>));
	<? } ?>
	

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
			
			<? for($n=0; $n<10; $n++) { ?>
				if (j == <?=$n;?>){ mobileId = '<?=$arr_distance[$n]['mobileId'];?>'; }
			<? } ?>	
			
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
					//document.getElementById('carRegistration').value = data.carRegistration+' '+data.province;
					//document.getElementById('driverId').value = data.driverId;
					//document.getElementById('carId').value = data.carId;
					//document.getElementById('mobileId').value = data.mobileId;
					//document.getElementById('garageId').value = data.garageId;
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

    <div class="span6">
        <form action="" name="fm_showcustomer" id="fm_showcustomer" method="post">   
            <input type="hidden" name="act" id="act" value="" />
            <input type="submit" class="btn btn-primary" value="กลับหน้าเรียกแท๊กซี่">
        </form>
    </div>

</div>


