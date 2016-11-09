<div id="page-title"> <h2> Create a Listing </h2> </div>

<div class="add-listing">
    <div>
        <form action="<?php echo URL; ?>listing/addListing" method="POST">
            <input type="text" name="streetNo" placeholder="Street Number" width="22%"/>
            <input type="text" name="streetName" placeholder="Street Name" />
            <input type="text" name="city" placeholder="City" />
            <input type="text" name="zipCode" placeholder="Zip Code" /><br><br>
            <input type="text" name="monthlyRent" placeholder="Monthly Rent" />
            <input type="text" name="deposit" placeholder="Deposit" />
            <input type="text" name="bedrooms" id="bedrooms" placeholder="Number of Rooms" />
            <input type="text" name="baths" id="baths" placeholder="Number of Bathrooms" /><br><br>
            <textarea cols="126" rows="3" name="description" placeholder="Description"></textarea><br><br>
            <input type="text" name="sqFt" placeholder="Square Feet" />
            <input type="text" name="petDeposit" placeholder="Pet Deposit" />
            <input type="text" name="keyDeposit" placeholder="Key Deposit" /><br><br>
            Start date:
            <input type="date" name="startDate" placeholder="Available From (Date)" />
            End date:
            <input type="date" name="endDate" placeholder="Available To (Date)" /><br><br>
            Add images:<br><br>
            <input type="checkbox" name="electricity"/> <label>Electrical</label>
            <input type="checkbox" name="internet"/> <label>Internet</label>
            <input type="checkbox" name="water"/> <label>Water</label>
            <input type="checkbox" name="gas"/> <label>Gas</label>
            <input type="checkbox" name="pets"/> <label>Allow Pets</label>
            <input type="checkbox" name="smoking"/> <label>Allow Smoking</label>
            <input type="checkbox" name="television"/> <label>Television</label>
            <input type="checkbox" name="furnished"/> <label>Furnished</label><br><br>
            <input type="file" name="images" value="Upload Images of the Listing"/><br><br>
            <input type="checkbox" name="agree"/>I agree to the terms
            <input type="submit" class="btn btn-default" name ="submit_listing" value="Create Listing" />
        </form>
    </div>
</div>
