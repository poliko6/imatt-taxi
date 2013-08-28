<div class="row-fluid">
  <div class="span12">
    <h3 class="heading" style="text-align:center;">ตำแหน่งรถแท๊กซี่ของ ""</h3>
    <div class="row-fluid">
      <div class="span4">
        <div class="row-fluid" id="g-map-top">
          <div class="span12">
            <div class="well">
              <form class="input-append" id="gmap_search">
                <input autocomplete="off" class="span8" type="text" placeholder="Find location on map..." />
                <button type="submit" class="btn"><i class="splashy-marker_rounded_add"></i></button>
              </form>
            </div>
            <div class="location_add_form well" style="display: none">
              <p class="formSep"><strong>Add/Edit location:</strong></p>
              <div class="formSep">
                <label>Name</label>
                <input type="text" class="span10" id="comp_name" />
                <label>Contact</label>
                <input type="text" class="span10" id="comp_contact" />
                <label>Phone</label>
                <input type="text" class="span10" id="comp_phone" />
                <label>Address</label>
                <input type="text" class="span10" id="comp_address" readonly="readonly" />
                <label>Lat, Lng</label>
                <input type="text" class="span10" id="comp_lat_lng" readonly="readonly" />
                <input type="hidden" id="comp_id" />
              </div>
              <button class="btn btn-invert">Save</button>
            </div>
          </div>
        </div>
      </div>
      <div class="span8">
        <div class="well">
          <div id="g_map" style="width:100%;height:400px"></div>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Taxi on Garage  -->
<?
$get_garage = 2;
$sql_mobile = "SELECT mobilemap.*, mobile.garageId ";
$sql_mobile .= "FROM mobilemap inner join mobile on mobilemap.mobileId = mobile.mobileId ";
$sql_mobile .= "WHERE mobile.garageId = '".$get_garage."'";
$rs_mobile = mysql_query($sql_mobile);
$data_mobile = mysql_fetch_object($rs_mobile);

#pre($data_mobile);

$sql_taxi = "SELECT * FROM car WHERE garageId =  '".$get_garage."'";
$rs_taxi = mysql_query($sql_taxi);
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
      	<? while($data_taxi = @mysql_fetch_object($rs_taxi)){ ?>
            <tr>
              <td>1</td>
              <td><?=$data_taxi->carRegistration?></td>
              <td>//คนขับ</td>
              <td class="address">4 New York Plaza, New York, NY 10004, United States</td>
              <td>40.702677, -74.011277</td>
              <td>(212) 210-2100</td>
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



<script src="js/jquery.min.js"></script> 
<!-- smart resize event --> 
<script src="js/jquery.debouncedresize.min.js"></script> 
<!-- hidden elements width/height --> 
<script src="js/jquery.actual.min.js"></script> 
<!-- js cookie plugin --> 
<script src="js/jquery.cookie.min.js"></script> 
<!-- main bootstrap js --> 
<script src="bootstrap/js/bootstrap.min.js"></script> 
<!-- sticky messages --> 
<script src="lib/sticky/sticky.min.js"></script> 
<!-- tooltips --> 
<script src="lib/qtip2/jquery.qtip.min.js"></script> 
<!-- jBreadcrumbs --> 
<script src="lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script> 
<!-- fix for ios orientation change --> 
<script src="js/ios-orientationchange-fix.js"></script> 
<!-- scrollbar --> 
<script src="lib/antiscroll/antiscroll.js"></script> 
<script src="lib/antiscroll/jquery-mousewheel.js"></script> 
<!-- lightbox --> 
<script src="lib/colorbox/jquery.colorbox.min.js"></script> 
<!-- common functions --> 
<script src="js/gebo_common.js"></script> 
<script src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script src="js/gmap3.min.js"></script> 
<!-- maps functions --> 
<script src="js/gebo_maps.js"></script> 
<script>
	$(document).ready(function() {
		//* show all elements & remove preloader
		setTimeout('$("html").removeClass("js")',1000);
	});
</script>