<?php
include ("config.php");
$business_id = $_SESSION['business_id'];

if(isset($_POST['submit']))
{
	$salutation = mysqli_real_escape_string($mysqli,$_POST['sal']);
	$firstname = mysqli_real_escape_string($mysqli,$_POST['fname']);
	$lastname = mysqli_real_escape_string($mysqli,$_POST['lname']);
	$company_name = mysqli_real_escape_string($mysqli,$_POST['cname']);
	$email = mysqli_real_escape_string($mysqli,$_POST['email']);
	$work_phone = mysqli_real_escape_string($mysqli,$_POST['wphone']);
	$mobile = mysqli_real_escape_string($mysqli,$_POST['mobile']);
	$gst = mysqli_real_escape_string($mysqli,$_POST['gst']);
	$billing_address = mysqli_real_escape_string($mysqli,$_POST['address']);
	$billing_state = mysqli_real_escape_string($mysqli,$_POST['bstate']);
	$shipping_address = mysqli_real_escape_string($mysqli,$_POST['saddress']);
	$shipping_state = mysqli_real_escape_string($mysqli,$_POST['sstate']);
	$notes = mysqli_real_escape_string($mysqli,$_POST['notes']);
	$date = date('m/d/Y h:i:s', time());
	
	$old_customer_details = mysqli_query($mysqli,"select * from tbl_contacts WHERE email='".$email."', mobile='".$mobile."' AND business_id='$business_id'");
	$fetch_customer_details = mysqli_num_rows($old_customer_details);

	if($fetch_customer_details < 1)
	{
	$insert_vendor_details = mysqli_query($mysqli, "insert tbl_contacts values ('','VENDOR','".$business_id."','".$salutation."','".$firstname."','".$lastname."','".$company_name."','".$email."','".$work_phone."','".$mobile."','".$gst."','".$billing_address."','".$billing_state."','INDIA','".$shipping_address."','".$shipping_state."','INDIA','".$notes."','active')");
	if($insert_vendor_details)
	{
		$data = "success";
	
	}else{
		$data = "error";
	}
	}else{
		$data = "customer_exist";
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
	<title>Add Vendor | Port-ME</title>
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
									New Vendor
									<div style="float:right;">
										<!--<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>-->

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;" onclick="window.location.href='vendor.php'"> <i class="fa fa-remove"></i> </span>
									</div>
								</h3>
								
							</div>
							
						</div><!-- /.rs-dashhead-content -->
						<!-- Begin Breadcrumb -->
					
						<!-- End Breadcrumb -->
					</div><!-- /.rs-dashhead -->
					<!-- End Dashhead -->

					<!-- Begin default content width -->
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
						}else if(isset($data) && $data == "customer_exist"){
						?>
						<p style="text-align:center;background:#4a89dc;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Customer Details Already Exist </p>
						<?php
						}
						?>
						</div>

						<div class="col-md-7 col-sm-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">

								<div class="panel-body">
									<form method="POST" id="rs-validation-login-page">
										<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Customer Name : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-3">
													<div class="form-group">
														<select name="sal" class="rs-selectize-single">
															<option value="">Salutation</option>
															<option value="Mr.">Mr.</option>
															<option value="Mrs.">Mrs.</option>
															<option value="Ms.">Ms.</option>
															<option value="Miss.">Miss.</option>
															<option value="Dr.">Dr.</option>
														</select>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-3">
													<div class="form-group">
														<input name="fname" type="text" class="form-control" id="rs-form-example-fname" placeholder="First Name" >
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-3">
													<div class="form-group">
														<input name="lname" type="text" class="form-control" id="rs-form-example-lname" placeholder="Last Name" >
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Company Name : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-9">
											<div class="form-group">
												<input name="cname" type="text" class="form-control"placeholder="Company Name">
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Email : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-9">
											<div class="form-group">
												<input name="email" type="email" class="form-control"placeholder="Enter Email Address" >
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Work Phone : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-9">
											<div class="form-group">
												<input name="wphone" type="integer" class="form-control"placeholder="Enter Work Phone Number">
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Mobile : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-9">
											<div class="form-group">
												<input name="mobile" type="integer" class="form-control"placeholder="Enter Mobile Number" >
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>GSTIN / PAN No : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-9">
											<div class="form-group">
												<input name="gst" type="text" class="form-control" placeholder="Enter GSTIN/PAN No." >
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

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
														
														

														<div class="row">
															<div class="col-sm-3">
																<div class="form-group">
																	<label> Address :<label>
																</div>
															</div>
															<div class="col-sm-8">
																<div class="form-group">
																	<input name="address" id="cityz" type="text" class="form-control billaddress1" id="rs-form-example-email" placeholder="Address" >
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div>
														</div>

														<div class="row">
															<div class="col-sm-3">
																<div class="form-group">
																	<label> State :<label>
																</div>
															</div>
															<div class="col-sm-8">
																<div class="form-group">
																	<select name="bstate" class="form-control billstate1" >
																	
																		<option value="">State</option>
																		<?php
																	$state_info = mysqli_query($mysqli, "select * from states");
																	while ($fetch_state = mysqli_fetch_array($state_info))
																	{
																	?>
																	<option value= "<?php echo $fetch_state['states_name'];?>"><?php echo $fetch_state['states_name'];?>&nbsp;(<?php echo $fetch_state['states_code'];?>)
																	</option>
																	<?php
																	}
																	?>
																	</select>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div>
														</div>

														
													</div>

													<div class="col-md-6 col-sm-12" style="margin-left:0px;padding:5px;">
														<h3 style="margin-bottom:15px;font-size:17px;">Shipping Address <span style="font-size:15px;float:right;color:#4a89dc;font-weight:normal;cursor:pointer;padding:5px;" onclick="copybillingaddr();"><i class="fa fa-hand-o-down"></i> Copy billing address</span></h3>
														
														<div class="row">
															<div class="col-sm-3">
																<div class="form-group">
																	<label> Address :<label>
																</div>
															</div>
															<div class="col-sm-8">
																<div class="form-group">
																	<input name="saddress" id="cityz1" type="text" class="form-control billaddress2" id="rs-form-example-email" placeholder="Address">
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div>
														</div>

														<div class="row">
															<div class="col-sm-3">
																<div class="form-group">
																	<label> State :<label>
																</div>
															</div>
															<div class="col-sm-8">
																<div class="form-group">
																	<select name="sstate" class="form-control billstate2">
																		<option value="">State</option>
																		<?php
																	$state_info = mysqli_query($mysqli, "select * from states");
																	while ($fetch_state = mysqli_fetch_array($state_info))
																	{
																	?>
																	<option value= "<?php echo $fetch_state['states_name'];?>"><?php echo $fetch_state['states_name'];?>&nbsp;(<?php echo $fetch_state['states_code'];?>)
																	</option>
																	<?php
																	}
																	?>
																	</select>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div>
														</div>

													</div>
												</div>
											</div><!-- /.tab-pane -->

											<div role="tabpanel" class="tab-pane fade" id="rs-tab-02">
												<h3 style="margin-bottom:15px;font-size:17px;">Notes</h3>	
												<div class="form-group">
													<textarea name="notes" class="form-control" placeholder="Notes" style="min-height:250px;"></textarea>
													<p class="help-block with-errors"></p>
												</div><!-- /.form-group -->
											</div><!-- /.tab-pane -->

										</div><!-- /.tab-content -->
									</div><!-- .panel-body -->

									<div class="panel-footer">
											<div class="form-group m-a-0">
												<button type="reset" class="btn btn-default btn-wide">Reset</button>
												<button name="submit" type="submit" class="btn btn-success btn-wide">Submit</button>
											</div>
										</div><!-- /.panel-footer -->
									</form>
								</div><!-- /.panel -->

								<!-- End Panel -->

						</div>
					</div><!-- /.container-fluid -->

				</div><!-- /.rs-inner -->
			</div><!-- /.rs-content -->
		</article><!-- /.rs-content-wrapper -->
		<!-- END MAIN CONTENT -->

	<?php include("footer.php");?>
	<!-- For address-->
	<script>
      var input = document.getElementById('cityz');
      var autocomplete = new google.maps.places.Autocomplete(input);
    </script>
		<script>
      var input = document.getElementById('cityz1');
      var autocomplete = new google.maps.places.Autocomplete(input);
    </script>
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
		function copybillingaddr(){
			var billaddress1 = $(".billaddress1").val();
			var billstate = $(".billstate1 option:selected").val();	
			
			$(".billaddress2").val(billaddress1);
			$('.billstate2 option[value='+billstate+']').prop('selected',true);
			//$(".billcountry2 select").val(billcountry)
		}
	</script>
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
					fname:"required",
					cname: "required",					
					email:	"required email",
					mobile:	"required number",
					gst:	"required",
					address: "required",
					bstate: "required",
					
				},
				messages: {
					fname: "Enter Supplier Name",
					cname: "Enter Company Name",					
					email:	"Enter Email Id",
					mobile: "Enter Phone number",
					gst: "Enter GST or PAN number",
					address: "Enter Address of Supplier",
					bstate: "Choose State",
					
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