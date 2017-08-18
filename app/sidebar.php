<?php
$page_name = BASENAME($_SERVER['PHP_SELF']);
$user_id = $_SESSION['business_id'];
$cu_info = mysqli_query($mysqli, "select * from tbl_business where business_id = '".$user_id."'");
$fetch_details = mysqli_fetch_array($cu_info);
?>
<aside class="rs-sidebar">
	
			<!-- Sidebar menu -->
			<ul class="rs-sidebar-nav default-sidebar-nav">
				<li class="rs-user-sidebar">
					<a href="edit_general_information.php" style="margin:0px;padding:10px 15px;font-size:20px;">
							<div  style="margin-top:20px;margin-bottom:20px;text-align:center;font-weight:bold;"><?php echo ucfirst($fetch_details['enterprise_name']);?></div>
						
							<!--<div style="margin-top:20px;"> 19AJRPM1168P1ZA </div>-->

						
					</a>
				</li>

				<li class="menu-block-divider "></li>

				<li class="nav-item start <?php if($page_name == 'dashboard.php'){ ?>active open<?php } ?>">
					<a href="dashboard.php">
						<span class="gcon gcon-gauge rs-icon-menu "></span>Dashboard
					</a>
				</li>
			


				<li class="nav-item start <?php if($page_name == 'vendor.php' ||  $page_name == 'customer.php') { ?>active open<?php } ?> ">
					<a href="javascript:void(0);">
						<span class="fa fa-address-book rs-icon-menu "></span>Contacts
					</a>
					<ul>
						<li class="<?php if($page_name == 'vendor.php'){ ?>active selected<?php } ?>"><a href="vendor.php">Vendors</a></li>
						<li class="<?php if($page_name == 'customer.php'){ ?>active selected<?php } ?>"><a href="customer.php">Customers</a></li>
					</ul>
				</li>

				<li class="nav-item start <?php if($page_name == 'product_group.php' ||  $page_name == 'hsn.php' ||  $page_name == 'product.php') { ?>active open<?php } ?>">
					<a href="javascript:void(0);">
						<span class="fa fa-shopping-cart rs-icon-menu"></span>Products / Services
					</a>
					<ul>
						<li class="<?php if($page_name == 'product_group.php'){ ?>active selected<?php } ?>"><a href="product_group.php">Group / Category</a></li>
						<li class="<?php if($page_name == 'hsn.php'){ ?>active selected<?php } ?>"><a href="hsn.php">HSN Codes</a></li>
						<li class="<?php if($page_name == 'product.php'){ ?>active selected<?php } ?>"><a href="product.php">Products</a></li>

					</ul>
				</li>

				<li class="nav-item start <?php if($page_name == 'add_sales_order.php' || $page_name == 'sales_order.php'){ ?>active open<?php } ?>">
					<a href="javascript:void(0);">
						<span class="fa fa-line-chart rs-icon-menu"></span>Sales
					</a>
					<ul>
						<li class="<?php if($page_name == 'add_sales_order.php'){ ?>active selected<?php } ?>"><a href="add_sales_order.php">Create Sales</a></li>
						<li class="<?php if($page_name == 'sales_order.php'){ ?>active selected<?php } ?>"><a href="sales_order.php">View Sales</a></li>
					</ul>
				</li>


				<li class="nav-item start <?php if($page_name == 'add_purchase_order.php' ||  $page_name == 'purchase_order_info.php'){ ?>active open<?php } ?>">
					<a href="javascript:void(0);">
						<span class="fa fa-usd rs-icon-menu"></span>Purchase Orders
					</a>
					<ul>
						<li class="<?php if($page_name == 'add_purchase_order.php'){ ?>active selected<?php } ?>"><a href="add_purchase_order.php">Create Purchase Order</a></li>
						<li class="<?php if($page_name == 'purchase_order_info.php'){ ?>active selected<?php } ?>"><a href="purchase_order_info.php">View Purchase Order</a></li>
					</ul>
				</li>



				<li class="nav-item start <?php if($page_name == 'purchase_transaction.php' ||  $page_name == 'sales_transaction.php' ) { ?>active open<?php } ?>">
					<a href="javascript:void(0);">
						<span class="fa fa-table rs-icon-menu"></span>Financial Reports
					</a>
					<ul>
						<li class="<?php if($page_name == 'purchase_transaction.php'){ ?>active selected<?php } ?>"><a href="purchase_transaction.php">Purchase Order History</a></li>
						<li class="<?php if($page_name == 'sales_transaction.php'){ ?>active selected<?php } ?>"><a href="sales_transaction.php">Sales Order Transaction</a></li>
						
						

					</ul>
				</li>
				
			
				<li class="nav-item start <?php if($page_name == 'login_security.php' ||  $page_name == 'edit_general_information.php') { ?>active open<?php } ?>">
					<a href="javascript:void(0);">
						<span class="fa fa-cog rs-icon-menu"></span>Accounts Settings
					</a>
					<ul>
						<li class="<?php if($page_name == 'login_security.php'){ ?>active selected<?php } ?>"><a href="login_security.php">Login Security</a></li>						
						<li class="<?php if($page_name == 'edit_general_information.php'){ ?>active selected<?php } ?>"><a href="edit_general_information.php">General Information</a></li>
					</ul>
				</li>
				
				<li class="nav-item start <?php if($page_name == 'logout.php') { ?>active open<?php } ?>">
					<a href="logout.php">
						<span class="gcon gcon-log-out rs-icon-menu"></span>Logout
					</a>
				</li>
								
				<li class="menu-block-divider"></li>
			</ul>
			<!-- End sidebar menu -->

		</aside>