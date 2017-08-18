<?php
include ("config.php");
$business_id = $_SESSION['business_id'];

if(isset($_POST['submit_hsn']))
{
	$chapter_no = $_POST['chapter_number'];
	$hsn		= $_POST['hsn'];
	$description = $_POST['description'];
	
		
	$old_hsn_details = mysqli_query($mysqli,"select * from hsn WHERE hsn_code='".$hsn."'");
	$fetch_hsn_details = mysqli_num_rows($old_hsn_details);
	
	if($fetch_hsn_details < 1)
	{
		
		$insert_hsn_details = mysqli_query($mysqli,"insert into hsn values('','".$chapter_no."','".$hsn."','".$description."','".$business_id."')");
		if($insert_hsn_details)
		{
			$data = "success";
		
		}
		else
			{
				$data = "error";
			}
	}
	else{
		$data = "hsn_exist";
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
	<title>Add HSN Code | Port-ME</title>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVEqoCsKgUMmAcDVX9OAwVMDewLI6yOAQ&sensor=false&libraries=places&language=en"></script>
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
									New HSN Code
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
								if(isset($data) && $data == "success")
						{
						?>
						<p style="text-align:center;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Added Successfully </p>
						<?php
						}else if(isset($data) && $data == "error"){
						?>
						<p style="text-align:center;background:#e54e53;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Error in Insertion </p>
						<?php
						}else if(isset($data) && $data == "hsn_exist"){
						?>
						<p style="text-align:center;background:#4a89dc;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> HSN Code Already Exist </p>
						<?php
						}
						?>
						</div>

						</div>
					
					<!-- Begin default content width -->
					<div class="container-fluid" style="padding:0px;margin-top:-20px;margin-right:5px;margin-left:-5px;">

					

						<div class="col-md-12 col-sm-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">

								<div class="panel-body">
									<form method="post" id="rs-validation-login-page">	
																			
									<div class="row">
											<div class="col-sm-2">
													<div class="form-group">
														<label><b>Chapter Number : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-4">
											<div class="form-group">
												<input name="chapter_number" type="text" class="form-control"placeholder="Enter Chapter Number">
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

										<div class="row">
											<div class="col-sm-2">
													<div class="form-group">
														<label><b>HSN Code : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-4">
											<div class="form-group">
												<input name="hsn" type="integer" class="form-control"placeholder="Enter HSN Code">
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>
											
										<div class="row">
												<div class="col-sm-2">
													<div class="form-group">
														<label><b> Description :</b><label>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<textarea name="description" class="form-control" placeholder="Enter Description Here"></textarea>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div>
											</div>
											
										
								</div><!-- /.panel-body -->
								<div class="panel-footer">
											<div class="form-group m-a-0">
												<button type="reset" class="btn btn-default btn-wide">Reset</button>
												<button name="submit_hsn" type="submit" class="btn btn-success btn-wide">Submit</button>
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
					hsn:	"required",
					description: "required",					
					
				},
				messages: {
					hsn: "Enter HSN Code",
					description: "Enter Description of Product",					
					
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