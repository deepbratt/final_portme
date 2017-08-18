<?php
include("config.php");
$business_id = $_SESSION['business_id'];
?>
<!DOCTYPE html>
<html lang=en>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Dashboard | Port-ME</title>
	<?php include("metalinks.php");?>
	
</head>


<body>

	<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div id="rs-wrapper">

		<!-- BEGIN MAIN HEADER NAV -->
		<?php include("header.php");?>
		<!-- END MAIN HEADER NAV -->


		<!-- BEGIN SIDEBAR NAV -->
		<?php include("sidebar.php");?>
		<!-- END SIDEBAR NAV -->


		<!-- BEGIN MAIN CONTENT -->
		<article class="rs-content-wrapper">
			<div class="rs-content">
				<div class="rs-inner">

					<?php
					$select_user = mysqli_query($mysqli,"select * from tbl_business where business_id='$business_id'");
					$fetch_user = mysqli_fetch_array($select_user);
					?>
					<!-- Begin Dashhead -->
					<div class="rs-dashhead m-b-lg">
						<div class="rs-dashhead-content">
							<div class="rs-dashhead-titles">
								<h6 class="rs-dashhead-subtitle text-uppercase">Dashboard</h6>
								<h3 class="rs-dashhead-title m-t">Good Day, <?php echo ucfirst($fetch_user['owners_firstname']);?> <?php echo ucfirst($fetch_user['owners_lastname']);?> !</h3>
								<!-- Begin Toolbar toggle button on mobile -->
								<div class="toggle-toolbar-btn">
									<span class="fa fa-sort"></span>
								</div><!-- /.toggle-toolbar-btn -->
								<!-- End Toolbar toggle button on mobile -->
							</div><!-- /.rs-dashhead-titles -->
							<!--<div class="rs-dashhead-toolbar">
								<button type="button" class="btn btn-success btn-wide rs-btn-icon block-on-mobile">
									<span class="gcon gcon-upload-to-cloud icon-btn"></span>
									Upload Item
								</button>
							</div>--><!-- /.rs-dashhead-toolbar -->
						</div><!-- /.rs-dashhead-content -->
						<!-- Begin Breadcrumb -->
						<ol class="breadcrumb">
							<li><a href="javascript:void(0);"><i class="fa fa-home m-r"></i> Home</a></li>
							<li class="active">Dashboard</li>
						</ol>
						<!-- End Breadcrumb -->
					</div><!-- /.rs-dashhead -->
					<!-- End Dashhead -->

					<!-- Begin default content width -->
					<div class="container-fluid">

						<!--<div class="alert alert-success alert-simple alert-dismissible fade in iconic-alert m-b-lg" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
							<div class="alert-icon">
								<span class="gcon gcon-emoji-happy centered-xy"></span>
							</div>
							<p><strong>You have received a payment</strong>. Click <a href="javascript:void(0);" class="alert-link">here</a> to review your payment page.</p>
						</div>-->

						
						<div class="row">
							<div class="col-lg-12">

								<div class="row">

									<?php
										$select_vendor = mysqli_query($mysqli,"select * from tbl_contacts where business_id='$business_id' and customer_type='vendor'");
										$count_vendor = mysqli_num_rows($select_vendor);
									?>
									<a href="vendor.php">
										<div class="col-sm-3" align="center">
											<div class="quick-stat panel panel-rounded bg-grad bg-grad-05 borderless">
												<div class="panel-heading borderless">
													<p class="subtitle text-lighten text-uppercase m-b-xs">Vendors</p>
													<h3 class="m-a-0 p-a-0"><?php echo $count_vendor;?></h3>
												</div>
											</div>
										</div>
									</a>

									<?php
										$select_customer = mysqli_query($mysqli,"select * from tbl_contacts where business_id='$business_id' and customer_type='customer'");
										$count_customer = mysqli_num_rows($select_customer);
									?>
									<a href="customer.php">
										<div class="col-sm-3" align="center">
											<div class="quick-stat panel panel-rounded bg-grad bg-grad-03 borderless">
												<div class="panel-heading borderless">
													<p class="subtitle text-lighten text-uppercase m-b-xs">Customers</p>
													<h3 class="m-a-0 p-a-0"><?php echo $count_customer;?></h3>
												</div>
											</div>
										</div>
									</a>

									<?php
										$select_product = mysqli_query($mysqli,"select * from tbl_products where business_id ='$business_id' and status ='active'");
										$count_product = mysqli_num_rows($select_product);
									?>
									<a href="product.php">
										<div class="col-sm-3" align="center">
											<div class="quick-stat panel panel-rounded bg-grad bg-grad-15 borderless">
												<div class="panel-heading borderless">
													<p class="subtitle text-lighten text-uppercase m-b-xs">Products</p>
													<h3 class="m-a-0 p-a-0"><?php echo $count_product;?></h3>
												</div>
											</div>
										</div>
									</a>

									<?php
										$select_cat = mysqli_query($mysqli,"select * from tbl_productcat where business_id ='$business_id' and status ='active'");
										$count_cat = mysqli_num_rows($select_cat);
									?>
									<a href="product_group.php">
										<div class="col-sm-3" align="center">
											<div class="quick-stat panel panel-rounded bg-grad bg-grad-15 borderless">
												<div class="panel-heading borderless">
													<p class="subtitle text-lighten text-uppercase m-b-xs">Product Categories</p>
													<h3 class="m-a-0 p-a-0"><?php echo $count_cat;?></h3>
												</div>
											</div>
										</div>
									</a>

								</div><!-- /.row -->

								<!-- Begin Panel -->
								<!--<div class="panel panel-plain panel-rounded">
									<div class="panel-heading borderless">
										<h3 class="panel-title">Top Item Sales</h3>
										<p class="subtitle text-uppercase m-t">Last 10 Months</p>
									</div>
									<div class="panel-body">
										<div id="morris-hero-area" style="width: 105%; height: 300px;"></div>
									</div>
									<div class="panel-body p-t-0">
										<div class="rs-col-stacked full-width-on-mobile borderless border-items m-a-0">
											<div class="stacked-item p-a text-center">
												<p class="text-muted m-a-0">Total Sales</p>
												<h3 class="m-t-0 f-w-400">213,015</h3>
											</div>
											<div class="stacked-item p-a text-center">
												<p class="text-muted m-a-0">Total Revenue</p>
												<h3 class="m-t-0 f-w-400 text-success">$2.5M</h3>
											</div>
											<div class="stacked-item p-a text-center">
												<p class="text-muted m-a-0">This Year Sales</p>
												<h3 class="m-t-0 f-w-400 text-info">57,760</h3>
											</div>
											<div class="stacked-item p-a text-center">
												<p class="text-muted m-a-0">Today Revenue</p>
												<h3 class="m-t-0 f-w-400 text-warning">$2,257</h3>
											</div>
										</div>
									</div>
								</div>-->
								<!-- End Panel -->

							</div><!-- /.col-md-9 -->

							<div class="col-lg-4">
							
					<!-- /.panel -->
								<!-- End Panel -->

							</div><!-- /.col-md-3 -->

						</div><!-- /.row -->

						
							
						<!-- Begin Panel -->
						<div class="panel panel-plain panel-rounded">
							<div class="panel-heading">
								<h3 class="panel-title">Products Summary</h3>
								<p class="subtitle text-uppercase m-t-xs">Stock Quantity</p>
								<!--<div class="panel-toolbar v-centered mobile-block">
									<button class="btn btn-success block-on-mobile"><i class="gcon gcon-archive icon-btn m-r"></i>View Statement</button>
								</div>--><!-- /.panel-toolbar -->
							</div><!-- /.panel-heading -->
							<div class="panel-body p-a-0">
								<div class="rs-col-stacked full-width-on-mobile border-items borderless m-a-0">
								<?php
								$select_pro = mysqli_query($mysqli,"select * from tbl_products where business_id='$business_id' and status='active' order by qty asc limit 6");
								while($fetch_pro = mysqli_fetch_array($select_pro)){
								?>
									<div class="text-center stacked-item p-a-md p-b-lg">
										<p><b><?php echo ucfirst($fetch_pro['name']);?></b></p>
										<div class="easypiechart easypie-info text-muted" data-percent="100">
											<span class="text-info"><?php echo $fetch_pro['qty'];?></span>
											<small>Items</small>
										</div><!-- /.easypiechart -->
									</div><!-- /.stacked-item -->
								<?php
								}
								?>
									
								</div><!-- /.rs-col-stacked -->
								<div class="table-responsive">
									<table class="table rs-table table-striped table-hover table-b-t">
										<thead>
											<tr>
												<th>Date</th>
												<th>Invoice ID</th>
												<th>Vender/Customer</th>
												<th>Type</th>
												<th>Products</th>
												<th>Amount</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$select_tarns = mysqli_query($mysqli,"select * from tbl_transactions where business_id='$business_id' and status='active' order by tbl_transaction_id desc limit 6");
											while($fetch_trans = mysqli_fetch_array($select_tarns)){
										?>
											<tr>
												<td><samp class="text-muted"><a href="print_invoice.php?order_id=<?php echo $fetch_trans['tbl_transaction_id'];?>" style="text-decoration:none;color:#888;"><?php echo date("M-d-Y",$fetch_trans['date'])?></a></samp></td>
												<td><a href="print_invoice.php?order_id=<?php echo $fetch_trans['tbl_transaction_id'];?>" style="text-decoration:none;color: #333;"><?php echo $fetch_trans['invoice_no'];?></a></td>
												<td>
												<?php
													$select_cus_type = mysqli_query($mysqli,"select * from tbl_contacts where customer_id='".$fetch_trans['customer_id']."'");
													$fetch_cus_type = mysqli_fetch_array($select_cus_type);
												?>
													<strong><a href="print_invoice.php?order_id=<?php echo $fetch_trans['tbl_transaction_id'];?>" style="text-decoration:none;color:#333;"><?php echo ucfirst($fetch_cus_type['first_name']);?>&nbsp;<?php echo ucfirst($fetch_cus_type['last_name']);?></a></strong>
												</td>
												<td><span class="label label-danger"><a href="print_invoice.php?order_id=<?php echo $fetch_trans['tbl_transaction_id'];?>" style="text-decoration:none;color:#fff;"><?php echo ucfirst($fetch_cus_type['customer_type']);?></span></td>
												<td>
												<?php
												$p_id = explode(',',$fetch_trans['product_id_array']);
												foreach($p_id as $key)
												{
													$select_product = mysqli_query($mysqli,"select * from tbl_products where product_id='$key'");
													$fetch_product = mysqli_fetch_array($select_product);
												?>
													<a href="print_invoice.php?order_id=<?php echo $fetch_trans['tbl_transaction_id'];?>"><?php echo ucfirst($fetch_product['name']);?></a>
													<br />
												<?php
												}
												?>
												</td>
												<td><strong class="text-danger"><a href="print_invoice.php?order_id=<?php echo $fetch_trans['tbl_transaction_id'];?>" style="text-decoration:none;color:#ef5350;"><?php echo(($fetch_trans['tbl_transaction_type']=='purchase')?'-':'');?>&nbsp; &#8377; &nbsp;<?php echo $fetch_trans['total'];?></a></strong></td>
											</tr>
										<?php
											}
										?>
										</tbody>
									</table>
								</div><!-- /.table-responsive -->
							</div><!-- .panel-body -->
						</div><!-- /.panel -->
						<!-- End Panel -->

					</div><!-- /.container-fluid -->

				</div><!-- /.rs-inner -->
			</div><!-- /.rs-content -->
		</article><!-- /.rs-content-wrapper -->
		<!-- END MAIN CONTENT -->


		<?php include("footer.php");?>

</body>
</html>