<?
foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
}


if ($driverId == '') {
	
	switch ($act) {
		case 'search':
			include('modules/mod_driver/drivercheck/drivercheck.search.php');		
			break;
		
		case 'searchsubmit':
			include('modules/mod_driver/drivercheck/drivercheck.listsearch.php');		
			break;
		
		default:
			include('modules/mod_driver/drivercheck/drivercheck.search.php');
			break;
	}
	
} else { 
	include('modules/mod_driver/drivercheck/drivercheck.show.php');
}
?>


<script type="text/javascript">

$(document).ready(function(){	
	
	/*$(document).on("keydown.NewActionOnF5", function(e){
		var charCode = e.which || e.keyCode;
		switch(charCode){
			case 116: // F5
				e.preventDefault();
				window.location = "index.php?p=<?=$p?>&menu=<?=$menu?>";
				break;
		}
	});	*/
});



function submitSearch(){
	if ($('#search_text').val() == ''){
		$('#search_text').closest('div').addClass("f_error");
		$('#search_text_err').fadeIn(1000);

	} else {
		$('#search_text').closest('div').removeClass("f_error");
		$('#search_text_err').fadeOut(100);
		
		$('#fm_search').submit();
	}
}




function seeDataSearch(id){
	//console.log(id);
	$('#driverId').val(id);
	$('#fm_driverid').submit();
}


function fn_changeLock(id,sval){
	$.post('modules/mod_driver/drivercheck/edit.statuslock.php', {status:sval, driverId:id} , function(data) {
		$('#div_lock').html(data);	
	});	
}
</script>
