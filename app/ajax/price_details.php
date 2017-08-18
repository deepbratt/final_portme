<?php
include ("../config.php");
if(isset($_POST['product_id']))
{
	$product_id = $_POST['product_id'];

	$select_details = mysqli_query($mysqli,"select * from product where product_id='".$product_id."'");
	$fetch_details = mysqli_fetch_array($select_details);
}
?>

<div class="form-group" style="font-size:15px;margin-top:10px;">
<b><?php echo $fetch_details['price'];?></b>
<p class="help-block with-errors"></p>
</div>
