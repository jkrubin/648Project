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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88652603-1', 'auto');
  ga('send', 'pageview');

</script>
