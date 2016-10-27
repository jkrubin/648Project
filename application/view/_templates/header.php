<!DOCTYPE html>
<html lang="en">
<head>
	<title>RentSFSU</title>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- JS -->
	<!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
	<!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

	<!-- CSS -->
	<link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>

	<!-- navigation -->
	<header <?php if (!empty($isHome)) echo "class='home'"; ?>>
		<nav>
			<ul>
				<a href="<?php echo URL; ?>"><li class="logo">RentSFSU</li></a>
			</ul>
		</nav>
		<div id="disclaimer">SFSU/FAU/Fulda Software Engineering Project, Fall 2016.  For Demonstration Only</div>
	</header>
