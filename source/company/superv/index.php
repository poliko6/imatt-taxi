<?
	session_start();
	include("../../include/class.mysqldb.php");
	include("../../include/config.inc.php");	
	include("../../include/class.function.php");
	
	$get_path = $_SERVER['REQUEST_URI'];
	$p_get_path = explode('/',$get_path);
	$this_garage = $p_get_path[count($p_get_path)-2];
	//$this_garage = '1234';
	
	$sql_ui = "SELECT garageinterface.*, garagelist.garageShortName FROM garageinterface ";
	$sql_ui .= "INNER JOIN garagelist ON garageinterface.garageId = garagelist.garageId ";
	$sql_ui .= "WHERE garagelist.garageShortName ='".trim($this_garage)."' ";
	$rs_ui = mysql_query($sql_ui);
	$data_ui = mysql_fetch_object($rs_ui);	
	//echo $sql_ui;
	
	$sql_ui_default = "SELECT * FROM garageinterface WHERE garageId = 0 ";
	$rs_ui_default = mysql_query($sql_ui_default);
	$data_ui_default = mysql_fetch_object($rs_ui_default);
	
	
	//Logo
	if ($data_ui->interfaceLogo == ''){
		$path_logo = "../../modules/mod_garagelayout/img/".$data_ui_default->interfaceLogo;
	} else {
		$path_logo = "img/".$data_ui->interfaceLogo;
		if (file_exists($path_logo)) {  //check file			
			$path_logo = "img/".$data_ui->interfaceLogo;
		} else { 						
			$path_logo = "../../modules/mod_garagelayout/img/".$data_ui_default->interfaceLogo;	
		}
	}
	

	//Banner
	if ($data_ui->interfaceBanner == ''){
		$path_banner = "../../modules/mod_garagelayout/img/".$data_ui_default->interfaceBanner;
	} else {
		$path_banner = "img/".$data_ui->interfaceBanner;
		if (file_exists($path_banner)) {  //check file			
			$path_banner = "img/".$data_ui->interfaceBanner;
		} else { 						
			$path_banner = "../../modules/mod_garagelayout/img/".$data_ui_default->interfaceBanner;	
		}
	}
	
	
	//Link FB
	if ($data_ui->interfaceFacebook == ''){
		$link_fb = trim($data_ui->interfaceFacebook);
	} else {
		$link_fb = trim($data_ui_default->interfaceFacebook);
	}
	
	//Link TW
	if ($data_ui->interfaceTwitter == ''){
		$link_tw = trim($data_ui->interfaceTwitter);
	} else {
		$link_tw = trim($data_ui_default->interfaceTwitter);
	}	
	
	//Link Plus
	if ($data_ui->interfaceGoogle == ''){
		$link_puls = trim($data_ui->interfaceGoogle);
	} else {
		$link_puls = trim($data_ui_default->interfaceGoogle);
	}
	
	
	$imgLogo = "<img src=\"$path_logo\" style=\"height:70px;\" alt=\"Logo\">";
	$imgBanner = "<img src=\"$path_banner\"  width=\"753\" height=\"445\">";
	
	/*echo $path_logo;
	echo "<br>";
	echo $path_banner;*/
	
	if ($data_ui->garageId){
		$data_title = select_db('majoradmin',"where garageId = $data_ui->garageId");
		$title_text = $data_title[0]['thaiCompanyName'];
		$garage_name_eng = $data_title[0]['englishCompanyName'];
		$garage_address = $data_title[0]['address'];
		$garage_email = 'Email : '.$data_title[0]['email'];
		$garage_phone = 'Phone : '.$data_title[0]['telephone'].', Call Center: '.$data_title[0]['callCenter'];
	} else {
		$title_text = 'Garage Page';
		$garage_name_eng = 'iMATTIO Co.,Ltd';
		$garage_address = '61 Pattanakarn 50 Road, Suanluang, Bangkok 10250';
		$garage_email = 'www.iMattio.com / Email : info@imattio.com, iMattioApp@gmail.com';
		$garage_phone = 'Phone : Thailand +6681-527-3988, +6681-942-1292 / USA +1-169-988-8993 ';
	}
	
	//pre($data_ui);
	//pre($data_ui_default);
	
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="description" content="Taxi management system." />
<meta name="keywords" content="taxi, meter" />
<meta name="author" content="iMattio" />
<title><?=$title_text?></title>
<link rel="shortcut icon" href="../../modules/mod_garagelayout/img/favicon.ico">

<!--style sheet-->
<link rel="stylesheet" media="screen" href="../../modules/mod_garagelayout/css/facebook-framework.css" />
<link rel="stylesheet" media="screen" href="../../modules/mod_garagelayout/css/style.css" />

<!--jquery libraries / others are at the bottom-->
<script src="../../modules/mod_garagelayout/js/jquery-1.7.1.min.js" type="text/javascript"></script>
</head>

<style type="text/css">
.th:hover img {
	-webkit-box-shadow: 0 0 6px 1px rgba(43,166,203,0.5);
	-moz-box-shadow: 0 0 6px 1px rgba(43,166,203,0.5);
	box-shadow: 0 0 6px 1px rgba(43,166,203,0.5);
}
.th img {
	display: block;
	border: solid 10px #ffd400;
	-webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.2);
	-moz-box-shadow: 0 0 0 1px rgba(0,0,0,0.2);
	/*box-shadow: 0 0 0 1px rgba(0,0,0,0.2);*/
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.65);/*ขนาดเงา*/
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	-ms-border-radius: 3px;
	-o-border-radius: 3px;
	border-radius: 3px;
	-webkit-transition-property: box-shadow;
	-moz-transition-property: box-shadow;
	-o-transition-property: box-shadow;
	transition-property: box-shadow;
	-webkit-transition-duration: 300ms;
	-moz-transition-duration: 300ms;
	-o-transition-duration: 300ms;
	transition-duration: 300ms;
}

.bgBlock {
	background: rgb(255,255,255); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(255,255,255,1) 0%, rgba(255,255,255,1) 54%, rgba(232,232,232,1) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(54%,rgba(255,255,255,1)), color-stop(100%,rgba(232,232,232,1))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,1) 54%,rgba(232,232,232,1) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,1) 54%,rgba(232,232,232,1) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,1) 54%,rgba(232,232,232,1) 100%); /* IE10+ */
	background: linear-gradient(to bottom,  rgba(255,255,255,1) 0%,rgba(255,255,255,1) 54%,rgba(232,232,232,1) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e8e8e8',GradientType=0 ); /* IE6-9 */
	border-bottom:1px solid #CCC;
	border-left:1px solid #CCC;
	border-right:1px solid #CCC;
}
</style>



<body style="background:url(../../modules/mod_garagelayout/img/background.png) repeat-x;">

<!-- header starts
================================================== -->
<section id="header" class="container clearfix" style="background:none;">
  <div class="span12">
    <nav class="mainNav">
      <ul style="margin:0px; padding:0px;">
        <li class="homeLink last" style="margin-top:10px;"><?=$imgLogo?></li>
      </ul>
      <ul class="fright">
        <li class="homeLink last" style="margin-top:10px;"> <img src="../../modules/mod_garagelayout/img/logo.png" style="height:70px;" alt="Logo"> </li>
      </ul>
    </nav>
  </div>
</section>
<!-- header ends
================================================== -->




<!-- banner starts
================================================== -->
<section class="content dark container clearfix"  style="margin-top:5px;">
  <div class="span12" style="text-align:center;">
    <p class="white MB20"></p>
    <div class="th"> <?=$imgBanner?> </div>
  </div>
</section>



<!-- content starts
================================================== -->
<section class="content dark container clearfix">
<div class="services clearfix"> 
  
  <!-- item 1 -->
  <div class="span6">
    <div style="background:url(../../modules/mod_garagelayout/img/content-head-news.png) no-repeat; width:373px; height:120px;" ></div>
    <div class="bgBlock" style="border-radius:0px 0px 30px 30px; height:200px; width:367px; margin-left:5px;">sdfasdf</div>
  </div>
  <!-- End --> 
  
  <!-- item 2 -->
  <div class="span6">
    <div style="background: url(../../modules/mod_garagelayout/img/content-head-pro.png) no-repeat; width:373px; height:120px;" ></div>
    <div class="bgBlock" style="border-radius:0px 0px 30px 30px; height:200px; width:367px; margin-left:5px;">sdfasdf</div>
  </div>
  <!-- End --> 
  
</div>
<!-- End Services -->
<section>

<!-- footer starts
================================================== -->
<section id="footer" class="container clearfix" style="background:none;"> 
  
  <!--first column starts-->
  <div class="span4"></div>
  <!--first column ends--> 
  
  <!--second column starts-->
  <div class="span4">
    <div style="float:left; margin-right:20px; margin-left:35px;"> ]
    	<a href="<?=$link_fb?>" target="_blank">
        	<img src="../../modules/mod_garagelayout/img/icon-fb.png" width="40">
        </a>
    </div>
    <div style="float:left; margin-right:20px;"> 
    	<a href="<?=$link_tw?>" target="_blank">
    		<img src="../../modules/mod_garagelayout/img/icon-tw.png" width="40">
        </a>
   	</div>
    <div style="float:left;"> 
    	<a href="<?=$link_puls?>" target="_blank">
    		<img src="../../modules/mod_garagelayout/img/icon-plus.png" width="40">
        </a>
    </div>
    <div style="clear:both;"></div>
    
    <div style="font-size:16; font-weight:bold; color:#666;">
      <div style="float:left; margin-right:10px;"><a href="<?=$link_fb?>" target="_blank">เกี่ยวกับเรา</a></div>
      <div style="float:left; margin-right:10px;">|</div>
      <div style="float:left; margin-right:10px;"><a href="<?=$link_fb?>" target="_blank">ติดต่อเรา</a></div>
      <div style="float:left; margin-right:10px;">|</div>
      <div style="float:left;"><a href="<?=$link_fb?>" target="_blank">แอพพลิเคชั่น</a></div>
    </div>
  </div>
  <!--second column ends--> 
  
  <!--third column starts-->
  <div class="span4"></div>
  <!--third column ends--> 
  
</section>
<!-- footer ends
================================================== --> 
<!-- copyright starts
================================================== -->
<section id="copyright" class="container clearfix">
  <div class="span3"> </div>
  <div class="span6" style="text-align:center;">
    <div><?=$garage_name_eng?></div>
    <div><?=$garage_address?></div>
    <div><?=$garage_email?></div>
    <div><?=$garage_phone?></div>
  </div>
  <div class="span3"> </div>
</section>
<!-- copyright ends
================================================== -->

</body>
</html>
