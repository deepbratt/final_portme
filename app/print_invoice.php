<?php
include ("config.php");
$business_id = $_SESSION['business_id'];
$order_id = $_GET['order_id'];
$bill_info = mysqli_query($mysqli, "select * from tbl_transactions where business_id='".$business_id."' and tbl_transaction_id ='".$order_id."'");
$fetch_bill_info = mysqli_fetch_array($bill_info);
?>

<!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Port-ME | Sales Order
    </title>
    <?php include("metalinks.php");?>
    <style>
      .padmar{
        margin:0px !important;
        padding:0px !important;
		
      }
	  .form-control{
		height:40px !important;
	  }
    </style>
  </head>
  <body>
    <!--[if lt IE 8]>s
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
            <div class="rs-dashhead m-b-lg" style="background:#f5f5f5">
              <div class="rs-dashhead-content">
                <div class="rs-dashhead-titles">
                  <h3 class="rs-dashhead-title m-t">
                    Print Sales Order :
                    <div style="float:right;">
					  <a  class="fa fa-backward btn btn-success " href="sales_order.php" >Back</a>
					  <button type="button" class=" fa fa-print btn btn-success " onclick="javascript:printDiv('printablediv')"> PRINT </button>
                    </div>
                  </h3>
                </div>
              </div>

            </div>

	<div id="printablediv" >
		<form id="" runat="server">
					<?php
						$owner_id = $fetch_bill_info['business_id'];
						$get_owner_info = mysqli_query($mysqli, "select * from tbl_business where business_id = '".$owner_id."'");
						$fetch_owner_info = mysqli_fetch_array($get_owner_info);

						$owner_state_id = $fetch_owner_info['state'];
						$get_owner_state_info = mysqli_query($mysqli, "select * from states where states_id = '".$owner_state_id."'");
						$fetch_owner_state_info = mysqli_fetch_array($get_owner_state_info);

						
								
					?> 
                
                
				
				<!-- table starts -->
				<div class="panel panel-plain panel-rounded " style="padding:15px;">
					<table class="table table-b-t table-b-b datatable-default rs-table table-striped table-bordered" style="border-right:1px solid #f5f5f5;border-left:1px solid #f5f5f5;">

						<thead colspan="12">
						   <tr style="font-size:15px;">
								<th colspan="4" style="text-align:left;">
									<div class="col-sm-12">
									  <label style="font-size:30px;"><?php echo $fetch_owner_info['enterprise_name'];?></label>
									</div>
									<div class="col-sm-12">
									  <label style="font-size:17px;"><?php echo $fetch_owner_info['owners_firstname'];?>&nbsp;&nbsp;<?php echo $fetch_owner_info['owners_lastname'];?></label>
									</div> 
									<div class="col-sm-12">
									  <label style="font-size:17px;"><?php echo $fetch_owner_info['address'];?>&nbsp;&nbsp;<?php echo $fetch_owner_state_info['states_name'];?>-<?php echo $fetch_owner_state_info['states_code'];?>&nbsp;&nbsp;<?php echo $fetch_owner_info['country'];?>
									  </label>
									</div>
								</th>
								

								<?php
								$customer_id = $fetch_bill_info['customer_id'];
								$get_customer_info = mysqli_query($mysqli, "select * from tbl_contacts where customer_id = '".$customer_id."'");
								$fetch_customer_info = mysqli_fetch_array($get_customer_info);
								
								$customer_state_id = $fetch_customer_info['state'];
								$get_customer_state_info = mysqli_query($mysqli, "select * from states where states_id = '".$customer_state_id."'");
								$fetch_customer_state_info = mysqli_fetch_array($get_customer_state_info);

								?> 

								<th colspan="5" style="text-align:center;">
									<div class="col-sm-12">
									  <label style="font-size:30px;"><?php echo $fetch_customer_info['salutation'];?>&nbsp;&nbsp;<?php echo $fetch_customer_info['first_name'];?>&nbsp;&nbsp;<?php echo $fetch_customer_info['last_name'];?></label>
									</div>
									<div class="col-sm-12">
									  <label style="font-size:17px;"><?php echo $fetch_customer_info['mobile'];?>,<?php echo $fetch_customer_info['work_phone'];?>
									  </label>
									</div> 
									<div class="col-sm-12">
									  <label style="font-size:17px;"><?php echo $fetch_customer_info['address'];?>&nbsp;&nbsp;<?php echo $fetch_customer_state_info['states_name'];?>-<?php echo $fetch_customer_state_info['states_code'];?>&nbsp;&nbsp;<?php echo $fetch_customer_info['country'];?>
									  </label>
									</div> 
								</th>

								<th colspan="3" style="text-align:right;">
									<div class="col-sm-12">
									  <label style="font-size:30px;">Invoice</label>
									</div>
									<div class="col-sm-12">
									  <label style="font-size:19px;"><?php echo $fetch_bill_info['invoice_no'];?>
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
						<tbody>

							<tr>
								<th style="text-align:center;"><i class="fa fa-shopping-bag" aria-hidden="true"></i></th>
								<th style="text-align:center;"><i class="fa fa-table" aria-hidden="true"></i></th>
								<th style="text-align:center;"><i class="fa fa-balance-scale" aria-hidden="true"></i></th>
								<th style="text-align:center;"><i class="fa fa-inr" aria-hidden="true"></i></th>										
								<th style="text-align:center;"><i class="fa fa-percent" aria-hidden="true"></i></th>								
								<th style="text-align:center;">CGST</th>
								<th style="text-align:center;">SGST</th>
								<th style="text-align:center;">IGST</th>
								<th style="text-align:center;"><i class="fa fa-inr" aria-hidden="true"></i></th>
								<th style="text-align:center;"><i class="fa fa-inr" aria-hidden="true"></i></th>
								<th style="text-align:center;"><i class="fa fa-inr" aria-hidden="true"></i></th>
								<th style="text-align:center;"><i class="fa fa-inr" aria-hidden="true"></i></th>

							
							</tr>
							<?php
								$product_id = explode(",",$fetch_bill_info['product_id_array']);
								 $count = sizeof($product_id);
								for($i=0;$i<$count; $i++){
									
								?>
							<tr>
								<th style="text-align:center;">								
									<?php 
									$pid = $product_id[$i];
									$fetch_pro_name = mysqli_query($mysqli,"SELECT * FROM tbl_products WHERE product_id='$pid'");
									$fetch_p_details = mysqli_fetch_array($fetch_pro_name);
									echo $fetch_p_details['name'];
									?>
								</th>
								
								<th style="text-align:center;">
									<?php
										$hsn_array = explode(",",$fetch_bill_info['hsn_array']);
										echo $hsn_array[$i];
									?>
								</th>
								<th style="text-align:center;">
								<?php
										$qty = explode(",",$fetch_bill_info['qty_array']);
										echo $qty[$i];
								?>
								</th>
								<th style="text-align:center;">
								<?php
										$unit_price = explode(",",$fetch_bill_info['unit_price_array']);
										echo $unit_price[$i];
								?>
								</th>										
								<th style="text-align:center;">
								<?php
										$tax_rate = explode(",",$fetch_bill_info['tax_rate_array']);
										echo $tax_rate[$i];
								?>
								</th>
								<th style="text-align:center;">
								<?php
										$cgst = explode(",",$fetch_bill_info['tax_cgst_array']);
										echo $cgst[$i];
								?>
								</th>
								<th style="text-align:center;">
								<?php
										$sgst = explode(",",$fetch_bill_info['tax_sgst_array']);
										echo $sgst[$i];
								?>.
								</th>
								<th style="text-align:center;">
								<?php
										$igst = explode(",",$fetch_bill_info['tax_igst_array']);
										echo $igst[$i];
								?>
								</th>
								<th style="text-align:center;">
								<?php
										$cess = explode(",",$fetch_bill_info['tax_cess_array']);
										echo $cess[$i];
								?>
								</th>
								<th style="text-align:center;">
								<?php
										$tax_val = explode(",",$fetch_bill_info['tax_value_array']);
										echo $tax_val[$i];
								?>
								</th>
								<th style="text-align:center;">
								<?php
										$discount = explode(",",$fetch_bill_info['discount_array']);
										echo $discount[$i];
								?>
								</th>
								<th style="text-align:center;">
								<?php
										$total = explode(",",$fetch_bill_info['total_array']);
										echo $total[$i];
								?>
								</th>
						
							</tr>
							<?php
							}
							?>
				
							

							<tr>
								<th colspan="9"></th>
								

								<th colspan="1" style="text-align:center;font-size:18px;">SubTotal</th>
								<th colspan="2" style="text-align:center;font-size:18px;"><i class="fa fa-inr"></i><?php echo $fetch_bill_info['subtotal']; ?></th>			
							</tr>

							<tr>
								<th colspan="9"></th>
								
								<th colspan="1" style="text-align:center;font-size:18px;">Discount</th>
								<th colspan="2" style="text-align:center;font-size:18px;"><i class="fa fa-inr"></i> <?php echo $fetch_bill_info['total_discount']; ?></th>			
							</tr>

							<tr>
								<th colspan="9"></th>
								
								<th colspan="1" style="text-align:center;font-size:25px;">Total</th>
								<th colspan="2" style="text-align:center;font-size:25px;"><i class="fa fa-inr"></i> <?php echo $fetch_bill_info['total']; ?></th>			
							</tr>

						</tbody>						

								
							

					</table>
				</div>
				<!-- table starts -->                



			  		
            </div>

          </div>

		</form>
		<?php include("footer.php");?>
        </div>
		
	</div>

      </article>
   
	  <?php include("sales_order_add_customer.php");?>
	  

      <script src="js/bootstrap-switch.min.js"></script>
      <script src="js/bootstrap-switch-example.js"></script>
      <script src="js/cleave.min.js"></script>
      <script src="js/cleave-phone.au.js"></script>
      <script src="js/cleave-example.js"></script>
      <script src="js/bootstrap-datepicker.min.js"></script>
      <script src="js/jquery.maskedinput.min.js"></script>
      <script src="js/maskedinput-example.js"></script>
      <script src="js/bootstrap-maxlength.min.js"></script>
      <script src="js/maxlength-example.js"></script>
      <script src="js/selectize.min.js"></script>
	  <script src="js/datepicker-example.js"></script>
      <script src="js/selectize-example.js"></script>
      <script src="js/validator.min.js"></script>

	

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
			location.reload()

          
        }
    </script>

      </body>
    </html>
