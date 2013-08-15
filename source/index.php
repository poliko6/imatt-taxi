<?
	session_start();
	include("include/class.function.php");
	include("include/class.mysqldb.php");
	include("include/config.inc.php");	
	include("include/class.chklogin.php");
	//pre($_SESSION);

	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		#echo $key ."=". $value."<br>";
	}
	
	$today = date("Y-m-d H:i:s");  
	$this_ip = $_SERVER['REMOTE_ADDR']; 
	
?>	

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Taxi Admin Panel</title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
        <!-- gebo blue theme-->
            <link rel="stylesheet" href="css/blue.css" id="link_theme" />
        <!-- breadcrumbs-->
            <link rel="stylesheet" href="lib/jBreadcrumbs/css/BreadCrumb.css" />
        <!-- tooltips-->
            <link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
        <!-- colorbox -->
            <link rel="stylesheet" href="lib/colorbox/colorbox.css" />    
        <!-- code prettify -->
            <link rel="stylesheet" href="lib/google-code-prettify/prettify.css" />    
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />    
        <!-- splashy icons -->
            <link rel="stylesheet" href="img/splashy/splashy.css" />
		<!-- flags -->
            <link rel="stylesheet" href="img/flags/flags.css" />	
		<!-- calendar -->
            <link rel="stylesheet" href="lib/fullcalendar/fullcalendar_gebo.css" />
            
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
			document.documentElement.className += 'js';
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
        <!-- fix for ios orientation change -->
        <script src="js/ios-orientationchange-fix.js"></script>
        <!-- scrollbar -->
        <script src="lib/antiscroll/antiscroll.js"></script>
        <script src="lib/antiscroll/jquery-mousewheel.js"></script>
        <!-- to top -->
        <script src="lib/UItoTop/jquery.ui.totop.min.js"></script>
        <!-- common functions -->
        <script src="js/gebo_common.js"></script>
        
        <script src="lib/jquery-ui/jquery-ui-1.8.23.custom.min.js"></script>
        <!-- touch events for jquery ui-->
        <script src="js/forms/jquery.ui.touch-punch.min.js"></script>
        <!-- multi-column layout -->
        <script src="js/jquery.imagesloaded.min.js"></script>
        <script src="js/jquery.wookmark.js"></script>
        <!-- responsive table -->
        <script src="js/jquery.mediaTable.min.js"></script>
        <!-- small charts -->
        <script src="js/jquery.peity.min.js"></script>
        <!-- charts -->
        <!--<script src="lib/flot/jquery.flot.min.js"></script>
        <script src="lib/flot/jquery.flot.resize.min.js"></script>
        <script src="lib/flot/jquery.flot.pie.min.js"></script> -->
        <!-- calendar -->
        <script src="lib/fullcalendar/fullcalendar.min.js"></script>
        <!-- sortable/filterable list -->
        <script src="lib/list_js/list.min.js"></script>
        <script src="lib/list_js/plugins/paging/list.paging.js"></script>
        <!-- dashboard functions -->
        
        <!--<script src="js/gebo_dashboard.js"></script> -->
    </head>
    <body class="sidebar_hidden ptrn_d menu_hover">
		<div id="loading_layer" style="display:none"><img src="img/ajax_loader.gif" alt="" /></div>

		<div id="maincontainer" class="clearfix">
			<!-- header -->
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="index.php"><i class="icon-home icon-white"></i> Taxi System</a>
                            <ul class="nav user_menu pull-right">
                                <!--<li class="hidden-phone hidden-tablet">
                                    <div class="nb_boxes clearfix">
                                        <a data-toggle="modal" data-backdrop="static" href="#myMail" class="label ttip_b" title="New messages">25 <i class="splashy-mail_light"></i></a>
                                        <a data-toggle="modal" data-backdrop="static" href="#myTasks" class="label ttip_b" title="New tasks">10 <i class="splashy-calendar_week"></i></a>
                                    </div>
                                </li>
								<li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav_condensed" data-toggle="dropdown"><i class="flag-gb"></i> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
										<li><a href="javascript:void(0)"><i class="flag-de"></i> Deutsch</a></li>
										<li><a href="javascript:void(0)"><i class="flag-fr"></i> Français</a></li>
										<li><a href="javascript:void(0)"><i class="flag-es"></i> Español</a></li>
										<li><a href="javascript:void(0)"><i class="flag-ru"></i> Pусский</a></li>
                                    </ul>
                                </li> -->
                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="img/user_avatar.png" alt="" class="user_avatar" /> Johny Smith <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
										<li><a href="user_profile.html">My Profile</a></li>
										<!--<li><a href="javascrip:void(0)">Another action</a></li> -->
										<li class="divider"></li>
										<li><a href="logout.php">ออกจากระบบ</a></li>
                                    </ul>
                                </li>
                            </ul>
							<a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
								<span class="icon-align-justify icon-white"></span>
							</a>
                            <nav>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-list-alt icon-white"></i> Forms <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="form_elements.html">Form elements</a></li>
                                                <li><a href="form_extended.html">Extended form elements</a></li>
                                                <li><a href="form_validation.html">Form Validation</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th icon-white"></i> Components <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="alerts_btns.html">Alerts & Buttons</a></li>
                                                <li><a href="icons.html">Icons</a></li>
                                                <li><a href="notifications.html">Notifications</a></li>
                                                <li><a href="tables.html">Tables</a></li>
												<li><a href="tables_more.html">Tables (more examples)</a></li>
                                                <li><a href="tabs_accordion.html">Tabs & Accordion</a></li>
                                                <li><a href="tooltips.html">Tooltips, Popovers</a></li>
                                                <li><a href="typography.html">Typography</a></li>
												<li><a href="widgets.html">Widget boxes</a></li>
												<li class="dropdown">
													<a href="#">Sub menu <b class="caret-right"></b></a>
													<ul class="dropdown-menu">
														<li><a href="#">Sub menu 1.1</a></li>
														<li><a href="#">Sub menu 1.2</a></li>
														<li><a href="#">Sub menu 1.3</a></li>
														<li>
															<a href="#">Sub menu 1.4 <b class="caret-right"></b></a>
															<ul class="dropdown-menu">
																<li><a href="#">Sub menu 1.4.1</a></li>
																<li><a href="#">Sub menu 1.4.2</a></li>
																<li><a href="#">Sub menu 1.4.3</a></li>
															</ul>
														</li>
													</ul>
												</li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-wrench icon-white"></i> Plugins <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="charts.html">Charts</a></li>
                                                <li><a href="calendar.html">Calendar</a></li>
                                                <li><a href="datatable.html">Datatable</a></li>
                                                <li><a href="file_manager.html">File Manager</a></li>
                                                <li><a href="floating_header.html">Floating List Header</a></li>
                                                <li><a href="google_maps.html">Google Maps</a></li>
                                                <li><a href="gallery.html">Gallery Grid</a></li>
                                                <li><a href="wizard.html">Wizard</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-file icon-white"></i> Pages <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="chat.html">Chat</a></li>
                                                <li><a href="error_404.html">Error 404</a></li>
												<li><a href="mailbox.html">Mailbox</a></li>
                                                <li><a href="search_page.html">Search page</a></li>
                                                <li><a href="user_profile.html">User profile</a></li>
												<li><a href="user_static.html">User profile (static)</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                            <a href="documentation.html"><i class="icon-book icon-white"></i> Help</a>
                                        </li>
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
                	
                     <nav>
                        <div id="jCrumbs" class="breadCrumb module">
                         	<ul>
                                <li>
                                    <a href="#"><i class="icon-home"></i></a>
                                </li>
                                <li>
                                	<strong style="color:#069;">ระบบการจัดการรถแท๊กซี่ (Taxi managemanet system)</strong>
                                </li>
                            </ul>                            
                        </div>
                    </nav>
                    
                    <div class="row-fluid">
						<div class="span6">
							<h3 class="heading" style="font-size:12px; border-bottom:1px #000 dotted; margin-bottom:7px; padding-bottom:2px;">
                            	<strong>ระบบจัดการสมาชิก</strong>
                           	</h3>
                        </div>    
                                 
                        <div class="span12" style="text-align:left;">
                            <ul class="dshb_icoNav tac" style="text-align:left;">
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/multi-agents.png)">Users</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/world.png)">Map</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/configuration.png)">Settings</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/lab.png)">Lab</a>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/van.png)">Delivery</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/pie-chart.png)">Charts</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/edit.png)">Add New Article</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/add-item.png)"> Add New Page</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/chat-.png)">Comments</a></li>
                            </ul>
                        </div>
                  				
                	</div>
                    
                    
                  	<div class="row-fluid">
						<div class="span6">
							<h3 class="heading" style="font-size:12px; border-bottom:1px #000 dotted; margin-bottom:7px; padding-bottom:2px;">
                            	<strong>ระบบจัดการสมาชิก</strong>
                           	</h3>
                        </div>    
                                 
                        <div class="span12" style="text-align:left;">
                            <ul class="dshb_icoNav tac" style="text-align:left;">
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/multi-agents.png)">Users</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/world.png)">Map</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/configuration.png)">Settings</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/lab.png)">Lab</a>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/van.png)">Delivery</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/pie-chart.png)">Charts</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/edit.png)">Add New Article</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/add-item.png)"> Add New Page</a></li>
                                <li style="background:none; border:none;"><a href="javascript:void(0)" style="background-image: url(img/gCons/chat-.png)">Comments</a></li>
                            </ul>
                        </div>
                  				
                	</div>

                    
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
        
         <div class="navbar navbar-fixed-bottom">
         	<div class="navbar-inner">
                <div class="container-fluid">
                </div>
        	</div>
        </div>
	</body>
</html>