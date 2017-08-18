





<!DOCTYPE html>
<html lang=en>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Port-ME | Invoice</title>
	<?php include("metalinks.php");?>
</head>


<body>

	<!--[if lt IE 8]>s
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
									Cteate Invoice:
									<div style="float:right;">
										<!--<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>-->

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;" onclick="window.location.href='view_invoice.php'"> <i class="fa fa-remove"></i> </span>
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
						}
						?>
						</div>
					

					<!-- Begin default content width -->
					<div class="container-fluid" style="padding:0px;margin-top:-20px;margin-right:5px;margin-left:-5px;">
					<div class="col-md-12 col-sm-12">					
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">
								<div class="panel-body">
								<div class="col-md-7 col-sm-12">
									<form name="vendor_form" method="POST" enctype="multipart/form-data" id="rs-validation-login-page">							
											<div class="row">
											<div class="col-sm-9">
											<div class="form-group">
												<select class="rs-selectize-single">
													<option value=""selected disabled>Customer Name</option>
													<option value="4">Thomas Edison</option>
													<option value="1">Nikola</option>
													<option value="3">Nikola Tesla</option>
													<option value="5">Arnold Schwarzenegger</option>
												</select>
											</div><!-- /.form-group -->
											</div>
											<div class="form-group" style="">
												<button style="height:34px;width:132px;text-align:center;padding:2px;" class="btn btn-success btn-wide"
												data-toggle="modal"
												data-target="#myModal" type="button"><i class="fa fa-plus"></i> Add Customer</button>
												
											</div>
											</div>

											<div class="form-group">
												<input type="tel" class="form-control"  placeholder="Invoice Number" name="orderno">
												<p class="help-block with-errors"></p>
											</div><!-- /.form-group -->

											<div class="form-group">
												<input type="tel" class="form-control rs-datepicker" placeholder="Invoice Date" name="invoicedate">
												<p class="help-block with-errors"></p>
											</div><!-- /.form-group -->

											<div class="row">
											<div class="col-sm-9">
											<div class="form-group">
												<select class="rs-selectize-single">
													<option value=""selected disabled>Seller Person</option>
													<option value="4">Thomas Edison</option>
													<option value="1">Nikola</option>
													<option value="3">Nikola Tesla</option>
													<option value="5">Arnold Schwarzenegger</option>
												</select>
											</div><!-- /.form-group -->
											</div>
											<div class="form-group" style="">
												<button style="height:34px;width:132px;text-align:center;padding:2px;" class="btn btn-success btn-wide"
												data-toggle="modal"
												data-target="#myModal2" type="button"><i class="fa fa-plus"></i> Add Seller</button>
												
											</div>
											</div>
										
								</div>
								<div class="col-md-5 col-sm-12" style="text-align:right;">
									
												<div class="col-sm-12">
													<label style="font-size:20px;">
														Indrajit Ghosh
													</label>
												</div>
												<div class="col-sm-12">
													<label style="font-size:15px;">
														Dukbanglow
													</label>
												</div>
												<div class="col-sm-12">
													<label style="font-size:15px;">
														Murshidabad
													</label>
												</div>
												<div class="col-sm-12">
													<label style="font-size:15px;">
														742132
													</label>
												</div>
												
									

							</div><!-- /.panel -->
							</div>


						</div>

							<div class="col-md-12" style="margin-top:-50px;">
							<!-- Begin Panel -->
								<div class="panel panel-plain panel-rounded">
									<div class="panel-body" style="background:" >

									<div class="add-more-contz">
												<div class="row atrri_add_cont">
														<div class="ache_ekta"></div>
															<div class="col-md-12">
																<table class="table table-bordered table-b-t table-b-b">
																	<thead>
																		<tr>
																			<th>Product Name</th>
																			<th>Quantity</th>
																			<th>Rate <i class="fa fa-inr" aria-hidden="true"></i></th>
																			<th>TAX %</th>
																			<th>TAX Value <i class="fa fa-inr" aria-hidden="true"></i></th>
																			<th>Amount <i class="fa fa-inr" aria-hidden="true"></i></th>

																		</tr>
																	</thead>
																	<tbody>
																		<tr class="roxkas">
																			<td class="col-sm-4">												
																				<div class="form-group">
																					 <select class="rs-selectize-single">
																						  <option value=""selected disabled>Product Name</option>
																						  <option value="4">Thomas Edison</option>
																						  <option value="1">Nikola</option>
																						  <option value="3">Nikola Tesla</option>
																						  <option value="5">Arnold Schwarzenegger</option>
																					 </select>
																				</div><!-- /.form-group -->
																				<p class="help-block with-errors"></p>
																			</td>

																			<td class="col-sm-1">												
																				<div class="form-group">																
																					<input type="text" name="attri[]" class="form-control" placeholder=" Qty " required>
																					<p class="help-block with-errors"></p>
																				</div>
																			</td>

																			<td class="col-sm-1">												
																				<div class="form-group" style="font-size:15px;margin-top:10px;">
																					<b>00.00</b>
																					<p class="help-block with-errors"></p>
																				</div>
																			</td>

																			<td class="col-sm-2">
																				<div class="form-group">
																					<label>CGST:-9%  </label>
																					  <br>
																					  <label>SGST:-9%  </label>
																				</div>
																			</td>

																			<td class="col-sm-2">
																				<div class="form-group" style="font-size:15px;">
																					<b style="color:#ef5350;">00.00</b>
																					<br>
																					<b style="color:#ef5350;">00.00</b>
																					<p class="help-block with-errors"></p>
																				</div>
																			</td>

																			<td class="col-sm-2">
																				<div class="form-group" style="font-size:15px;margin-top:10px;">
																					<b style="color:#5dc26a;">00.00</b>
																					<p class="help-block with-errors"></p>
																				</div>
																				<div class="col-sm-1" style="margin-top:-20px;">
																				&nbsp;
																				</div>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>													
												</div>


											</div>
										
											<div class="row atrri" style="margin-top:0px;">
												<div class="col-sm-12">
													<div class="form-group">
														<a href="#" class="add-more" style="font-size:15px;">
															<i class="fa fa-plus"></i> Add More Product
														</a>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->

											<div class="row col-sm-offset-9">
												<div class="col-sm-8">
													<label style="font-size:15px;">
														Sub Total <i class="fa fa-inr" aria-hidden="true"></i>
													</label>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label style="font-size:17px;">
															<b>00.00</b>
														</label>	
														<p class="help-block with-errors"></p>
													</div>
												</div>
											</div>

											<div class="row col-sm-offset-9">
												<div class="col-sm-4">
													<label style="font-size:15px;margin-top:5px;">
														Discount
													</label>
												</div>												 
											<div class="col-sm-8">
													<div class="form-group">
														<div class="input-group">
													<div class="input-group-btn">
														<select  class="btn btn-default dropdown-toggle" style="height:34px;padding:2px;"
														data-toggle="dropdown"
														aria-haspopup="true" aria-expanded="false">			
															<option>Rs.</option>
															<option>%</option>															
														</select>
													</div><!-- /btn-group -->
													<input type="text" class="form-control" aria-label="...">
												</div><!-- /input-group -->
													</div>
												</div>
											</div>

											<div class="row col-sm-offset-9">
												<div class="col-sm-8">
													<label style="font-size:20px;">
														TOTAL <i class="fa fa-inr" aria-hidden="true"></i>
													</label>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label style="font-size:20px;">
															<b style="color:#5dc26a;">00.00</b>
														</label>															
														<p class="help-block with-errors"></p>
													</div>
												</div>
											</div>											
										</div>

										<div class="panel-footer">
											<div class="form-group m-a-0" style="padding-left:0px;">
												<button type="reset" class="btn btn-default btn-wide">Reset</button>
												<button type="submit" class="btn btn-success btn-wide">Submit</button>
											</div>
										</div><!-- /.panel-footer -->
									</div>
							</form>
						</div><!-- /.panel -->						
					</div><!-- /.container-fluid -->

				</div><!-- /.rs-inner -->
			</div><!-- /.rs-content -->
		</article><!-- /.rs-content-wrapper -->
		<!-- END MAIN CONTENT -->

	<?php include("footer.php");?>

				<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Staff</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
									<form name="vendor_form" method="POST" enctype="multipart/form-data" id="rs-validation-login-page">
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<p style="font-size:14px;">Staff Name</p>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-8">
													<div class="form-group">
														<input type="text" class="form-control" id="rs-form-example-name" placeholder="Staff Name" name="name" >
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->

											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<p style="font-size:14px;">E-mail Address</p>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-8">
													<div class="form-group">
														<input type="text" class="form-control" id="rs-form-example-name" placeholder="Email Address" name="name" >
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-8 -->
											</div><!-- /.row -->

											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<p style="font-size:14px;">Phone Number</p>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-8">
													<div class="form-group">
														<input type="text" class="form-control" id="rs-form-example-name" placeholder="Phone Number" name="name" >
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-8 -->
											</div><!-- /.row -->
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<p style="font-size:14px;">Commision (%)</p>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-8">
													<div class="form-group">
														<input type="text" class="form-control" id="rs-form-example-name" placeholder="Commision %" name="name" >
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-8 -->
											</div><!-- /.row -->
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<p style="font-size:14px;">Documents</p>
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
														
														<div class="form-group">
															<input type="text" class="form-control billcity" id="rs-form-example-email" placeholder="Street/Village" name="billing_city">
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->
														<div class="form-group">
															<input type="text" class="form-control billcity" id="rs-form-example-email" placeholder="State" name="billing_city">
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->	
													</div>

													<div class="col-md-6 col-sm-12" style="margin-left:0px;padding:5px;">

														<div class="form-group">
															<input type="text" class="form-control billstate2" id="rs-form-example-tel" placeholder="City" name="shipping_state">
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<input type="tel" class="form-control bilzip2" id="rs-form-example-tel" placeholder="Zip" name="shipping_zip">
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														
													</div>
												</div>
											</div><!-- /.tab-pane -->

										</div><!-- /.tab-content -->
									</div><!-- .panel-body -->

									
											<div class="form-group m-a-0" style="padding-left:20px;">
												<button type="reset" class="btn btn-default btn-wide">Reset</button>
												<button type="submit" class="btn btn-success btn-wide" name="submit">Submit</button>
											</div>
										
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- start pop up-->
	<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width:130%">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Customer</h4>
        </div>
        <div class="modal-body">
         <!-- Begin default content width -->
					<div class="container-fluid" style="padding:0px;margin-top:-20px;margin-right:5px;margin-left:-5px;">
						<div class="col-sm-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">
								<div class="panel-body" style="margin-top:10px;">
									<form >
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<select class="rs-selectize-single" required>
															<option value="">Salutation</option>
															<option value="4">Mr.</option>
															<option value="1">Mrs.</option>
															<option value="3">Ms.</option>
															<option value="5">Miss.</option>
															<option value="6">Dr.</option>
														</select>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-4">
													<div class="form-group">
														<input type="text" class="form-control" id="rs-form-example-fname" placeholder="First Name" required>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-4">
													<div class="form-group">
														<input type="text" class="form-control" id="rs-form-example-lname" placeholder="Last Name" required>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->

											<div class="form-group">
												<input type="email" class="form-control" id="rs-form-example-email" placeholder="Company Name" required>
												<p class="help-block with-errors"></p>
											</div><!-- /.form-group -->

											<div class="form-group">
												<input type="email" class="form-control" id="rs-form-example-email" placeholder="Email" required>
												<p class="help-block with-errors"></p>
											</div><!-- /.form-group -->

											<div class="form-group">
												<input type="tel" class="form-control" id="rs-form-example-tel" placeholder="Work Phone" required>
												<p class="help-block with-errors"></p>
											</div><!-- /.form-group -->

											<div class="form-group">
												<input type="tel" class="form-control" id="rs-form-example-tel" placeholder="Mobile" required>
												<p class="help-block with-errors"></p>
											</div><!-- /.form-group -->

											<div class="form-group">
												<input type="tel" class="form-control" id="rs-form-example-tel" placeholder="Website" required>
												<p class="help-block with-errors"></p>
											</div><!-- /.form-group -->

								</div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div>

						<div class="col-md-5 col-sm-12">
							<!-- Begin Panel 
							<div class="panel panel-plain panel-rounded" >
								<iframe width="100%" height="100%" src="https://www.youtube.com/embed/5GZ3fP71Bzg" style="padding:10px;min-height:300px;" frameborder="0" allowfullscreen></iframe>
							</div> panel -->
						</div>
						
						<div class="col-md-12" style="margin-top:-50px;">
							<!-- Begin Panel -->
								<div class="panel panel-plain panel-rounded">
									<div class="panel-body">
										<!-- Nav tabs -->
										<ul class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active"><a href="#rs-tab-01" aria-controls="rs-tab-01" role="tab" data-toggle="tab">Address</a></li>
											<li role="presentation"><a href="#rs-tab-02" aria-controls="rs-tab-02" role="tab" data-toggle="tab">Notes</a></li>
										</ul>

										<!-- Tab panes -->
										<div class="tab-content p-t-md">
											<div role="tabpanel" class="tab-pane fade in active" id="rs-tab-01">
												<div class="col-md-12" style="margin:0px;padding:0px;">
													<div class="col-md-6 col-sm-12" style="padding:5px;">
														<h3 style="margin-bottom:15px;font-size:17px;">Billing Address</h3>
														
														<div class="form-group">
															<textarea class="form-control billstreet" placeholder="Street" required></textarea>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<input type="text" class="form-control billcity" id="rs-form-example-email" placeholder="City" required>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<input type="text" class="form-control billstate" id="rs-form-example-tel" placeholder="State" required>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<input type="tel" class="form-control bilzip" id="rs-form-example-tel" placeholder="Zip" required>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

													</div>

													<div class="col-md-6 col-sm-12" style="margin-left:0px;padding:5px;">
														<h3 style="margin-bottom:15px;font-size:17px;">Shipping Address <span style="font-size:15px;float:right;color:#4a89dc;font-weight:normal;cursor:pointer;padding:5px;" onclick="copybillingaddr();"><i class="fa fa-hand-o-down"></i> Copy billing address</span></h3>
														
														<div class="form-group">
															<textarea class="form-control billstreet2" placeholder="Street" required></textarea>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<input type="text" class="form-control billcity2" id="rs-form-example-email" placeholder="City" required>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<input type="text" class="form-control billstate2" id="rs-form-example-tel" placeholder="State" required>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<input type="tel" class="form-control bilzip2" id="rs-form-example-tel" placeholder="Zip" required>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

													</div>
												</div>
											</div><!-- /.tab-pane -->

											<div role="tabpanel" class="tab-pane fade" id="rs-tab-02">
												<h3 style="margin-bottom:15px;font-size:17px;">Notes</h3>	
												<div class="form-group">
													<textarea class="form-control" placeholder="Notes" style="min-height:250px;" required></textarea>
													<p class="help-block with-errors"></p>
												</div><!-- /.form-group -->
											</div><!-- /.tab-pane -->

										</div><!-- /.tab-content -->
									</div><!-- .panel-body -->

									<div class="panel-footer">
											<div class="form-group m-a-0">
												<button type="reset" class="btn btn-default btn-wide">Reset</button>
												<button type="submit" class="btn btn-success btn-wide">Submit</button>
											</div>
										</div><!-- /.panel-footer -->
									</form>
								</div><!-- /.panel -->

								<!-- End Panel -->

						</div>
					</div><!-- /.container-fluid -->
				</div>


       
		
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		 </div>						  
	</div>
 </div> <!--/ end pop up-->				

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
		<script>

		$(document).ready(function() {
		  $(".add-more").click(function(){ 
			  var htmlz = "<div class='row atrri_add_cont'><div class='ache_ekta'></div><div class='col-md-12'><table class='table table-bordered table-b-t table-b-b'><thead></thead><tbody><tr class='roxkas'><td class='col-sm-4'><div class='form-group'> <select class='rs-selectize-single' style='height:32px;width:310px;border:border:2px solid red;'> <option value=' 'selected disabled>Product Name</option> <option value=' 4' >Thomas Edison</option> <option value='1'>Nikola</option> <option value='3'>Nikola Tesla</option> <option value=' 5' >Arnold Schwarzenegger</option> </select></div><!-- /.form-group --><p class=' help-block with-errors' ></p></td><td class=' col-sm-1' ><div class=' form-group' ><input type=' text'name='attri[]'class=' form-control'placeholder='Qty'required><p class=' help-block with-errors' ></p></div></td><td class=' col-sm-1' ><div class='form-group'style='font-size:15px;margin-top:10px;' ><b>00.00</b><p class=' help-block with-errors' ></p></div></td><td class=' col-sm-2' ><div class='form-group'><label>CGST:-9%</label><br><label>SGST:-9%</label></div></div></td><td class=' col-sm-2' ><div class=' form-group'  style=' font-size:15px;'><b style='color:#ef5350;'>00.00</b><br><b style=' color:#ef5350;' >00.00</b><p class=' help-block with-errors' ></p></div></td><td class='col-sm-2'><div class='form-group'style=' font-size:15px;margin-top:10px;'><b style='color:#5dc26a;' >00.00</b> <a href='#' class='remove' style='color:#ef5350;padding:45px;'><i class='fa fa-trash'></i></a> <p class='help-block with-errors'></p></div><div class=' col-sm-1'style='margin-top:-20px;'>&nbsp;</div></td></tr></tbody></table></div></div>";
			  //alert(htmlz);
			  $(".add-more-contz").append(htmlz);
		  });

		  $("body").on("click",".remove",function(){ 
			  
			  $(this).parents(".atrri_add_cont").remove();
		  });

		});
	</script>
	
</body>
</html>