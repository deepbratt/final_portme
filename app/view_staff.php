<?php
include ("config.php");
$user_id = $_SESSION['user_id'];
$staff_id = $_GET['staff_id'];

?>



<!DOCTYPE html>
<html lang=en>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title> Staff | Port-ME</title>
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
									View Staff
									<div style="float:right;">
										<!--<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>-->

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;" onclick="window.location.href='staff.php'"> <i class="fa fa-remove"></i> </span>
									</div>
								</h3>
								
							</div>
							
						</div><!-- /.rs-dashhead-content -->
						<!-- Begin Breadcrumb -->

						<!-- End Breadcrumb -->
					</div><!-- /.rs-dashhead -->
					<!-- End Dashhead -->
					
					<!-- Begin default content width -->
					<div class="container-fluid loginwrap" style="padding:0px;margin-top:-20px;margin-right:5px;margin-left:-5px;">
						<div class="col-md-12 col-sm-12">
							<p style="text-align:center;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Registration Successfull </p>
						</div>

						<?php
							
							$view_staff_info = mysqli_query($mysqli, "select * from staff_details where staff_id='".$staff_id."'");
							$fetch_staff_details = mysqli_fetch_array ($view_staff_info);
						?>


						<div class="col-md-7 col-sm-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">

								<div class="panel-body">
									<form name="vendor_form" method="POST" enctype="multipart/form-data" id="rs-validation-login-page">
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<p style="font-size:16px;">Staff Name</p>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-8">
													<div class="form-group">
														<label> <?php echo $fetch_staff_details['name']; ?></label>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->

											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<p style="font-size:16px;">E-mail Address</p>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-8">
													<div class="form-group">
														<label> <?php echo $fetch_staff_details['email']; ?></label>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-8 -->
											</div><!-- /.row -->

											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<p style="font-size:16px;">Phone Number</p>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-8">
													<div class="form-group">
														<label> <?php echo $fetch_staff_details['phone']; ?></label>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-8 -->
											</div><!-- /.row -->
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<p style="font-size:16px;">Commision (%)</p>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-8">
													<div class="form-group">
														<label> <?php echo $fetch_staff_details['commision']; ?></label>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-8 -->
											</div><!-- /.row -->
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<p style="font-size:16px;">Documents</p>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-8">
													<div class="form-group">
														<input type="file" class="form-control" id="rs-form-example-name" placeholder="Documents" name="name" >
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-8 -->
											</div><!-- /.row -->
																
							</div><!-- /.panel -->
						</div>
						
					</div><!-- /.container-fluid -->

					<div class="col-md-12" style="margin-top:-50px;">
							<!-- Begin Panel -->
								<div class="panel panel-plain panel-rounded">
									<div class="panel-body">
										<!-- Nav tabs -->
										<ul class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active" ><a href="#rs-tab-01" aria-controls="rs-tab-01" role="tab" data-toggle="tab">Address</a></li>
										</ul>

										<!-- Tab panes -->
										<div class="tab-content p-t-md">
											<div role="tabpanel" class="tab-pane fade in active" id="rs-tab-01">
												<div class="col-md-12" style="margin:0px;padding:0px;">
													<div class="col-md-6 col-sm-12" style="padding:5px;">
														
														<div class="row">
															<div class="col-sm-4">
																<div class="form-group">
																	<p style="font-size:16px;">Village/Street : -</p>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div><!-- /.col-sm-4 -->
															<div class="col-sm-8">
																<div class="form-group">
																	<label> <?php echo $fetch_staff_details['street']; ?></label>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div><!-- /.col-sm-4 -->
														</div><!-- /.row -->

														<div class="row">
															<div class="col-sm-4">
																<div class="form-group">
																	<p style="font-size:16px;">State : -</p>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div><!-- /.col-sm-4 -->
															<div class="col-sm-8">
																<div class="form-group">
																	<label> <?php echo $fetch_staff_details['state']; ?></label>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div><!-- /.col-sm-4 -->
														</div><!-- /.row -->
													</div>

													<div class="col-md-6 col-sm-12" style="margin-left:0px;padding:5px;">

														<div class="row">
															<div class="col-sm-4">
																<div class="form-group">
																	<p style="font-size:16px;">City : -</p>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div><!-- /.col-sm-4 -->
															<div class="col-sm-8">
																<div class="form-group">
																	<label> <?php echo $fetch_staff_details['city']; ?></label>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div><!-- /.col-sm-4 -->
														</div><!-- /.row -->

														<div class="row">
															<div class="col-sm-4">
																<div class="form-group">
																	<p style="font-size:16px;">Zip Code : -</p>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div><!-- /.col-sm-4 -->
															<div class="col-sm-8">
																<div class="form-group">
																	<label> <?php echo $fetch_staff_details['zip']; ?></label>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div><!-- /.col-sm-4 -->
														</div><!-- /.row -->
														
													</div>
												</div>
											</div><!-- /.tab-pane -->

										</div><!-- /.tab-content -->
									</div><!-- .panel-body -->
									</form>
								</div><!-- /.panel -->

								<!-- End Panel -->

						</div>

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
	
</body>
</html>