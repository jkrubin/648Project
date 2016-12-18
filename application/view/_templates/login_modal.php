<!-- Sign up / Log in Modal -->
<div class="modal member" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"><br>

			<!-- Modal Tabs-->
			<div class="bs-example bs-example-tabs">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<ul class="nav nav-tabs" id="myTab">
					<li class=""><a href="#signup" data-toggle="tab">Sign up</a></li>
					<li class="active"><a href="#login" data-toggle="tab">Log in</a></li>
				</ul>
			</div>
			<!-- Modal Forms-->
			<div class="modal-body">
				<div id="myTabContent" class="tab-content">
					<div class=" tab-pane active" id="login">
						<form id="form-wrapper" method="post" action="<?php echo URL?>api/login" data-toggle="validator">

							<div class="form-group">
								<input class="form-input form-control" type="email" name="email"
								       placeholder="Email Address" required/>
								<div class="help-block with-errors"></div>
							</div>
    
							<div class="form-group">
								<input class="form-input form-control" type="password" name="password" placeholder="Password"
								       required/>
								<div class="help-block with-errors"></div>
							</div>
    
							<input type="submit" name="login" class="form-input btn btn-default" value="Log in"/>
    
						</form>

					</div>

					<div class=" tab-pane" id="signup">
						<form id="form-wrapper" method="post" action="<?php echo URL?>api/signup" data-toggle="validator">

							<div class="form-group">
								<input class="form-input form-control" type="email" name="email"
								       placeholder="Email Address" required/>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<input class="form-input form-control" type="text" name="firstname"
								       placeholder="First Name" required/>
								<div class="help-block with-errors"></div>
							</div>

							<div class="form-group">
								<input class="form-input form-control" type="text" name="lastname"
								       placeholder="Last Name" required/>
								<div class="help-block with-errors"></div>
							</div>

							<div class="form-group">
								<input class="form-input form-control" id="inputPassword" type="password" name="password"
								       placeholder="Password"
								       required/>
								<div class="help-block with-errors"></div>
							</div>

							<div class="form-group">
								<input class="form-input form-control" type="password" data-match="#inputPassword"
								       data-match-error="password does not match" name="repass"
								       placeholder="Retype Password" required/>
								<div class="help-block with-errors"></div>
							</div>

							<label class="form-input">By registering, I accept the RentSFSU.com <a href="#">Terms of
									Service</a>.</label>
							<input type="submit" name="signup" class="btn btn-default" value="Sign up"/>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
