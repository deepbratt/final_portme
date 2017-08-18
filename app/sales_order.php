<?php
include ("config.php");
$business_id = $_SESSION['business_id'];

if(isset($_GET['delete_id']))
{
	$delete_id = $_GET['delete_id'];
	$delete_customer = mysqli_query($mysqli,"update tbl_transactions set status ='inactive' where tbl_transaction_id = '".$delete_id."'");
	if($delete_customer)
		{
			echo "<script>window.location.href='sales_order.php'</script>";
		}
}
$sale_order_info = mysqli_query ($mysqli,"select * from tbl_transactions where business_id='".$business_id."' and tbl_transaction_type='sales' and status='active'");

?>

<!DOCTYPE html>
<html lang=en>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>My Sales Order | Port-ME </title>
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
									Sales Order List
									<!--<div style="float:right;">
										<span style="padding:10px 10px;font-size:15px;font-weight:normal;color:#4a89dc;cursor:pointer;border-right:1px solid #CCC;"> <i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;Page Tutorial</span>

										<span style="padding:10px 5px;font-size:25px;font-weight:normal;color:#000;cursor:pointer;" style="float:-right;"> <i class="fa fa-remove"></i> </span>
									</div>-->
								</h3>
								
							</div>
							<div class="rs-dashhead-toolbar">
								<button type="button" class="btn btn-success btn-wide rs-btn-icon block-on-mobile" onclick="window.location.href='add_sales_order.php'">
									<span class="gcon gcon-upload-to-cloud icon-btn"></span>
									Add New
								</button>
							</div><!-- /.rs-dashhead-toolbar -->
							
						</div><!-- /.rs-dashhead-content -->
						
					</div><!-- /.rs-dashhead -->
					<!-- End Dashhead -->

					<!-- Begin default content width -->
					<div class="container-fluid">

						<!-- Begin Panel -->
						<div class="panel panel-plain panel-rounded table-responsive">
								<table class="table table-b-t table-b-b datatable-default rs-table table-default" style="border-right:1px solid #f5f5f5;border-left:1px solid #f5f5f5;">
									<thead>
							            <tr>
							                <th>Invoice Number</th>
							                <th>Customer Name</th>
							                <th>GST Number</th>
							                <th>Total Price</th>
											<th>Date</th>
											<th>Action</th>
							               
							            </tr>
							        </thead>
							        <tbody>
							            <tr>
										<?php
										while ($fetch_sales_order_info = mysqli_fetch_array($sale_order_info))										
										{
										?>
										<td><?php echo $fetch_sales_order_info['invoice_no']?></td>
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
											<td><?php echo ucfirst($fetch_sales_order_info['ecome_gstin']);?></td>
							                <td>Rs.&nbsp;<?php echo ucfirst($fetch_sales_order_info['total']);?></td>
							                <td><?php echo $fetch_sales_order_info['date']?></td>
							               	<td>
												<a href="print_invoice.php?order_id=<?php echo $fetch_sales_order_info['tbl_transaction_id'];?>" class="fa fa-eye" style="height:35px;margin-top:10px;padding-right:-50px; font-size:25px"> </a>												
												<a href="?delete_id=<?php echo $fetch_sales_order_info['tbl_transaction_id'];?>" class="fa fa-trash" style="height:35px;margin-top:10px;padding-right:-50px; font-size:25px"></a>
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

</body>
</html>