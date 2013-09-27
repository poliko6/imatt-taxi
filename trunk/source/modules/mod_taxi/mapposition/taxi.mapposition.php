<!-- datatable -->
<link rel="stylesheet" type="text/css" href="lib/datatables/css/demo_table_jui.css"/> 
<script src="lib/datatables/jquery.dataTables.min.js"></script>


<?
foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	#echo $key ."=". $value."<br>";
}
//Case Supervisor
if ($u_garage == 1) {
	
	if ($garageId == ''){
		$taxiwork_data = count_data_mysql('transportSectionId','transportsection','1');
	} else {		
		$taxiwork_data = count_data_mysql('transportSectionId','transportsection',"garageId = '".$garageId."'");
	}			
	
} else { //Case Garage
	$taxiwork_data = count_data_mysql('transportSectionId','transportsection',"garageId = '".$u_garage."'");
	$garageId  = $u_garage;
}
$total = $taxiwork_data;


///=====Data Major
if ($garageId == ''){ 
	$major_name = 'ทั้งหมด';
} else {
	$major_data = select_db('majoradmin',"where garageId = '".$garageId."'");
	$major_name = $major_data[0]['thaiCompanyName'];
	$garageId = $major_data[0]['garageId'];
}






 
 
//=============================================== Begin Map ================================================= 
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
function load(lat,lng,z) {
	
	var latlng = new google.maps.LatLng(lat,lng);    
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
		zoom: z,     
		center: latlng,     
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};   
	map = new google.maps.Map(document.getElementById("map_canvas"),myOptions); 
	//infowindow.open(map, marker);
	
	//createMarker(name,address, latlng,v_post,v_kind,pic,lat,lon,id) ;



	//ใช้ GEOCODER
  	geocoder = new google.maps.Geocoder();        
  		marker = new google.maps.Marker({
  	});

	searchLocation();
}//end load





function mapload(lat,lng,zoom) {
	console.log(lat+' '+lng);
	var lat = parseFloat(lat);
	var lng = parseFloat(lng);
	var latlng = new google.maps.LatLng(lat,lng);    
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
		zoom: zoom,     
		center: latlng,     
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};   
	map = new google.maps.Map(document.getElementById("map_canvas"),myOptions); 
}//end load





setInterval(function(){
/* 1000 = 1 วินาที */
    downloadUrl("modules/mod_taxi/mapposition/get.taxiposition.php?vpost=<?=$con1_encode?>&vkind=<?=$con2_encode?>&province=<?=$province_encode;?>&amphur=<?=$omp_encode?>&distict=<?=$tom_encode?>&price1=<?=$price1?>&price2=<?=$price2?>&garageId=<?=$garageId?>", function(data) {
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

	if(v_kind==1) { /* แดง ไม่มีลูกค้า รถวิ่ง  */
		image=c_red;
	}else if(v_kind==2) { /* เขียว มีลูกค้า รถวิ่ง  */
		image=c_green;
	} else if (v_kind==3) { /*  เหลือง  จอด  */
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
	load(47.614495,-122.341861,11);	
};
</script>




<div id='map_canvas' style='height:700px; width:100%; border:#CCCCCC solid 1px; float:left;'></div>
<div style="clear:both">
    คลิก ที่รูปรถ จะเห็น ทะเบียนรถและอู่รถสังกัดของแต่ละคัน <br>
    <!--ให้ทดสอบการแสดงตำแหน่ง ที่เปลี่ยนไปของรถ เมื่อ พิกัด lat,long เปลี่ยนไป <a href="taxi1.php" target="_blank">คลิกที่นี่</a> -->
    
    <br>
    <img src='modules/mod_taxi/images/c1.png'> ไม่มีลูกค้า
    &nbsp;&nbsp;&nbsp;
    <img src='modules/mod_taxi/images/c2.png'> มีลูกค้า
    &nbsp;&nbsp;&nbsp;
    <img src='modules/mod_taxi/images/c3.png'> เหลือง
</div>

<!-- ======================================== End Map ================================================ -->







<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').dataTable( {			
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "modules/mod_taxi/mapposition/scripts/server_processing.php?garageId=<?=$garageId?>",
			
			
			"sPaginationType" : "full_numbers",// แสดงตัวแบ่งหน้า
			"bLengthChange": true, // แสดงจำนวน record ที่จะแสดงในตาราง
			"iDisplayLength": 10, // กำหนดค่า default ของจำนวน record 
			"bFilter": true, // แสดง search box
			//"sScrollY": "400px", // กำหนดความสูงของ ตาราง

			"oTableTools": {
				"sRowSelect": "single" // คลิกที่ record มีแถบสีขึ้น
			},
 
			
			"oLanguage": {
				"sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
				"sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
				"sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
				"sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
				"sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
				"sSearch": "ค้นหา :"
			 }
		} );
	} );
</script>

<div class="row-fluid search_page">
	<div class="span12">
     	<div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รถแท๊กซี่ที่กำลังทำงานอยู่ของ "<span style="color:#C30; font-weight:bold;"><?=$major_name?></span>" มีจำนวน <strong><?=$total?></strong></div>
               	
                
                              	
                <form action="" name="fm_selectmajor" id="fm_selectmajor" method="post">                	
                	<div class="pull-right"> 
                    
						<? 
						
						$major_data_list = select_db('majoradmin',"order by dateAdded desc");
						?> 
						<select name="garageId" id="garageId" onchange="fm_selectmajor.submit();" style="width:250px;">
							<option value="">ทั้งหมด</option>
							<? foreach($major_data_list as $valMajor){?>
								<option value="<?=$valMajor['garageId']?>" <? if ($garageId == $valMajor['garageId']) { echo "selected=\"selected\""; } ?> ><?=$valMajor['thaiCompanyName']?></option>
							<? } ?>
						</select>	       
				  
              	 	</div>
              
                </form>
            </div>
        </div>
        
        
         <!--<table cellpadding="0" cellspacing="0" border="0" class="display" id="example"> -->
         <table class="table table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th width="3%">ลำดับ</th>
                    <th width="10%">หมายเลขทะเบียน</th>
                    <th width="15%">ชื่อคนขับ</th>
                    <th width="10%">เบอร์โทรติดต่อ</th>   
                    <th width="22%">ตำแหน่งที่อยู่</th>
                    <th width="30%">อู่รถ</th>
                    <th width="10%">แสดง</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="dataTables_empty">กำลังโหลดข้อมูล</td>
                </tr>
            </tbody>	
         </table>
    
    </div>
</div>