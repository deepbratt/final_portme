<?php
include ("config.php");
if(!isset($_SESSION['user_id']))
	{
		echo "<script>window.location.href='index.php'</script>";
	}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>IsraFind | Dashboard</title>
        <?php include('metalinks.php'); ?>
	</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
		<?php include('header.php'); ?>
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
			<?php include('sidebar.php'); ?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="dashboard.php">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Dashboard</span>
                            </li>
                        </ul>
                    </div>
					<!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title" style="background:#efefef;padding:7px;font-size:17px;">Informations
                        <!--<small>Statistics</small>-->
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN DASHBOARD STATS 1-->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div style="height:60px;width:65px;" class="col-md-6">
								<a href="add_prebooking_users.php" ><img src="images/1467999267_cloud-users.png" style="height:45px;width:60px;" /></a>
							</div>
							<div class="col-md-6" style="font-size:13px;padding-top:17px;">
								<a href="add_prebooking_users.php" style="color:#000;">Add Prebooking Customers</a>
							</div>
                        </div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div style="height:60px;width:65px;" class="col-md-6">
								<a href="view_prebooking_users.php" ><img src="images/if_Users_85409.png" style="height:45px;width:50px;" /></a>
							</div>
							<div class="col-md-6" style="font-size:13px;padding-top:17px;">
								<a href="view_prebooking_users.php" style="color:#000;">View Prebooking Customers</a>
							</div>
                        </div>

                    </div>
					
                    <div class="clearfix"></div>
					
					
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
		<?php include('footer.php'); ?>
    </body>

</html>