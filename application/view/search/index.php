<div id="wrapper">
	<div id="search-wrapper">
		<form id="search" class="home">
			<input type="text" placeholder="Address, City, or ZIP code" />
			<input type="submit" value="Search" />
		</form>
	</div>
	<div id="results-wrapper">
		<ul id="listings">
			<?php
				foreach ($listings as $i => $row) {

					$rent = $row["MonthlyRent"];
					$address = $row["StreetNo"] . ' ' . $row["StreetName"] . ', ' . $row["City"] . ' ' . $row["ZIP"];

					echo "<li class='listing'>\n";
					echo "<p><span class='rent'>\$$rent</span> <span class='address'>$address</span></p>";

					echo "</li>\n";
				}
			?>
		</ul>
	</div>
</div>