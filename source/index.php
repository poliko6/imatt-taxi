<?
	session_start();
	include("include/class.function.php");
	include("include/class.mysqldb.php");
	include("include/config.inc.php");	
	include('include/main_class.php');
	
	//include("include/class.chklogin.php");
	//pre($_SESSION);

	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	$today = date("Y-m-d H:i:s");  
	$this_ip = $_SERVER['REMOTE_ADDR']; 

?>	



<?
if (empty($_SESSION['pass_actived'])){
	?>
     <META HTTP-EQUIV="Refresh" CONTENT="0;URL=login.php">
	<?
} else {
	$u_username = $_SESSION['u_username'] ; //username มาจากตาราง major และ minor
	$u_id = $_SESSION['u_id'];	 //id มาจากตาราง major และ minor
	$u_type = $_SESSION['u_type']; //ถ้าเป็นพนักงานให้เป็น 3
	$u_garage = $_SESSION['u_garage']; 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
        <title>Taxi Admin Panel</title>
    
    
    	 <!-- Bootstrap framework -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
        <!-- jQuery UI theme-->
            <link rel="stylesheet" href="lib/jquery-ui/css/Aristo/Aristo.css" />
        <!-- gebo blue theme-->
            <link rel="stylesheet" href="css/blue.css" id="link_theme" />
        <!-- breadcrumbs-->
            <link rel="stylesheet" href="lib/jBreadcrumbs/css/BreadCrumb.css" />
        <!-- tooltips-->
            <link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />
        <!-- code prettify -->
            <link rel="stylesheet" href="lib/google-code-prettify/prettify.css" />   
        <!-- flags -->
            <link rel="stylesheet" href="img/flags/flags.css" />	
		<!-- calendar -->
            <link rel="stylesheet" href="lib/fullcalendar/fullcalendar_gebo.css" />                 
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />    
        <!-- splashy icons -->
            <link rel="stylesheet" href="img/splashy/splashy.css" />
		<!-- datepicker -->
            <link rel="stylesheet" href="lib/datepicker/datepicker.css" />
        <!-- tag handler -->
            <link rel="stylesheet" href="lib/tag_handler/css/jquery.taghandler.css" />
        <!-- nice form elements -->
            <link rel="stylesheet" href="lib/uniform/Aristo/uniform.aristo.css" />
		<!-- 2col multiselect -->
            <link rel="stylesheet" href="lib/multiselect/css/multi-select.css" />
		<!-- enhanced select -->
            <link rel="stylesheet" href="lib/chosen/chosen.css" />
        <!-- upload -->
            <link rel="stylesheet" href="lib/plupload/js/jquery.plupload.queue/css/plupload-gebo.css" />
		<!-- colorbox -->
            <link rel="stylesheet" href="lib/colorbox/colorbox.css" />
		<!-- colorpicker -->
            <link rel="stylesheet" href="lib/colorpicker/css/colorpicker.css" />	
		    
        <!-- main styles -->
            <link rel="stylesheet" href="css/style.css" />
			
            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />
	
        <!-- Favicon -->
            <link rel="shortcut icon" href="favicon.ico" />
            
          
		
     
            
		
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
			<script src="lib/flot/excanvas.min.js"></script>
        <![endif]-->
		
		<script>
			//* hide all elements & show preloader
			//document.documentElement.className += 'js';
		</script>
        
        
        <script src="js/jquery.min.js"></script>
        <!-- smart resize event -->
        <script src="js/jquery.debouncedresize.min.js"></script>
        <!-- hidden elements width/height -->
        <script src="js/jquery.actual.min.js"></script>
        <!-- js cookie plugin -->
        <script src="js/jquery.cookie.min.js"></script>
        <!-- main bootstrap js -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- bootstrap plugins -->
        <script src="js/bootstrap.plugins.min.js"></script>
        <!-- tooltips -->
        <script src="lib/qtip2/jquery.qtip.min.js"></script>
        <!-- jBreadcrumbs -->
        <script src="lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
        <!-- lightbox -->
        <script src="lib/colorbox/jquery.colorbox.min.js"></script>

    </head>
    <!--<body class="sidebar_hidden ptrn_d menu_hover"> -->
    <body class="sidebar_hidden ptrn_d">
		<div id="loading_layer" style="display:none"><img src="img/ajax_loader.gif" alt="" /></div>

		<div id="maincontainer" class="clearfix">
			<!-- header -->
            <header>            	
                
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="index.php"><i class="icon-home icon-white"></i> Taxi System</a>
                            <ul class="nav user_menu pull-right">                     
                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="img/user_avatar.png" alt="" class="user_avatar" /> <?=$u_username?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
										<li><a href="#">My Profile</a></li>
										<!--<li><a href="javascrip:void(0)">Another action</a></li> -->
										<li class="divider"></li>
										<li><a href="include/class.logout.php">ออกจากระบบ</a></li>
                                    </ul>
                                </li>
                            </ul>
							<a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
								<span class="icon-align-justify icon-white"></span>
							</a>
                            <nav>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                    	<? include('menu/main.submain.php'); ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>             
               
            </header>
            
            
         
            
            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">                
                	 <? #pre($_SESSION); ?>
  					 <? include('modules/mod_body/main.body.php'); ?>
                </div>
            </div>
            
 			<a id="toTop" href="#" style="display: inline;"><span id="toTopHover" style="opacity: 0;"></span>
     			To Top
    		</a>
         
 
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1000);
				});
			</script>
		
		</div> <!-- Main Body -->
        
        <!--
         <div class="navbar navbar-fixed-bottom">
         	<div class="navbar-inner">
                <div class="container-fluid">
                	
                </div>
        	</div>
        </div>
        -->
	</body>
</html>
<? } ?>