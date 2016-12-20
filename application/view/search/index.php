<div id="wrapper">
	<div id="search-wrapper">
		<?php
			require_once(APP . 'view/_templates/search_form.php');
		?>
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
				#convert $row into URL encoded query string
				$idPass = http_build_query(array('detail' => $row["ListingId"]));
				foreach ($_GET as $key => $value) {
					if ($key != 'url') {
						$idPass .= "&" . $key . "=" . $value;
					}
				}

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
				#passes ListingId to Listing_detail page
				echo "    	<a href='" . URL . "listing_detail?$idPass'> ";
				echo "			<img src='" . URL . "public/img/placeholder.png' height='150px' width='150px'/> ";
				echo "		</a>\n";
				echo "		</div>\n";

				# Listing summary
				echo "		<div class='listing-details-right'>\n";
				echo "			<ul>\n";
				echo "				<li class='bedrooms'>";
				if ($bedrooms == 0) {
					echo "Studio";
				} else if ($bedrooms == 1) {
					echo "$bedrooms bedroom";
				} else {
					echo "$bedrooms bedrooms";
				}
				echo "</li>\n";

				echo "				<li class='baths'>$baths bath";
				if ($baths > 1) {
					echo "s";
				}
				echo "</li>\n";
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

								<div class="col-sm-8">
									<div class="address">
										<p>900 Folsom St</p>
										<p>San Francisco, CA 94105</p>
									</div>
									<div class="rental-details">
										<p><span class="bedrooms">Studio</span> &nbsp; <span class="baths">1 Bath</span></p>
									</div>
									<input class="form-input form-control" type="text" name="subject" placeholder="Subject" required="">
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

