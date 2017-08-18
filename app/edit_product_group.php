<?php
include("config.php");
$user_id = $_SESSION['user_id'];
$productcat_id = $_GET['edit_id'];

$business_id = $_SESSION['business_id'];

if(isset($_POST['update_details']))
{
	$type  = str_replace('\'', '\\\'',$_POST['type']);
	$cat_name  = str_replace('\'', '\\\'',$_POST['cat_name']);
	$desc  = str_replace('\'', '\\\'',$_POST['desc']);
	$attri = implode(",",$_POST["attri"]);
	$optn = implode(",",$_POST["optn"]);
	$hsn_codes  = str_replace('\'', '\\\'',$_POST['hsn_codes']);
	$uqc_codes  = str_replace('\'', '\\\'',$_POST['uqc_codes']);

	
	$update_query = mysqli_query($mysqli,"update tbl_productcat set category_name='$cat_name',type='$type',description='$desc',attr_name='$attri',attr_value='$optn',HSN_code='$hsn_codes',UQC_dmension='$uqc_codes' where productcat_id='$productcat_id'");
	if($update_query)
	{
		$data = "success";
	}
	else{
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
	<title>Edit Product | Port-ME</title>
	<?php include("metalinks.php");?>
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script src="bootstrap.min.js"></script>
	
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
									Edit Product Category
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
						<p style="text-align:center;background:#e54e53;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Error while updating </p>
						<?php
						}
						?>
						</div>
						
						<div class="col-md-7 col-sm-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">
							<?php
							$select_query = mysqli_query($mysqli,"select * from tbl_productcat where productcat_id='$productcat_id'");
							$fetch_query = mysqli_fetch_array($select_query);
							?>

								<div class="panel-body">
									<form method="post" enctype="multipart/form-data" id="rs-validation-login-page">
											<div class="row" style="margin-bottom:10px;">
												<div class="col-sm-3" style="margin-top:10px;">
													<span >
														Type
													</span>
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-6">
													<div class="radio radio-custom">
													<label class="radio-inline">
														<input type="radio" name="type" id="cs-radio-04" value="product" <?php echo(($fetch_query['type'] == 'product')?'checked':'')?>>
														<span class="checker"></span>
														Product
													</label>
													<label class="radio-inline">
														<input type="radio" name="type" id="cs-radio-05" value="service" <?php echo(($fetch_query['type'] == 'service')?'checked':'')?>>
														<span class="checker"></span>
														Service
													</label>
												</div>

												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->

											<div class="row">
												<div class="col-sm-3">
													Category Name
												</div>
												<div class="col-sm-9">
													<div class="form-group">
														<input name="cat_name" type="text" class="form-control" id="rs-form-example-email" value=<?php echo $fetch_query['category_name'];?> required>
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
														<textarea name="desc" class="form-control"  style="height:150px;" required><?php echo $fetch_query['description'];?></textarea>
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
																<input type="checkbox" value="1" class="attributes_options" <?php echo(($fetch_query['attr_name'] != '' && $fetch_query['attr_value'] != '')?'checked':'')?>>
																<span class="checker"></span>
																Create Attributes and options
															</label>
														</div>
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->
											
											<div class="add-more-contz atrri see_new" >
												<div class="row atrri_add_cont">
														<div class="col-sm-3 ache_ekta">
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<label style="font-size:13px;">
																	Attribute
																</label>																
																<?php
																 $attri = explode(",",$fetch_query['attr_name']);
																 foreach($attri as $attri_fetch)
																 {
																?>
																<input type="text" name="attri[]" class="form-control" value="<?php echo $attri_fetch;?>" placeholder="Eg: color" >
																<p class="help-block with-errors"></p>
																<?php
																 }
																?>															
															</div>
														</div>

														<div class="col-sm-5">
															<div class="form-group">
																<div class="col-sm-10">
																	<label style="font-size:13px;">
																		Options
																	</label>																
																<?php
																 $option = explode(",",$fetch_query['attr_value']);
																 foreach($option as $option_fetch)
																 {
																?>
																<input type="text" name="optn[]" class="form-control" value="<?php echo $option_fetch;?>" placeholder="Eg: color" >
																<p class="help-block with-errors"></p>
																<?php
																 }
																?>
																<p class="help-block with-errors"></p>
																</div>
																<?php
																
																for($i=1;$i<=count($option);$i++){
																	$function = "remove_prev('".$i."')";
																?>
																<input type="text" id="cat_id" value="<?php echo $productcat_id;?>" style="display:none;">
																 <div class='col-sm-2' style='margin-top:30px;'><a href='javascript:void(0);' onclick="<?php echo $function;?>" style='color:#ef5350;'><i class='fa fa-trash'></i></a></div>
																<?php
																}
																?>
															</div>
														</div>
												</div>
												
											</div>


											<div class="row atrri">
												<div class="col-sm-3">
												</div>
												<div class="col-sm-9">
													<div class="form-group">
														<a href="javascript:void(0)" class="add-more" style="font-size:13px;" onclick="add_more_attri();">
															<i class="fa fa-plus"></i> Add More Attribute
														</a>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->

											

											<div class="row">
												<div class="col-sm-3" style="margin-top:10px;">
													<span >
														HSN Codes :
													</span>
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-9">
											   <div class="form-group">                
												 <select name="hsn_codes" class="rs-selectize-single">													   
												    <?php
												  $select_hsn = mysqli_query($mysqli,"select * from hsn where business_id='$business_id'");
												  while($fetch_hsn = mysqli_fetch_array($select_hsn)){
												  ?>
													  <option value="<?php echo $fetch_hsn['hsn_code'];?>" <?php echo (($fetch_hsn['hsn_code']==$fetch_query['HSN_code'])?'selected':'');?>><?php echo $fetch_hsn['hsn_code'];?></option>
												  <?php
												  }
												  ?>
												 </select>
											   </div><!-- /.form-group -->
											  </div>
											</div>

											<div class="row">
												<div class="col-sm-3" style="margin-top:10px;">
													<span >
														UQC Codes :
													</span>
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-9">
											   <div class="form-group">                
												 <select name="uqc_codes" class="rs-selectize-single">													   
												    <?php
													 $select_uqc = mysqli_query($mysqli,"select * from dimension_uqc");
													 while($fetch_uqc = mysqli_fetch_array($select_uqc)){
													 ?>
													  <option value="<?php echo $fetch_uqc['uqc_id'];?>" <?php echo (($fetch_uqc['uqc_id'] == $fetch_query['UQC_dmension'])?'selected':'');?>><?php echo $fetch_uqc['name'];?></option>
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
						
						<!-- 
						<div class="col-md-5 col-sm-12">
							<div class="dropzone">
								
							</div>
						</div>
					 -->
						
					</div><!-- /.container-fluid -->
					<div class="panel-footer" style="background:#fff;">
							<div class="form-group m-a-0">
								<button type="submit" class="btn btn-success btn-wide" name="update_details">Submit</button>
							</div>
						</div><!-- /.panel-footer -->
					</form>
				</div><!-- /.rs-inner -->
			</div><!-- /.rs-content -->
		</article><!-- /.rs-content-wrapper -->
		<!-- END MAIN CONTENT -->

	<?php include("footer.php");?>


	<script>
	    function remove_prev(e)
      {	
		  var cat = $('#cat_id').val();
        $.ajax({
          type: 'post',
          url: 'ajax/remove_cat.php',
          data: {
            remove_id:e,
			cat_id : cat
          }
          ,
          success: function (response) {
            $(".see_new").html(response);
          }
        }
              );
      }
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
					cat_name: "required",				
					hsn_codes:	"required",
					
				},
				messages: {
					cat_name: "Enter Category Name",				
					hsn_codes: "Choose HSN Code",
					
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