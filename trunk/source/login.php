<?
	ob_start();
	session_start();
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		//echo $key.'='.$value."<br>";
	}
	
	include("include/class.mysqldb.php");
	include("include/config.inc.php");
	include("include/class.function.php");
	include("include/class.login.facebook.php");
	
	//$password = '';
	//print_r($_COOKIE);
	//pre($user);
	//pre($_SESSION);
	//echo '<br>logout fb = '.$logoutUrl;
	//echo '<br>login fb = '.$loginUrl;
	
	
	if (!empty($logout)){
		session_destroy();
		$user = NULL;
	}
	
?>

<!DOCTYPE html>
<html lang="en" class="login_page">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Taxi Admin Panel - Login Page</title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
        <!-- theme color-->
            <link rel="stylesheet" href="css/blue.css" />
        <!-- tooltip -->    
			<link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
        <!-- main styles -->
            <link rel="stylesheet" href="css/style.css" />
    
        <!-- Favicon -->
           	<link rel="shortcut icon" href="favicon.ico" />
    
        	<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    
        <!--[if lte IE 8]>
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
        <![endif]-->
        
        <link rel="stylesheet" href="lib/zocial/zocial.css" />
		
        <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script src="js/jquery.actual.min.js"></script>
        <script src="lib/validation/jquery.validate.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
		
		$(document).ready(function(){	
			var typeselect = '<?=$typeuser?>';
			if (typeselect != '') {
				fn_changeSet(typeselect);
			}
			//console.log(find_chk);	
			$(document).on("keydown.NewActionOnF5", function(e){
				var charCode = e.which || e.keyCode;
				switch(charCode){
					case 116: // F5
						e.preventDefault();
						window.location = "login.php?typeuser=1";
						break;
				}
			});	
		});
	
		
		function login(){
			//alert($("#username").val());
			var setText = '';
			var pass = 1;
			var chkMem = 0;
			var typeselect = $('#typeuser').val();
			
			//console.log($('#typeuser').val());
			
			if (typeselect == 1) {
				if ($("#username").val()==''){
					$("#username").closest('div').addClass("f_error");
					setText = 'โปรดกรอก username';
					pass = 0;		
				}
				
				if ($("#password").val()==''){
					$("#password").closest('div').addClass("f_error");
					if (setText == ''){
						setText = 'โปรดกรอก password';
					} else {
						setText = setText+',password';
					}
					pass = 0;
				}
				
				if ($("#garageid").val()==''){
					$("#garageid").closest('div').addClass("f_error");
					if (setText == ''){
						setText = 'โปรดกรอกรหัสอู่รถ';
					} else {
						setText = setText+' และรหัสอู่รถ';
					}
					pass = 0;
				}
				
				if ($('#chkMem').is(':checked')){
					chkMem = 1;
				} 
				
				
				if (pass){
	
					$.post("include/class.login.php", { 
						process: "login",
						username: $("#username").val(),
						password: $("#password").val(),
						garageid: $("#garageid").val(),
						chkMem : chkMem
					}, 
						function(data){
							$("#divPostData").html(data);
						}
					);
				} else {
					$("#divPostData").html("<div class='alert alert-login alert-error'>"+setText+"</div>");
				}
			}
			
			
			
			
			if (typeselect == 2) {
				if ($("#username2").val()==''){
					$("#username2").closest('div').addClass("f_error");
					setText = 'โปรดกรอก email';
					pass = 0;		
				}
				
				
				if ($("#password2").val()==''){
					$("#password2").closest('div').addClass("f_error");
					if (setText == ''){
						setText = 'โปรดกรอก password';
					} else {
						setText = setText+',password';
					}
					pass = 0;
				}
				
				
				if (pass){
	
					$.post("include/class.login.customer.php", { 
						process: "login",
						username: $("#username2").val(),
						password: $("#password2").val()
					}, 
						function(data){
							$("#divPostData").html(data);
						}
					);
				} else {
					$("#divPostData").html("<div class='alert alert-login alert-error'>"+setText+"</div>");
				}
			}
			
			
			
			
		}
		
		
		function fn_changeSet(value){
			var fbID = '<?=$user;?>'; //Check Facebook ID
			//console.log('<?=$user;?>');
			
			
			
			$("#setcustomer1").hide();
			$("#setcustomer2").hide();
			
			if(value == 1) {
				$('#setadmin').show();
				$('#setcustomer').hide();
			} else {
				
				$('#setadmin').hide();
				$('#setcustomer').show();
				
				
				
				if ((fbID != '') && (fbID != '0')){
					
					$.post("include/class.login.customer.php", { 
						process: "loginfb",
						fbID: fbID
					}, 
						function(data){
							//console.log(data);
							if (data == '1'){
								$("#setcustomer1").show();
							} else {
								window.location = 'register.php';
							}
						}
					);
					
				} else {
					$("#setcustomer2").show();
				}
					
					
			}
		}
		
		
		function fn_formSubmit(value){
			window.location = 'login.php?typeuser='+value+'';
		}
		
		</script>
        
        
    </head>
    <body>
		
        
       <form action="" method="post" id="logout_fb">
       		<input type="hidden" name="logout" value="1">
       </form>
		
		<div class="login_box">
       
			<form action="" method="post" id="login_form">
            
				<div class="top_b">
                	<strong>Taxi Admin</strong>
                </div>   
                 
				<div id="divPostData"></div>
                

				<div class="cnt_b">               
                
     
                    
                    <?php
					if (empty($typeuser)) {
						$typeuser = 1;
					}
                    
					?>
                    <div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-flag"></i></span>
                                                        
                            <select name="typeuser" id="typeuser" onChange="fn_formSubmit(this.value);">
                                <option value="1" <? if ($typeuser == 1) { echo "selected"; } ?> >ผู้ดูแลระบบ</option>
                                <option value="2" <? if ($typeuser == 2) { echo "selected"; } ?> >ลูกค้า</option>                              
                            </select>
                          
						</div>
					</div>
              
                    <div style="clear:both;"></div>
                	
                    
                    
                    <!--set admin -->
                    <div id="setadmin">  
                                      
                        <div class="formRow clearfix">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input type="text" id="username" name="username" placeholder="Username" value="" />
                            </div>
                        </div>
      
                                            
                        <div class="formRow clearfix">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-lock"></i></span>                             
                                <input type="password" id="password" name="password" placeholder="Password" value="" />
                                <!--<span class="help-block">help block</span> -->
                            </div>
                        </div>
                        
                        <div class="formRow clearfix">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-briefcase"></i></span>
                                <input type="text" id="garageid" name="garageid" placeholder="Garage ID" value="" />
                            </div>
                        </div>
                        
                        <div class="formRow clearfix">
                            <label class="checkbox"><input type="checkbox"  id="chkMem" name="chkMem"/> Remember me</label>
                        </div>
                    </div>
         
                    
                    <!-- set customer -->
                    <div id="setcustomer" style="display:none;">                    
                        
                     
                        	<div id="setcustomer1">
                                <div style="padding:5px;">
                                    <a href="index.php" class="zocial amazon">เข้าระบบแท๊กซี่</a>
                                </div>
                                <div style="padding:5px;">
                                    <a onClick="logout_fb.submit();" class="zocial facebook">Sign out Facebook</a>
                                </div>
                            </div>
                           
            
          		
                        	<div id="setcustomer2">
                                <div class="formRow clearfix">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-user"></i></span><input type="text" id="username2" name="username2" placeholder="EMail" value="<?=trim($username2)?>" />
                                    </div>
                                </div>
              
                                                    
                                <div class="formRow clearfix">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-lock"></i></span>                             
                                        <input type="password" id="password2" name="password2" placeholder="Password" value="" />
                                        <!--<span class="help-block">help block</span> -->
                                    </div>
                                </div>
                                
                                <div style="padding:5px;">
                                     
                                    <a href="<?=$loginUrl?>" class="zocial facebook">Sign in with Facebook</a>
                        
                                </div>
                                
                            </div>
                  
                        
                        <!--<div class="formRow clearfix">
                            <label class="checkbox"><input type="checkbox"  id="chkMem2" name="chkMem2"/> Remember me</label>
                        </div> -->
                    </div>
                    
                    
                    
				</div>
				<div class="btm_b clearfix">
					<button class="btn btn-inverse pull-right" type="button" onClick="login();">Sign In</button>
					<span style="font-size:12px;">
                    <a href="register.php">ลูกค้าลงทะเบียนที่นี่</a></span>
                </div> 
 
			</form>
      
	
			<div class="links_b links_btm clearfix">
				<!--<span class="linkform"><a href="#pass_form">Forgot password?</a></span> -->
				<span class="linkform" style="display:none">Never mind, <a href="#login_form">send me back to the sign-in screen</a></span>
			</div>
		</div>
        
        
  
        <script>
            $(document).ready(function(){
				
				$("#password").val('');
                
				//* boxes animation
				form_wrapper = $('.login_box');
				function boxHeight() {
					form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);	
				};
				form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });
                $('.linkform a,.link_reg a').on('click',function(e){
					var target	= $(this).attr('href'),
						target_height = $(target).actual('height');
					$(form_wrapper).css({
						'height'		: form_wrapper.height()
					});	
					$(form_wrapper.find('form:visible')).fadeOut(400,function(){
						form_wrapper.stop().animate({
                            height	 : target_height,
							marginTop: ( - (target_height/2) - 24)
                        },500,function(){
                            $(target).fadeIn(400);
                            $('.links_btm .linkform').toggle();
							$(form_wrapper).css({
								'height'		: ''
							});	
                        });
					});
					e.preventDefault();
				});
				
				
				
				//* validation
				$('#login_form').validate({
					onkeyup: false,
					errorClass: 'error',
					validClass: 'valid',
					rules: {
						username: { required: true, minlength: 3 },
						password: { required: true, minlength: 8 }
					},
					highlight: function(element) {
						$(element).closest('div').addClass("f_error");
						setTimeout(function() {
							boxHeight()
						}, 200)
					},
					unhighlight: function(element) {
						$(element).closest('div').removeClass("f_error");
						setTimeout(function() {
							boxHeight()
						}, 200)
					},
					errorPlacement: function(error, element) {
						$(element).closest('div').append(error);
					}
				});
            });
        </script>
    </body>
</html>
