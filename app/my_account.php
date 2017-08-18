<?php
include ("config.php");
$user_id =$_SESSION['user_id'];
$get_business_id = mysqli_query($mysqli,"SELECT * FROM users JOIN (user_access_levels,company_details) WHERE users.user_id=user_access_levels.user_id AND    user_access_levels.business_id=company_details.company_id AND users.user_id='$user_id'");

$get_business_id = mysqli_fetch_array($get_business_id);
$business_id = $get_business_id['company_id'];


$cu_info = mysqli_query($mysqli, "select * from users where user_id = '".$user_id."'");
$fetch_details = mysqli_fetch_array($cu_info);
$image = $fetch_details['logo_image'];


if(isset($_POST['update']))
{
	$username = mysqli_real_escape_string($mysqli,$_POST['cu_name']);
	$type	  = mysqli_real_escape_string($mysqli,$_POST['type_business']);
	$pan	  = mysqli_real_escape_string($mysqli,$_POST['pan']);
	$adhaar	  = mysqli_real_escape_string($mysqli,$_POST['adhaar']);
	$gstin = mysqli_real_escape_string($mysqli,$_POST['gstin']);
	$street	  = mysqli_real_escape_string($mysqli,$_POST['street']);
	$city	  = mysqli_real_escape_string($mysqli,$_POST['city']);
	$state	  = mysqli_real_escape_string($mysqli,$_POST['state']);
	$zip	  = mysqli_real_escape_string($mysqli,$_POST['zip']);

	if($_FILES['logo_upload']['name'] == '')
	{
		$user_pic = $image;
	}
	else
	{

	$tmp_image = $_FILES['logo_upload']['tmp_name'];
	$image = $_FILES['logo_upload']['name'];
	$user_pic = rand(99,9999).$image;
	move_uploaded_file($tmp_image,"uploads/".$user_pic);
	}

$update_details = mysqli_query ($mysqli, "update users set username='".$username."', pan='".$pan."', logo_image = '".$user_pic."' ,type_business='".$type."'  , adhaar='".$adhaar."',business='".$gstin."',street='".$street."',city='".$city."',state='".$state."',zip='".$zip."', business_id = '".$business_id."' where user_id='".$user_id."'");
if ($update_details)
	{
			$data = "updated";
	}
		else
	{
		$data = "not_updated";
	}



	if(isset($_POST['change_pass']))
	{
	$old_password = $_POST['old_password'];
	$select_query = mysqli_query($mysqli,"select * from profile_page where password='".$old_password."' and id='". $user_id."'");
	$get_row = mysqli_num_rows($select_query);
	if($get_row > 0)
	{
		$new_password = mysqli_real_escape_string($mysqli,$_POST['Password']);
		$confirm_password = mysqli_real_escape_string($mysqli,$_POST['confirm_password']);

		if($new_password == $confirm_password)
		{
			$change_password = mysqli_query($mysqli,"update profile_page set password='".$confirm_password."' where id='".$user_id."'");
			if($change_password)
			{
				$data = "password_change";
			}
			else
			{
				$data = "pass_not_change";
			}
		}
		else
		{ 
			$data = "confirm_error";
		}
	}
	else
	{
		$data = "pass_doesnt_match";
	}
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
	<title>Update Profile Details | Port-ME</title>
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
					<form method="POST" enctype="multipart/form-data">
					<!-- Begin Dashhead -->
					<div class="rs-dashhead m-b-lg" style="background:#f5f5f5">
						<div class="rs-dashhead-content">
							<div class="rs-dashhead-titles">
								<h3 class="rs-dashhead-title m-t">
									Update Profile Details
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


						<div class="col-md-12 col-sm-12">
						<?php
								if(isset($data) && $data == "updated")
						{
						?>
						<p style="text-align:center;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Profile Updated Successfully </p>
						<?php
						}else if(isset($data) && $data == "not_updated"){
						?>
						<p style="text-align:center;background:#e54e53;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Error while updating.. Please try again!! </p>
						<?php
						}
						?>
						</div>



					<!-- Begin default content width -->
					<div class="container-fluid" style="padding:0px;margin-top:-20px;margin-right:5px;margin-left:-5px;">
					<div class="col-md-12" style="margin-top:0px;">
							<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded" >
								<div class="panel-body" style="text-align:right;">	
								<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Change Password</button>
								</div>
							
									<div class="panel-body" >
										<div class="tab-content p-t-md">
											<div role="tabpanel" class="tab-pane fade in active" id="rs-tab-01">
												<div class="col-md-12" style="margin:0px;padding:0px;">
													<div class="col-md-6 col-sm-12" style="padding:5px;">
														<h3 style="margin-bottom:15px;font-size:17px;">Customer Information</h3>
														
														<div class="form-group">
															<div class="col-sm-2">
															Username:
															</div>
														<input name="cu_name" type="text" class="form-control " value= <?php echo $fetch_details['username'];?>> </input>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<div class="col-sm-2">
																Email :
															</div>
															<input name="email" type="email" class="form-control " id="rs-form-example-email" value=<?php echo $fetch_details['email']; ?> >
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<div class="col-sm-4">
																Phone Number :
															</div>
															<input name="phone" type="integer" class="form-control " id="rs-form-example-tel" value=<?php echo $fetch_details['phone']; ?> >
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->														
													</div>

											<div class="col-md-6 col-sm-12" style="margin-left:0px;padding:38px;">
														<h3 style="margin-bottom:15px;font-size:17px;"></h3>
														
														<div class="form-group">
															<div class="col-sm-4">
																PAN Number :
															</div>
															<input name="pan" type="text" class="form-control " placeholder="PAN Number" required value=<?php echo $fetch_details['pan']; ?>></input>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
														<div class="col-sm-4">
																Adhaar Number :
															</div>
															<input name="adhaar" type="text" class="form-control " id="rs-form-example-email" placeholder="Adhaar Number" required value=<?php echo $fetch_details['adhaar']; ?>>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
														<div class="col-sm-4">
																GSTIN Number :
															</div>
															<input name="gstin" type="text" class="form-control " id="rs-form-example-tel" placeholder="Business ID" required value=<?php echo $fetch_details['business']; ?>>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->										

														
													</div>
												</div>
										
											

								
					<!--------------------------------------------------------------------------------------------------------->
					
					<div class="col-md-12" style="margin:0px;padding:0px;">
							<div class="col-md-6 col-sm-6" style="padding:5px;">
							<h3 style="margin-bottom:15px;font-size:17px;">Select type of business:</h3>	

							<div class="form-group ">
							<select name="type_business" class="form-control">
							<option value="<?php echo $fetch_details['type_business'];?>" selected disabled ><?php echo $fetch_details['type_business']; ?>  </option>
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
						<span class=" f-s-xs form-control-feedback" aria-hidden="true"></span>
					</div><!-- /.form-group -->
					</div>
					
						<div class="col-md-6 col-sm-12" style="padding:5px;">
						<div class="form-group">
							<h3 style="margin-bottom:15px;font-size:17px;">Choose Logo</h3>	
						<input name="logo_upload" type="file" class="form-control " id="rs-form-example-tel">
						<p class="help-block with-errors"></p>
					</div>
					

				</div><!-- /.panel-body -->
			</div><!-- /.panel -->
		</div>

					<div class="col-md-12" style="margin-top:5px;">
							<!-- Begin Panel -->
								<div class="panel panel-plain panel-rounded">
									<div class="panel-body">									
										<div class="tab-content p-t-md">
											<div role="tabpanel" class="tab-pane fade in active" id="rs-tab-01">
												<div class="col-md-12" style="margin:0px;padding:0px;">
													<div class="col-md-6 col-sm-12" style="padding:5px;">
														<h3 style="margin-bottom:15px;font-size:17px;">Customer Address</h3>
														
														<div class="form-group">
															<div class="col-sm-2">
																Street :
															</div>
															<textarea name="street"  class="form-control " placeholder="Street" required ><?php echo $fetch_details['street']; ?></textarea>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<div class="col-sm-2">
																City :
															</div>
															<input name="city" type="text" class="form-control " id="rs-form-example-email" placeholder="City" required value=<?php echo $fetch_details['city']; ?>>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<div class="col-sm-2">
																State :
															</div>
															<input name="state" type="text" class="form-control " id="rs-form-example-tel" placeholder="State" required value=<?php echo $fetch_details['state']; ?>>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->

														<div class="form-group">
															<div class="col-sm-3">
																ZIP code :
															</div>
															<input name="zip" type="integer" class="form-control " id="rs-form-example-tel" placeholder="Zip" required value=<?php echo $fetch_details['zip']; ?>>
															<p class="help-block with-errors"></p>
														</div><!-- /.form-group -->												
														
													</div>

												</div>
											</div><!-- /.tab-pane -->

									
										</div><!-- /.tab-content -->
									</div><!-- .panel-body -->
									

									<div class="panel-footer">
											<div class="form-group m-a-0">
												<button name="reset" type="reset" class="btn btn-default btn-wide">Reset</button>
												<button name="update" type="submit" class="btn btn-success btn-wide">Update</button>
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

	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Password</h4>
        </div>
        <div class="modal-body">
          
		  <div class="panel-body">
										<form >										
												
										<div class="row">
											<div class="col-sm-4">Old Password:</div>
												<div class="form-group">
													<div class="col-sm-8">
														<input type="password" class="form-control" id="rs-form-example-email" placeholder="Old Password"  required>
															<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div>
										</div>

										<div class="row">
											<div class="col-sm-4">New Password:</div>
												<div class="form-group">
													<div class="col-sm-8">
														<input type="password" class="form-control" id="rs-form-example-email" placeholder="New Password"  required>
															<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div>
										</div>
											
										<div class="row">
											<div class="col-sm-4">Confirm Password:</div>
												<div class="form-group">
													<div class="col-sm-8">
														<input type="password" class="form-control" id="rs-form-example-email" placeholder="Confirm Password"  required>
															<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div>
										</div>
											

								</div><!-- /.panel-body -->

								<div class="form-group m-a-0" style="padding-left:20px;">
												<button type="update" class="btn btn-success btn-wide" name="change_pass">Change Password</button>
											</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


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