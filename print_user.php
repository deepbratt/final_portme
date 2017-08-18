<?php
include("config.php");
if(!isset($_SESSION['user_id']))
	{
		echo "<script>window.location.href='index.php'</script>";
	}
$customer_id = $_GET['id'];


?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <title>ADMIN || Add Pre Booking Customers</title>
        <?php include('metalinks.php'); ?>
		<style>
		  .hidden {
		   display:none;
		  }
		</style>
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
                                <a href="dashboard.php">Dasboard</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Pre Booking Customers</span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title">Pre Booking Customers
                        <small></small><div class="col-md-offset-10 col-md-2">
                                                    <input type="submit" class="btn green" onclick="javascript:printDiv('printablediv')" value="Print">
                                                </div>
                    </h3>
					 
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-home font-dark"></i>
                                        <span class="caption-subject font-dark sbold uppercase"> Pre Booking Customers</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
								<div id="printablediv" >
		<form id="" runat="server">
					
                
                <?php
				$select_query = mysqli_query($mysqli,"select * from prebooking_customers where id='$customer_id'");
				$fetch_query = mysqli_fetch_array($select_query);
				?>
				
				<!-- table starts -->
				<div class="panel panel-plain panel-rounded " style="padding:15px;">
					<table class="table table-b-t table-b-b datatable-default rs-table table-striped table-bordered" style="border-right:1px solid #f5f5f5;border-left:1px solid #f5f5f5;">

						<thead colspan="12">
						   <tr style="font-size:15px;">
								<th colspan="4" style="text-align:left;">
									<div class="col-sm-12">
									  <label style="font-size:30px;"> Port-Me</label>
									</div>
									<div class="col-sm-12">
									  <label style="font-size:17px;"> Email:-Support@gmail.com</label>
									</div> 
									<div class="col-sm-12">
									  <label style="font-size:17px;">Contact:-1234567
									  </label>
									</div>
								</th>
								

								

								<th colspan="5" style="text-align:center;">
									<div class="col-sm-12">
									  <label style="font-size:30px;"></label>
									</div>
									<div class="col-sm-12">
									  <label style="font-size:17px;">
									  </label>
									</div> 
									<div class="col-sm-12">
									  <label style="font-size:17px;">
									  </label>
									</div> 
									<div class="col-sm-12">
									  <label style="font-size:17px;">
									  </label>
									</div>
								</th>

								<th colspan="6" style="text-align:right;">
									<div class="col-sm-12">
									  <label style="font-size:30px;">Prebooking Invoice</label>
									</div>
									<div class="col-sm-12">
									  <label style="font-size:19px;">Invoice No:-<?php echo date("dmy");?><?php echo $fetch_query['id'];?>
									  </label>
									</div>
									<div class="col-sm-12">
									  <label style="font-size:17px;">
										Date : <?php echo date("d/m/y");?>
									  </label>
									</div> 
								</th>						
								
							</tr>
						</thead>						

						<thead>
						   <tr style="font-size:15px;">
								<th colspan="2" style="text-align:center;">Customer Name</th>
								<th colspan="2" style="text-align:center;">Enterprise Name</th>	
								
								<th colspan="2" style="text-align:center;">Email</th>
								<th colspan="2" style="text-align:center;">Phone</th>										
								<th colspan="1" style="text-align:center;">Address</th>
								<th colspan="2" style="text-align:center;">Payment Option</th>
								<th colspan="2" style="text-align:center;">Represented By</th>
								<th colspan="2" style="text-align:center;">Payment Status</th>

								
							</tr>
						</thead>
						<tbody>
							
							<tr>
								<th style="text-align:center;" colspan="2">	<?php echo $fetch_query['name'] ?>							
									
								</th>
								
								<th style="text-align:center;" colspan="2"><?php echo $fetch_query['enterprise_name'] ?>
									
								</th>
								
								
								<th style="text-align:center;" colspan="2"><?php echo $fetch_query['email'] ?>
								
								</th>
								<th style="text-align:center;" colspan="2"><?php echo $fetch_query['phone'] ?>
								
								</th>										
								<th style="text-align:center;" colspan="1"><?php echo $fetch_query['address'] ?>
								
								</th>
								<th style="text-align:center;" colspan="2"><?php echo $fetch_query['payment_option'] ?>
								
								</th>
								<th style="text-align:center;" colspan="2"><?php echo $fetch_query['represented_by'] ?>
								
								</th>
								<th style="text-align:center;" colspan="2"><?php echo $fetch_query['payment_status'] ?>
								
								</th>
						
							</tr>
							
							<tr>
								<th colspan="9"></th>
								
								<th colspan="2" style="text-align:center;font-size:25px;">Total<i class="fa fa-inr"></i></th>
								<th colspan="4" style="text-align:center;font-size:25px;"><?php echo $fetch_query['amount'] ?></th>			
							</tr>
							
							<tr>
								<th colspan="9"></th>
								
								<th colspan="6" style="text-align:center;font-size:15px;"></th>
							</tr>
							<tr></tr>

							<tr>
								<th colspan="9"></th>
								
								<th colspan="6" style="text-align:center;font-size:15px;">Signature  :- .................................. </th>
							</tr>

						</tbody>						

								
							

					</table>
				</div>
				<!-- table starts -->                



			  		
            </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                                <!-- END VALIDATION STATES-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <?php include('footer.php'); ?>

		 <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();
			

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
    </script>

    </body>		
</html>
