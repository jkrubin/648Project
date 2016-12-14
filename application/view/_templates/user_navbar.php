<!-- navigation -->
<header class="home">
	<nav id="navbar" class="home">
		<div class="logo">
			<a href="<?php echo URL; ?>">RentSFSU</a>
		</div>
		<div class="navbar-right">
			<ul>
				<a href="<?php echo URL; ?>listing">
					<li class="btn btn-default">Add listing</li>
				</a>
				<a href="<?php echo URL; ?>dashboard">
					<li class="logout">Manage listings</li>
				</a>
				<a href="<?php echo URL; ?>messages">
					<li class="logout">Messages</li>
				</a>
				<a href="<?php echo URL; ?>account">
					<li class="username"><?php
						echo $_SESSION['Name'];
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
