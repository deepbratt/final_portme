<?php
	include("config.php");
	include("user_related/functions.php");
	$user_id = $_SESSION['business_id'];
	$get_user_information = mysqli_query($mysqli, "select * from tbl_business where business_id = '".$user_id."'");
	$fetch_user_data = mysqli_fetch_array($get_user_information);

?>
	<nav class="navbar navbar-default rs-navbar navbar-static-top">
			<div class="container-fluid">

				<!-- 
				Begin navbar header
				Brand and toggle get grouped for better mobile display 
				-->
				<div class="navbar-header has-right-divider">

					<!-- Begin Logo Brand 
					Available class : .fixed-width
					-->
					<div class="rs-logo fixed-width">
						<!-- Main Image logo -->
						<a class="navbar-brand" href="" >
							<img alt="Brand" src="images/logo.png"  style="height:60px;margin-left:50px;margin-top:5px;">
						</a>
						<!-- Main small logo -->
						<!-- <a class="navbar-brand" href="index.html">
						<img alt="Brand" src="../dist/img/logo-small.png">
						</a> -->
						<!-- Text logo -->
						<!-- <a class="navbar-brand text-uppercase rs-brand-text" href="index.html">
						Roosa
						</a> -->
						<!-- Initial text / icon logo -->
						<!-- <a class="navbar-brand rs-brand-text brand-initial" href="index.html">
						<i class="gcon gcon-twitter text-info"></i>
						</a> -->
					</div><!-- /.rs-logo -->
					<!-- End Logo Brand -->

					<!-- Begin button to toggle sidebar -->
					<button type="button" class="navbar-toggle collapsed sidebar-toggle" id="rs-sidebar-toggle-mobile">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- End button to toggle sidebar -->

					<!-- Begin button to toggle navbar element -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#roosa-nav-collapse" aria-expanded="false">
						<span class="gcon gcon-dots-three-vertical f-s-sm"></span>
					</button>
					<!-- End button to toggle navbar element -->
					
				</div><!-- /.navbar-header -->
				<!-- End Navbar header -->

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="roosa-nav-collapse">
					
					<!-- All left content goes here -->
					<div class="navbar-left">

						<!--<ul class="nav navbar-nav">
							<li class="navbar-icon dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-globe"></i>
									<span class="visible-xs-inline-block text-menu">Connected Accounts</span>
								</a>
								<ul class="dropdown-menu p-b-0 p-t-0">
									<li class="dropdown-header text-uppercase has-divider hidden-xs">Sync with other accounts</li>

									<li>
										<ul class="grid-dropdown scroll-dropdown rs-scroll-custom">
											<li>
												<a href="javascript:void(0);">
													<img src="images/1485192153_amazon.png" class="rs-dropdown-img" alt="Icon">
													Amazon
												</a>
											</li>
											<li>
												<a href="javascript:void(0);">
													<img src="images/1485192142_ebay.png" class="rs-dropdown-img" alt="Icon">
													Ebay
												</a>
											</li>
											<li>
												<a href="javascript:void(0);">
													<img src="images/1485192145__shopify.png" class="rs-dropdown-img" alt="Icon">
													Shopify
												</a>
											</li>
											
										</ul>
									</li>

									<!--<li class="text-center bottom-button"><a href="javascript:void(0);">All Accounts</a></li>
								</ul>
							</li>
						</ul>-->

						<!-- Begin nav search form -->
						<form class="navbar-form navbar-left" style="margin-top:16px;margin-left:-13px;">
							<div class="form-group has-feedback">
								Trial expires in 1 day <a href="" class="fpass">Upgrade</a>
							</div>
						</form>
						<!-- End nav search form -->

					</div><!-- /.navbar-left -->

					<!-- All right content goes here -->
					<div class="navbar-right">

						<ul class="nav navbar-nav">
							<!--<li class="navbar-icon dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" style="font-size:14px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<span> My Warehhouse</span>
									<i class="fa fa-chevron-circle-down" style="color:#e54e53;"></i>
								</a>
								<ul class="dropdown-menu xl-dropdown p-b-0 p-t-0">
									<li class="dropdown-header text-uppercase has-divider hidden-xs">
										Warehouses
									</li>
									<li>
										<ul class="rs-inner-dropdown has-divider media-menu scroll-dropdown rs-scroll-custom">
											<li class="new"><a href="javascript:void(0);">
												<span class="media img-circle bg-primary">EJ</span>
												<span class="id">Syspider Technology Pvt. Ltd.</span>
												<span class="time small">Manager</span>
											</a></li>
											<li class="old"><a href="javascript:void(0);">
												<img src="images/04.png" class="media img-circle" alt="Avatar">
												<span class="id">Deep Kumar Impex</span>
												<span class="time small">Sales</span>
											</a></li>

										</ul>
									</li>
									<li class="text-center bottom-button"><a href="javascript:void(0);">Manage Warehouse</a></li>
								</ul>
							</li>
							

							<li class="navbar-icon dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="circle-notification bg-danger badge-notification"></span>
									<i class="gcon gcon-bell"></i>
									<span class="visible-xs-inline-block text-menu">Notifications</span>
								</a>
								<ul class="dropdown-menu xl-dropdown p-b-0 p-t-0">
									<li class="dropdown-header text-uppercase has-divider hidden-xs">
										Notifications
										<span class="label label-success m-l">2 new</span>
									</li>
									<li>
										<ul class="rs-inner-dropdown has-divider media-menu scroll-dropdown rs-scroll-custom">
											<li class="new"><a href="javascript:void(0);">
												<span class="media img-circle bg-primary">EJ</span>
												<span class="id">Enjelina Joli</span> Add one of your items as favorite
												<span class="time small">About 30 minutes ago</span>
											</a></li>
											<li class="new"><a href="javascript:void(0);">
												<img src="images/04.png" class="media img-circle" alt="Avatar">
												<span class="id">Joker Betmen</span> Follows you
												<span class="time small">About an hour ago</span>
											</a></li>
											<li><a href="javascript:void(0);">
												<img src="images/13.png" class="media img-circle" alt="Avatar">
												<span class="id">Selena Gemes</span> Commented on one of your items
												<span class="time small">About 30 minutes ago</span>
											</a></li>
											<li><a href="javascript:void(0);">
												<img src="images/07.png" class="media img-circle" alt="Avatar">
												<span class="id">Jono Linon</span> Rated you item
												<span class="time small">About 30 minutes ago</span>
											</a></li>
											<li><a href="javascript:void(0);">
												<span class="media img-circle gcon gcon-shopping-bag bg-primary"></span>
												<span class="id">Enjelina Joli</span> Purchased your item
												<span class="time small">About 30 minutes ago</span>
											</a></li>
										</ul>
									</li>
									<li class="text-center bottom-button"><a href="javascript:void(0);">View all notifications</a></li>
								</ul>
							</li>-->
						</ul>

						<ul class="nav navbar-nav">
							<!-- Begin user menu -->
							<li class="rs-user-nav dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="circle-notification badge-notification bg-success"></span>
									<img src="uploads/<?php echo $fetch_user_data['logo'];?>" class="rs-nav-avatar img-circle" alt="Avatar" style="height:50px;width:50px;">
									<span class="visible-xs-inline-block m-l">Welcome, <strong><?php echo $fetch_user_data['username'];?></strong></span>
								</a>
								<!-- Dropdown -->
								<ul class="dropdown-menu lg-dropdown">
									<li class="inherit-bg">
										<a href="javascript:void(0);">
											<span class="f-s-xs f-w-500"><?php echo ucfirst($fetch_user_data['enterprise_name']);?></span>
										</a>
									</li>
									<li role="separator" class="divider"></li>
									<li class="menu-icon"><a href="login_security.php"><span class="mcon mcon-face rs-dropdown-icon"></span>Login security</a></li>
									<li class="menu-icon"><a href="edit_general_information.php"><span class="fa fa-industry rs-dropdown-icon"></span>General information</a></li>
									<li class="menu-icon"><a href="logout.php"><span class="gcon gcon-log-out rs-dropdown-icon"></span>Log Out</a></li>
								</ul>
								<!-- End dropdown -->
							</li>
							<!-- End user menu -->
						</ul>
					</div><!-- /.navbar-right -->
					<!-- End navbar right content -->

				</div><!-- /.collapse navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>