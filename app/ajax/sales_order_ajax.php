<!--<?php
require("../config.php");
if(isset($_POST['product_id']))
{
	$product_id = $_POST['product_id'];
	$select_query = mysqli_query($mysqli,"select * from product where product_id='".$product_id."'");
	$fetch_query = mysqli_fetch_array($select_query);
	$tax_name = $fetch_query['tax_name'];
	$price = $fetch_query['price'];

	 $return_arr[] = array("tax_name" => $tax_name,
                    "price" => $price);

	 echo json_encode($return_arr);
}
?>-->

<?php

include "config.php";
if(isset($_POST['product_id']))
{

$return_arr = array();
$product_id = $_POST['product_id'];

$query = "SELECT * FROM product where product_id = '".$product_id."'";

$fetch_query = mysqli_fetch_array($query);

while($row = mysqli_fetch_array($result)){
    $tax_name = $fetch_query['tax_name'];
    $price = $fetch_query['price'];
   

    $return_arr[] = array("tax_name" => $tax_name,
                    "price" => $price,);
}

// Encoding array in JSON format
echo json_encode($return_arr);
}