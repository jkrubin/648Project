<div id="wrapper">
	<div id="search-wrapper">
		<form id="search" class="home" action="<?php echo URL; ?>search" method="GET">
			<input type="text" name="q" placeholder="Enter City" <?php if (!empty($_GET['q'])) echo "value='".$_GET["q"]."'"; ?> />
			<input type="submit" class="btn btn-default" value="Search" />
		</form>
	</div>
	<div id="results-wrapper">
		<ul id="listings">
			<?php
				foreach ($listings as $i => $row) {

					$rent = $row["MonthlyRent"];
					$address = $row["StreetNo"] . ' ' . $row["StreetName"] . ', ' . $row["City"] . ', CA ' . $row["ZIP"];
					$bedrooms = $row['Bedrooms'];
					$baths = $row['Baths'];
					$sqft = $row['SqFt'];
					$description = $row['Description'];

					echo "<li class='listing'>\n";
					
					# Listing heading
					echo "  <div class='listing-heading'>\n";
					echo "		<p class='listing-heading-left'>\n";
					echo "			<span class='listing-order'>".($i + 1).".</span>\n";
					echo "			<span class='address'>$address</span>\n";
					echo "		</p>\n";
					echo "		<p class='rent listing-heading-right'>\$$rent</p>\n";
					echo "  </div>\n";
					
					# Listing details
					echo "	<div class='listing-details'>\n";
					# Photos window
					echo "		<div class='photos listing-details-left'>\n";
					echo "    	<img src='". URL ."public/img/placeholder.png' height='150px' width='150px'/>\n";
					echo "		</div>\n";

					
					# Listing summary
					echo "		<div class='listing-details-right'>\n";
					echo "			<ul>\n";
					echo "				<li class='bedrooms'>$bedrooms bedrooms</li>\n";
					echo "				<li class='baths'>$baths baths</li>\n";
					echo "			</ul>\n";
					if (!empty($description)) {
						echo "			<p class='description'>$description</p>\n";
					}
					echo "		</div>\n";

					echo "  </div>\n";
					echo "</li>\n";
				}
			?>
		</ul>
	</div>
</div>
