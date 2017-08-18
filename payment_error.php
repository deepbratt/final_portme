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

        <div class="container" style="margin-top:5px;">
			<div class="row main">
				<div class="col-md-12 main-login main-center" >
					<div style="height:45px;border:1px solid #f73347;;background:#f73347;">
						<p style="text-align:center;font-size:18px;color:white;">OPPS!! Your Payment Is Cancel</p>
					</div>
				<div style="border:2px solid #981c34; margin-top:60px; height:250px; width:100%; float:left; background:#ececec; border-radius:20px;">
                
                    <hr class="line-tab" />
                    <h5 style="font-size:30px; text-align:center; margin-bottom:20px;"><b>Thank You For Choosing PORT-ME</b><br/>
					<span style="font-size:14px;">Please Click The Button To Retry</span>
					
					<a href="https://portme.co/signup.php"><button class="waves-effect btn brochure-btn1 mobile-btn" style="top:290px;margin-left:-250px;  background:#e52d2d; text-align:center; font-size:16px; font-weight:500; position:absolute;">Click To Retry</button></a>
					
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
