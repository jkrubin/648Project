<div id="wrapper">
	<div id="search-wrapper">
		<form id="search" action="<?php echo URL; ?>search" method="GET">
			<input type="text" name="q"
			       placeholder="Enter City" <?php if (!empty($_GET['q'])) echo "value='" . $_GET["q"] . "'"; ?> />
			<select name="br">
				<option value="0" <?php if ($_GET["br"] === 0) echo "selected='selected'"; ?>>Studio</option>
				<option value="1" <?php if ($_GET["br"] === 1) echo "selected='selected'"; ?>>1 Bedroom</option>
				<option value="2" <?php if ($_GET["br"] === 2) echo "selected='selected'"; ?>>2 Bedroom</option>
				<option value="3" <?php if ($_GET["br"] === 3) echo "selected='selected'"; ?>>3+ Bedroom</option>
			</select>
			<input type="submit" class="btn btn-default" value="Search"/>
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
				echo "			<span class='listing-order'>" . ($i + 1) . ".</span>\n";
				echo "			<span class='address'>$address</span>\n";
				echo "		</p>\n";
				echo "		<p class='rent listing-heading-right'>\$$rent</p>\n";
				echo "  </div>\n";

				# contact landlord
				echo " <a class='bottom-right btn btn-default' href='#contact' data-toggle='modal' data-target='.contact'>contact landlord</a>\n";

				# Listing details
				echo "	<div class='listing-details'>\n";
				# Photos window
				echo "		<div class='photos listing-details-left'>\n";
				echo "    	<img src='" . URL . "public/img/placeholder.png' height='150px' width='150px'/>\n";
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

	<!-- contact landlord Modal -->
	<div class="modal contact" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content"><br>
				<div class="modal-header text-center">
					<h class="modal-title">Message Landlord</h>
				</div>
				<!-- Modal Forms-->
				<div class="modal-body">
					<div class=" tab-pane active">
						<form id="form-wrapper" method="post" action="" data-toggle="validator">
							<div class="form-group row">

								<img class="col-sm-4" src='<?php echo URL; ?>public/img/placeholder.png' height='150px' width='150px'/>

								<div class="col-sm-4 col-sm-offset-4">
									<input class="form-input form-control" type="text" name="subject" placeholder="Subject" required/>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-group">
								<textarea class="form-control" id="inputComment" name="message" placeholder="Message"
								          rows="10"></textarea>
								<div class="help-block with-errors"></div>
							</div>

							<input type="submit" name="sendMsg" class="form-input btn btn-default" value="Send"/>

						</form>

					</div>

				</div>

			</div>
		</div>
	</div>

</div>
