<?
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
	$garageId = $data_ui->garageId;
	
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
	$garageAbout = $data_ui->garageAbout;
	/*echo $path_logo;
	echo "<br>";
	echo $path_banner;*/
	
	if ($data_ui->garageId){
		$data_title = select_db('majoradmin',"where garageId = $data_ui->garageId");
		$data_province = select_db('province',"where provinceId = ".$data_title[0]['provinceId']."");
		$data_district = select_db('district',"where districtId = ".$data_title[0]['districtId']."");
		$data_amphur = select_db('amphur',"where amphurId = ".$data_title[0]['amphurId']."");
		$data_zipcode = $data_title[0]['zipcode'];
		
		$provinceName = $data_province[0]['provinceName'];
		$districtName = $data_district[0]['districtName'];
		$amphurName = $data_amphur[0]['amphurName'];
		
		
		$title_text = $data_title[0]['thaiCompanyName'];
		$garage_name_eng = $data_title[0]['englishCompanyName'];
		$garage_address = $data_title[0]['address'].' ต.'.$districtName.' อ.'.$amphurName.' จ.'.$provinceName.' '.$data_zipcode;
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


<!--jquery libraries / others are at the bottom-->
<script src="../../js/jquery.min.js" type="text/javascript"></script>

<!-- Bootstrap framework -->
<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="../../bootstrap/css/bootstrap-responsive.min.css" />

<!-- main bootstrap js -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- bootstrap plugins -->
<script src="../../js/bootstrap.plugins.min.js"></script>

</head>

<style type="text/css">
.th:hover img {
	-webkit-box-shadow: 0 0 6px 1px rgba(43,166,203,0.5);
	-moz-box-shadow: 0 0 6px 1px rgba(43,166,203,0.5);
	box-shadow: 0 0 10px 1px rgba(43,166,203,0.5);
}
.th img {
	display: block;
	border: solid 10px #ffd400;
	-webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.2);
	-moz-box-shadow: 0 0 0 1px rgba(0,0,0,0.2);
	/*box-shadow: 0 0 0 1px rgba(0,0,0,0.2);*/
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.65);/*ขนาดเงา*/
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
a { text-decoration: none; }
a:hover { text-decoration: none; }
</style>



<body style="background:url(../../modules/mod_garagelayout/img/background.png) repeat-x;">

  <div class="container">
  
  		<!-- logo starts
            ================================================== -->
  		<div class="row-fluid" style="">
        	<div class="span2 offset2" style=""><a href="index.php"><?=$imgLogo?></a></div>
            <div class="span2 offset4" style="text-align:right;">
            	<!--<img src="../../modules/mod_garagelayout/img/logo.png" style="height:70px;" alt="Logo"> -->
          	</div>        	
        </div>
     	<!-- logo ends
            ================================================== -->    
      
      
        
     	<!-- banner starts
            ================================================== -->  
      	<div class="row-fluid" style="margin-top:40px;">
        	<div class="span12">
            	<div class="span2"></div>
            	<div class="span8" style="text-align:center;">
            		<div class="th"><?=$imgBanner?></div>
                </div>
                <div class="span2"></div>
            </div>
        </div>
     	<!-- banner ends
            ================================================== --> 

           
           
            
     	<!-- content starts
            ================================================== --> 
      	<div class="row-fluid" style="margin-top:40px;">   
        	<div class="span12">
            	<div class="span2"></div>
                
            	<div class="span4" style="">
                    <? include('../../modules/mod_garagelayout/blog_news.php'); ?>
              	</div>
                
              	<div class="span4" style="">
                	<? include('../../modules/mod_garagelayout/blog_promotion.php'); ?>
              	</div>
                
                <div class="span2"></div>
            </div>
        </div>   
     	<!-- content ends
            ================================================== -->       
           
           
      	<!-- footer starts
            ================================================== -->     
      	<div class="row-fluid" style="margin-top:40px;">
      		<div class="span12">
            	<div class="span4"></div>
                <div class="span4" style="">
                    <div class="span3" style=""> </div>
                	<div class="span2" style="text-align:center;"> 
                        <a href="<?=$link_fb?>" target="_blank">
                            <img src="../../modules/mod_garagelayout/img/icon-fb.png" width="40">
                        </a>
                    </div>
                    
                    <div class="span2" style="text-align:center;"> 
                        <a href="<?=$link_tw?>" target="_blank">
                        	<img src="../../modules/mod_garagelayout/img/icon-tw.png" width="40">
                    	</a>
                    </div>
                    
                    <div class="span2" style="text-align:center;"> 
                        <a href="<?=$link_puls?>" target="_blank">
                        	<img src="../../modules/mod_garagelayout/img/icon-plus.png" width="40">
                    	</a>
                    </div>
                    <div class="span3" style=""> </div>
                </div>
                <div class="span4"></div>
            </div>
      	</div>     
            
            
        <div class="row-fluid" style="margin-top:20px;">
        	<div class="span12">	
            	<div class="span4" style=""></div>
                <div class="span4" style="color:#999;">
                	
                	<div class="span3" style="text-align:center;"> 
                       <a href="#myModalAbout" role="button" data-toggle="modal">เกี่ยวกับเรา</a>                                      
                    </div>
                    
                   	<div class="span1" style="text-align:center;">|</div>
                   
                    <div class="span3" style="text-align:center;"> 
                        <a href="#myModalContact" role="button" data-toggle="modal">ติดต่อเรา</a>
                    </div>
                    
                    <div class="span1" style="text-align:center;">|</div>
                    
                    <div class="span3" style="text-align:center;"> 
                        <a href="#" target="_blank">แอพพลิเคชั่น</a>
                    </div>
   
                </div>
                <div class="span4" style=""></div>
            </div>
        </div>
      	<!-- footer ends
            ================================================== -->
       
       
       <!-- Modal About Us -->
        <div id="myModalAbout" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel" style="color:#039;"><span class="icon-user"></span> เกี่ยวกับเรา</h4>
          </div>
          <div class="modal-body">
            <p><?=$garageAbout?></p>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">ปิด</button>
          </div>
        </div> <!-- Modal About Us -->
        
        
        
        <!-- Modal Contact -->
        <div id="myModalContact" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel" style="color:#039;"><span class="icon-envelope"></span> ติดต่อเรา</h4>
          </div>
          <div class="modal-body">
            <p>
            	<div class="alert alert-error" id="alert2" style="display:none; margin-top:5px; margin-bottom:5px;">
                    <a class="close" data-dismiss="alert">×</a>
                    <div id="msg2"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
                </div>
                <div class="alert alert-success" id="alert3" style="display:none; margin-top:5px; margin-bottom:5px;">
                    <a class="close" data-dismiss="alert">×</a>
                    <div id="msg3"><strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</div>
                </div>
            	
            	<div class="control-group">
                  <label class="control-label" for="inputWarning">ชื่อที่ติดต่อ</label>
                  <div class="controls">
                    <input type="text" id="sendName">
                    <div class="help-inline" id="sendName_err" style="display:none; color:#C00;">กรุณาป้อนชื่อสำหรับติดต่อ</div>  
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="inputWarning">อีเมล์</label>
                  <div class="controls">
                    <input type="text" id="sendEmail">
                    <div class="help-inline" id="sendEmail_err" style="display:none; color:#C00;">กรุณาป้อนอีเมล์สำหรับติดต่อ</div> 
                  	<i><div class="help-inline" id="txtemailerr" style="color:#F00;"></div></i>
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label" for="inputWarning">ข้อความ</label>
                  <div class="controls">
                    <textarea rows="3" id="sendDetail"></textarea>
                    <div class="help-inline" id="sendDetail_err" style="display:none; color:#C00;">กรุณาป้อนข้อความ</div> 
                  </div>
                </div>
			</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" onClick="fn_sendMail();">ส่งข้อความ</button>
            <button class="btn" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>
          </div>
        </div> <!-- Modal Contact -->
        
        
        <script type="text/javascript">
			//var send_mail = '<?=$data_title[0]['email']?>';
			var send_mail = 'hs5xrk@gmail.com';
			var delayAlert = null;
			function fn_sendMail(){
				console.log(send_mail);
				var pass = 1;
				if (checkData('sendName') == 0){ pass = 0 }
				if (checkData('sendEmail') == 0){ pass = 0 }
				//if (checkData('textarea#sendDetail') == 0){ pass = 0 }	
				
				
				if ($('textarea#sendDetail').val() == ''){ 
					$('textarea#sendDetail').closest('div').addClass("f_error");
					$('#sendDetail_err').fadeIn(1000);
					pass = 0
				} else {
					$('#textarea#sendDetail').closest('div').removeClass("f_error");
					$('#sendDetail_err').fadeOut(100);					
				}
				
				
				///Email
				if ($('#sendEmail').val() != ''){	
					var chkmail = checkEmail($('#sendEmail').val());
					if (chkmail == false){
						$('#sendEmail').closest('div').addClass("f_error");
						$('#txtemailerr').text('กรุณากรอก email ให้ถูกต้อง');
						$('#txtemailerr').fadeIn(1000);
						pass = 0;
					} else {
						$('#sendEmail').closest('div').removeClass("f_error");
						$('#txtemailerr').fadeOut(100);
					}
				} else {		
					$('#txtemailerr').hide();
				}
			
				
				if (pass){
					var sendName = $('#sendName').val();
					var sendEmail = $('#sendEmail').val();
					var sendDetail = $('textarea#sendDetail').val();
					jQuery.ajax({
						url :'../../modules/mod_garagelayout/send.email.php',
						type: 'GET',
						data: 'act=sendmail&sendName='+sendName+'&sendEmail='+sendEmail+'&sendDetail='+sendDetail+'&send_mail='+send_mail+'',
						dataType: 'jsonp',
						dataCharset: 'jsonp',
						success: function (data){
							///console.log(data.success);
							if (data.success){
								alertPopup('msg3','alert3',''+data.message+'',1);
								$('myModalContact').modal('toggle');
							} else {
								alertPopup('msg2','alert2',''+data.message+'',0);
								$('myModalContact').modal('toggle');
							}
						}
					});	
				}
				
			}
			
			function alertPopup(msgid,alertid,message,newload){
				$('#'+msgid+'').text(''+message+'');
				$('#'+alertid+'').fadeIn(500, function() {
					clearTimeout(delayAlert);  
					delayAlert=setTimeout(function(){  
						$(''+alertid+'').fadeOut(1000);
						if (newload == 1){
							window.location = "index.php";
						}
						delayAlert=null;  
					},2000);  
				});
			}
			
			
			function checkEmail(email) {
				var emailFilter=/^.+@.+\..{2,3}$/;
				if (!(emailFilter.test(email))) {
					//console.log('กรุณากรอก email ให้ถูกต้อง');
					return 0; 
				} else {
					return 1; 
				}
			}
			
			
			function checkData(id){
				if ($('#'+id+'').val() == ''){ 
					$('#'+id+'').closest('div').addClass("f_error");
					$('#'+id+'_err').fadeIn(1000);
					return 0;
				} else {
					$('#'+id+'').closest('div').removeClass("f_error");
					$('#'+id+'_err').fadeOut(100);
					return 1;
				}
			}
		</script>

            
       	
            
	</div>
    
    
    <!-- copyright starts
        ================================================== -->    
    <div class="row" style="margin-top:20px; background: url(../../modules/mod_garagelayout/img/foot-bar.png) repeat-x;">      
        <div class="row-fluid" style="margin-top:20px;background:#ffd400 ;">
            <div class="span12">
                <div class="span3"> </div>
                <div class="span6" style="text-align:center;">
                    <div><?=$garage_name_eng?></div>
                    <div><?=$garage_address?></div>
                    <div><?=$garage_email?></div>
                    <div><?=$garage_phone?></div>
                </div>
                <div class="span3"> </div>
            </div>
        </div>
    </div>
    <!-- copyright ends 
    ================================================== -->
 </body>
</html>
