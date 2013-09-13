<?
//Code Pee Tik

$var_car_number=200;

$con1=$_REQUEST['con1']; 
$con1_encode=urlencode($con1);

$con2=$_REQUEST['con2'];
$con2_encode=urlencode($con2);


$province=$_REQUEST['province']; // จังหวัด 
$omp=$_REQUEST['omp']; // อำเภอ
$tom=$_REQUEST['tom']; // ตำบล

$province_encode=urlencode($province);
$omp_encode=urlencode($omp);
$tom_encode=urlencode($tom);


$province="เชียงใหม่";
$omp="เมือง";
?>

<script type="text/javascript" src="js/util.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?&sensor=false&language=th" type="text/javascript"></script>

<script type="text/javascript">
//<![CDATA[
var infowindow;
var geocoder;
var markers_tik = [];


function cleanPoint() {
  cleanPointStep2();
  markers_tik = [];
}

function cleanPointStep2() {
  setAllMap(null);
}

function setAllMap(map) {
  for (var i = 0; i < markers_tik.length; i++) {
    markers_tik[i].setMap(map);
  }
}


function searchLocation() {
	var keyword="<?=$tom?> <?=$omp?> <?=$province?>";
	
	geocoder.geocode( { 'address': keyword}, function(results, status) { 
		if (status == google.maps.GeocoderStatus.OK) { 
			var location = new google.maps.LatLng( results[0].geometry.location.lat(), results[0].geometry.location.lng());
			marker.setPosition(location);
			map.panTo (marker.getPosition());
		} else {   
			alert("Geocode was not successful for the following reason: " + status);   
		}   
	});
}



//begin load
function load() {
	var latlng = new google.maps.LatLng(47.614495,-122.341861);    
	var myOptions = {     
			visualRefresh:true, 
			panControl: true,
			zoomControl: true, 
			zoomControlOptions: {   
		},
		mapTypeControl: true,
		scrollwheel: false,
		scaleControl: false, 
		streetViewControl: true,  
		overviewMapControl: true,
		zoom: 11,     
		center: latlng,     
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};   
	map = new google.maps.Map(document.getElementById("map_canvas"),myOptions); 
	//infowindow.open(map, marker);




	//ใช้ GEOCODER
  	geocoder = new google.maps.Geocoder();        
  		marker = new google.maps.Marker({
  	});

	searchLocation();
}//end load


setInterval(function(){
/* 1000 = 1 วินาที */
    downloadUrl("modules/mod_taxi/mapposition/get.taxiposition.php?vpost=<?=$con1_encode?>&vkind=<?=$con2_encode?>&province=<?=$province_encode;?>&amphur=<?=$omp_encode?>&distict=<?=$tom_encode?>&price1=<?=$price1?>&price2=<?=$price2?>", function(data) {
      var markers = data.documentElement.getElementsByTagName("marker");


      for (var i = 0; i < markers.length; i++) {
        var latlng = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
		var lat =parseFloat(markers[i].getAttribute("lat"));
		var lng =parseFloat(markers[i].getAttribute("lng"));
		var id =parseFloat(markers[i].getAttribute("id"));
		var marker = createMarker(markers[i].getAttribute("name"),markers[i].getAttribute("address"), latlng,markers[i].getAttribute("v_post"),markers[i].getAttribute("v_kind"),markers[i].getAttribute("pic"),lat,lng,markers[i].getAttribute("id"));
		 
		}//end for
	});
},5000);




setInterval(function(){
	cleanPoint();
},4999); 




function createMarker(name,address, latlng,v_post,v_kind,pic,lat,lng,id) {

	iconshadow = new google.maps.MarkerImage('modules/mod_taxi/images/shadow50.png',
	  new google.maps.Size(37, 34),
      new google.maps.Point(0,0),
      new google.maps.Point(0, 32));
		
 /* เขียว  มีลูกค้า รถวิ่ง */
	 c_green = new google.maps.MarkerImage('modules/mod_taxi/images/c2.png',
      new google.maps.Size(20, 32),
      new google.maps.Point(0,0),
      new google.maps.Point(0, 32));

 /* แดง  ไม่มีลูกค้า รถวิ่ง */
	c_red = new google.maps.MarkerImage('modules/mod_taxi/images/c1.png',
      new google.maps.Size(20, 32),
      new google.maps.Point(0,0),
      new google.maps.Point(0, 32));

 /* เหลือง  จอด */
	c_yellow = new google.maps.MarkerImage('modules/mod_taxi/images/c3.png',
	  new google.maps.Size(20, 32),
      new google.maps.Point(0,0),
      new google.maps.Point(0, 32));


	shadow=iconshadow;

	if(v_kind==1){ /* แดง  ไม่มีลูกค้า รถวิ่ง  */
		image=c_red;
	}else if(v_kind==2){ /* เขียว มีลูกค้า รถวิ่ง  */
		image=c_green;
	}else if(v_kind==3){ /*  เหลือง  จอด  */
		image=c_yellow;
	}

	var marker = new google.maps.Marker({position: latlng, map: map, icon:image,shadow:shadow});
	markers_tik.push(marker);




//begin click ================
	


	google.maps.event.addListener(marker, "click", function() {
      if (infowindow) infowindow.close();
	 // var html = "<a href=page.php?id="+id+" target='_blank'><img src='<?=$path_allimages?>/"+pic+"' border='0' border='0' width='75' height='55'><br/>"+"<b>" + name + "</b></a> <br/>" + address;
	 var html=id;
	  html +="<br>("+v_post+")";
      infowindow = new google.maps.InfoWindow({content: html});
      infowindow.open(map, marker);
	   
   
   });
  
//end click =================
    return marker;

 }


//]]>
</script>

<script type="text/javascript">
window.onload = function()
{
	load();	
};
</script>




<div id='map_canvas'  style='width:1200px; height:700px; border:#CCCCCC solid 1px; float:left;'></div>
<div style="clear:both">
    คลิก ที่รูปรถ จะเห็น เลขที่ ลำดับรถ แต่ละคัน <br>
    <!--ให้ทดสอบการแสดงตำแหน่ง ที่เปลี่ยนไปของรถ เมื่อ พิกัด lat,long เปลี่ยนไป <a href="taxi1.php" target="_blank">คลิกที่นี่</a> -->
    
    <br>
    <img src='modules/mod_taxi/images/c1.png'> แดง  ไม่มีลูกค้า รถวิ่ง
    &nbsp;&nbsp;&nbsp;
    <img src='modules/mod_taxi/images/c2.png'> เขียว  มีลูกค้า รถวิ่ง
    &nbsp;&nbsp;&nbsp;
    <img src='modules/mod_taxi/images/c3.png'>  เหลือง  จอด
</div>




<!--<div class="row-fluid">
  <div class="span12">
    <h3 class="heading" style="text-align:center;">ตำแหน่งรถแท๊กซี่ของ ""</h3>
    <div class="row-fluid">      
      <div class="span12">
        <div class="well">
          <div id="g_map" style="width:100%;height:400px"></div>
        </div>
      </div>
    </div>
  </div>

</div> -->


<!-- Taxi on Garage  -->
<?
$get_garage = 2;
/*$sql_mobile = "SELECT mobilemap.*, mobile.garageId ";
$sql_mobile .= "FROM mobilemap inner join mobile on mobilemap.mobileId = mobile.mobileId ";
$sql_mobile .= "WHERE mobile.garageId = '".$get_garage."'";
$rs_mobile = mysql_query($sql_mobile);
$data_mobile = mysql_fetch_object($rs_mobile);*/

#pre($data_mobile);

/*$sql_taxi = "SELECT * FROM car WHERE garageId =  '".$get_garage."'";
$rs_taxi = mysql_query($sql_taxi);*/


$sql_mobile = "SELECT * FROM mobile WHERE garageId = '".$get_garage."'";
$rs_mobile = mysql_query($sql_mobile);
?>

<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped location_table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Contact</th>
          <th>Adress</th>
          <th>Lat, Lng</th>
          <th>Phone</th>
          <th style="width:90px">Actions</th>
        </tr>
      </thead>
      <tbody>
      	<? 
		while($rs_mobile = @mysql_fetch_object($rs_mobile)){ 
			
			//$data_car = 
			?>
            <tr>
              <td>1</td>
              <td><?=$data_taxi->carRegistration?></td>
              <td>//คนขับ</td>
              <td class="address">4 New York Plaza, New York, NY 10004, United States</td>
              <td><?=$rs_mobile->latitude;?>, <?=$rs_mobile->longitude;?></td>
              <td><?=$rs_mobile->mobileNumber;?></td>
              <td>
                  <a href="javascript:void(0)" class="show_on_map btn btn-gebo btn-mini">Show</a> 
                  <!--<a href="javascript:void(0)" class="comp_edit btn btn-mini">Edit</a> -->
              </td>
            </tr>
        <? } ?>        
       
      </tbody>
    </table>
  </div>
</div>
</div>
</div>