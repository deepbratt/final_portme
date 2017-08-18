<?php
include ("config.php");
$business_id = $_SESSION['business_id'];

if(isset($_POST['submit']))
{
	$category_id   = mysqli_real_escape_string($mysqli,$_POST['product_category_id']);
	$product_name = mysqli_real_escape_string($mysqli,$_POST['product_name']);
	$desc	   = mysqli_real_escape_string($mysqli,$_POST['desc']);	
	$cost_price = mysqli_real_escape_string($mysqli,$_POST['cost_price']);
	$selling_price = mysqli_real_escape_string($mysqli,$_POST['selling_price']);
	$attribute = $_POST['attri'];
	$add_attribute = implode(",",$attribute);
	$options = $_POST['optn'];
	$add_options   = implode(",",$options);
	$tax_info = mysqli_real_escape_string($mysqli,$_POST['tax_rate']);
	$date = time();
	
	

	$insert_product = mysqli_query($mysqli,"insert into tbl_products values ('','".$category_id."','".$business_id."','".$product_name."','".$desc."','0','".$cost_price."','".$selling_price."','".$add_attribute."','".$add_options."','".$tax_info."','active','".$date."') ");
	if($insert_product)
	{
		$data = "success";
	}
	else
	{
		$data = "error";
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
	<title>Add Product | Port-ME</title>
	<?php include("metalinks.php");?>
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script src="bootstrap.min.js"></script>
	<style>
		.atrri{display:none;}
	</style>
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
									New Product
									<div style="float:right;">
										<!--<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>-->

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;" onclick="window.location.href='product.php'"> <i class="fa fa-remove"></i> </span>
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
					

						
						<div class="col-md-7 col-sm-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">
								<div class="panel-body">
									<form method="POST" id="rs-validation-login-page">										
							
								<div class="row" style="margin-bottom:5px;">
									<div class="col-sm-3" style="margin-top:10px;">         
											Choose Category              
											  </div>
											 <div class="col-sm-9">
											   <div class="form-group">                
											 <select name="product_category_id" class="form-control">
													<option selected disabled value="">Choose Category Name</option>
												<?php
												$all_category = mysqli_query($mysqli, "select * from tbl_productcat where business_id = '".$business_id."'");
												while ($fetch_category = mysqli_fetch_array($all_category))
												{
												?>																				   
											   <option value="<?php echo $fetch_category['productcat_id']?>"><?php echo $fetch_category['category_name']?></option>
												<?php
												}
											   ?>
											  
											 </select>
											   </div><!-- /.form-group -->
											  </div>
										</div>

											<div class="row">
												<div class="col-sm-3">
													Product Name
												</div>
												<div class="col-sm-9">
													<div class="form-group">
														<input name="product_name" type="text" class="form-control" placeholder="Product Name">
														<p class="help-block with-errors"></p>
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-sm-3">
													Description
												</div>
												<div class="col-sm-9">
													<div class="form-group">
														<textarea  name="desc" class="form-control" placeholder="Description" style="height:150px;" ></textarea>
														<p class="help-block with-errors"></p>
													</div>
												</div>
											</div>	
											
											

											<div class="row">
												<div class="col-sm-3">
													Cost Price <i class="fa fa-inr"></i>
												</div>
												<div class="col-sm-9">
													<div class="form-group">
														<input name="cost_price" type="integer" class="form-control" placeholder="Enter Cost Price">
														<p class="help-block with-errors"></p>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-sm-3">
													Selling Price <i class="fa fa-inr"></i>
												</div>
												<div class="col-sm-9">
													<div class="form-group">
														<input name="selling_price" type="integer" class="form-control" placeholder="Enter Selling Price">
														<p class="help-block with-errors"></p>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-sm-3" style="margin-top:10px;">
													<div class="form-group">
														Multiple Items
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-6">
													<div class="form-group">
														<div class="checkbox checkbox-custom checkbox-danger">
															<label style="font-size:13px;">
																<input type="checkbox" value="1" class="attributes_options" onchange="valueChanged()">
																<span class="checker"></span>
																Create Attributes and options
															</label>
														</div>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->
											
											<div class="add-more-contz atrri">
												<div class="row atrri_add_cont">
														<div class="col-sm-3 ache_ekta">
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<label style="font-size:13px;">
																	Attribute
																</label>
																<input type="text" name="attri[]" class="form-control" placeholder="Eg: color">
																<p class="help-block with-errors"></p>
															</div>
														</div>

														<div class="col-sm-5">
															<div class="form-group">
																<div class="col-sm-10">
																	<label style="font-size:13px;">
																		Options
																	</label>
																	<input type="text" name="optn[]" class="form-control" placeholder="Red">
																	<p class="help-block with-errors"></p>
																</div>
																<div class="col-sm-2" style="margin-top:30px;">
																	&nbsp;
																</div>
															</div>
														</div>
												</div>
											</div>


											<div class="row atrri">
												<div class="col-sm-3">
												</div>
												<div class="col-sm-9">
													<div class="form-group">
														<a href="javascript:void(0)" class="add-more" style="font-size:13px;" onclick="add_more_attri()">
															<i class="fa fa-plus"></i> Add More Attribute
														</a>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->

									<div class="row" style="margin-bottom:5px;">
										<div class="col-sm-3" style="margin-top:10px;">         
											Tax Rate              
											  </div>
											 <div class="col-sm-9">
											   <div class="form-group">                
											 <select name="tax_rate" class="form-control">
													<option selected disabled value="">Choose Tax Rate</option>
												<?php
												$tax_rate = mysqli_query($mysqli, "select * from tax_rates");
												while ($fetch_tax = mysqli_fetch_array($tax_rate))
												{
												?>																				   
											   <option value="<?php echo $fetch_tax['tax_rate']?>"><?php echo $fetch_tax['tax_rate']?></option>
												<?php
												}
											   ?>
											  
											 </select>
										</div><!-- /.form-group -->
									 </div>
								</div>

										</div><!-- /.panel-body -->
									</div><!-- /.panel -->
								</div>
						
						<!-- right side
						<div class="col-md-5 col-sm-12">
							 
							<div class="panel panel-plain panel-rounded" style="padding-top:20px;" >
								<iframe width="100%" height="50%" src="https://www.youtube.com/embed/5GZ3fP71Bzg" style="padding:30px;min-height:300px;" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>-->
						
					</div><!-- /.container-fluid -->
					<div class="panel-footer" style="background:#fff;">
							<div class="form-group m-a-0">
								<button type="reset" class="btn btn-default btn-wide">Reset</button>
								<button name="submit" type="submit" class="btn btn-success btn-wide">Submit</button>
							</div>
						</div><!-- /.panel-footer -->
					</form>
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
	<script src="js/drag_file.js"></script>
	<script>
		function valueChanged()
		{
			if($('.attributes_options').is(":checked"))   
				$(".atrri").show();
			else
				$(".atrri").hide();
		}

		function add_more_attri()
		{
			 var htmlz = "<div class='row atrri_add_cont'><div class='col-sm-3 ache_ekta'></div><div class='col-sm-4'><div class='form-group'><label style='font-size:13px;'>Attribute</label><input type='text' name='attri[]' class='form-control' placeholder='Eg: color'  ><p class='help-block with-errors'></p></div></div><div class='col-sm-5'><div class='form-group'><div class='col-sm-10'><label style='font-size:13px;'>Options</label><input type='text' name='optn[]' class='form-control' placeholder='Red'  ><p class='help-block with-errors'></p></div><div class='col-sm-2' style='margin-top:30px;'><a href='javascript:void(0);' class='remove' style='color:#ef5350;'><i class='fa fa-trash'></i></a></div></div></div></div>";

$(".add-more-contz").append(htmlz);

$("body").on("click",".remove",function(){ 
			  
			  $(this).parents(".atrri_add_cont").remove();
		  });
		}

		
	</script>
	
	<script>
		(function() {
			$(".dropzone").dropzone({
				url: 'upload.php',
				margin: 20,
				params:{
					'action': 'save'
				},
				success: function(res, index){
					console.log(res, index);
				}
			});

			$(".dropzone2").dropzone({
				url: 'upload.php',
				margin: 20,
				allowedFileTypes: 'image.*, pdf',
				params:{
					'action': 'save'
				},
				uploadOnDrop: true,
				uploadOnPreview: false,
				preview: true,
				success: function(res, index){
					console.log(res, index);
				}
			});
		}());
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
					product_category_id: "required"
					product_name: "required",				
					cost_price:	"required number",
					selling_price: "required number",
					
				},
				messages: {
					product_category_id:"Choose Product Category",
					product_name: "Enter Product Name",				
					cost_price: "Enter Cost Price",
					selling_price: "Enter Selling Price",
					
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