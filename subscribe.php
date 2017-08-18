<?php
	include('config.php');
	if(isset($_POST['submit']))
	{
		$user_id = $_POST['user_id'];
		$product_id = $_POST['product_id'];
	
		$date = time();
		$get_subscribed = mysqli_query($mysqli,"insert into subscribed_list values('','".$product_id."','".$user_id."','".$date."','pending')");
		if($get_subscribed)
		{
			$data = "successfull";
			echo "<script>setTimeout(function(){ window.location.href='success.php' }, 3000);</script>";

		}
		else
		{
			$data = "error";
			echo "<script>setTimeout(function(){ window.location.href='failure.php' }, 3000);</script>";
		}

	}

?>

<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "ExFRDwDa";

// Merchant Salt as provided by Payu
$SALT = "aa9AA2JetB";

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
<?php
$user_id = $_SESSION['user_id'];
$user_query = mysqli_query($mysqli,"select * from user where id = '".$user_id."'");
$user_fetch = mysqli_fetch_array($user_query);
?>
<!DOCTYPE html>
<html class="no-js" lang="en-US">
	<head>
		<meta charset="UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Checkout &#8211; Skilled</title>
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
		<?php include ("meta_links.php"); ?>
	</head>
			<body onload="submitPayuForm()" class="page page-id-2556 page-template page-template-page-fullwidth page-template-page-fullwidth-php woocommerce-checkout woocommerce-page wpb-js-composer js-comp-ver-4.10 vc_responsive woocommerce">
				<?php
	include ("header1.php");
?>
									<div class="cbp-row wh-page-title-bar">
										<div class="cbp-container">
											<div class="one whole wh-padding wh-page-title-wrapper">
												<h1 class="page-title">Checkout</h1>
												<div class="wh-breadcrumbs align-left">
													<nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
														<ul class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">
															<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="trail-item trail-begin">
																<a href="index.php" rel="home">
																	<span itemprop="name">Home</span>
																</a>
																<meta itemprop="position" content="1" />
															</li>
															<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="trail-item trail-end">
																<span itemprop="name">Checkout</span>
																<meta itemprop="position" content="2" />
															</li>
														</ul>
													</nav>
												</div>
											</div>
										</div>
									</div>
									<div class="cbp-row wh-content">
										<div class="cbp-container">
											<?php
													if(isset($_GET['data']) && $_GET['data'] == 'success')
													{
													
													?>
														<div id="successMessage" style="border:1px solid black;text-align:center;padding:11px;border-radius:2px;">
															<p style="color:black;">Congratulations!!! You have successfully Subscribed This Course.</p>
														</div>
													<?php
													}else if(isset($_GET['data']) && $_GET['data'] == 'error')
													{
													?>
														<div id="successMessage" style="border:1px solid black;text-align:center;padding:11px;border-radius:2px;">
															<p style="color:black;">Oops!!! Something went wrong. Please try again.</p>
														</div>
													<?php
														}
													
													?>
											<div class="three fourths wh-padding wh-content-inner">
											
												<div class="woocommerce">
													<form  method="POST"  enctype="multipart/form-data">
														<h3 id="order_review_heading">Your order</h3>
														<div id="order_review" class="woocommerce-checkout-review-order">
															<table class="shop_table woocommerce-checkout-review-order-table">
																<thead>
																	<tr>
																		<th class="product-name">Course Name</th>
																		<th class="product-total">Total Price</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	if($_SESSION['cart'] > 0)
																	{
																		
																		$total = 0;
																		foreach($_SESSION['cart'] As $key => $value)
																		{
																			
																			$get_course_query = mysqli_query($mysqli,"select * from courses where course_id='".$key."'");
																			$get_fetch_course = mysqli_fetch_array($get_course_query);
									

																	?>


																	<tr class="cart_item">
																		<td class="product-name">
																		<?php echo $get_fetch_course['course_title'];?>&nbsp;							 
																			
																		</td>
																		<td class="product-total">
																			<span class="amount"><i class="fa fa-inr"></i> <?php echo $get_fetch_course['course_price'];?></span>
																		</td>
																	</tr>
																</tbody>
																<?php
																		}
																	
																?>
																<tfoot>
																	<tr class="cart-subtotal">
																		<th>Subtotal</th>
																		<td>
																			<span class="amount"><i class="fa fa-inr"></i> <?php echo $get_fetch_course['course_price'];?></span>
																		</td>
																	</tr>
																	<tr class="order-total">
																		<th>Total</th>
																		<td>
																			<strong>
																				<span class="amount"><i class="fa fa-inr"></i> <?php echo $get_fetch_course['course_price'];?></span>
																			</strong>
																		</td>
																	</tr>
																</tfoot>
																<?php
																	}
																else{

																?>
																<h3>there are no products is here</h3>
																<?php
																}
																?>
															</table>
															<div id="payment" class="woocommerce-checkout-payment">
																<!-- <ul class="payment_methods methods">
																	<li>Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.</li>
																</ul> -->
																<div class="form-row place-order">
																	<noscript>Since your browser does not support JavaScript, or it is disabled, please ensure you click the 
																		<em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.
																		<br/>
																		<input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals" />
																	</noscript>
																	
																	<input type="hidden" id="_wpnonce" name="user_id" value="<?php echo $value;?>" />
																	<input type="hidden" name="course_id" value="<?php echo $key;?>" />




																	
																	
																</div>
															</div>
														</div>
													</form>
											<form action="<?php echo $action; ?>" method="post" name="payuForm">
											  <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
											  <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
											  <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
											  <table style="display:none;">
												<tr>
												  <td><b>Mandatory Parameters</b></td>
												</tr>
												<tr>
												  <td>Amount: </td>
												  <td><input name="amount" value="1" /></td>
												  <td>First Name: </td>
												  <td><input name="firstname" id="firstname" value="<?php echo $user_fetch['name'] ?>" /></td>
												</tr>
												<tr>
												  <td>Email: </td>
												  <td><input name="email" id="email" value="<?php echo $user_fetch['email'] ?>" /></td>
												  <td>Phone: </td>
												  <td><input name="phone" value="<?php echo $user_fetch['phone'] ?>" /></td>
												</tr>
												<tr>
												  <td>Product Info: </td>
												  <td colspan="3"><textarea name="productinfo"><?php echo $get_fetch_course['course_id'] ?></textarea></td>
												</tr>
												<tr>
												  <td>Success URI: </td>
												  <td colspan="3"><input name="surl" value="http://portme.co/beta2/success.php" size="64" /></td>
												</tr>
												<tr>
												  <td>Failure URI: </td>
												  <td colspan="3"><input name="furl" value="http://portme.co/beta2/failure.php" size="64" /></td>
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
												  
													<td colspan="4"></td>
												  
												</tr>
											  </table>
											  <?php if(!$hash) { ?>
												
												<input type="submit" id="place_order" value="Place order" data-value="Place order" name="submit" />
												<?php } ?>
											</form>
												</div>
											</div>
										
											<div class="wh-sidebar one fourth wh-padding">
										
												<div class="widget scp_latest_posts-2 widget-latest-posts">
													<h5 class="widget-title">Related Course</h5>
													<hr />
													<?php
												
														$get_related_query = mysqli_query($mysqli,"select * from courses where course_subcategory='".$get_fetch_course['course_subcategory']."' and course_id != '".$get_fetch_course['course_id']."' ");
														while($related_course_fetch = mysqli_fetch_array($get_related_query))
														{
													?>
													<div class="widget-post-list-item show-image">
														<div class="thumbnail">
															<a href="course_details.php?course_id=<?php echo $related_course_fetch['course_id'];?>" title="<?php echo $related_course_fetch['course_title'];?>">
																<img width="150" height="150" src="admin/uploads/<?php echo $related_course_fetch['course_image'];?>" class="attachment-thumbnail size-thumbnail wp-post-image" alt="10" srcset="admin/uploads/<?php echo $related_course_fetch['course_image'];?>" sizes="(max-width: 150px) 100vw, 150px" />
															</a>
														</div>
														<div class="title">
															<a title="<?php echo $related_course_fetch['course_title'];?>" href="course_details.php?course_id=<?php echo $related_course_fetch['course_id'];?>"><?php echo $related_course_fetch['course_title'];?></a>
														</div>
														<div class="meta-data">
															<span class="date">
																<i class="lnr lnr-clock"></i> <?php echo date("F j, g:i a",$related_course_fetch['course_date']) ?>                   
															</span>
															<span class="comments-count">
																<i class="fa fa-comment-o"></i>&nbsp;

																<a href=""><?php
																	$get_comment_count_query = mysqli_query($mysqli,"select * from comment where course_id='".$get_fetch_course['course_id']."'");
																	$get_count_comment = mysqli_num_rows($get_comment_count_query);
																	echo $get_count_comment;
																?></a>
															</span>
														</div>
													</div>
													<?php
														}
														
													?>
												
												</div>
											
											</div>
										</div>
									</div>
	<?php
		include ("footer.php.php");
	?>
								</body>
							</html>
