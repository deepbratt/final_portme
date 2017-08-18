<?php
include("config.php");
$user_id = $_SESSION['user_id'];
$business_id = $_SESSION['business_id'];
$productcat_id = $_GET['view_id'];

?>
<!DOCTYPE html>
<html lang=en>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>View Product group | Port-ME</title>
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
									View Product Group
									<div style="float:right;">
										<!--<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>-->

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;" onclick="window.location.href='product_group.php'"> <i class="fa fa-remove"></i> </span>
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
					<?php
					   if(isset($data) && $data == "success"){
					  ?>
					  <div class="col-md-12 col-sm-12">
					   <p style="text-align:center;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Your Product Group added successfully.</p>
					  </div>
					  <?php
					   }else if(isset($data) && $data == "error"){
					  ?>
					  <div class="col-md-12 col-sm-12">
					   <p style="text-align:center;background:#ff0066;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Something went wrong! Please try again later. </p>
					  </div>
					  <?php
					  }
					 ?>
						<div class="col-md-7 col-sm-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">
							<?php
							$select_query = mysqli_query($mysqli,"select * from tbl_productcat where productcat_id='$productcat_id'");
							$fetch_query = mysqli_fetch_array($select_query);
							?>
								<div class="panel-body">
									<form method="POST" enctype="multipart/form-data">
											<div class="row" style="margin-bottom:10px;">
												<div class="col-sm-3" style="margin-top:10px;">
													<b>Type :</b>
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-6">
													<div class="radio radio-custom" style="color: #4a89dc;">
													<?php echo $fetch_query['type'];?>
												</div>

												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->

											<div class="row">
												<div class="col-sm-3">
													<b>Group Name :</b>
												</div>
												<div class="col-sm-9">
													<div class="form-group"  style="color: #4a89dc;">
														<?php echo $fetch_query['category_name'];?>
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-sm-3">
													<b>Description :</b>
												</div>
												<div class="col-sm-9">
													<div class="form-group" style="color: #4a89dc;">
														<?php echo $fetch_query['description'];?>
													</div>
												</div>
											</div>


											<div class="row">
												<div class="col-sm-3" style="margin-top:10px;">
													<div class="form-group">
														<b>Multiple Items :</b>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
		
											</div><!-- /.row -->
											
											
											<div class="row" >
													<div class="col-sm-3">
													</div>
													<div class="col-sm-4" style="margin-top:-35px;">
														<div class="form-group">
															<label style="font-size:13px;">
																<b>Attribute</b>
															</label>
															<br />
															<span  style="color: #4a89dc;">
															<?php
																$data_atti = explode(",",$fetch_query['attr_name']);
																
																foreach($data_atti As $key => $data_atti_values){
			
																	echo $data_atti_values;
																?>
																<p class="help-block with-errors"></p>
															<?php
																}
															?>
															</span>
															
														</div>
													</div>

													<div class="col-sm-5" style="margin-top:-35px;">
														<div class="form-group">
															
																<label style="font-size:13px;">
																	<b>Options</b>
																</label>
																<br />
																<span  style="color: #4a89dc;">
															<?php
																$data_option = explode(",",$fetch_query['attr_value']);
																
																foreach($data_option As $key => $data_option_values){
			
																	echo $data_option_values;
																?>
																<p class="help-block with-errors"></p>
															<?php
																}
															?>
															</span>
														</div>
													</div>
											</div>
											


											<div class="row">
												<div class="col-sm-3" style="margin-top:10px;">
													<b>
														HSN Code :
													</b>
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-6">
													<div class="radio radio-custom" style="color: #4a89dc;">
													<?php 
													$select_hsn = mysqli_query($mysqli,"select * from hsn where hsn_code = '".$fetch_query['HSN_code']."'");
													$fetch_hsn = mysqli_fetch_array($select_hsn);
													echo $fetch_hsn['hsn_code'];
													?>
												</div>

												</div><!-- /.col-sm-4 -->
											</div>
											
											<div class="row">
												<div class="col-sm-3" style="margin-top:10px;">
													<b>
														UQC Diamension :
													</b>
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-6">
													<div class="radio radio-custom" style="color: #4a89dc;">
													<?php 
													$select_uqc = mysqli_query($mysqli,"select * from dimension_uqc where uqc_id = '".$fetch_query['UQC_dmension']."'");
													$fetch_uqc = mysqli_fetch_array($select_uqc);
													echo $fetch_uqc['name'];
													?>
												</div>

												</div><!-- /.col-sm-4 -->
											</div>
											<div class="panel-footer" style="background:#fff;">
							<div class="form-group m-a-0">
								<a href="edit_product_group.php?edit_id=<?php echo $fetch_query['productcat_id'];?>" class="btn btn-success btn-wide">Edit Details</a>
								<a class="btn btn-success btn-wide" href="product_group.php" style="color:white;">Back</a>
							</div>
							
						</div><!-- /.row -->

								</div><!-- /.panel-body -->

								

							</div><!-- /.panel -->
						</div>
						
						<!-- right side -->
						
						<!-- right side ends -->
						
					</div><!-- /.container-fluid -->
					<!-- /.panel-footer -->
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

		$(document).ready(function() {
		  $(".add-more").click(function(){ 
			  var htmlz = "<div class='row atrri_add_cont'><div class='col-sm-3 ache_ekta'></div><div class='col-sm-4'><div class='form-group'><label style='font-size:13px;'>Attribute</label><input type='text' name='attri[]' class='form-control' placeholder='Eg: color' required><p class='help-block with-errors'></p></div></div><div class='col-sm-5'><div class='form-group'><div class='col-sm-10'><label style='font-size:13px;'>Options</label><input type='text' name='optn[]' class='form-control' placeholder='Red' required><p class='help-block with-errors'></p></div><div class='col-sm-2' style='margin-top:30px;'><a href='#' class='remove' style='color:#ef5350;'><i class='fa fa-trash'></i></a></div></div></div></div>";
			  //alert(htmlz);
			  $(".add-more-contz").append(htmlz);
		  });

		  $("body").on("click",".remove",function(){ 
			  
			  $(this).parents(".atrri_add_cont").remove();
		  });

		});
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
	
</body>
</html>