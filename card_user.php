<?php
include("config.php");
if(!isset($_SESSION['user_id']))
	{
		echo "<script>window.location.href='index.php'</script>";
	}
$customer_id = $_GET['id'];
$get_coustomer_query = mysqli_query($mysqli,"select * from prebooking_customers where id='".$customer_id."'");
$get_fetch_details = mysqli_fetch_array($get_coustomer_query);
?>
<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "p1YluE";

// Merchant Salt as provided by Payu
$SALT = "2bwyroQl";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
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
		<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
		<style>
		  .hidden {
		   display:none;
		  }
		</style>
	</head>
    <!-- END HEAD -->

    <body onload="submitPayuForm()" class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
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
                                        <span class="caption-subject font-dark sbold uppercase"> Pre Booking Customers</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
					
                
                <?php
				$select_query = mysqli_query($mysqli,"select * from prebooking_customers where id='$customer_id'");
				$fetch_query = mysqli_fetch_array($select_query);
				?>
				
				<!-- table starts -->
				<div class="panel panel-plain panel-rounded " style="padding:15px;">
					<table class="table table-b-t table-b-b datatable-default rs-table table-striped table-bordered" style="border-right:1px solid #f5f5f5;border-left:1px solid #f5f5f5;">

						<thead colspan="12">
						   <tr style="font-size:15px;">
								<th colspan="6" style="text-align:left;">
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
								<th colspan="3" style="text-align:center;">Customer Name</th>								
								<th colspan="3" style="text-align:center;">Email</th>
								<th colspan="3" style="text-align:center;">Phone</th>										
								<th colspan="5" style="text-align:center;">Ammount</th>


								
							</tr>
						</thead>
						<tbody>
							
							<tr>
								<th style="text-align:center;" colspan="3">	<?php echo $fetch_query['name'] ?>					
									
								</th>
								
								<th style="text-align:center;" colspan="3"><?php echo $fetch_query['email'] ?>
									
								</th>
								
								
								<th style="text-align:center;" colspan="3"><?php echo $fetch_query['phone'] ?>
								
								</th>
								<th style="text-align:center;" colspan="3"><?php echo $fetch_query['payment_option'] ?>
								
								</th>
						
							</tr>
						</tbody>						

								
							

					</table>
				</div>
				<!-- table starts -->                
            </div>
										<div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-10 col-md-2">
	<form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table >
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><input name="amount" value="<?php echo $get_fetch_details['amount'];?>" /></td>
          <td>First Name: </td>
          <td><input name="firstname" id="firstname" value="<?php echo $get_fetch_details['name'];?>" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php echo $get_fetch_details['email'];?>" /></td>
          <td>Phone: </td>
          <td><input name="phone" value="<?php echo $get_fetch_details['phone'];?>" /></td>
        </tr>
        <tr>
          <td>Product Info: </td>
          <td colspan="3"><textarea name="productinfo">GST Software Prebooking</textarea></td>
        </tr>
        <tr>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="https://portme.co/admin/success.php" size="64" /></td>
        </tr>
        <tr>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="https://portme.co/admin/failure.php" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
          <td><b>Optional Parameters</b></td>
        </tr>
        <tr>
          <td>Last Name: </td>
          <td><input name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" /></td>
          <td>Cancel URI: </td>
          <td><input name="curl" value="" /></td>
        </tr>
        <tr>
          <td>Address1: </td>
          <td><input name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" /></td>
          <td>Address2: </td>
          <td><input name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" /></td>
          <td>State: </td>
          <td><input name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" /></td>
        </tr>
        <tr>
          <td>Country: </td>
          <td><input name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" /></td>
          <td>Zipcode: </td>
          <td><input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF1: </td>
          <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
          <td>UDF2: </td>
          <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF3: </td>
          <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
          <td>UDF4: </td>
          <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF5: </td>
          <td><input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
          <td>PG: </td>
          <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
        </tr>
        <tr>
          <?php if(!$hash) { ?>
            <input type="submit" class="btn green" name="submit" value="Procced">
          <?php } ?>
        </tr>
      </table>
    </form>
                                                   
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
</html>
