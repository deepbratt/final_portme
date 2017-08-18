
<!DOCTYPE html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Portme</title>
        <!--  Favicon -->
		<?php
			include('meta_links.php');
		?>
    </head>
    <body>
       
        <!-- ==============================================
                     **MAIN HEADER**
        =============================================== -->
				<?php
					include('header.php');
				?>
        <!-- ==============================================
                             **MAIN BANNER**
        =============================================== -->
        <section class="main-banner paraxify banner-image-1 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-banner-content text-center">
                            <h2>Log-in</h2>
                            <ul class="breadcrumbs">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Log-in</a></li>
                            </ul>
                            <p>Explore the Features and Attractions</p>
                        </div>
                    </div>
                </div>
            </div><!-- End Container -->
        </section><!-- End Section -->
        <!-- ==============================================
                             **FUNCTIONALITIES**
        =============================================== -->

		<section class="contact ptb-80">
            <div class="container">
            <div class="row">
				
			<?php
			if(isset($data) && $data == "error"){
			?>
				<p style="text-align:center;background:#e54e53;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;"> Username and password did not match! </p>
			<?php
			}
			?>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form autocomplete="off" novalidate="novalidate" id="ContactForm" name="contact-form">
                            <h5>Log In</h5>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group ptb-10">
                                        <input placeholder="Enter your full name" class="form-control" name="full_name" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group ptb-10">
                                        <input placeholder="Enter your email" name="email" class="form-control" type="email">
                                    </div>
                                </div>
                                
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group ptb-10">
                                        <input placeholder="Enter your password" name="subject" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-theme-primary" type="submit" name="submit">Log in</button>
                        </form>
				<p class="text-center text-muted small m-a-0">
					<a href="forget_pass.php" class="fpass">Forgot Password?</a><br>
					Don't have an account? <a href="signup.php">Sign up here</a>
				</p>
                    </div>
                    
            </div>
            </div><!-- End Container -->
        </section><!-- End Section -->

        <!-- ==============================================
                             **FOOTER STARTS**
        =============================================== -->        
                <?php
					include('footer.php');
				?>  
				<!-- End Footer -->
				
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Modenizer JS -->
        <script src="js/modernizr-custom.js"></script>
        <!-- Bootsvav Menu -->
        <script src="assets/bootsnav-master/js/bootsnav.js" type="text/javascript"></script>
        <!-- Parallax -->
        <script src="js/paraxify.min.js" type="text/javascript"></script>
        <!-- Way Points -->
        <script src="js/waypoints.min.js" type="text/javascript"></script>
        <!-- Conterup -->
        <script src="js/jquery.counterup.min.js" type="text/javascript"></script>
        <!-- Custom JS -->
        <script src="js/custom.js"></script>
        <!-- ==============================================
                ** STYLE SWITCHER-ONLY FOR DEMO PURPOSE**
        =============================================== -->
        <div id="style-switcher">
            <div id="toggle-switcher"><i class="fa fa-cog"></i></div>
            <h1>Change Color</h1>
            <ul>
                <li><img src="images/color_01.jpg" alt="" /></li>
                <li><img src="images/color_02.jpg" alt="" /></li>
                <li><img src="images/color_03.jpg" alt="" /></li>
                <li><img src="images/color_04.jpg" alt="" /></li>
                <li><img src="images/color_05.jpg" alt="" /></li>
                <li><img src="images/color_06.jpg" alt="" /></li>
            </ul>
        </div>
        <!--Style Switcher Script-->
        <script src="js/style-switcher.js"></script>
        <!--End Style Switcher-->
   
	<!-- Page Plugins -->
	<script src="js/jquery.validate.min.js"></script>

	<!-- Template Js -->
	<script src="js/apps.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function($){
			"use strict";
			// Footer Absolute
			$('.rs-footer').footerAbsolute({
			    absoluteClass		: 'login-footer',
			    mainContent			: 'login-wrap'
			});
			// Example login validation
			$('#rs-validation-login-page').validate({
				ignore: 'input[type=hidden]', // ignore hidden fields
				rules: {
					username: "required email",
					password: "required",
					phone:"required number",
					country: "required",
					business: "required",
					type: "required"
				},
				messages: {
					username: "Please enter your email",
					password: "Please provide a password",
					phone: "Please enter your phone number",
					country: "Please choose your country",
					business: "Please enter your business name",
					type: "Please choose your business category"
				},
				errorElement: "p",
				errorPlacement: function ( error, element ) {
					error.addClass( "help-block" );
					// Has feedback
					if (element.parents('div').hasClass('has-feedback')) {
						error.appendTo( element.parent() );
					}
					else{
						error.insertAfter(element);
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".form-group" ).addClass( "has-error" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".form-group" ).removeClass( "has-error" );
				}
			});
		});
	</script>

</body>
</html>