<?php
include("config.php");
if(!isset($_SESSION['user_id']))
	{
		echo "<script>window.location.href='index.php'</script>";
	}

if(isset($_POST['submit']))
{
	$name = mysqli_real_escape_string($mysqli,$_POST['name']);
	$enter_name = mysqli_real_escape_string($mysqli,$_POST['enter_name']);
	$email = mysqli_real_escape_string($mysqli,$_POST['email']);
	$phone = mysqli_real_escape_string($mysqli,$_POST['phone']);
	$address = mysqli_real_escape_string($mysqli,$_POST['address']);
	$payment_option = mysqli_real_escape_string($mysqli,$_POST['payment_option']);
	$amount = mysqli_real_escape_string($mysqli,$_POST['amount']);
	$represented_by = mysqli_real_escape_string($mysqli,$_POST['represented_by']);
	$date = time();
	if($payment_option == 'Cash')
	{
		$insert_details = mysqli_query($mysqli,"insert into prebooking_customers values('','".$name."','".$enter_name."','".$email."','".$phone."','".$address."','".$payment_option."','".$amount."','Paid','".$represented_by."','".$date."')");
	$last_id = mysqli_insert_id($mysqli);
		$redirect = "<script>window.location.href='print_user.php?id=$last_id'</script>";
	}
	else if($payment_option == 'Card')
	{
		$insert_details = mysqli_query($mysqli,"insert into prebooking_customers values('','".$name."','".$enter_name."','".$email."','".$phone."','".$address."','".$payment_option."','".$amount."','Pending','".$represented_by."','".$date."')");
	$last_id = mysqli_insert_id($mysqli);
		$redirect = "<script>window.location.href='card_user.php?id=$last_id'</script>";
	}

	if($insert_details)
	{
		$data = "success";
		echo $redirect;
	}
	else
	{
		$data = "error";
	}
	 
}

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
                                <span>Add Pre Booking Customers</span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title">Add Pre Booking Customers
                        <small></small>
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
                                        <span class="caption-subject font-dark sbold uppercase">Add Pre Booking Customers</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <form  id="form_sample_3" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below.
											</div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Your form validation is successful!
											</div>
											<div class="alert alert-success <?php if((isset($success)) && ($success == 1)) { } else { ?> display-hide <?php } ?>">
                                                <button class="close" data-close="alert"></button> You have successfully Updated your Password. .
											</div>
                                            <div class="alert alert-danger <?php if((isset($success)) && ($success == 0)) { } else { ?> display-hide <?php } ?>">
                                                <button class="close" data-close="alert"></button> Oops!! Something went wrong. Please try again.
											</div>
											 <div class="alert alert-danger <?php if((isset($success)) && ($success == 2)) { } else { ?> display-hide <?php } ?>">
                                                <button class="close" data-close="alert"></button> Oops!! Something went wrong. Please Check Your Password Again.
											</div>
                                      
											
											<div class="form-group">
                                                <label class="control-label col-md-3">Name
                                                </label>
                                                <div class="col-md-7">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
														</span>
														<input type="text" name="name" data-required="1" class="form-control" required />
													</div>
												</div>
                                            </div>

											<div class="form-group">
                                                <label class="control-label col-md-3">Enterprise Name
                                                </label>
                                                <div class="col-md-7">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
														</span>
														<input type="text" name="enter_name" data-required="1" class="form-control" required />
													</div>
												</div>
                                            </div>

											<div class="form-group">
                                                <label class="control-label col-md-3">Email
                                                </label>
                                                <div class="col-md-7">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
														</span>
														<input type="text" name="email" data-required="1" class="form-control" />
													</div>
												</div>
                                            </div>

											<div class="form-group">
                                                <label class="control-label col-md-3">Phone
                                                </label>
                                                <div class="col-md-7">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
														</span>
														<input type="text" name="phone" data-required="1" class="form-control" required />
													</div>
												</div>
                                            </div>


											<div class="form-group">
                                                <label class="control-label col-md-3">Represented By
                                                </label>
                                                <div class="col-md-7">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
														</span>
														<input type="text" name="represented_by" data-required="1" class="form-control" required />
													</div>
												</div>
                                            </div>

											<div class="form-group">
                                                <label class="control-label col-md-3">Payment Options
                                                </label>
                                                <div class="col-md-7">
													<div class="input-group">
													<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
														</span>
															<select class="form-control form-control-solid placeholder-no-fix" name="payment_option">
															<option value="">Choose a method</option>
															<option value="Card">Card</option>
															<option value="Cash">Cash</option>
														</select>
													</div>
												</div>
                                            </div>

											<div class="form-group">
                                                <label class="control-label col-md-3">Amount Payable
                                                </label>
                                                <div class="col-md-7">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
														</span>
														<input type="text" name="amount" data-required="1" class="form-control" required />
													</div>
												</div>
                                            </div>

											<div class="form-group">
                                                <label class="control-label col-md-3">Address
                                                </label>
                                                <div class="col-md-7">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
														</span>
														<textarea type="textarea" name="address" data-required="1" class="form-control" required> </textarea>
													</div>
												</div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <input type="submit" class="btn green" name="submit" value="Submit">
                                                </div>
                                            </div>
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
    </body>
	<!-- jQuery Form Validation code -->
	  <script>
	  
	  var FormValidation=function()
	  {
		  var e=function(){},
			  r=function(){},
		      i=function(){
		  var e=$("#form_sample_3"),
			  r=$(".alert-danger",e),
			  i=$(".alert-success",e);
		  e.on("submit",function()
		  {
			  for(var e in CKEDITOR.instances)CKEDITOR.instances[e].updateElement()
		  }),
		  e.validate(
		  {
			errorElement:"span",
		    errorClass:"help-block help-block-error",
			focusInvalid:!1,
			ignore:"",
			rules:
			{
				
				Description:{required:!0,minlength:20},
			
			},
			messages:
			{
				
				Description:{required:"Description Is Required",minlength:"Atleast {0} Characters"},
				
			},
			errorPlacement:function(e,r)
			{
				r.parent(".input-group").size()>0?e.insertAfter(r.parent(".input-group")):r.attr("data-error-container")?e.appendTo(r.attr("data-error-container")):r.parents(".radio-list").size()>0?e.appendTo(r.parents(".radio-list").attr("data-error-container")):r.parents(".radio-inline").size()>0?e.appendTo(r.parents(".radio-inline").attr("data-error-container")):r.parents(".checkbox-list").size()>0?e.appendTo(r.parents(".checkbox-list").attr("data-error-container")):r.parents(".checkbox-inline").size()>0?e.appendTo(r.parents(".checkbox-inline").attr("data-error-container")):e.insertAfter(r)
			},
			invalidHandler:function(e,t)
			{
				i.hide(),
				r.show(),
				App.scrollTo(r,-200)
			},
			highlight:function(e)
			{
				$(e).closest(".form-group").addClass("has-error")
			},
			unhighlight:function(e)
			{
				$(e).closest(".form-group").removeClass("has-error")
			},
			success:function(e)
			{
				e.closest(".form-group").removeClass("has-error")
			},
			submitHandler:function(e)
			{
				i.show(),
				r.hide(),
				e[0].submit()
			}
		}),
		$(".select2me",e).change(function(){e.validate().element($(this))}),
		$(".date-picker").datepicker({rtl:App.isRTL(),autoclose:!0}),
		$(".date-picker .form-control").change(function(){e.validate().element($(this))})},
		t=function(){};return{init:function(){t(),e(),r(),i()}}
	  }();
	  jQuery(document).ready(function(){FormValidation.init()});


	  var FormInputMask=function()
	  {
		  var a=function()
		  {
			  $('#price').inputmask("numeric", {
				radixPoint: ".",
				groupSeparator: ",",
				digits: 2,
				autoGroup: true,
				rightAlign: false,
				oncleared: function () { self.Value(''); }
			});
			$('#size').inputmask("numeric", {
				radixPoint: ".",
				groupSeparator: ",",
				digits: 2,
				autoGroup: true,
				rightAlign: false,
				oncleared: function () { self.Value(''); }
			});
			 
			  
		  };
		  return{init:function(){a(),n()}}
	  }();
	  App.isAngularJsApp()===!1&&jQuery(document).ready(function(){FormInputMask.init()});
	  
	  </script>
		
</html>
