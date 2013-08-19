<?
	ob_start();
	session_start();
	
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		//echo $key.'='.$value."<br>";
	}
	
	include("include/class.mysqldb.php");
	include("include/config.inc.php");
	
	
	$password = '';
	//print_r($_COOKIE);
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
		
        
        <script type="text/javascript">
		function login(){
			//alert($("#username").val());
			var setText = '';
			var pass = 1;
			var chkMem = 0;
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
		</script>
        
        
    </head>
    <body>

		
		<div class="login_box">
			<form action="" method="post" id="login_form">
            
				<div class="top_b"><strong>Taxi Admin</strong></div>    
				<div id="divPostData"></div>
				<div class="cnt_b">
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-user"></i></span><input type="text" id="username" name="username" placeholder="Username" value="<?=trim($username)?>" />
						</div>
					</div>
  
                                        
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span>                             
                            <input type="password" id="password" name="password" placeholder="Password" value="" />
                            <!--<span class="help-block">help block</span> -->
						</div>
					</div>
                    <div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-briefcase"></i></span>
                            <input type="text" id="garageid" name="garageid" placeholder="Garage ID" value="" />
						</div>
					</div>
					<div class="formRow clearfix">
						<label class="checkbox"><input type="checkbox"  id="chkMem" name="chkMem"/> Remember me</label>
					</div>
				</div>
				<div class="btm_b clearfix">
					<button class="btn btn-inverse pull-right" type="button" onClick="login();">Sign In</button>
				</div>  
			</form>
			
			<form action="#" method="post" id="pass_form" style="display:none">
				<div class="top_b">Can't sign in?</div>    
					<div class="alert alert-info alert-login">
					Please enter your email address. You will receive a link to create a new password via email.
				</div>
				<div class="cnt_b">
					<div class="formRow clearfix">
						<div class="input-prepend">
							<span class="add-on">@</span><input type="text" placeholder="Your email address" />
						</div>
					</div>
				</div>
				<div class="btm_b tac">
					<button class="btn btn-inverse" type="submit">Request New Password</button>
				</div>  
			</form>
			
			
			<div class="links_b links_btm clearfix">
				<!--<span class="linkform"><a href="#pass_form">Forgot password?</a></span> -->
				<span class="linkform" style="display:none">Never mind, <a href="#login_form">send me back to the sign-in screen</a></span>
			</div>
		</div>
		
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.actual.min.js"></script>
        <script src="lib/validation/jquery.validate.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
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
