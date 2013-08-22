 <?
 foreach($_REQUEST as $key => $value)  {
	$$key = $value;
	//echo $key ."=". $value."<br>";
 }
 //pre($_SESSION);
 
 
 switch ($act){
	case 'addtaxi':
		include('modules/mod_taxi/taximanage/formAdd.php');
	 	break;
	case 'edittaxi':
		include('modules/mod_taxi/taximanage/formEdit.php');
		break;
	default:
		include('modules/mod_taxi/taximanage/taxiShow.php');
 }
 
 ?>
 
<script type="text/javascript">
	var delayAlert=null; 
	$(document).ready(function(){
		
	});
	
	function alertFadeOut(id){
		$('#'+id+'').fadeOut(1000); 
	}
	
	function reloadPage(){
		window.location = 'index.php?p=taxi.taximanage&menu=main_taxi&garageid=<?=$garageid?>'; 
	}
	
	function fn_goToPage(page){
		console.log(page);
		if (page == 'add'){
			window.location = 'index.php?p=taxi.taximanage&menu=main_taxi&garageid=<?=$garageid?>&act=addtaxi'; 
		}
	}
</script>