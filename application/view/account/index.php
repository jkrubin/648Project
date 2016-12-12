<!-- Dashboard / Messages Modal -->
<div class="modal member" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"><br>

			<!-- Modal Tabs-->
			<div class="bs-example bs-example-tabs">
				<ul class="nav nav-tabs" id="myTab">
					<li class=""><a href="#dashboard" data-toggle="tab">Dashboard</a></li>
					<li class="active"><a href="#messages" data-toggle="tab">Messages</a></li>
				</ul>
			</div>
			<!-- Modal Forms-->
			<div class="modal-body">
				<div id="myTabContent" class="tab-content">
					<div class=" tab-pane active" id="login">
						<form id="form-wrapper" method="post" action="" data-toggle="validator" onsubmit="return check_login(this)">

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


						<?php
						if (isset($_POST['email']) && isset($_POST['password'])) {
							$check_login = $this->model->authenticate_user($_POST['email'], $_POST['password'], '');
							if ($check_login['status'] == 'success') {
								echo "<center>log in successful =D</center>";
							} elseif ($check_login['status'] == 'error') {
								echo "<center>" . $check_login['message'] . "</center>";
							}
						}
						?>
					</div>

					<div class=" tab-pane" id="signup">
						<form id="form-wrapper" method="post" action="" data-toggle="validator"
						      onsubmit="return check_signup(this)">

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
								       placeholder="Retype
                                               Password" required/>
								<div class="help-block with-errors"></div>
							</div>

							<label class="form-input">By registering, I accept the RentSFSU.com <a href="#">Terms of
									Service</a>.</label>
							<input type="submit" name="signup" class="btn btn-default" value="Sign up"/>
						</form>

						<?php
						if (isset($_POST['signup'])) {
							if ($check) {
								echo "<center>success</center>";
							} else {
								echo "<center>unsuccess</center>";
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
