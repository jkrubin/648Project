<div id="page-title"> <h2> All Messages </h2> <?php
    $_SESSION["favcolor"] = "purple";
    $_SESSION["site"] = "RentSFSU";
    print_r($_SESSION);
    ?>
</div>

<div id="wrapper">
    <div id="messages-wrapper">
        <ul id="messages">
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
                echo "      <button type='submit' action='<?php echo URL; ?>listing/addListing' method='POST'' id='delete' class='btn btn-default' name ='delete'> Delete Message </button>";
                echo "      <button type='submit' action='<?php echo URL; ?>listing/addListing' method='POST'' id='save' class='btn btn-default' name ='reply'> Reply </button>";
                echo "	</div>\n";

                echo "</li>\n";
            }
            ?>
            <
    </div>
</div>
