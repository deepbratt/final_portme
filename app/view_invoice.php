<!DOCTYPE html>
<html lang=en>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Port-ME | Sales Order</title>
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
									Generate Invoice :
									<div style="float:right;">
										<!--<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>-->

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;" onclick="window.location.href='invoice.php'"> <i class="fa fa-remove"></i> </span>
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
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">
								<div class="panel-body">
								<div class="col-md-7 col-sm-12">
									<form name="vendor_form" method="POST" enctype="multipart/form-data" id="rs-validation-login-page">							
											
											<div class="row">
												<div class="col-sm-3">
												Customer Name:
												</div>
												<div class="col-sm-7">
													<div class="form-group" style="margin-bottom:-1px;">
														<label>CUSTOMER NAME HERE</label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->												
											</div><!-- /.row -->

											<div class="row">
											<div class="col-sm-3">
													Invoice Number :
											</div>
												<div class="form-group">
													<div class="col-sm-8">
														<label>INVOICE NUMBER HERE </label>
													</div><!-- /.form-group -->
												</div>
											</div>

											<div class="row">
											<div class="col-sm-3">
													Invoice Date :
											</div>
												<div class="form-group">
													<div class="col-sm-8">
														<label>INVOICE DATE HERE</label>
													</div><!-- /.form-group -->
												</div>
										</div>

											<div class="row">
												<div class="col-sm-3">
												Seller Person :
												</div>
												<div class="col-sm-7">
													<div class="form-group" style="margin-bottom:10px;">
														<label> SALES PERSON FULL NAME HERE</label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->												
											</div><!-- /.row -->
										</div>
									</form>
								

								<div class="col-md-5 col-sm-12" style="text-align:right; margin-bottom:10px;">
									<form name="vendor_form" method="POST" enctype="multipart/form-data" id="rs-validation-login-page">
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
												</form>

									

							</div><!-- /.panel -->
							</div>


						</div>

							<div class="col-md-12" >
							<!-- Begin Panel -->
								<div class="panel panel-plain panel-rounded">
									<div class="panel-body" style="background:" >

									<div class="add-more-contz">
												<div class="row atrri_add_cont">
														<div class="ache_ekta">
														</div>


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
											<tr>
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
													<div class="form-group" style="font-size:15px;margin-top:20px;">												
																
														<b>2</b>
														<p class="help-block with-errors"></p>
													</div>
												</td>
												<td>
													<div class="form-group" style="font-size:15px;margin-top:10px;">
														<b>00.00</b>
														<p class="help-block with-errors"></p>
													</div>
												</td>

												<td class="col-sm-2">
													<div class="form-group">
														<div class="input-group">
															<select class="rs-selectize-optgroup" multiple>
																<option value="">Choose</option>
																<option value="CGST">CGST</option>
																<option value="SGST">SGST</option>
																<option value="VAT">VAT</option>
															</select>
																
														</div><!-- /input-group -->
													</div>
												</td>

												<td class="col-sm-2">
													<div class="form-group" style="font-size:15px;margin-top:10px;">
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
												<a href="sales_order.php"><button class="btn btn-success btn-wide">BACK</button>
												<a href="print_invoice.php"><button class="btn btn-success btn-wide">PRINT INVOICE</button>
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
			  var htmlz = "<div class='row atrri_add_cont'><div class='col-sm-3'><div class='form-group'><label style='font-size:13px;'>Product Name</label><input type='text' name='attri[]' class='form-control' placeholder=' Product ' required><p class='help-block with-errors'></p></div></div><div class='col-sm-2'><div class='form-group'><label style='font-size:13px;'>Quantity</label><input type='text' name='attri[]' class='form-control' placeholder=' Qty ' required><p class='help-block with-errors'></p></div></div><div class='col-sm-2'><div class='form-group'><label style='font-size:13px;'>Rate</label><input type='text' name='attri[]' class='form-control' placeholder=' Rs.' required><p class='help-block with-errors'></p></div></div><div class='col-sm-2'><div class='form-group'><label style='font-size:13px;'>TAX</label><input type='text' name='attri[]' class='form-control' placeholder='TAX %' required><p class='help-block with-errors'></p></div></div><div class='col-sm-2'><div class='form-group'><label style='font-size:13px;'>Amount</label><input type='text' name='optn[]' class='form-control' placeholder='Rs.' required><p class='help-block with-errors'></p></div></div><div class='col-sm-1' style='margin-top:30px;'><a href='#' class='remove' style='color:#ef5350;'><i class='fa fa-trash'></i></a></div></div></div></div></div>";
			  //alert(htmlz);
			  $(".add-more-contz").append(htmlz);
		  });

		  $("body").on("click",".remove",function(){ 
			  
			  $(this).parents(".atrri_add_cont").remove();
		  });

		});
	</script>

	<script>
		function copybillingaddr(){
			var billstreet = $(".billstreet").val();
			var billcity = $(".billcity").val();
			var billstate = $(".billstate").val();
			var bilzip = $(".bilzip").val();
			var billcountry = $(".billcountry option:selected").val();
			
			$(".billstreet2").val(billstreet);
			$(".billcity2").val(billcity);
			$(".billstate2").val(billstate);
			$(".bilzip2").val(bilzip);
			$(".billcountry2 select").val(billcountry)
			$('.billcountry2 option[value='+billcountry+']').prop('selected',true);
		}
	</script>
	
</body>
</html>