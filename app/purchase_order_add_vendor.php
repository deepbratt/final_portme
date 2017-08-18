<!-- start pop up-->
<div id="modisada">
<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">
    <form method="post" enctype="multipart/form-data" id="rs-validation-login-page">
      <!-- Modal content-->
      <div class="modal-content" style="width:130%">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Vendor</h4>
        </div>
        <div class="modal-body">
         <!-- Begin default content width -->
					<div class="container-fluid" style="padding:0px;margin-top:-20px;margin-right:5px;margin-left:-5px;">
					

						<div class="col-md-12">
						<!-- Begin Panel -->
							<div class="panel panel-plain panel-rounded">

								<div class="panel-body"style="margin-top:10px;">
										<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Vendor Name : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->

												<div class="col-sm-3">
													<div class="form-group">
														<select name="sal" class="rs-selectize-single salutation" >
															<option value="">Salutation</option>
															<option value="Mr.">Mr.</option>
															<option value="Mrs.">Mrs.</option>
															<option value="Ms.">Ms.</option>
															<option value="Miss.">Miss.</option>
															<option value="Dr.">Dr.</option>
														</select>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-3">
													<div class="form-group">
														<input name="fname" type="text" class="form-control fname" id="rs-form-example-fname" placeholder="First Name" >
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
												<div class="col-sm-3">
													<div class="form-group">
														<input name="lname" type="text" class="form-control lname" id="rs-form-example-lname" placeholder="Last Name" >
														<p class="help-block with-errors"></p>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											</div><!-- /.row -->

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Company Name : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-9">
											<div class="form-group">
												<input name="cname" type="text" class="form-control cname"placeholder="Company Name" >
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Email : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-9">
											<div class="form-group">
												<input name="email" type="email" class="form-control email"placeholder="Enter Email Address" >
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Work Phone : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-9">
											<div class="form-group">
												<input name="wphone" type="integer" class="form-control wphone"placeholder="Enter Work Phone Number">
												<p class="help-block with-errors" ></p>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>Mobile : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-9">
											<div class="form-group">
												<input name="mobile" type="integer" class="form-control mobile"placeholder="Enter Mobile Number">
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

											<div class="row">
											<div class="col-sm-3">
													<div class="form-group">
														<label><b>GSTIN / PAN No : </b></label>
													</div><!-- /.form-group -->
												</div><!-- /.col-sm-4 -->
											<div class="col-sm-9">
											<div class="form-group">
												<input name="gst" type="text" class="form-control gst"placeholder="Enter GSTIN/PAN No.">
												<p class="help-block with-errors"></p>
											</div>
											</div><!-- /.form-group -->
											</div>

								</div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div>
						
						<div class="col-md-12" style="margin-top:-50px;">
							<!-- Begin Panel -->
								<div class="panel panel-plain panel-rounded">
									<div class="panel-body">
										<!-- Nav tabs -->
										<ul class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active"><a href="#rs-tab-01" aria-controls="rs-tab-01" role="tab" data-toggle="tab">Address</a></li>
											<li role="presentation"><a href="#rs-tab-02" aria-controls="rs-tab-02" role="tab" data-toggle="tab">Notes</a></li>
										</ul>

										<!-- Tab panes -->
										<div class="tab-content p-t-md">
											<div role="tabpanel" class="tab-pane fade in active" id="rs-tab-01">
												<div class="col-md-12" style="margin:0px;padding:0px;">
													<div class="col-md-6 col-sm-12" style="padding:5px;">
														<h3 style="margin-bottom:15px;font-size:17px;">Billing Address</h3>
																				

														<div class="row">
															<div class="col-sm-3">
																<div class="form-group">
																	<label> Address :<label>
																</div>
															</div>
															<div class="col-sm-8">
																<div class="form-group">
																	<input name="address" type="text" id="cityz" class="form-control billaddress1" placeholder="Enter Address" >
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div>
														</div>

															<div class="row">
															<div class="col-sm-3">
																<div class="form-group">
																	<label> State :<label>
																</div>
															</div>
															<div class="col-sm-8">
																<div class="form-group">
																	<select name="bstate" class="form-control billstate1" >
																	
																		<option value="">Select State</option>
																		<?php
																	$state_info = mysqli_query($mysqli, "select * from states");
																	while ($fetch_state = mysqli_fetch_array($state_info))
																	{
																	?>
																	<option value= "<?php echo $fetch_state['states_id'];?>"><?php echo $fetch_state['states_name'];?>&nbsp;(<?php echo $fetch_state['states_code'];?>)
																	</option>
																	<?php
																	}
																	?>
																	</select>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div>
														</div>

													</div>

													<div class="col-md-6 col-sm-12" style="margin-left:0px;padding:5px;">
														<h3 style="margin-bottom:15px;font-size:17px;">Shipping Address <span style="font-size:15px;float:right;color:#4a89dc;font-weight:normal;cursor:pointer;padding:5px;" onclick="copybillingaddr();"><i class="fa fa-hand-o-down"></i> Copy billing address</span></h3>
														
														<div class="row">
															<div class="col-sm-3">
																<div class="form-group">
																	<label> Address :<label>
																</div>
															</div>
															<div class="col-sm-8">
																<div class="form-group">
																	<input name="saddress" type="text" id="cityz1" class="form-control billaddress2" placeholder="Enter Address" >
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div>
														</div>

														<div class="row">
															<div class="col-sm-3">
																<div class="form-group">
																	<label> State :<label>
																</div>
															</div>
														<div class="col-sm-8">
																<div class="form-group">
																	<select name="sstate" class="form-control billstate2">
																		<option value="">Select State</option>
																		<?php
																	$state_info = mysqli_query($mysqli, "select * from states");
																	while ($fetch_state = mysqli_fetch_array($state_info))
																	{
																	?>
																	<option value= "<?php echo $fetch_state['states_id'];?>"><?php echo $fetch_state['states_name'];?>&nbsp;(<?php echo $fetch_state['states_code'];?>)
																	</option>
																	<?php
																	}
																	?>
																	</select>
																	<p class="help-block with-errors"></p>
																</div><!-- /.form-group -->
															</div>
														</div>

													</div>
												</div>
											</div><!-- /.tab-pane -->

											<div role="tabpanel" class="tab-pane fade" id="rs-tab-02">
												<h3 style="margin-bottom:15px;font-size:17px;">Notes</h3>	
												<div class="form-group">
													<textarea class="form-control notes" placeholder="Notes" style="min-height:250px;" ></textarea>
													<p class="help-block with-errors"></p>
												</div><!-- /.form-group -->
											</div><!-- /.tab-pane -->

										</div><!-- /.tab-content -->
									</div><!-- .panel-body -->

									<div class="panel-footer">
											<div class="form-group m-a-0">
												<button type="reset" class="btn btn-default btn-wide">Reset</button>
												<button name="submit_details" type="button" class="btn btn-success btn-wide ajaxsub" onclick="ajax_add_cust();">Submit</button>
											</div>
										</div><!-- /.panel-footer -->
								</div><!-- /.panel -->

								<!-- End Panel -->

						</div>
					</div><!-- /.container-fluid -->
				</div>


       
		
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		 </div>		
		 </form>
	</div>
 </div> <!--/ end pop up-->
 </div>
 <script>
		function copybillingaddr(){
			var billaddress1 = $(".billaddress1").val();
			var billstate = $(".billstate1 option:selected").val();	
			
			$(".billaddress2").val(billaddress1);
			$('.billstate2 option[value='+billstate+']').prop('selected',true);
			//$(".billcountry2 select").val(billcountry)
		}
	</script>
	<script>
      var input = document.getElementById('cityz');
      var autocomplete = new google.maps.places.Autocomplete(input);
    </script>
	<script>
      var input = document.getElementById('cityz1');
      var autocomplete = new google.maps.places.Autocomplete(input);
    </script>

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
					fname:"required",
					cname: "required",					
					email:	"required email",
					mobile:	"required number",
					gst:	"required",
					address: "required",
					bstate: "required",
					
				},
				messages: {
					fname: "Enter Supplier Name",
					cname: "Enter Company Name",					
					email:	"Enter Email Id",
					mobile: "Enter Phone number",
					gst: "Enter GST or PAN number",
					address: "Enter Address of Supplier",
					bstate: "Choose State",
					
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


