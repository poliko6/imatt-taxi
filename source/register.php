<?
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
		//echo $key.'='.$value."<br>";
	}
	
	include("include/class.mysqldb.php");
	include("include/config.inc.php");

	
	//print_r($_COOKIE);
?>

<!DOCTYPE html>
<html lang="en" class="login_page">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Taxi Admin Panel - Register Page</title>
    
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
	
		function fn_cancel(){
			window.location = 'login.php'; 
		}
		</script>
        
        
    </head>
    <body>

		
		<div class="login_box">
			<form action="" method="post" id="login_form">
            
				<div class="top_b"><strong>Register Taxi Customer</strong></div>    
				<div id="divPostData"></div>
				            
					
						
							
                            <?php
							$fields = "[
								 {'name':'name'},
								 {'name':'email'},
								 {'name':'location'},
								 {'name':'citizenid', 'description':'หมายเลขบัตรประชาชน', 'type':'text' },
								 {'name':'gender'},
								 {'name':'birthday'},
								 {'name':'password'},
								 {'name':'phone', 'description':'Phone Number','type':'text'},					
								 {'name':'captcha'}
							]";
							?>
							<iframe src="https://www.facebook.com/plugins/registration?
									 client_id=595440030501428&
									 redirect_uri=http://taxi.imattioapp.com/include/register.save.php?regis=ok&
									 fields=<?php echo urlencode($fields);?>"
								scrolling="auto"
								frameborder="no"
								style="border:none; font-size:10px;"
								allowTransparency="true"
								width="100%"
								height="550">
							</iframe> 
					
				                
			
				<div class="btm_b clearfix">
					<button class="btn btn-inverse pull-right" type="button" onClick="fn_cancel();">Cancel</button>
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
