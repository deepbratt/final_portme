<?php
	include("../config.php");

	/*item fields */
	$product_id = $_POST['p_id'];

	$hsn = $_POST['hsn'];
	$unit_price = $_POST['unit_price'];
	/*product er details*/
	$get_pro_details = mysqli_query($mysqli,"SELECT * FROM tbl_products JOIN tbl_productcat WHERE tbl_products.productcat_id = tbl_productcat.productcat_id AND tbl_products.product_id='$product_id'");
	$fetch_product_details = mysqli_fetch_array($get_pro_details);
	$name = $fetch_product_details['name'];
	$selling_price = $fetch_product_details['selling_price'];
	$hsn = $fetch_product_details['HSN_code'];

	
	
	if($_POST['tax_rate'] == ""){
		$actual_tax_rate = $fetch_product_details['tax_rate'];
	}else{
		$actual_tax_rate = $_POST['tax_rate'];
	}
	/*product er details ends */

	$qty = $_POST['qty'];
	$select_total_qty = mysqli_query($mysqli,"select * from tbl_products where product_id='$product_id'");
	$fetch_total_qty = mysqli_fetch_array($select_total_qty);
	if($qty > $fetch_total_qty['qty']){
		$sold_data = "sold_out";
	}
	


	$unit_price = $fetch_product_details['selling_price'];
	$product_price = $qty*$selling_price;
	
	$tax_rate = $actual_tax_rate/100;

	
	$cgst = $_POST['cgst'];
	$sgst = $_POST['sgst'];
	$igst = $_POST['igst'];
	$cess = $_POST['cess'];
	$tax_val = $_POST['tax_val'];

	$cus_state = $_POST['cus_state'];
	$business_id = $_SESSION['business_id'];
	$get_business_stateid = mysqli_query($mysqli,"SELECT * FROM tbl_business WHERE business_id='$business_id'");
	$fetch_business_stateid = mysqli_fetch_array($get_business_stateid);
	$business_state = $fetch_business_stateid['state'];


	if($tax_val != '0' || $tax_val != ''){
		if($business_state != $cus_state){
			$cgst = "00.00";
			$sgst = "00.00";
			$igst = $product_price*$tax_rate;
		}else{
			
			$cgst = ($product_price*$tax_rate)/2;
			$sgst = ($product_price*$tax_rate)/2;
			$igst = "00.00";
		}
	}else{
		$tax_rate = "00.00";
		$tax_val = "00.00";
		$cgst = "00.00";
		$sgst = "00.00";
		$igst = "00.00";
	}

	$discount = $_POST['discount'];
	$tax_val = $cgst + $sgst + $igst + $cess;
	$total_tax_rate = $product_price * $tax_rate ;
	$total_price = $product_price + $total_tax_rate + $tax_val - $discount;

	$product_price = $qty*$selling_price;

	
	/*item fields ends */

	



	$response = array("pid"=> $product_id ,"hsn"=> $hsn , "qty" => $qty , "unit_price" => number_format($unit_price, 2, '.', ''),"tax_rate" => $actual_tax_rate , "cgst" => number_format($cgst, 2, '.', '') , "sgst" => number_format($sgst, 2, '.', '') , "igst" => number_format($igst, 2, '.', ''), "cess" =>number_format($cess, 2, '.', ''), "tax_val" => number_format($tax_val, 2, '.', ''), "disount" => number_format($discount, 2, '.', ''), "total" => number_format($total_price, 2, '.', '') , "sub_total" => $product_price ,"sold_data" => $sold_data);
	header("Content-Type: application/json");
	echo json_encode($response);
?>