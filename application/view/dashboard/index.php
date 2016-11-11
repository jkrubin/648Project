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
                $bedrooms = $row['Bedrooms'];
                $baths = $row['Baths'];
                $sqft = $row['SqFt'];
                $description = $row['Description'];

                echo "<li class='edit-listing'>\n";

                # Listing heading
                echo "  <div class='edit-listing-heading'>\n";
                echo "		<p class='edit-listing-heading-left'>\n";
                echo "			<span class='edit-listing-order'>" . ($i + 1) . ".</span>\n";
                echo "			<input class='addressSmall' value='$streetNo'/n>";
                echo "			<input class='address' value='$streetName'/n>";
                echo "			<input class='address' value='$city'/n>";
                echo "			<input class='addressSmall' value='$state'/n>";
                echo "			<input class='address' value='$zip'/n>";
                echo "		</p>\n";
                echo "		<p class='edit-listing-heading-right'>\n";
                echo "                  $<input class='rent' value='$rent'/>\n";
                echo "          </p>\n";
                echo "  </div>\n";

                # Listing details
                echo "	<div class='edit-listing-details'>\n";
                # Photos window
                echo "		<div class='photos edit-listing-details-left'>\n";
                echo "          <img src='" . URL . "public/img/placeholder.png' height='150px' width='150px'/>\n";
                if (!empty($description)) {
                    echo "			<textarea class='description'>$description</textarea>\n";
                }
                echo "		</div>\n";


                # Listing summary
                echo "		<div class='edit-listing-details-right'>\n";
                echo "<button style='float:right;' type='submit' action='<?php echo URL; ?>listing/addListing' method='POST'' class='btn btn-default' name ='delete'> Delete Listing </button>";
                echo "			<ul>\n";
                echo "				<li class='bedrooms'>$bedrooms bedrooms</li>\n";
                echo "				<li class='baths'>$baths baths</li>\n";
                echo "			</ul>\n";
                echo "		</div>\n";

                echo "  </div>\n";
                echo "</li>\n";
            }
            ?>
            <
    </div>
</div>
