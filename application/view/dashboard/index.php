        <ul id="listings">
            <?php
            if ($listings != null){
                foreach ($listings as $i => $row) {
                    $url = URL;
                    $listingId = $row["ListingId"];
                    $rent = $row["MonthlyRent"];
                    $streetNo = $row["StreetNo"];
                    $streetName = $row["StreetName"];
                    $city = $row["City"];
                    $state = 'CA';
                    $zip = $row["ZIP"];
                    $bedrooms = $row["Bedrooms"];
                    $baths = $row["Baths"];
                    $sqft = $row["SqFt"];
                    $description = $row["Description"];
                    $monthlyRent = $row["MonthlyRent"];
                    $deposit = $row["Deposit"];
                    $petDeposit = $row["PetDeposit"];
                    $keyDeposit = $row["KeyDeposit"];
                    $startDate = $row["StartDate"];
                    $endDate = $row["EndDate"];

                    $electricity = $row["Electricity"];
                    $internet = $row["Internet"];
                    $water = $row["Water"];
                    $gas = $row["Gas"];
                    $television = $row["Television"];
                    $pets = $row["Pets"];
                    $smoking = $row["Smoking"];
                    $furnished = $row["Furnished"];

                    echo "<li class='edit-listing'>\n";

                    # Listing heading
                    echo "  <div class='edit-listing-heading'>\n";
                    echo "		<p class='edit-listing-heading-left'>\n";
                    echo "          <form id='listingChanges' method='post' action='$url/api/changeListing'>";
                    echo "			<span class='edit-listing-order'>" . ($i + 1) . ".</span>\n";
                    echo "			<input class='inputSmall' name='StreetNo' value='$streetNo'/n>";
                    echo "			<input class='address' name='StreetName' value='$streetName'/n>";
                    echo "			<input class='address' name='City' value='$city'/n>";
                    echo "			<input class='inputSmall' value='$state'/n>";
                    echo "			<input class='inputSmall' name='ZIP' value='$zip'/n>";
                    echo "                  Rent: $ <input class='rent' name='MonthlyRent' value='$rent'/>\n";
                    echo "		</p>\n";
                    echo "  </div>\n";

                    # Listing details
                    echo "	<div class='edit-listing-details'>\n";

                    # Photos window
                    echo "		<div class='photos edit-listing-details-left'>\n";
                    echo "          <img src='" . URL . "public/img/placeholder.png' height='150px' width='150px'/>\n";
                    echo "			<textarea class='description' name='Description'>$description</textarea>\n";
                    echo "		</div>\n";


                    # Listing summary
                    echo "		<div class='edit-listing-details-right'>\n";
                    echo "              <div class='col1'>\n";
                    echo "			<ul>\n";
                    echo "				<li><input type='number' name='Bedrooms' value='$bedrooms' id='inputSmall'/><br>Bedrooms</li><br>\n";
                    echo "				<li><input type='number' name='Baths' value='$baths' id='inputSmall'/><br>Baths</li><br>\n";
                    echo "			</ul>\n";
                    echo "              </div>\n";
                    echo "              <div class='col2'>\n";
                    echo "			<ul>\n";
                    echo "				<li><input type='number' value='$monthlyRent' id='inputSmall'/><br>Monthly Rent</li><br>\n";
                    echo "				<li><input type='number' name='Deposit' value='$deposit' id='inputSmall'/><br>Deposit</li><br>\n";
                    echo "			</ul>\n";
                    echo "              </div>\n";
                    echo "              <div class='col3'>\n";
                    echo "			<ul>\n";
                    echo "				<li><input type='number' name='KeyDeposit' value='$keyDeposit' id='inputSmall'/><br>Key Deposit</li><br>\n";
                    echo "				<li><input type='number' name='PetDeposit'value='$petDeposit' id='inputSmall'/><br>Pet Deposit</li><br>\n";
                    echo "			</ul>\n";
                    echo "              </div>\n";
                    echo "              <div class='col4'>\n";
                    echo "			<ul>\n";
                    echo "				<li><input type='date' name='StartDate' value='$startDate' id='inputSmall'/><br>Start Date</li><br>\n";
                    echo "				<li><input type='date' name='EndDate' value='$endDate' id='inputSmall'/><br>End Date</li><br><br>\n";
                    echo "			</ul>\n";
                    echo "              </div>\n";
                    echo "              <div class='col5'>\n";
                    echo "			<ul>\n";
                    echo "                           <input type='checkbox' name='Electricity' value='$electricity'/>";
                    echo "                           <label>Electricity</label><br><br>";
                    echo "                           <input type='checkbox' name='Furnished' value='$furnished'/>";
                    echo "                           <label>Furnished</label><br><br>";
                    echo "                           <input type='checkbox' name='Gas' value='$gas'/>";
                    echo "                           <label>Gas</label><br><br>";
                    echo "                           <input type='checkbox' name='Internet' value='$internet'/>";
                    echo "                           <label>Internet</label>";
                    echo "			</ul>\n";
                    echo "              </div>\n";
                    echo "              <div class='col6'>\n";
                    echo "			<ul>\n";
                    echo "                           <input type='checkbox' name='Pets' value='$pets'/>";
                    echo "                           <label>Allow Pets</label><br><br>";
                    echo "                           <input type='checkbox' name='Smoking' value='$smoking'/>";
                    echo "                           <label>Smoking</label><br><br>";
                    echo "                           <input type='checkbox' name='Television' value='$television'/>";
                    echo "                           <label>Television</label><br><br>";
                    echo "                           <input type='checkbox' name='Water' value='$water'/>";
                    echo "                           <label>Water</label>";
                    echo "			</ul>\n";
                    echo "              </div>\n";
                    echo "		</div>\n";
                    
                    #buttons
                    echo "  </div>\n";
                    echo "      <div class='edit-listing-buttons'>";
                    echo "      <input type='hidden' name='ListingId' value='$listingId'>";
                    echo "      <button type='submit' id='delete' class='btn btn-default' name ='delete' value='delete'> Delete Listing </button>";
                    echo "      <button type='submit' id='save' class='btn btn-default' name ='save' value='save'> Save Changes </button>";
                    echo "      </form>";
                    echo "	</div>\n";
                    echo "</li>\n";
                }
            }
            else{
                echo "<li class='edit-listing edit-listing-none'>\n";
        # Listing heading
                        echo "  <div class='edit-listing-heading'>\n";
                        echo "		<p class='edit-listing-none-heading'>\n";
                        echo "			<span >You do not have any listings at this time.</span>\n";
                        echo "		</p>";
                        echo "  </div>\n";
                echo "</li>\n";
            }
            ?>
        </ul>