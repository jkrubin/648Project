<div id="wrapper" class="home">

	<div id="search-wrapper" class="home">
		<div id="lede"><h1>Find Apartments and Homes for Rent</h1></div>
		<div id="query-error" class="hidden error"><h4>Enter a city or ZIP to search</h4></div>
		<div id="room-error" class="hidden error"><h4>Select the number of bedrooms you're looking for</h4></div>
		<form id="search" class="home" method="get" action="<?php echo URL; ?>search">
			<input type="text" name="q" placeholder="Enter City or ZIP" />
			<select name="br">
				<option value="-1">-- Bedrooms</option>
				<option value="0">Studio</option>
				<option value="1">1 Bedroom</option>
				<option value="2">2 Bedroom</option>
				<option value="3">3+ Bedroom</option>
			</select>
			<input type="submit" class="btn btn-default" value="Search" />
		</form>
	</div>
</div>

<script src="<?php echo URL; ?>js/search-validator.js"></script>