<?php
include ("../config.php");
	$business_id = $_SESSION['business_id'];

	$salutation = $_POST['sal'];
	$firstname = $_POST['fname'];
	$lastname = $_POST['lname'];
	$company_name = $_POST['cname'];
	$email = $_POST['email'];
	$work_phone = $_POST['wphone'];
	$mobile = $_POST['mobile'];
	$gst = $_POST['gst'];
	$billing_address = $_POST['address'];
	$billing_state = $_POST['bstate'];
	$shipping_address = $_POST['saddress'];
	$shipping_state = $_POST['sstate'];
	$notes = $_POST['notes'];
	$date = time();

	$insert_customer_details = mysqli_query($mysqli, "insert tbl_contacts values ('','customer','".$business_id."','".$salutation."','".$firstname."','".$lastname."','".$company_name."','".$email."','".$work_phone."','".$mobile."','".$gst."','".$billing_address."','".$billing_state."','INDIA','".$shipping_address."','".$shipping_state."','INDIA','".$notes."','active')");
	if($insert_customer_details)
	{
		$data = "".$firstname." ".$lastname."-".$mobile."";
	}
	else
	{
		$data = "".$firstname." ".$lastname."-".$mobile."";
	}
?>