<!DOCTYPE html>
<html lang=en>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Port-ME | Sales report</title>
	<?php include("metalinks.php");?>
	
</head>


<body>

	<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div id="rs-wrapper">

		<!-- BEGIN MAIN HEADER NAV -->
		<?php include("header.php");?>
		<!-- END MAIN HEADER NAV -->


		<!-- BEGIN SIDEBAR NAV -->
		<?php include("sidebar.php");?>
		<!-- END SIDEBAR NAV -->


		<!-- BEGIN MAIN CONTENT -->
		<article class="rs-content-wrapper">
			<div class="rs-content">
				<div class="rs-inner">

					<!-- Begin Dashhead -->
					<div class="rs-dashhead m-b-lg" style="background:#f5f5f5">
						<div class="rs-dashhead-content">
							<div class="rs-dashhead-titles">
								<h3 class="rs-dashhead-title m-t">
									Sales Report
									<!--<div style="float:right;">
										<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;"> <i class="fa fa-remove"></i> </span>
									</div>-->
								</h3>
								
							</div>							
						</div><!-- /.rs-dashhead-content -->
						
					</div><!-- /.rs-dashhead -->
					<!-- End Dashhead -->


					<div class="col-sm-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">

								<div class="panel-body">
									<form method="POST">
											<div class="row">
												<div class="col-sm-4">
												<label><b>Choose ......</b></label>
													<div class="form-group">
														<select name="sal" class="rs-selectize-single" >														<option value="" selected disabled>Choose .....</option>	
															<option value="Mr.">Monthly</option>
															<option value="Mrs.">Quaterly</option>
															<option value="Ms.">Semesterly</option>
															<option value="Miss.">Yearly</option>
														</select>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class=" col-sm-3">
												<label><b>From</b></label>
													<div class="form-group">
														<input type="tel" class="form-control rs-datepicker" placeholder="Date">
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-3">
												<label><b>To </b></label>
													<div class="form-group">
														<input type="tel" class="form-control rs-datepicker" placeholder="Date">
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class=" col-sm-2">
													<div class="form-group" style="padding:26px">
														<div class="form-group m-a-0">
															<button name="submit" type="submit" class="btn btn-success btn-wide">Submit</button>
														</div>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

											</div><!-- /.row -->

								</div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div>



					<!-- Begin default content width -->
					<div class="container-fluid">						

						<div class="row">
							<div class="col-lg-12">							

								<!-- Begin Panel -->
								<div class="panel panel-plain panel-rounded">
									<div class="panel-body">
										<div id="morris-hero-bar" style="width: 100%; height: 300px;"></div>
									</div><!-- .panel-body -->
									<div class="panel-body p-t-0">
										<div class="rs-col-stacked full-width-on-mobile borderless border-items m-a-0">
											<div class="stacked-item p-a text-center">
												<p class="text-muted m-a-0">Total Sales</p>
												<h3 class="m-t-0 f-w-400">213,015</h3>
											</div><!-- /.stacked-item -->
											<div class="stacked-item p-a text-center">
												<p class="text-muted m-a-0">Total Revenue</p>
												<h3 class="m-t-0 f-w-400 text-success">$2.5M</h3>
											</div><!-- /.stacked-item -->
											<div class="stacked-item p-a text-center">
												<p class="text-muted m-a-0">This Year Sales</p>
												<h3 class="m-t-0 f-w-400 text-info">57,760</h3>
											</div><!-- /.stacked-item -->
											<div class="stacked-item p-a text-center">
												<p class="text-muted m-a-0">Today Revenue</p>
												<h3 class="m-t-0 f-w-400 text-warning">$2,257</h3>
											</div><!-- /.stacked-item -->
										</div><!-- /.rs-col-stacked -->
									</div><!-- .panel-body -->
								</div><!-- /.panel -->
								<!-- End Panel -->

							</div><!-- /.col-md-9 -->

							<div class="col-lg-4">
							
					<!-- /.panel -->
								<!-- End Panel -->

							</div><!-- /.col-md-3 -->

						</div><!-- /.row -->
						<!-- Begin Panel -->
						<div class="panel panel-plain panel-rounded table-responsive">
								<table class="table table-b-t table-b-b datatable-default rs-table table-default" style="border-right:1px solid #f5f5f5;border-left:1px solid #f5f5f5;">
									<thead>
							            <tr>
							                <th>Customer Name</th>
							                <th>Order Number</th>
							                <th>Sales Date</th>
							                <th>Seller Person</th>							               
							            </tr>
							        </thead>
							        <tbody>
							            <tr>
							                <td>Tiger Nixon</td>
							                <td>System Architect</td>
							                <td>Edinburgh</td>
							                <td>61</td>							               
							            </tr>
							          
							        </tbody>
								</table>
						</div><!-- /.panel -->
						<!-- End Panel -->						
						<!-- End Panel -->

					</div><!-- /.container-fluid -->

				</div><!-- /.rs-inner -->
			</div><!-- /.rs-content -->
		</article><!-- /.rs-content-wrapper -->
		<!-- END MAIN CONTENT -->


		<?php include("footer.php");?>
			
	<!-- Page Plugins -->
	
	<script src="js/maxlength-example.js"></script><!-- Example -->
	<script src="js/morris-example.js"></script>

	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="js/datepicker-example.js"></script><!-- Example -->



	<script src="js/selectize.min.js"></script>
	<script src="js/selectize-example.js"></script><!-- Example -->

	<!-- Page Plugins -->

</body>
</html>