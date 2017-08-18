<?php
include ("../config.php");
if(isset($_POST['customer_id']))
{
	$customer_id = $_POST['customer_id'];

	$select_details = mysqli_query($mysqli,"select * from customers where customer_id='".$customer_id."'");
	$fetch_details = mysqli_fetch_array($select_details);
}
?>
<div class="col-sm-12">
	<label style="font-size:20px;" >
		<?php echo $fetch_details['firstname'];?> <?php echo $fetch_details['lastname'];?>
	</label>
</div>
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
</div>
	