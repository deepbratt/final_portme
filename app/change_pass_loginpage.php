<?php
 include ("config.php");

if(isset($_POST['change_pass']))
	{
		$new_password = $_POST['Password'];
		$confirm_password = $_POST['confirm_password'];

		if($new_password == $confirm_password)
		{
			$change_password = mysqli_query($mysqli,"update users set password='".$confirm_password."' where id='".$user_id."'");
			if($change_password)
			{
				echo "<script>alert('successfully Changed')</script>";
			}
			else
			{
				echo "<script>alert('error')</script>";
			}
		}
		else
		{
			echo "<script>alert('confirm error')</script>";
		}
	}

	
?>

<!DOCTYPE html>
<html lang=en>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Change Password | Port-ME</title>

	<?php 
		include("metalinks.php");
	?>
	<style>
		.bg-grad-03{
			background:#f0eff0 !important;
		}
		.form-control{
			font-size:12px;
		}
		.fpass:hover{
			text-decoration:underline !important;
		}
	</style>
</head>


<body>

	<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div id="rs-wrapper" class="bg-grad-03">

		<div class="login-wrap p-a-md m-x-auto">
			
			<div class="bg-white b-r-a p-a-lg light-bs" style="box-shadow:3px 3px 3px 3px #CCC;margin-top:50px;">
				<p class="text-center" style="margin-bottom:30px;"><a href="http://www.port-me.com"><img src="images/logo.png" alt="Logo" style="height:80px;"></a></p>
				<form class="m-b-lg" id="rs-validation-login-page">
					<div class="form-group has-feedback feedback-left">
						<label class="control-label">Password</label>
						<input name="Password" type="password" name="password" id="rs-form-example-password" placeholder="Enter your new password" class="form-control">
						<span class="gcon gcon-lock f-s-xs form-control-feedback" aria-hidden="true"></span>
					</div><!-- /.form-group -->
					<div class="form-group has-feedback feedback-left">
						<label class="control-label">Confirm Password</label>
						<input type="password" name="confirm_password" id="rs-form-example-passconfirm" placeholder="Enter again your new password" class="form-control">
						<span class="gcon gcon-lock f-s-xs form-control-feedback" aria-hidden="true"></span>
					</div><!-- /.form-group -->
					
					<button class="btn btn-success btn-block text-uppercase" name= "change_pass" type="submit">Change Password</button>
				</form>

				<p class="text-center text-muted small m-a-0">
					<a href="signup.php" class="fpass">Don't have a account yet?</a><br>
					I already remember, get back to <a href="index.php">Login Page</a>
				</p>
			</div><!-- /.bg-white -->
		</div><!-- /.login-wrap -->


		<!-- BEGIN FOOTER -->
		<footer class="rs-footer login-footer text-center" style="background:url(images/top-clg-sec.png)">
			<span class="text-white small" style="color:#000 !important;">&copy; 2017 &copy; <a href="http://www.port-me.com" class="text-lighten"  style="color:#000 !important;text-decoration:underline;">Port-ME</a> All Rights Reserved</span>
		</footer>
		<!-- END FOOTER -->

	</div><!-- /#rs-wrapper -->


	
	<!-- <script src=https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js></script>
	<script>
	window.jQuery || document.write('<script src="../dist/js/vendor/jquery.min.js"><\/script>')
	</script> -->
	<script src="js/vendor.js"></script>
	<script src="js/plugins.js"></script>
	

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
					password: "required",
					confirm_password: {
					  equalTo: "#rs-form-example-password"
					}
				},
				messages: {
					password: "Please provide a password",
					confirm_password: "Password and confirm password doesn't match"
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