<?php
	include("../config.php");
	$value = $_POST['suggest'];

	$get_cust_query = mysqli_query($mysqli,"SELECT * FROM tbl_contacts WHERE customer_id='$value'");
	$fetch_cust_query = mysqli_fetch_array($get_cust_query);
	
?>

<div class="col-sm-12">
	<label style="font-size:20px;border-bottom:1px solid #CCC;" class="fname_lname">
		CUSTOMER DETAILS
	</label>
</div>
<div class="col-sm-12">
	<label style="font-size:20px;" class="fname_lname">
		<?php echo ucfirst($fetch_cust_query['first_name']);?>&nbsp;<?php echo ucfirst($fetch_cust_query['last_name']);?>
	</label>
</div>
<div class="col-sm-12" class="street_city">
	<label style="font-size:15px;">
		<?php echo $fetch_cust_query['mobile'];?> , <?php echo $fetch_cust_query['email'];?>
	</label>
</div>
<div class="col-sm-12" class="state_zip">
	<label style="font-size:15px;">
		<?php echo ucfirst($fetch_cust_query['address']);?><br /> 
		<?php 
			$state = $fetch_cust_query['state'];
			$get_state_details = mysqli_query($mysqli,"SELECT * FROM states WHERE states_code='$state'");
			$fetch_state_details = mysqli_fetch_array($get_state_details);

			echo ucfirst($fetch_state_details['states_name']);
		?>
		-
		<span class="p_o_s_c"><?php echo $fetch_state_details['states_code']; ?></span>
	</label>
</div>