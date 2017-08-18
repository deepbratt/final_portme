<?php
	include ("app/config.php");
	if(isset($_POST['register-submit']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$enterprise_name = $_POST['entrprice'];
		$phone = $_POST['phone'];

		$get_efileing_leeds = mysqli_query($mysqli,"insert into efileing_leeds values('','".$name."','".$email."','".$enterprise_name."','".$phone."')");
		if($get_efileing_leeds)
		{
			$data = "success";
		}
		else
		{
			$data = "failed";
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
       

		<section class="demo-request ">
			<div class="whtscoch" id="whtscoch">
				<div class="container">
				  <h1>Port-ME <span style="color:#c0392b;">Registration/span></h1> 
				  <p style="margin-top:45px;">Request For Submitting E-Fileing Process</p>
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
				<p style="text-align:left;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;"> You Have Successfully Request For E-Fileing,Our Exicutive Will Call You In An Hour!! </p>
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

        <div class="container" style="margin-top:21px;">
			<div class="row main">
				<div class="col-md-8 main-login main-center" >
					<div style="height:45px;border:1px solid red;background:#f73347">
						<p style="text-align:center;font-size:18px;color:white;">Request For E-Fileing</p>
					</div>
					<form id="register-form"  method="post" role="form" style="margin-top:15px;">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
                                <div class="input-group">
									<span class="input-group-addon" style="background:white;"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" style="background:#f0f0f0;" required name="name" id="name"  placeholder="Enter your Name"/>
								</div>
                             </div>
							 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
                                <div class="input-group">
									<span class="input-group-addon" style="background:white;"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" style="background:#f0f0f0;" required name="email" id="name"  placeholder="Enter your email"/>
								</div>
                             </div>

                           

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
                                <div class="input-group">
									<span class="input-group-addon" style="background:white;"><i class="fa fa-pencil" aria-hidden="true"></i></span>
									<input type="text" class="form-control" style="background:#EEEEEE;" required name="entrprice" id="entrprice"  placeholder="Enter your Enterprice name"/>
								</div>
                            </div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
                                <div class="input-group">
									<span class="input-group-addon" style="background:white;"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" style="background:#EEEEEE;" required name="phone" id="phone"  placeholder="Enter your phone number"/>
								</div>
                            </div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register"  value="Proceed Request" style="background:#f73347;color:white;">
											</div>
										</div>
									</div>
								</form>	
				</div>
				
				<div class="col-lg-3 col-md-3 col-md-offset-1 col-sm-6 col-xs-12" style="background:#f73347; padding:10px;">
                        <div class="contact-address">
                            <div class="single-content">
                                <i class="ti-map-alt" ></i>
                                <h5>OFFICE ADDRESS</h5>
                                <p>Head office 12 sector 7, Ada Rood-15 H#12 Texas, USA</p>
                            </div>
                            <div class="single-content">
                                <i class="ti-mobile"></i>
                                <h5>Phone</h5>
                                <p>+01 87676646</p>
                            </div>
                            <div class="single-content">
                                <i class="ti-email"></i>
                                <h5>Email</h5>
                                <p>info@fedrex.com</p>
                            </div>
                        </div>
                </div>
				
				
			</div>
		</div>

                    
					
					
                </div>
            </div><!-- End Container -->
        </section><!-- End Section -->

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
