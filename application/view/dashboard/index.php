<div id="page-title"> <h2> Landlord Dashboard </h2> </div>

<div id="wrapper">
    <div id="dashboard-wrapper">
        <ul id="listings">
            <?php
            foreach ($listings as $i => $row) {

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
                echo "			<span class='edit-listing-order'>" . ($i + 1) . ".</span>\n";
                echo "			<input class='inputSmall' value='$streetNo'/n>";
                echo "			<input class='address' value='$streetName'/n>";
                echo "			<input class='address' value='$city'/n>";
                echo "			<input class='inputSmall' value='$state'/n>";
                echo "			<input class='address' value='$zip'/n>";
                echo "		</p>\n";
                echo "		<p class='edit-listing-heading-right'>\n";
                echo "                  Rent: $<input class='rent' value='$rent'/>\n";
                echo "          </p>\n";
                echo "  </div>\n";

                # Listing details
                echo "	<div class='edit-listing-details'>\n";

                # Photos window
                echo "		<div class='photos edit-listing-details-left'>\n";
                echo "          <img src='" . URL . "public/img/placeholder.png' height='150px' width='150px'/>\n";
                echo "			<textarea class='description'>$description</textarea>\n";
                echo "		</div>\n";


                # Listing summary
                echo "		<div class='edit-listing-details-right'>\n";
                echo "              <div class='col1'>\n";
                echo "			<ul>\n";
                echo "				<li><input type='number' value='$bedrooms' id='inputSmall'/><br>Bedrooms</li><br>\n";
                echo "				<li><input type='number' value='$baths' id='inputSmall'/><br>Baths</li><br>\n";
                echo "			</ul>\n";
                echo "              </div>\n";
                echo "              <div class='col2'>\n";
                echo "			<ul>\n";
                echo "				<li><input type='number' value='$monthlyRent' id='inputSmall'/><br>Monthly Rent</li><br>\n";
                echo "				<li><input type='number' value='$deposit' id='inputSmall'/><br>Deposit</li><br>\n";
                echo "			</ul>\n";
                echo "              </div>\n";
                echo "              <div class='col3'>\n";
                echo "			<ul>\n";
                echo "				<li><input type='number' value='$keyDeposit' id='inputSmall'/><br>Key Deposit</li><br>\n";
                echo "				<li><input type='number' value='$petDeposit' id='inputSmall'/><br>Pet Deposit</li><br>\n";
                echo "			</ul>\n";
                echo "              </div>\n";
                echo "              <div class='col4'>\n";
                echo "			<ul>\n";
                echo "				<li><input type='date' value='$startDate' id='inputSmall'/><br>Start Date</li><br>\n";
                echo "				<li><input type='date' value='$endDate' id='inputSmall'/><br>End Date</li><br>\n";
                echo "			</ul>\n";
                echo "              </div>\n";
                echo "		</div>\n";

                echo "  </div>\n";

                # Listing checkboxes
                echo "	<div class='edit-listing-checkboxes'>\n";
                echo "      <input type='checkbox' value='$electricity'/>";
                echo "      <label>Electricity</label>";
                echo "      <input type='checkbox' value='$furnished'/>";
                echo "      <label>Furnished</label>";
                echo "      <input type='checkbox' value='$gas'/>";
                echo "      <label>Gas</label>";
                echo "      <input type='checkbox' value='$internet'/>";
                echo "      <label>Internet</label>";
                echo "      <input type='checkbox' value='$pets'/>";
                echo "      <label>Allow Pets</label>";
                echo "      <input type='checkbox' value='$smoking'/>";
                echo "      <label>Smoking</label>";
                echo "      <input type='checkbox' value='$television'/>";
                echo "      <label>Television</label>";
                echo "      <input type='checkbox' value='$water'/>";
                echo "      <label>Water</label><br><br>";
                echo "      <button type='submit' action='<?php echo URL; ?>listing/addListing' method='POST'' id='delete' class='btn btn-default' name ='delete'> Delete Listing </button>";
                echo "      <button type='submit' action='<?php echo URL; ?>listing/addListing' method='POST'' id='save' class='btn btn-default' name ='save'> Save Changes </button>";
                echo "	</div>\n";

                echo "</li>\n";
            }
            ?>
    </div>
</div>
