<?php
	include('config.php');
	$business_id = $_SESSION['business_id'];
	
	if(isset($_POST['update']))
	{
		$old = mysqli_real_escape_string($mysqli,$_POST['old']);
		$new = mysqli_real_escape_string($mysqli,$_POST['new']);
		$confirm_new = mysqli_real_escape_string($mysqli,$_POST['confirm_new']);

		$select_prev = mysqli_query($mysqli,"select * from tbl_business where business_id='$business_id'");
		$fetch_prev = mysqli_fetch_array($select_prev);

		if($fetch_prev['password'] == $old)
		{
			if($fetch_prev['password'] != $new)
			{
				if($new == $confirm_new)
				{
					$update_query = mysqli_query($mysqli,"update tbl_business set password='".$new."' where business_id='".$business_id."'");
					if($update_query)
					{
						$data = 'success';
					}
					else{
						$data = 'error';
					}
				}
				else{
					$data = 'confirm_error';
				}
			}
			else{
					$data = 'same_error';
				}
		}
		else{
					$data = 'match_error';
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
	<?php include("metalinks.php");?>

</head>


<body>

	<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div id="rs-wrapper">
		<?php 
			include("header.php");
			include("sidebar.php");
		?>
			
		<!-- BEGIN MAIN CONTENT -->
		<article class="rs-content-wrapper">
			<div class="rs-content">
				<div class="rs-inner">

					<!-- Begin Dashhead -->
					<div class="rs-dashhead m-b-lg" style="background:#f5f5f5">
						<div class="rs-dashhead-content">
							<div class="rs-dashhead-titles">
								<h3 class="rs-dashhead-title m-t">
									Login Security:
									<div style="float:right;">
										<!--<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>-->

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;" onclick="window.location.href='dashboard.php'"> <i class="fa fa-remove"></i> </span>
									</div>
								</h3>
								
							</div>
							
						</div><!-- /.rs-dashhead-content -->
						<!-- Begin Breadcrumb -->

						<!-- End Breadcrumb -->
					</div><!-- /.rs-dashhead -->
					<!-- End Dashhead -->
						<div class="container-fluid" style="padding:0px;margin-top:-20px;margin-right:5px;margin-left:-5px;">
						<div class="col-md-12 col-sm-12">

										<?php
											if(isset($data) && $data=='success'){
										?>
										<p style="text-align:center;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Password Changed Successfully </p>
										<?php
									  }
										
											if(isset($data) && $data=='error'){
										?>
										<p style="text-align:center;background:#ef5350;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Failed to Update </p>
										<?php
									  }
										 if(isset($data) && $data=='confirm_error'){
										?>
										<p style="text-align:center;background:#ef5350;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;">  Oops! New Password And Confirm Passwword Doesn't Match </p>

										<?php
									  }
										 if(isset($data) && $data=='same_error'){
										?>
										<p style="text-align:center;background:#ef5350;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;">  Oops! New Password And Current Passwword Can't be Same!</p>
										<?php
									  }
										 if(isset($data) && $data=='match_error'){
										?>
										<p style="text-align:center;background:#ef5350;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;">  Oops! Current Passwword Didn't Match!</p>
										<?php
									  }
										?>
						</div>
					
					<!-- Begin default content width -->
					<div class="container-fluid" style="padding:0px;margin-top:-20px;margin-right:5px;margin-left:-5px;">

					

						<div class="col-md-12 col-sm-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">

								<div class="panel-body">
									<form method="post" id="rs-validation-login-page">	
																			
										<div class="row">
											<div class="col-sm-2">Old Password:</div>
												<div class="form-group">
													<div class="col-sm-4">
														<input name="old_password" type="password" class="form-control" id="rs-form-example-email" placeholder="Old Password"  required>
															<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div>
										</div>

										<div class="row">
											<div class="col-sm-2">New Password:</div>
												<div class="form-group">
													<div class="col-sm-4">
														<input name="new_password" type="password" class="form-control" id="rs-form-example-email" placeholder="New Password"  required>
															<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div>
										</div>
											
										<div class="row">
											<div class="col-sm-2">Confirm Password:</div>
												<div class="form-group">
													<div class="col-sm-4">
														<input name="confirm_new_password" type="password" class="form-control" id="rs-form-example-email" placeholder="Confirm Password"  required>
															<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div>
										</div>
											
										
								</div><!-- /.panel-body -->
								<div class="panel-footer">
											<div class="form-group m-a-0">
												<button type="reset" class="btn btn-default btn-wide">Reset</button>
												<button name="update" type="submit" class="btn btn-success btn-wide">Submit</button>
											</div>
										</div><!-- /.panel-footer -->
									</form>
							</div><!-- /.panel -->
						</div>

					
						
						
					</div><!-- /.container-fluid -->

				</div><!-- /.rs-inner -->
			</div><!-- /.rs-content -->
		</article><!-- /.rs-content-wrapper -->
		<!-- END MAIN CONTENT -->
	<?php include("footer.php");?>
	<!-- Page Plugins -->
	<script src="js/bootstrap-switch.min.js"></script>
	<script src="js/bootstrap-switch-example.js"></script>

	<script src="js/cleave.min.js"></script>
	<script src="js/cleave-phone.au.js"></script><!-- Example -->
	<script src="js/cleave-example.js"></script><!-- Example -->

	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="js/datepicker-example.js"></script><!-- Example -->

	<script src="js/jquery.maskedinput.min.js"></script>
	<script src="js/maskedinput-example.js"></script><!-- Example -->

	<script src="js/bootstrap-maxlength.min.js"></script>
	<script src="js/maxlength-example.js"></script><!-- Example -->

	<script src="js/selectize.min.js"></script>
	<script src="js/selectize-example.js"></script><!-- Example -->

	<!-- Page Plugins -->
	<script src="js/validator.min.js"></script>
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
					old_password:"required",
					new_password : "required",					
					confirm_new_password:"required",
					
					
				},
				messages: {
					old_password: "Enter Old Password",
					new_password: "Enter New Password",					
					confirm_new_password:"Confirm Password",
					
					
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