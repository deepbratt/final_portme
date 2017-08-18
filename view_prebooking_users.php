<?php
include('config.php');
if(!isset($_SESSION['user_id']))
	{
		echo "<script>window.location.href='index.php'</script>";
	}

	$user_id = $_SESSION['user_id'];
	$get_type = mysqli_query($mysqli,"select * from prebooking_customers where id='".$user_id."'");
	$get_count = mysqli_num_rows($get_type);
	$get_fetch_type = mysqli_fetch_array($get_type);

	if(isset($_GET['delete_id'])){
$delete_prebooking_id = $_GET['delete_id'];
$delete_prebooking = mysqli_query($mysqli, "delete from prebooking_customers where id = '".$delete_prebooking_id."'");

if($delete_prebooking){
 echo "<script>window.location.href='view_prebooking_users.php'</script>";
}
else
	{
		echo "<script>alert('unable to delete')</script>";
	}
}

	$id = mysqli_query($mysqli,"select * from users");
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
		<title>View Pre Booking</title>
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
                                <a href="index.html">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <a href="#">Users</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>View</span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Users -
                        <small>View</small>
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-home font-dark"></i>
                                        <span class="caption-subject bold uppercase">View Users</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th >Name</th>
												<th >Enterprise Name</th>
                                                <th >Email</th>
												<th >Phone</th>
												<th >Address</th>
												<th class="none" >Payment Option</th>
												<th class="none" >Payment Status</th>
												<th >Represented By</th>
												<th >Date</th>
												<th >Action</th>
												<th >Action</th>
												
                                            </tr>
                                        </thead>
										<tbody>
											<tr>
											<?php
												$query = mysqli_query($mysqli,"select * from prebooking_customers");
											
												while($fetch_details = mysqli_fetch_array($query))
												{
												?>
												<td><?php echo $fetch_details['name'];?></td>
												<td><?php echo $fetch_details['enterprise_name'];?></td>
												<td><?php echo $fetch_details['email'];?></td>
												<td><?php echo $fetch_details['phone'];?></td>
												<td><?php echo $fetch_details['address'];?></td>
												<td><?php echo $fetch_details['payment_option'];?></td>
												<td><?php echo $fetch_details['payment_status'];?></td>
												<td><?php echo $fetch_details['represented_by'];?></td>
												<td><?php echo $fetch_details['date'];?></td>
												<td ><a href="" class="btn blue btn-outline sbold uppercase">View</a></td>
												<td ><a href="?delete_id=<?php echo $fetch_details['id'];?>" class="btn red btn-outline sbold uppercase">Delete</a></td>
											</tr>
											<?php
												}
												?>
										</tbody>
                                      
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <?php include('footer.php') ?>
    </body>

</html>