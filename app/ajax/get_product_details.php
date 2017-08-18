<?php
include ("../config.php");
if(isset($_POST['product_id']))
{
	$product_id = $_POST['product_id'];

	$select_details = mysqli_query($mysqli,"select * from product where product_id='".$product_id."'");
	$fetch_details = mysqli_fetch_array($select_details);
}
?>

<div class="form-group">
<label><?php echo $fetch_details['tax_name'];?>&nbsp;<?php echo $fetch_details['tax_rate'];?></label>
</div>



<!--
<div class="col-sm-12">
	<label style="font-size:15px;">
		<?php echo $fetch_details['billing_street'];?> <?php echo $fetch_details['billing_city'];?>
	</label>
</div>
<div class="col-sm-12">
	<label style="font-size:15px;">
		<?php echo $fetch_details['billing_state'];?>
	</label>
</div>
<div class="col-sm-12">
	<label style="font-size:15px;">
		<?php echo $fetch_details['billing_zip'];?>
	</label>
</div> -->
	