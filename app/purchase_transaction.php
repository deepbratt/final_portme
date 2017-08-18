<?php
include ("config.php");
$business_id = $_SESSION['business_id'];
if(isset($_POST['submit']))
{
 $fromtime = $_POST['from'];

	$fromdate =  strtotime($_POST['from_date']);
	$todate = strtotime($_POST['to_date']);

	$check_data_between_date = mysqli_query($mysqli, "select * from tbl_transactions where date between '".$fromdate."' and '".$todate."' and tbl_transaction_type = 'purchase'");
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
<title>Port-ME | Purchase Transaction </title>
<?php include("metalinks.php");?>
	<style>
		.dt-buttons a{
			border:1px solid #CCC;
			padding:3px 8px;
			margin:5px;
			color:#000;
			font-size:12px;
			border-radius:3px;
			float:right;
			margin-bottom:10px;
			background:#f6f6f6;
		}
		.dt-buttons a:hover{
			background:#fff;
		}
		div.dataTables_wrapper div.dataTables_filter{
			text-align:left !important;
			padding:5px;
		}
		div.dataTables_wrapper div.dataTables_filter input{
			width:300px !important;
		}
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
					<form method="POST">
					<!-- Begin Dashhead -->
					<div class="rs-dashhead m-b-lg" style="background:#f5f5f5">
						<div class="rs-dashhead-content">
							<div class="rs-dashhead-titles">
								<h3 class="rs-dashhead-title m-t">
									Purchase Transaction
									<!--<div style="float:right;">
										<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;"> <i class="fa fa-remove"></i> </span>
									</div>-->
								</h3>
								
							</div>
							
					<div class="row" style="margin-top:20px;">
                         <div class="col-md-3" >
							<div class="form-group has-feedback">
								<label class="control-label">From date</label>
								<input name="from_date" type="text" class="form-control rs-datepicker" data-date-format="dd-mm-yyyy" placeholder="DD-MM-YYYY" readonly>
								<span class="fa fa-calendar form-control-feedback" aria-hidden="true"></span>
							</div><!-- /.form-group -->
						</div><!-- /.col-md-3 -->

				<div class="col-md-3">
							<div class="form-group has-feedback">
								<label class="control-label">To date</label>
								<input name="to_date" type="text" class="form-control rs-datepicker" data-date-format="dd-mm-yyyy" placeholder="DD-MM-YYYY" readonly>
								<span class="fa fa-calendar form-control-feedback" aria-hidden="true"></span>
							</div><!-- /.form-group -->
						</div><!-- /.col-md-3 -->
					
					 <input name="submit" type="submit" value="Submit" class="btn-success" style="margin-top:30px;">
					</div>
							
						</div><!-- /.rs-dashhead-content -->
						
					</div><!-- /.rs-dashhead -->
					<!-- End Dashhead -->

					<!-- Begin default content width -->
					<div class="container-fluid">

						<!-- Begin Panel -->
						<div class="panel panel-plain panel-rounded table-responsive">
								<table class="table table-b-t table-b-b datatable-default rs-table table-default" style="border-right:1px solid #f5f5f5;border-left:1px solid #f5f5f5;">			
						<thead>
						   <tr style="font-size:15px;">
								<th style="text-align:center;">Invoice Number</th>
								<th style="text-align:center;">Vendor Name</th>
								<th style="text-align:center;">Place of Supply</th>
								<th style="text-align:center;">Product</th>
								<th style="text-align:center;">HSN</th>
								<th style="text-align:center;">Qty</th>
								<th style="text-align:center;">Unit Price</th>										
								<th style="text-align:center;">Tax rate</th>
								<th colspan="3" style="text-align:center;">TAX</th>
								<th style="text-align:center;">Cess</th>
								<th style="text-align:center;">Tax value</th>
								<th style="text-align:center;">Discount</th>
								<th style="text-align:center;">Total</th>

								
							</tr>
						</thead>
						<thead>

							<tr>
								<th style="text-align:center;"></th>
								<th style="text-align:center;"></th>
								<th style="text-align:center;"></th>
								<th style="text-align:center;"></th>
								<th style="text-align:center;"></th>
								<th style="text-align:center;"></th>
								<th style="text-align:center;"></th>
								<th style="text-align:center;"></th>
								<th style="text-align:center;">CGST</th>								
								<th style="text-align:center;">SGST</th>
								<th style="text-align:center;">IGST</th>
								<th style="text-align:center;"></th>
								<th style="text-align:center;"></th>
								<th style="text-align:center;"></th>
								<th style="text-align:center;"></th>
								

							
							</tr>
					</thead>
					<tbody>	
							<?php
							while($fetch_sales_order_info = mysqli_fetch_array($check_data_between_date)){
							?>
							<tr>
							<td><?php echo $fetch_sales_order_info['invoice_no']?> </td>	
							<td>
							<?php
								$customer_id = $fetch_sales_order_info['customer_id'];
								$get_customer_query = mysqli_query($mysqli,"select * from tbl_contacts where customer_id='".$customer_id."'");
								$get_fetch_customer_name = mysqli_fetch_array($get_customer_query);
								echo ucfirst($get_fetch_customer_name['salutation']);
								echo "&nbsp;&nbsp;";
								echo ucfirst($get_fetch_customer_name['first_name']);
								echo "&nbsp;&nbsp;";
								echo ucfirst($get_fetch_customer_name['last_name']);
							?>
							</td>
							<td> 
							<?php
							$get_state_id = $fetch_sales_order_info['Place_of_supply'];
							$state_info = mysqli_query($mysqli, "select * from states where states_code = '".$get_state_id."'");
							$fetch_state_info = mysqli_fetch_array($state_info);
							echo ucfirst($fetch_state_info['states_name']);
							?>
							</td>
								<td style="text-align:center;">									
											<?php 
											$product_id = explode(",",$fetch_sales_order_info['product_id_array']);
											//print_r($product_id);
											$count = count($product_id);
											for($i=0;$i<$count; $i++)
											{
											?>
											<?php 																			
											$fetch_pro_name = mysqli_query($mysqli,"SELECT * FROM tbl_products WHERE product_id='$product_id[$i]'");
											$fetch_p_details = mysqli_fetch_array($fetch_pro_name);
											echo $fetch_p_details['name'];
											echo "<br />";
											?>											
											<?php
											}
											?>
										</td>
								
										<td style="text-align:center;">
											<?php
											$hsn_array = explode(",",$fetch_sales_order_info['hsn_array']);
											foreach($hsn_array as $hsn_name){
											echo $hsn_name;
											echo "<br />";
											}
											?>
										</td>
								<td style="text-align:center;">
											<?php
											$quantity_array = explode(",",$fetch_sales_order_info['qty_array']);
											foreach($quantity_array as $quantity_details){
											echo $quantity_details;
											echo "<br />";
											}
											?>
								</td>
								<td style="text-align:center;">
											<?php
											$unit_price_array = explode(",",$fetch_sales_order_info['unit_price_array']);
											foreach($unit_price_array as $unit_price_details){
											echo $unit_price_details;
											echo "<br />";
											}
											?>
								</td>										
								<td style="text-align:center;">
											<?php
											$tax_rate_array = explode(",",$fetch_sales_order_info['tax_rate_array']);
											foreach($tax_rate_array as $tax_rate_details){
											echo $tax_rate_details;
											echo "<br />";
											}
											?>
								</td>
								<td style="text-align:center;">
											<?php
											$cgst_array = explode(",",$fetch_sales_order_info['tax_cgst_array']);
											foreach($cgst_array as $cgst_details){
											echo $cgst_details;
											echo "<br />";
											}
											?>
								</td>
								<td style="text-align:center;">
										<?php
											$sgst_array = explode(",",$fetch_sales_order_info['tax_sgst_array']);
											foreach($sgst_array as $sgst_details){
											echo $sgst_details;
											echo "<br />";
											}
											?>
								</td>
								<td style="text-align:center;">
								<?php
											$igst_array = explode(",",$fetch_sales_order_info['tax_igst_array']);
											foreach($igst_array as $igst_details){
											echo $igst_details;
											echo "<br />";
											}
											?>
								</td>
								<td style="text-align:center;">
								<?php
											$cess_array = explode(",",$fetch_sales_order_info['tax_cess_array']);
											foreach($cess_array as $cess_details){
											echo $cess_details;
											echo "<br />";
											}
											?>
								</td>
								<td style="text-align:center;">
								<?php
											$tax_value= explode(",",$fetch_sales_order_info['tax_value_array']);
											foreach($tax_value as $tax_value_details){
											echo $tax_value_details;
											echo "<br />";
											}
											?>
								</td>
								<td style="text-align:center;">
								<?php
											$discount_info = explode(",",$fetch_sales_order_info['discount_array']);
											foreach($discount_info as $discount_details){
											echo $discount_details;
											echo "<br />";
											}
											?>
								</td>
								<td style="text-align:center;">
								<?php
											$total_array = explode(",",$fetch_sales_order_info['total_array']);
											foreach($total_array as $total_details){
											echo $total_details;
											echo "<br />";
											}
											?>
								</td>
						
							</tr>
								<?php
							}	
							?>
							
							</tbody>						

								
							

					</table>
						</div><!-- /.panel -->
						<!-- End Panel -->

					</div><!-- /.container-fluid -->
					</form>
				</div><!-- /.rs-inner -->
			</div><!-- /.rs-content -->
		</article><!-- /.rs-content-wrapper -->
		<!-- END MAIN CONTENT -->

	<?php include("footer.php");?>
	<!-- Page Plugins -->
	<script src="js/datatables.min.js"></script>
	<!--<script src="js/datatables-example.js"></script>-->
	
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>

	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="js/datepicker-example.js"></script><!-- Example -->



	<script>
		$(document).ready(function() {
			$('.datatable-default').DataTable( {
				dom: 'Bfrtip',
				columnDefs: [{ 
					  "targets": -1
				}],
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			} );
		} );
	</script>

	 <script>	 
	  $('.rs-datepicker').datepicker({
     format: "d/m/Y",
     autoclose: true,
	}).on('changeDate', function (ev) {
		 $(this).datepicker('hide');
	});
	</script>

</body>
</html>
