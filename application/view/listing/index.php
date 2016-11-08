<div id="page-title"> <h2> Create a Listing </h2> </div>

<div class="listing">
    <div>
        <form action="<?php echo URL; ?>listing/addListing" method="POST">
            <input type="text" name="streetNo" placeholder="Street Number" />
            <input type="text" name="streetName" placeholder="Street Name" />
            <input type="text" name="city" placeholder="City" />
            <input type="text" name="zipCode" placeholder="Zip Code" /><br><br>
            <textarea cols="150" rows="3" name="description" placeholder="Description"></textarea><br><br>
            <input type="text" name="sqFt" placeholder="Square Feet" />
            <input type="text" name="monthlyRent" placeholder="Monthly Rent" />
            <input type="text" name="deposit" placeholder="Deposit" />
            <input type="text" name="petDeposit" placeholder="Pet Deposit" />
            <input type="text" name="keyDeposit" placeholder="Key Deposit" /><br><br>
            <input type="checkbox" name="electricity"/>Electrical
            <input type="checkbox" name="internet"/>Internet
            <input type="checkbox" name="water"/>Water
            <input type="checkbox" name="gas"/>Gas
            <input type="checkbox" name="pets"/>Allow Pets
            <input type="checkbox" name="smoking"/>Allow Smoking
            <input type="checkbox" name="television"/>Television
            <input type="checkbox" name="furnished"/>Comes Furnished<br><br>
            <input type="text" name="bedrooms" id="bedrooms" placeholder="Number of Rooms" />
            <input type="text" name="baths" id="baths" placeholder="Number of Bathrooms" />
            Start date:
            <input type="date" name="startDate" placeholder="Available From (Date)" />
            End date:
            <input type="date" name="endDate" placeholder="Available To (Date)" /><br><br>
            Add images:<br><br>
            <input type="file" name="images" value="Upload Images of the Listing"/><br><br>
            <input type="checkbox" name="agree"/>I agree to the terms
            <input type="submit" class="btn btn-default" name ="submit_listing" value="Create Listing" />
        </form>
    </div>
</div>
