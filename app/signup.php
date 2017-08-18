<?php
	include("config.php");
	include("user_related/functions.php");
		

	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$phone = $_POST['phone'];
		$country = "India";
		$business = $_POST['business'];
		$type = $_POST['type'];
		$status = "pending";
		$date = time();
		$subscription_package = "";
		$subscription_expdate = "";
		$subscription_price = "";
		
		$check_email = check_duplicate_email($email);
		echo $check_email;
		if($check_email < 1){
			$save_reg = mysqli_query($mysqli,"INSERT into tbl_business VALUES ('','".$email."','".$password."','', '','', '".$phone."', '".$type."', '".$business."', '', '', '', '', '".$country."', '', 'active', '".$date."', '','','','','','','')");
			if($save_reg)
			{	
				$_SESSION['business_id'] = mysqli_insert_id($mysqli);
				echo "<script>window.location.href='edit_general_information.php'</script>";
			}
			else
			{
				$data = "error";
			}			
		}
		else{
			$data = "email";
		}
	}
?>

<!DOCTYPE html>
<html lang=en>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Sign Up | Port-ME</title>

	<?php 
		include("metalinks.php");
	?>
	<style>
		.bg-grad-03{
			background:#f0eff0 !important;
		}
		.form-control{
			font-size:12px;
		}
		.fpass:hover{
			text-decoration:underline !important;
		}
		.login-wrap{
			max-width:550px;
		}
	</style>
</head>


<body>

	<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div id="rs-wrapper" class="bg-grad-03">
		

		<div class="login-wrap p-a-md m-x-auto">
			<?php
				if(isset($data) && $data == "success"){
			?>
				<p style="text-align:center;background:#5cb85c;border:1px solid #CCC;border-radius:5px;padding:5px;color:#fff;font-weight:bold;"> Registration Successfull </p>
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
			<div class="bg-white b-r-a p-a-lg light-bs" style="box-shadow:3px 3px 3px 3px #CCC;margin-top:10px;">
				<p class="text-center" style="margin-bottom:30px;"><a href="http://www.port-me.com"><img src="images/logo.png" alt="Logo" style="height:80px;"></a></p>
				<form class="m-b-lg" id="rs-validation-login-page" method="POST" enctype="multipart/form-data">
					<div class="form-group has-feedback feedback-left">
						<input type="email" name="email" placeholder="Enter your email" class="form-control">
						<span class="gcon gcon-user f-s-xs form-control-feedback" aria-hidden="true"></span>
					</div><!-- /.form-group -->

					<div class="form-group has-feedback feedback-left">
						<input type="password" name="password" placeholder="Enter your account password" class="form-control">
						<span class="gcon gcon-lock f-s-xs form-control-feedback" aria-hidden="true"></span>
					</div><!-- /.form-group -->

					<div class="form-group has-feedback feedback-left">
						<input type="text" name="phone" placeholder="Enter your phone" class="form-control">
						<span class="gcon gcon-phone f-s-xs form-control-feedback" aria-hidden="true"></span>
					</div><!-- /.form-group -->

					<div class="form-group has-feedback feedback-left">
						<select name="country" class="form-control">
							<option value="" selected disabled>Choose Country</option>
							<option value="Afghanistan">Afghanistan</option>
							<option value="Albania">Albania</option>
							<option value="Algeria">Algeria</option>
							<option value="American Samoa">American Samoa</option>
							<option value="Andorra">Andorra</option>
							<option value="Angola">Angola</option>
							<option value="Anguilla">Anguilla</option>
							<option value="Antartica">Antarctica</option>
							<option value="Antigua and Barbuda">Antigua and Barbuda</option>
							<option value="Argentina">Argentina</option>
							<option value="Armenia">Armenia</option>
							<option value="Aruba">Aruba</option>
							<option value="Australia">Australia</option>
							<option value="Austria">Austria</option>
							<option value="Azerbaijan">Azerbaijan</option>
							<option value="Bahamas">Bahamas</option>
							<option value="Bahrain">Bahrain</option>
							<option value="Bangladesh">Bangladesh</option>
							<option value="Barbados">Barbados</option>
							<option value="Belarus">Belarus</option>
							<option value="Belgium">Belgium</option>
							<option value="Belize">Belize</option>
							<option value="Benin">Benin</option>
							<option value="Bermuda">Bermuda</option>
							<option value="Bhutan">Bhutan</option>
							<option value="Bolivia">Bolivia</option>
							<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
							<option value="Botswana">Botswana</option>
							<option value="Bouvet Island">Bouvet Island</option>
							<option value="Brazil">Brazil</option>
							<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
							<option value="Brunei Darussalam">Brunei Darussalam</option>
							<option value="Bulgaria">Bulgaria</option>
							<option value="Burkina Faso">Burkina Faso</option>
							<option value="Burundi">Burundi</option>
							<option value="Cambodia">Cambodia</option>
							<option value="Cameroon">Cameroon</option>
							<option value="Canada">Canada</option>
							<option value="Cape Verde">Cape Verde</option>
							<option value="Cayman Islands">Cayman Islands</option>
							<option value="Central African Republic">Central African Republic</option>
							<option value="Chad">Chad</option>
							<option value="Chile">Chile</option>
							<option value="China">China</option>
							<option value="Christmas Island">Christmas Island</option>
							<option value="Cocos Islands">Cocos (Keeling) Islands</option>
							<option value="Colombia">Colombia</option>
							<option value="Comoros">Comoros</option>
							<option value="Congo">Congo</option>
							<option value="Congo">Congo, the Democratic Republic of the</option>
							<option value="Cook Islands">Cook Islands</option>
							<option value="Costa Rica">Costa Rica</option>
							<option value="Cota D'Ivoire">Cote d'Ivoire</option>
							<option value="Croatia">Croatia (Hrvatska)</option>
							<option value="Cuba">Cuba</option>
							<option value="Cyprus">Cyprus</option>
							<option value="Czech Republic">Czech Republic</option>
							<option value="Denmark">Denmark</option>
							<option value="Djibouti">Djibouti</option>
							<option value="Dominica">Dominica</option>
							<option value="Dominican Republic">Dominican Republic</option>
							<option value="East Timor">East Timor</option>
							<option value="Ecuador">Ecuador</option>
							<option value="Egypt">Egypt</option>
							<option value="El Salvador">El Salvador</option>
							<option value="Equatorial Guinea">Equatorial Guinea</option>
							<option value="Eritrea">Eritrea</option>
							<option value="Estonia">Estonia</option>
							<option value="Ethiopia">Ethiopia</option>
							<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
							<option value="Faroe Islands">Faroe Islands</option>
							<option value="Fiji">Fiji</option>
							<option value="Finland">Finland</option>
							<option value="France">France</option>
							<option value="France Metropolitan">France, Metropolitan</option>
							<option value="French Guiana">French Guiana</option>
							<option value="French Polynesia">French Polynesia</option>
							<option value="French Southern Territories">French Southern Territories</option>
							<option value="Gabon">Gabon</option>
							<option value="Gambia">Gambia</option>
							<option value="Georgia">Georgia</option>
							<option value="Germany">Germany</option>
							<option value="Ghana">Ghana</option>
							<option value="Gibraltar">Gibraltar</option>
							<option value="Greece">Greece</option>
							<option value="Greenland">Greenland</option>
							<option value="Grenada">Grenada</option>
							<option value="Guadeloupe">Guadeloupe</option>
							<option value="Guam">Guam</option>
							<option value="Guatemala">Guatemala</option>
							<option value="Guinea">Guinea</option>
							<option value="Guinea-Bissau">Guinea-Bissau</option>
							<option value="Guyana">Guyana</option>
							<option value="Haiti">Haiti</option>
							<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
							<option value="Holy See">Holy See (Vatican City State)</option>
							<option value="Honduras">Honduras</option>
							<option value="Hong Kong">Hong Kong</option>
							<option value="Hungary">Hungary</option>
							<option value="Iceland">Iceland</option>
							<option value="India">India</option>
							<option value="Indonesia">Indonesia</option>
							<option value="Iran">Iran (Islamic Republic of)</option>
							<option value="Iraq">Iraq</option>
							<option value="Ireland">Ireland</option>
							<option value="Israel">Israel</option>
							<option value="Italy">Italy</option>
							<option value="Jamaica">Jamaica</option>
							<option value="Japan">Japan</option>
							<option value="Jordan">Jordan</option>
							<option value="Kazakhstan">Kazakhstan</option>
							<option value="Kenya">Kenya</option>
							<option value="Kiribati">Kiribati</option>
							<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
							<option value="Korea">Korea, Republic of</option>
							<option value="Kuwait">Kuwait</option>
							<option value="Kyrgyzstan">Kyrgyzstan</option>
							<option value="Lao">Lao People's Democratic Republic</option>
							<option value="Latvia">Latvia</option>
							<option value="Lebanon">Lebanon</option>
							<option value="Lesotho">Lesotho</option>
							<option value="Liberia">Liberia</option>
							<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
							<option value="Liechtenstein">Liechtenstein</option>
							<option value="Lithuania">Lithuania</option>
							<option value="Luxembourg">Luxembourg</option>
							<option value="Macau">Macau</option>
							<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
							<option value="Madagascar">Madagascar</option>
							<option value="Malawi">Malawi</option>
							<option value="Malaysia">Malaysia</option>
							<option value="Maldives">Maldives</option>
							<option value="Mali">Mali</option>
							<option value="Malta">Malta</option>
							<option value="Marshall Islands">Marshall Islands</option>
							<option value="Martinique">Martinique</option>
							<option value="Mauritania">Mauritania</option>
							<option value="Mauritius">Mauritius</option>
							<option value="Mayotte">Mayotte</option>
							<option value="Mexico">Mexico</option>
							<option value="Micronesia">Micronesia, Federated States of</option>
							<option value="Moldova">Moldova, Republic of</option>
							<option value="Monaco">Monaco</option>
							<option value="Mongolia">Mongolia</option>
							<option value="Montserrat">Montserrat</option>
							<option value="Morocco">Morocco</option>
							<option value="Mozambique">Mozambique</option>
							<option value="Myanmar">Myanmar</option>
							<option value="Namibia">Namibia</option>
							<option value="Nauru">Nauru</option>
							<option value="Nepal">Nepal</option>
							<option value="Netherlands">Netherlands</option>
							<option value="Netherlands Antilles">Netherlands Antilles</option>
							<option value="New Caledonia">New Caledonia</option>
							<option value="New Zealand">New Zealand</option>
							<option value="Nicaragua">Nicaragua</option>
							<option value="Niger">Niger</option>
							<option value="Nigeria">Nigeria</option>
							<option value="Niue">Niue</option>
							<option value="Norfolk Island">Norfolk Island</option>
							<option value="Northern Mariana Islands">Northern Mariana Islands</option>
							<option value="Norway">Norway</option>
							<option value="Oman">Oman</option>
							<option value="Pakistan">Pakistan</option>
							<option value="Palau">Palau</option>
							<option value="Panama">Panama</option>
							<option value="Papua New Guinea">Papua New Guinea</option>
							<option value="Paraguay">Paraguay</option>
							<option value="Peru">Peru</option>
							<option value="Philippines">Philippines</option>
							<option value="Pitcairn">Pitcairn</option>
							<option value="Poland">Poland</option>
							<option value="Portugal">Portugal</option>
							<option value="Puerto Rico">Puerto Rico</option>
							<option value="Qatar">Qatar</option>
							<option value="Reunion">Reunion</option>
							<option value="Romania">Romania</option>
							<option value="Russia">Russian Federation</option>
							<option value="Rwanda">Rwanda</option>
							<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
							<option value="Saint LUCIA">Saint LUCIA</option>
							<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
							<option value="Samoa">Samoa</option>
							<option value="San Marino">San Marino</option>
							<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
							<option value="Saudi Arabia">Saudi Arabia</option>
							<option value="Senegal">Senegal</option>
							<option value="Seychelles">Seychelles</option>
							<option value="Sierra">Sierra Leone</option>
							<option value="Singapore">Singapore</option>
							<option value="Slovakia">Slovakia (Slovak Republic)</option>
							<option value="Slovenia">Slovenia</option>
							<option value="Solomon Islands">Solomon Islands</option>
							<option value="Somalia">Somalia</option>
							<option value="South Africa">South Africa</option>
							<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
							<option value="Span">Spain</option>
							<option value="SriLanka">Sri Lanka</option>
							<option value="St. Helena">St. Helena</option>
							<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
							<option value="Sudan">Sudan</option>
							<option value="Suriname">Suriname</option>
							<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
							<option value="Swaziland">Swaziland</option>
							<option value="Sweden">Sweden</option>
							<option value="Switzerland">Switzerland</option>
							<option value="Syria">Syrian Arab Republic</option>
							<option value="Taiwan">Taiwan, Province of China</option>
							<option value="Tajikistan">Tajikistan</option>
							<option value="Tanzania">Tanzania, United Republic of</option>
							<option value="Thailand">Thailand</option>
							<option value="Togo">Togo</option>
							<option value="Tokelau">Tokelau</option>
							<option value="Tonga">Tonga</option>
							<option value="Trinidad and Tobago">Trinidad and Tobago</option>
							<option value="Tunisia">Tunisia</option>
							<option value="Turkey">Turkey</option>
							<option value="Turkmenistan">Turkmenistan</option>
							<option value="Turks and Caicos">Turks and Caicos Islands</option>
							<option value="Tuvalu">Tuvalu</option>
							<option value="Uganda">Uganda</option>
							<option value="Ukraine">Ukraine</option>
							<option value="United Arab Emirates">United Arab Emirates</option>
							<option value="United Kingdom">United Kingdom</option>
							<option value="United States">United States</option>
							<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
							<option value="Uruguay">Uruguay</option>
							<option value="Uzbekistan">Uzbekistan</option>
							<option value="Vanuatu">Vanuatu</option>
							<option value="Venezuela">Venezuela</option>
							<option value="Vietnam">Viet Nam</option>
							<option value="Virgin Islands (British)">Virgin Islands (British)</option>
							<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
							<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
							<option value="Western Sahara">Western Sahara</option>
							<option value="Yemen">Yemen</option>
							<option value="Yugoslavia">Yugoslavia</option>
							<option value="Zambia">Zambia</option>
							<option value="Zimbabwe">Zimbabwe</option>
						</select>
						<span class="gcon gcon-map f-s-xs form-control-feedback" aria-hidden="true"></span>
					</div><!-- /.form-group -->
					
					<div class="form-group has-feedback feedback-left">
						<input type="text" name="business" placeholder="Enter name of your business" class="form-control">
						<span class="gcon gcon-home f-s-xs form-control-feedback" aria-hidden="true"></span>
					</div><!-- /.form-group -->

					<div class="form-group  feedback-left">
						<select name="type" class="form-control">
							<option value="" selected disabled> Type of your business </option>
							<option value="Accounting Services"> Accounting Services </option>
							<option value="Administrative Services "> Administrative Services </option>
							<option value="Advertising, Creative Design, Media and Marketing Services"> Advertising, Creative Design, Media and Marketing Services </option>
							<option value="Agriculture, Farming, Fishing and Forestry"> Agriculture, Farming, Fishing and Forestry </option>
							<option value="Amusement, Gambling, and Recreation"> Amusement, Gambling, and Recreation </option>
							<option value="Animal Services"> Animal Services </option>
							<option value="Architectural, Engineering, Design and Related Services"> Architectural, Engineering, Design and Related Services </option>
							<option value="CA/TAX Consultant"> CA/TAX Consultant </option>
							<option value="Care Givers"> Care Givers </option>
							<option value="Charity, Nonprofits and Similar Groups"> Charity, Nonprofits and Similar Groups </option>
							<option value="Church"> Church </option>
							<option value="Computer Systems Design and Related Services"> Computer Systems Design and Related Services </option>
							<option value="Construction"> Construction </option>
							<option value="Consulting, Professional and Technical Services"> Consulting, Professional and Technical Services </option>
							<option value="Educational Services"> Educational Services </option>
							<option value="Finance and Insurance"> Finance and Insurance </option>
							<option value="Food & Beverage Establishments"> Food & Beverage Establishments </option>
							<option value="Freelancer"> Freelancer </option>
							<option value="General Service-Based Business"> General Service-Based Business </option>
							<option value="Hair Salons, Barbers and Spas"> Hair Salons, Barbers and Spas </option>
							<option value="Healthcare Services"> Healthcare Services </option>
							<option value="Human Resources and Placement Consulting"> Human Resources and Placement Consulting </option>
							<option value="IT & Telecommunications"> IT & Telecommunications </option>
							<option value="Land and Property including Management"> Land and Property including Management </option>
							<option value="Landscaping and Gardening Services"> Landscaping and Gardening Services </option>
							<option value="Learning Institutes"> Learning Institutes </option>
							<option value="Legal Services"> Legal Services </option>
							<option value="Manufacturers"> Manufacturers </option>
							<option value="Manufacturing and Mining"> Manufacturing and Mining </option>
							<option value="Performing Arts, Spectator Sports, and Related Industries"> Performing Arts, Spectator Sports, and Related Industries </option>
							<option value="Repair and Maintenance Services"> Repair and Maintenance Services </option>
							<option value="Retail Shops, Mail Order and Online"> Retail Shops, Mail Order and Online </option>
							<option value="Transportation and Warehousing"> Transportation and Warehousing </option>
							<option value="Travel and Tourism Services"> Travel and Tourism Services </option>
							<option value="Vehicle Sales, Maintenance and Repairs"> Vehicle Sales, Maintenance and Repairs </option>
							<option value="Whole-sellers"> Whole-sellers </option>
							<option value="Wholesale Trade and Distributors"> Wholesale Trade and Distributors </option>
						</select>
						<span class="gcon gcon-box f-s-xs form-control-feedback" aria-hidden="true"></span>
					</div><!-- /.form-group -->




					<button class="btn btn-success btn-block text-uppercase" type="submit" name="submit">Sign up</button>
				</form>
				<p class="text-center text-muted small m-a-0">
					Already have an account? <a href="index.php">Login here</a>
				</p>
			</div><!-- /.bg-white -->
		</div><!-- /.login-wrap -->


		<!-- BEGIN FOOTER -->
		<footer class="rs-footer login-footer text-center" style="background:url(images/top-clg-sec.png)">
			<span class="text-white small" style="color:#000 !important;">&copy; 2017 &copy; <a href="http://www.port-me.com" class="text-lighten"  style="color:#000 !important;text-decoration:underline;">Port-ME</a> All Rights Reserved</span>
		</footer>
		<!-- END FOOTER -->

	</div><!-- /#rs-wrapper -->


	
	<!-- <script src=https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js></script>
	<script>
	window.jQuery || document.write('<script src="../dist/js/vendor/jquery.min.js"><\/script>')
	</script> -->
	<script src="js/vendor.js"></script>
	<script src="js/plugins.js"></script>
	

	<!-- Page Plugins -->
	<script src="js/jquery.validate.min.js"></script>

	<!-- Template Js -->
	<script src="js/apps.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function($){
			"use strict";
			// Footer Absolute
			$('.rs-footer').footerAbsolute({
			    absoluteClass		: 'login-footer',
			    mainContent			: 'login-wrap'
			});
			// Example login validation
			$('#rs-validation-login-page').validate({
				ignore: 'input[type=hidden]', // ignore hidden fields
				rules: {
					username: "required email",
					password: "required",
					phone:"required number",
					country: "required",
					business: "required",
					type: "required"
				},
				messages: {
					username: "Please enter your email",
					password: "Please provide a password",
					phone: "Please enter your phone number",
					country: "Please choose your country",
					business: "Please enter your business name",
					type: "Please choose your business category"
				},
				errorElement: "p",
				errorPlacement: function ( error, element ) {
					error.addClass( "help-block" );
					// Has feedback
					if (element.parents('div').hasClass('has-feedback')) {
						error.appendTo( element.parent() );
					}
					else{
						error.insertAfter(element);
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".form-group" ).addClass( "has-error" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".form-group" ).removeClass( "has-error" );
				}
			});
		});
	</script>

</body>
</html>