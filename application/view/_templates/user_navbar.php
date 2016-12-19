<!-- navigation -->
<header class="home">
	<nav id="navbar" class="home">
		<div class="logo">
			<a href="<?php echo URL; ?>">RentSFSU</a>
		</div>
		<div class="navbar-right">
			<ul>
				<a id="create" href="<?php echo URL; ?>listing">
					<li class="btn btn-default create">Add listing</li>
				</a>
				<a href="<?php echo URL; ?>account_center">
					<li class="username"><?php
                                            echo "<p>Welcome, ", $_SESSION['Name'],"</p> Messages and Listings";
					?></li>
				</a>
				<a href="<?php echo URL; ?>api/logout">
					<li id="logout">Log out</li>
				</a>
			</ul>
		</div>
	</nav>
	<div id="disclaimer">SFSU/FAU/Fulda Software Engineering Project, Fall 2016. For Demonstration Only</div>
</header>
