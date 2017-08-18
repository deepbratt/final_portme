<?php
include("app/config.php");
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
			
		   $regidate = time();
		   $ending_date = strtotime('+1 year',  $regidate);
           $update_payment = mysqli_query($mysqli,"update tbl_business set subscription_startdate='".$regidate."',subscription_enddate='".$ending_date."',payment_status='".$status."' where email='".$email."'");
		   if($update_payment)
		   {
				echo "<script>window.location.href='https://portme.co/payment_success.php?payment_status=".$status."&&email=".$email."'</script>";
		   }
		   else
		   {
		   }
           
		   }         
?>	