<?php
	include ("app/config.php");
	$plan_id = $_GET['plan'];
	if(isset($_POST['register-submit']))
	{
		$frst_name = $_POST['frst_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$business_id = md5(uniqid(rand(), true));
		$password = rand();
		$get_email_check = mysqli_query($mysqli,"select * from tbl_business where email='".$email."'");
		$get_rows = mysqli_num_rows($get_email_check);
		if($get_rows == 0)
		{
		$business_name = $_POST['enterprise'];
		$phone = $_POST['phone'];
		$state = $_POST['state'];
		$payment = $_POST['payment'];
		$regidate = time();
		$ending_date = strtotime('+1 year',  $regidate);
		$logo = "if_administrator_67249.png";
		$date  = time();
		
		$get_query = mysqli_query($mysqli,"insert into tbl_business values('','".$email."','".$password."','','','','".$phone."','','".$business_name."','".$frst_name."','".$last_name."','','".$state."','','".$logo."','inactive','".$date."','no','no','".$regidate."','".$ending_date."','pending','".$payment."','".$business_id."')");
		if($get_query)
		{
			$id = mysqli_insert_id($mysqli);
			if($payment == 'card')
			{
				echo "<script>window.location.href='payment_process.php?id=".$id."'&&plan_id=".$plan_id."'</script>";
			}
			else
			{
			
		$to = $email;
		$subject = 'Confirmation Mail';
		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Simples-Minimalistic Responsive Template</title>
      
      <style type="text/css">
         /* Client-specific Styles */
         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.*/
         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
         a img {border:none;}
         .image_fix {display:block;}
         p {margin: 0px 0px !important;}
         table td {border-collapse: collapse;}
         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
         a {color: #0a8cce;text-decoration: none;text-decoration:none!important;}
         /*STYLES*/
         table[class=full] { width: 100%; clear: both; }
         /*IPAD STYLES*/
         @media only screen and (max-width: 640px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #0a8cce; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #0a8cce !important;
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 440px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
         img[class=banner] {width: 440px!important;height:220px!important;}
         img[class=colimg2] {width: 440px!important;height:220px!important;}
         
         
         }
         /*IPHONE STYLES*/
         @media only screen and (max-width: 480px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #0a8cce; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #0a8cce !important; 
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 280px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
         img[class=banner] {width: 280px!important;height:140px!important;}
         img[class=colimg2] {width: 280px!important;height:140px!important;}
         td[class=mobile-hide]{display:none!important;}
         td[class="padding-bottom25"]{padding-bottom:25px!important;}
        
         }
      </style>
   </head>
   <body>
     
<!-- Start of header -->
<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <!-- logo -->
                                    <table width="140" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                       <tbody>
                                          <tr>
                                             <td width="169" height="45" align="center">
                                                <div class="imgpop">
                                                   <a target="_blank" href="#">
                                                   <img src="https://portme.co/images/logo.png" alt="" border="0" width="120" height="120" style="display:block; border:none; outline:none; text-decoration:none;">
												   <!--<h1>Logo</h1>-->
                                                   </a>
                                                </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <!-- end of logo -->
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of Header -->
 
<!-- Start of seperator -->
<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="seperator">
   <tbody>
      <tr>
         <td>
            <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
               <tbody>
                  <tr>
                     <td align="center" height="20" style="font-size:1px; line-height:1px;">&nbsp;</td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of seperator -->   
<!-- Start Full Text -->
<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="full-text">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                       <tbody>
                                          <!-- Title -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #666666;  line-height: 18px;" st-title="fulltext-heading">
                                               Hello '.$email.' ,
                                             </td>
                                          </tr>
                                          <!-- End of Title -->
                                          <!-- spacing -->
                                          <tr>
                                             <td width="100%" height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                          </tr>
                                          <!-- End of spacing -->
                                          <!-- content -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #666666; text-align:center; line-height: 30px;" st-content="fulltext-content">
												Thank You For Choosing PORT-ME.
                                             </td>
                                          </tr>
										   <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #666666; text-align:center; line-height: 30px;" st-content="fulltext-content">
												Here Is Your Password '.$password.' and Your Personal Business Id '.$business_id.'.
                                             </td>
                                          </tr>

										    <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #666666; text-align:center; line-height: 30px;" st-content="fulltext-content">
												Do Not Forgot To Change Your Password After Login Thanks.
                                             </td>
                                          </tr>
                                          <!-- End of content -->
										  <!-- spacing -->
                                          <tr>
                                             <td width="100%" height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                          </tr>
                                          <!-- End of spacing -->
										  
										  <!-- Footer -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #666666;text-align:center;line-height: 18px;" st-title="fulltext-heading">
												<a href="https://www.portme.co/">PORTME.CO</a>
                                             </td>
                                          </tr>
                                          <!-- End of Footer -->
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- end of full text -->





<!-- Start of Postfooter -->
<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="postfooter" >
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <tr>
                                 <td align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 14px;color: #666666" st-content="postfooter">
                                    Gracius From <a href="https://portme.co/" style="text-decoration: none; color: #0a8cce">PORTME</a> Team.
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td width="100%" height="20"></td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of postfooter -->
   
   </body>
   </html>';
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
			$headers .= 'From: <noreply@portme.co>' . "\r\n";
			$headers .= 'Cc: noreply@portme.co' . "\r\n";

		mail($to, $subject, $message, $headers);
		echo "<script>window.location.href='payment_success.php'</script>";
			}

		}
		else
		{
			$data = "error";

		}
		}
		else
		{
			$data = "email";

		}

	}
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
				<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
				<title>Portme</title>
				<!--  Favicon -->
				<?php
			include('meta_links.php');
		?>
				<script>
$(document).ready(function () {
	
   function my_function() {
		alert('yoo');
   
        $('#amar').show('fast');
    };

});
</script>
			</script>
			<style>
		label.btn span {
  font-size: 1.5em ;
}

label input[type="radio"] ~ i.fa.fa-circle-o{
    color: #c8c8c8;    display: inline;
}
label input[type="radio"] ~ i.fa.fa-dot-circle-o{
    display: none;
}
label input[type="radio"]:checked ~ i.fa.fa-circle-o{
    display: none;
}
label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
    color: #f73347;   display: inline;
}
label:hover input[type="radio"] ~ i.fa {
color: #f73347;
}

label input[type="checkbox"] ~ i.fa.fa-square-o{
    color: #c8c8c8;    display: inline;
}
label input[type="checkbox"] ~ i.fa.fa-check-square-o{
    display: none;
}
label input[type="checkbox"]:checked ~ i.fa.fa-square-o{
    display: none;
}
label input[type="checkbox"]:checked ~ i.fa.fa-check-square-o{
    color: #f73347;    display: inline;
}
label:hover input[type="checkbox"] ~ i.fa {
color: #f73347;
}

div[data-toggle="buttons"] label.active{
    color: #f73347;
}

div[data-toggle="buttons"] label {
display: inline-block;
padding: 6px 12px;
margin-bottom: 0;
font-size: 10px;
font-weight: normal;
line-height: 2em;
text-align: left;
white-space: nowrap;
vertical-align: top;
cursor: pointer;
background-color: none;
border: 0px solid 
#c8c8c8;
border-radius: 3px;
color: #c8c8c8;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}

div[data-toggle="buttons"] label:hover {
color: #f73347;
}

div[data-toggle="buttons"] label:active, div[data-toggle="buttons"] label.active {
-webkit-box-shadow: none;
box-shadow: none;
}
		</style>
			<body>
				<!-- ==============================================
                     **MAIN HEADER**
        =============================================== -->
				<?php
					include('header.php');
				?>
				<!-- ==============================================
                             **MAIN BANNER**
        =============================================== -->
		<section class="demo-request" style="margin-top:80px;">
    <div class="whtscoch" id="whtscoch">
		<div class="container">
		  <h1>Port-ME <span style="color:#c0392b;">REGISTRATION PANEL</span></h1> 
		  <p>5-Minute To Setup, Enrich Your Business To Another Level With PORTME</p>
		</div>
	</div>
</section>
					<!-- ==============================================
                             **FUNCTIONALITIES**
        =============================================== -->
					<section class="contact ptb-80">
						<div class="container">
							<div class="row">
								<?php
				if(isset($data) && $data == "success"){
			?>
								<p style="text-align:left;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;"> Registration Successfull! Please Check Your Email For Password and Business Id </p>
								<?php
			}else if(isset($data) && $data == "error"){
			?>
								<p style="text-align:center;background:#e54e53;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;"> Something went wrong! please try again later. </p>
								<?php
			}else if(isset($data) && $data == "email"){
			?>
								<p style="text-align:center;background:#e54e53;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;"> Email Already Exists! Try using another email. </p>
								<?php
			}
			?>
								<!-- End Section -->
								<div class="container">
									<div class="row main">
										<div class="col-md-8 main-login main-center" >
											<div style="height:45px;border:1px solid red;background:#f73347;">
												<p style="text-align:center;font-size:18px;color:white;margin-top:6px;">Registration</p>
											</div>
											<form   method="post" role="form" style="margin-top:15px;">
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
													<div class="input-group">
														<span class="input-group-addon" style="background:white;">
															<i class="fa fa-user fa" aria-hidden="true"></i>
														</span>
														<input type="text" class="form-control" style="background:#f0f0f0;" required name="frst_name" id="name"  placeholder="Enter Your First Name"/>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
													<div class="input-group">
														<span class="input-group-addon" style="background:white;">
															<i class="fa fa-user fa" aria-hidden="true"></i>
														</span>
														<input type="text" class="form-control" style="background:#f0f0f0;" required name="last_name" id="name"  placeholder="Enter Your Last Name"/>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
													<div class="input-group">
														<span class="input-group-addon" style="background:white;">
															<i class="fa fa-envelope fa" aria-hidden="true"></i>
														</span>
														<input type="text" class="form-control" style="background:#EEEEEE;" required name="email" id="email"  placeholder="Enter your Email"/>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
													<div class="input-group">
														<span class="input-group-addon" style="background:white;">
															<i class="fa fa-pencil" aria-hidden="true"></i>
														</span>
														<input type="text" class="form-control" style="background:#EEEEEE;" required name="enterprise" id="entrprice"  placeholder="Enter your Enterprise name"/>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
													<div class="input-group">
														<span class="input-group-addon" style="background:white;">
															<i class="fa fa-phone fa" aria-hidden="true"></i>
														</span>
														<input type="text" class="form-control" style="background:#EEEEEE;" required name="phone" id="phone"  placeholder="Enter your phone number"/>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
													<div class="input-group">
														<span class="input-group-addon" style="background:white;">
															<i class="fa fa-building fa" aria-hidden="true"></i>
														</span>
														<select name="type" name="state" class="form-control" style="background:#EEEEEE;" required>
															<option value="" selected="" disabled=""> Type of State </option>
															<?php
										$state_query = mysqli_query($mysqli,"select * from states");
										while($get_fetch = mysqli_fetch_array($state_query))
										{
									?>
															<option value="
																<?php echo $get_fetch['states_code']?>" >
																<?php echo $get_fetch['states_name']?>
															</option>
															<?php
										}
									?>
														</select>
													</div>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="amar" style="padding:20px;">
													<div class="col-md-2 col-md-offset-1 " >
														<p>Payment ?
															<p>
															</div>
															<div class="col-md-3" >
																<div class="btn-group btn-group-vertical" data-toggle="buttons">
																	<label class="btn active">
																		<input type="radio" name='payment' value="cash">
																			<i class="fa fa-circle-o fa-2x"></i>
																			<i class="fa fa-dot-circle-o fa-2x"></i>
																			<span> Cash Payment</span>
																		</label>
																	</div>
																</div>
																<div class="col-md-3" >
																	<div class="btn-group btn-group-vertical" data-toggle="buttons">
																		<label class="btn active">
																			<input type="radio" name='payment' value="card">
																				<i class="fa fa-circle-o fa-2x"></i>
																				<i class="fa fa-dot-circle-o fa-2x"></i>
																				<span> Card Payment</span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="form-group" style="padding-top:15px;">
																	<div class="row">
																		<div class="col-sm-6 col-sm-offset-3">
																			<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" style="background:#f73347;color:white;"  value="Register Now">
																			</div>
																		</div>
																	</div>
																</form>
															</div>
															<?php
																if($_GET['plan'] == 1)
																{
															?>
															<div class="col-lg-4 col-md-4  col-sm-6 col-xs-12" ">
																<div style="border:2px solid #981c34;  height:300px; width:100%; float:left; background:#ececec; border-radius:20px;">
																	<center><img src="images/Rupee-Symbol-PNG-Transparent-Image.png" width="20%" style=" margin-left:-40px; "/></center>
																	<h6 style="font-size:18px; text-align:center;padding-top:5px;  font-weight:500;">BILLING SOFTWARE WITH GST.</h6>
																	<span style="margin-left:165px;"><i class="fa fa-plus fa-2" style="font-color:#f73347;" aria-hidden="true"></i></span>
																	<h6 style="font-size:18px; text-align:center;  font-weight:500;">SUPPORT</h6>
																	<hr class="line-tab" />
																	<h5 style="font-size:30px; text-align:center; margin-bottom:20px;"><b> Rs. 5,999/ Year</b><br/><span style="font-size:14px;"> all-inclusive</span></h5>
                   
																</div>
															</div>
															<?php
															}
																if($_GET['plan'] == 2)
																{
															?>
															<div class="col-lg-4 col-md-4  col-sm-6 col-xs-12" ">
																<div style="border:2px solid #981c34;  height:300px; width:100%; float:left; background:#ececec; border-radius:20px;">
																	<center><img src="images/Rupee-Symbol-PNG-Transparent-Image.png" width="20%" style=" margin-left:-40px; "/></center>
																	<h6 style="font-size:18px; text-align:center;padding-top:5px;  font-weight:500;">GST SOFTWARE AND SUPPORT</h6>
																	<span style="margin-left:165px;"><i class="fa fa-plus fa-2" style="font-color:#f73347;" aria-hidden="true"></i></span>
																	<h6 style="font-size:18px; text-align:center;  font-weight:500;">GST ID, TAX FILING AND INVOICING</h6>
																	<hr class="line-tab" />
																	<h5 style="font-size:30px; text-align:center; margin-bottom:20px;"><b> Rs. 10,999/ Year</b><br/><span style="font-size:14px;"> all-inclusive</span></h5>
                   
																</div>
															</div>
															<?php
																}
																if($_GET['plan'] == 3)
																{
															?>
																<div class="col-lg-4 col-md-4  col-sm-6 col-xs-12" ">
																<div style="border:2px solid #981c34;  height:300px; width:100%; float:left; background:#ececec; border-radius:20px;">
																	<center><img src="images/Rupee-Symbol-PNG-Transparent-Image.png" width="20%" style=" margin-left:-40px; "/></center>
																	<h6 style="font-size:18px; text-align:center;padding-top:5px;  font-weight:500;">GST SOFTWARE AND SUPPORT</h6>
																	<span style="margin-left:165px;"><i class="fa fa-plus fa-2" style="font-color:#f73347;" aria-hidden="true"></i></span>
																	<h6 style="font-size:18px; text-align:center;  font-weight:500;">COMPUTER AND PRINTER</h6>
																	<hr class="line-tab" />
																	<h5 style="font-size:30px; text-align:center; margin-bottom:20px;"><b> Rs. 19,999/ Year</b><br/><span style="font-size:14px;"> all-inclusive</span></h5>
                   
																</div>
															</div>
															<?php
																}
															?>
														</div>
													</div>
												</div>
											</div>
											<!-- End Container -->
										</section>
										<!-- End Section -->
										<!-- ==============================================
                             **FOOTER STARTS**
        =============================================== -->
										<?php
					include('footer.php');
				?>
										<!-- End Footer -->
										<!-- jQuery -->
										<script src="js/jquery.min.js"></script>
										<!-- Bootstrap JS -->
										<script src="js/bootstrap.min.js"></script>
										<!-- Modenizer JS -->
										<script src="js/modernizr-custom.js"></script>
										<!-- Bootsvav Menu -->
										<script src="assets/bootsnav-master/js/bootsnav.js" type="text/javascript"></script>
										<!-- Parallax -->
										<script src="js/paraxify.min.js" type="text/javascript"></script>
										<!-- Way Points -->
										<script src="js/waypoints.min.js" type="text/javascript"></script>
										<!-- Conterup -->
										<script src="js/jquery.counterup.min.js" type="text/javascript"></script>
										<!-- Custom JS -->
										<script src="js/custom.js"></script>
										<!-- ==============================================
                ** STYLE SWITCHER-ONLY FOR DEMO PURPOSE**
        =============================================== -->
										<!--Style Switcher Script-->
										<script src="js/style-switcher.js"></script>
										<!--End Style Switcher-->
									</body>
								</html>
