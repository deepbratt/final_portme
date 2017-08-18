<?php
	include('config.php');
	$user_id = $_SESSION['user_id'];
	
	if(isset($_POST['update']))
	{
		$old = mysqli_real_escape_string($mysqli,$_POST['old']);
		$new = mysqli_real_escape_string($mysqli,$_POST['new']);
		$confirm_new = mysqli_real_escape_string($mysqli,$_POST['confirm_new']);

		$select_prev = mysqli_query($mysqli,"select * from users where id='$user_id'");
		$fetch_prev = mysqli_fetch_array($select_prev);

		if($fetch_prev['password'] == $old)
		{
			if($fetch_prev['password'] != $new)
			{
				if($new == $confirm_new)
				{
					$update_query = mysqli_query($mysqli,"update users set password='".$new."' where id='".$user_id."'");
					if($update_query)
					{
						$data = 'success';
						echo  "<script>window.location.href='dashboard.php'</script>";
					}
					else{
						$data = 'error';
					}
				}
				else{
					$data = 'confirm_error';
				}
			}
			else{
					$data = 'same_error';
				}
		}
		else{
					$data = 'match_error';
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
        <title>Settings</title>
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
                <img src="" >
			</a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content" style="margin-top:10px;">


										<?php
											if(isset($data) && $data=='success'){
										?>
										<p style="text-align:center;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Password Changed Successfully </p>
										<?php
									  }
										
											if(isset($data) && $data=='error'){
										?>
										<p style="text-align:center;background:#ef5350;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;"> Failed to Update </p>
										<?php
									  }
										 if(isset($data) && $data=='confirm_error'){
										?>
										<p style="text-align:center;background:#ef5350;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;">  Oops! New Password And Confirm Passwword Doesn't Match </p>

										<?php
									  }
										 if(isset($data) && $data=='same_error'){
										?>
										<p style="text-align:center;background:#ef5350;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;">  Oops! New Password And Current Passwword Can't be Same!</p>
										<?php
									  }
										 if(isset($data) && $data=='match_error'){
										?>
										<p style="text-align:center;background:#ef5350;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;margin-left:15px;">  Oops! Current Passwword Didn't Match!</p>
										<?php
									  }
										?>

			

            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" method="post">
                <h3 class="form-title font-green">Change Password</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Old Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Old Password" name="old" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">New Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="new" /> </div>
				<div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" name="confirm_new" /> </div>
                <div class="form-actions">
                    <input type="submit" class="btn green uppercase" name="update" value="Change Password">
                </div>
               
            </form>
            <!-- END LOGIN FORM -->
            
        </div>
    

        <?php
			include ("footer.php");
		?>
    </body>

</html>