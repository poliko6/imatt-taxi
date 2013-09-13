<div class="row-fluid">
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

</div>


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