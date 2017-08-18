<?php
 include("config.php");

if(isset($_POST['submit']))
{
	$username = $_POST['Username'];
	$password = $_POST['password'];
	$something_query = mysqli_query($mysqli,"select * from users where email ='".$username."' and password='".$password."'");
	$fetch_details = mysqli_fetch_array($something_query);
	$check_rows = mysqli_num_rows($something_query);

	if($check_rows > 0)
	{
		$_SESSION['user_id']= $fetch_details['user_id'];
		
		$data = "success" ;
		echo "<script>window.location.href='dashboard.php'</script>";
	}
	else
	{
		$data = "error";
	}

	
}

?>


<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Admin Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
		<?php
			include ("metalinks.php");
		?>
		<style>
			.login {
				background-color: #fff!important;
				background:url("images/shutterstock_336509381.jpg") fixed;
			}
			.page-footer{
				display:none !important;
			}
		</style>
        </head>
    <!-- END HEAD -->

    <body class=" login page-footer-fixed"  >
        <!-- BEGIN LOGO -->
		
        <div class="logo" style="margin-top:100px;margin-bottom:10px;">
            <a href="../index.php">
			</a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content" style="margin-top:10px;">

			<?php
								if(isset($data) && $data == "success")
						{
						?>
						<p style="text-align:center;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Login Successfully </p>
						<?php
						}else if(isset($data) && $data == "error"){
						?>
						<p style="text-align:center;background:#e54e53;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Error in Login </p>
						<?php
						}
						?>

            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" method="post">
                <h3 class="form-title font-green">SIGN IN</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="Username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions">
                    <input type="submit" class="btn green uppercase" name="submit" value="login">
                </div>
               
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form"  method="post">
                <h3 class="font-green">Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">Back</button>
                    <button type="submit" name="submit" class="btn btn-success uppercase pull-right">Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
    

        <?php
			include ("footer.php");
		?>
    </body>

</html>