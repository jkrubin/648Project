<div id="wrapper">
	<div id="search-wrapper">
		<form id="search" class="home" action="<?php echo URL; ?>search/fetchListings" method="GET">
			<input type="text" placeholder="Address, City, or ZIP code" />
			<input type="submit" value="Search" />
		</form>
	</div>
	<div id="results-wrapper">
		<ul id="listings">
			<?php
				foreach ($listings as $i => $row) {

					$rent = $row["MonthlyRent"];
					$address = $row["StreetNo"] . ' ' . $row["StreetName"] . ', ' . $row["City"] . ', CA ' . $row["ZIP"];
					$bedrooms = $row['Bedrooms'];
					$bathrooms = $row['Baths'];
					$sqft = $row['SqFt'];
					$description = $row['Description'];

					# Listing heading
					echo "<li class='listing'>\n";
					echo "<p><span class='rent'>\$$rent</span> <span class='address'>$address</span></p>";

					# Main content div (thumbnails to the left)
					echo "<div class='photos'></div>";
					echo "<div class='listing-details'><ul>";
					echo "<li class='bedrooms'>$bedrooms bedrooms</li>";
					echo "<li class='bathrooms'>$bathrooms baths</li>";
					echo "<li class='sqft'>$sqft square feet</li>";
					echo "</ul></div>";

					# Short blurb
					if (!empty($description)) {
						echo "<p class='description'>$description</p>";
					}

					echo "</li>\n";
				}
			?>
		</ul>
	</div>
</div>
