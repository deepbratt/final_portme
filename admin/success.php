<?php
include("config.php");
$status=$_POST["status"];
$firstname=$_POST["firstname"];

$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="2bwyroQl";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction Please try again";
		   }
	   else {
			$coustomer_email = $_POST['email'];
			$get_coustomer_query = mysqli_query($mysqli,"select * from prebooking_customers where email='".$coustomer_email."'");
			$get_fetch_coustomer = mysqli_fetch_array($get_coustomer_query);
           $update_payment = mysqli_query($mysqli,"update prebooking_customers set payment_status='paid' where id='".$get_fetch_coustomer['id']."'");
		   $coustomer_id = $get_fetch_coustomer['id'];
		   if($update_payment)
		   {
				echo "<script>window.location.href='https://portme.co/admin/print_user.php?customer_id='.$coustomer_id.'</script>";
		   }
		   else
		   {
		   }
           
		   }         
?>	