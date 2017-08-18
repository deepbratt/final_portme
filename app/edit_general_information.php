<?php
include("config.php");

$business_id = $_SESSION['business_id'];


if(isset($_POST['update_details']))
{
	$firstname		= mysqli_real_escape_string($mysqli,$_POST['fname']);
	$lastname		= mysqli_real_escape_string($mysqli,$_POST['lname']);
	$company_name	= mysqli_real_escape_string($mysqli,$_POST['cname']);
	$email			= mysqli_real_escape_string($mysqli,$_POST['email']);
	$work_phone		= mysqli_real_escape_string($mysqli,$_POST['wphone']);
	$mobile			= mysqli_real_escape_string($mysqli,$_POST['mobile']);
	$gstin		    = mysqli_real_escape_string($mysqli,$_POST['gstin']);
	$business_type  = mysqli_real_escape_string($mysqli,$_POST['business_type']);
	$address		= mysqli_real_escape_string($mysqli,$_POST['address']);
	$state			= mysqli_real_escape_string($mysqli,$_POST['state']);
	if($_FILES['image']['name'] == '')
	{
		$select_prev = mysqli_query($mysqli,"select * from tbl_business where business_id='$business_id'");
		$fetch_prev = mysqli_fetch_array($select_prev);
		$savdse_image = $fetch_prev['logo'];
	}
	else
	{
	$tmp_image = $_FILES['image']['tmp_name'];
	$image = $_FILES['image']['name'];
	$savdse_image = rand(99,9999).$image;

	move_uploaded_file($tmp_image,"uploads/".$savdse_image);
	}

	$update_customer_details = mysqli_query($mysqli, "update tbl_business set owners_firstname='".$firstname."', owners_lastname='".$lastname."', enterprise_name='".$company_name."', email='".$email."', work_phone='".$work_phone."', mobile='".$mobile."', 	gst_pan='".$gstin."', type_of_business='".$business_type."', address='".$address."', state='".$state."', country='INDIA', logo='".$savdse_image."'  where business_id='".$business_id."' ");
	if($update_customer_details)
	{
		$data = "success";
	}
	else
	{
		$data = "error" ;
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
	<title>Edit User Details | Port-ME</title>
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
									Edit User Details
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

					<!-- Begin default content width -->
					<div class="container-fluid" style="padding:0px;margin-top:-20px;margin-right:5px;margin-left:-5px;">
						<div class="col-md-12 col-sm-12">

						<?php
								if(isset($data) && $data == "success")
						{
						?>
						<p style="text-align:center;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Updated Successfully </p>
						<?php
						}else if(isset($data) && $data == "error"){
						?>
						<p style="text-align:center;background:#e54e53;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Error in updation </p>
						<?php
						}
						?>
						</div>

						
						<?php
						$select_query = mysqli_query($mysqli,"select * from tbl_business where business_id='".$business_id."'");
						$fetch_query = mysqli_fetch_array($select_query);
						?>
						<div class="col-md-8 col-sm-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">

								<div class="panel-body">
									<form  method="post" enctype="multipart/form-data" id="rs-validation-login-page">
										<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Owner Name : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-4">
													<div class="form-group">
														<input name="fname" type="text" class="form-control" id="rs-form-example-fname" value=<?php echo $fetch_query['owners_firstname']; ?>>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-4">
													<div class="form-group">
														<input name="lname" type="text" class="form-control" id="rs-form-example-lname" value=<?php echo $fetch_query['owners_lastname']; ?>>
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
											<div class="col-sm-8">
											<div class="form-group">
												<input name="cname" type="text" class="form-control" id="rs-form-example-fname" value=<?php echo $fetch_query['enterprise_name']; ?>>
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
											<div class="col-sm-8">
											<div class="form-group">
												<input name="email" type="text" class="form-control" id="rs-form-example-fname" value=<?php echo $fetch_query['email']; ?>>
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
											<div class="col-sm-8">
											<div class="form-group">
												<input name="wphone" type="text" class="form-control" id="rs-form-example-fname" value=<?php echo $fetch_query['work_phone']; ?>>
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
											<div class="col-sm-8">
											<div class="form-group">
												<input name="mobile" type="text" class="form-control" id="rs-form-example-fname" value=<?php echo $fetch_query['mobile']; ?>>
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
											<div class="col-sm-8">
											<div class="form-group">
												<input name="gstin" type="text" class="form-control" id="rs-form-example-fname" value=<?php echo $fetch_query['gst_pan']; ?>>
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Business Type : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-8">
											<div class="form-group">
												<select name="business_type" class="form-control" >
												
												<option value= "<?php echo $fetch_query['type_of_business'];?>"><?php echo $fetch_query['type_of_business'];?></option>
												
													<option value="Accounting Services"> Accounting Services </option>
													<option value="Administrative Services "> Administrative Services </option>
													<option value="Advertising, Creative Design, Media and Marketing Services"> Advertising, Creative Design, Media and Marketing Services </option>
													<option value="Agriculture, Farming, Fishing and Forestry"> Agriculture, Farming, Fishing and Forestry </option>
													<option value="Amusement, Gambling, and Recreation"> Amusement, Gambling, and Recreation </option>
													<option value="Animal Services"> Animal Services </option>
													<option value="Architectural, Engineering, Design and Related Services"> Architectural, Engineering, Design and Related Services </option>
													<option value="CA/TAX Consultant"> CA/TAX Consultant </option>
													<option value="Care Givers"> Care Givers </option>
													<option value="Charity, Nonprofits and Similar Groups"> Charity, Nonprofits and Similar Groups </option>
													<option value="Church"> Church </option>
													<option value="Computer Systems Design and Related Services"> Computer Systems Design and Related Services </option>
													<option value="Construction"> Construction </option>
													<option value="Consulting, Professional and Technical Services"> Consulting, Professional and Technical Services </option>
													<option value="Educational Services"> Educational Services </option>
													<option value="Finance and Insurance"> Finance and Insurance </option>
													<option value="Food & Beverage Establishments"> Food & Beverage Establishments </option>
													<option value="Freelancer"> Freelancer </option>
													<option value="General Service-Based Business"> General Service-Based Business </option>
													<option value="Hair Salons, Barbers and Spas"> Hair Salons, Barbers and Spas </option>
													<option value="Healthcare Services"> Healthcare Services </option>
													<option value="Human Resources and Placement Consulting"> Human Resources and Placement Consulting </option>
													<option value="IT & Telecommunications"> IT & Telecommunications </option>
													<option value="Land and Property including Management"> Land and Property including Management </option>
													<option value="Landscaping and Gardening Services"> Landscaping and Gardening Services </option>
													<option value="Learning Institutes"> Learning Institutes </option>
													<option value="Legal Services"> Legal Services </option>
													<option value="Manufacturers"> Manufacturers </option>
													<option value="Manufacturing and Mining"> Manufacturing and Mining </option>
													<option value="Performing Arts, Spectator Sports, and Related Industries"> Performing Arts, Spectator Sports, and Related Industries </option>
													<option value="Repair and Maintenance Services"> Repair and Maintenance Services </option>
													<option value="Retail Shops, Mail Order and Online"> Retail Shops, Mail Order and Online </option>
													<option value="Transportation and Warehousing"> Transportation and Warehousing </option>
													<option value="Travel and Tourism Services"> Travel and Tourism Services </option>
													<option value="Vehicle Sales, Maintenance and Repairs"> Vehicle Sales, Maintenance and Repairs </option>
													<option value="Whole-sellers"> Whole-sellers </option>
													<option value="Wholesale Trade and Distributors"> Wholesale Trade and Distributors </option>
												</select>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Address : </b></label>
													</div><!-- /.form-group -->
											</div><!-- /.col-sm-4 -->
											<div class="col-sm-8">
											<div class="form-group">
												<input name="address" type="text" class="form-control" id="rs-form-example-fname" value=<?php echo $fetch_query['address']; ?>>
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>State : </b></label>
													</div><!-- /.form-group -->
											</div><!-- /.col-sm-4 -->
											<div class="col-sm-8">
											<div class="form-group">
												<select name="state" class="form-control billstate1" required>
													
												<?php
												$state_info = mysqli_query($mysqli, "select * from states");
												while ($fetch_bill_state = mysqli_fetch_array($state_info))
												{
												?>
												<option value= "<?php echo $fetch_bill_state['states_code'];?>" <?php echo(($fetch_query['state']==$fetch_bill_state['states_code'])?'selected':'');
												?>><?php echo $fetch_bill_state['states_name'];?>&nbsp;(<?php echo $fetch_bill_state['states_code'];?>)
												</option>
												<?php
												}
												?>
												</select>
												<p class="help-block with-errors"></p>
											</div><!-- /.form-group -->
										</div>
										</div>
									</div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div>


						<div class="col-md-4 col-sm-12">
							
							<div class="panel panel-plain panel-rounded" >
								<div class="row">
									<div class="col-sm-12">
											<div class="form-group">
												<label><b>Logo : </b></label>
											</div><!-- /.form-group -->
										</div><!-- /.col-sm-4 -->
									<div class="col-sm-12">
									<div class="" style="margin-left:70px;">
										<a href="javascript:void(0);">
										<?php
										$chobi = $fetch_query['logo'];
										?>
											<img src="uploads/<?php echo (($chobi == '')?'user.png':$chobi);?>" alt="Avatar" class="avatar img-circle">
										</a>
					
									</div>
								<div class="form-group">
												<label></label>
												<input type="file" name="image" class="filestyle" data-buttontext="Find file" id="filestyle-0" tabindex="-1"  style="height:40px !important;">
												
											</div>
									</div><!-- /.form-group -->
								</div>
							</div> 
						</div>
						
						<div class="col-md-12" style="margin-top:-50px;">
							<!-- Begin Panel -->
								<div class="panel panel-plain panel-rounded">
									

									<div class="panel-footer">
											<div class="form-group m-a-0">
												<button name="update_details" type="submit" class="btn btn-success btn-wide" style="color:white;">Update</button>
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
	<!-- Page Plugins -->
	<script src="js/bootstrap-switch.min.js"></script>
	<script src="js/bootstrap-switch-example.js"></script>

	<script src="js/cleave.min.js"></script>
	<script src="js/cleave-phone.au.js"></script><!-- Example -->
	<script src="js/cleave-example.js"></script><!-- Example -->

	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="js/datepicker-example.js"></script><!-- Example -->

	<script src="js/jquery.maskedlabel.min.js"></script>
	<script src="js/maskedlabel-example.js"></script><!-- Example -->

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
					fname:"required",
					cname: "required",					
					email:	"required email",
					mobile:	"required number",
					gstin:	"required",
					business_type: "required",
					address: "required",
					state: "required",
					
				},
				messages: {
					fname: "Enter Supplier Name",
					cname: "Enter Company Name",					
					email:	"Enter Email Id",
					mobile: "Enter Phone number",
					gstin: "Enter GST or PAN number",
					business_type: "Select Business Type",
					address: "Enter Address of Supplier",
					state: "Choose State",
					
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