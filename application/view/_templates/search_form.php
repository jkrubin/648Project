<div id="query-error" class="hidden error"><h4>Enter a city or ZIP to search</h4></div>
<div id="room-error" class="hidden error"><h4>Select the number of bedrooms you're looking for</h4></div>
<form id="search" <?php if (isset($home)) { echo 'class="home"'; } ?> method="get" action="<?php echo URL; ?>search">
	<input type="text" name="q" placeholder="Enter City or ZIP"
			<?php if (!empty($_GET['q'])) echo "value='" . $_GET["q"] . "'"; ?> />
	<div id="search-br">
		<label for="brmin">Bedrooms</label>
		<input type="number" id="brmin" name="brmin" placeholder="Min"
				<?php if (!empty($_GET['brmin'])) echo "value='" . $_GET["brmin"] . "'"; ?> /> to
		<input type="number" name="brmax" placeholder="Max"
				<?php if (!empty($_GET['brmax'])) echo "value='" . $_GET["brmax"] . "'"; ?> />
	</div>
	<div id="search-rent">
		<label for="rentmin">Rent</label>
		<input type="number" id="rentmin" name="rentmin" placeholder="Min"
				<?php if (!empty($_GET['rentmin'])) echo "value='" . $_GET["rentmin"] . "'"; ?> /> to
		<input type="number" name="rentmax" placeholder="Max"
				<?php if (!empty($_GET['rentmax'])) echo "value='" . $_GET["rentmax"] . "'"; ?> />
	</div>
	<input type="submit" class="btn btn-default" value="Search" />
</form>