<div id="wrapper" class="signup">

	<div id="search-wrapper" class="signup">
		<div id="lede"><h1>sign up</h1></div>
		<form class="home" method="post" action="">
			<center><input type="email" name="email" placeholder="Email Address" required="@"/></center>
			<br>
			<center><input type="text" name="firstname" placeholder="First Name" required/></center>
			<br>
			<center><input type="text" name="lastname" placeholder="Last Name" required/></center>
			<br>
			<center><input type="password" name="password" placeholder="Password" required/></center>
			<br>
			<center><input type="password" name="repass" placeholder="Retype Password" required/></center>
			<br>
			<center><label>By registering, I accept the RentSFSU.com <a href="#">Terms of Service</a>.</label></center>
			<br>

			<center><input type="submit" name="submit" class="btn btn-default" value="Create Account"/></center>
			<br>
		</form>

		<?php
		if (isset($_POST['submit'])) {
			if ($check) {
				echo "<center>success</center>";
			} else {
				echo "<center>unsuccess</center>";
			}
		}
		?>
	</div>
</div>