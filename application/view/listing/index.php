<script src="public/js/showLabels.js"></script>

<div id="page-title"> <h2> Create a Listing </h2> </div>
<div class="add-listing">
    <div>
        <form action="<?php echo URL; ?>listing/addListing" method="POST"><br>
            <text id="showLabelSTNo">Street Number</text>
            <text id="showLabelSTName">Street Name</text>
            <text id="showLabelCity">City</text>
            <text id="showLabelZipCode">Zip Code</text><br>
            <input type="text" onkeydown="showLabel('showLabelSTNo')" name="streetNo" placeholder="Street Number"/>
            <input type="text" onkeydown="showLabel('showLabelSTName')" name="streetName" placeholder="Street Name" />
            <input type="text" onkeydown="showLabel('showLabelCity')" name="city" placeholder="City" />
            <input type="text" onkeydown="showLabel('showLabelZipCode')" name="zipCode" placeholder="Zip Code" /><br><br>
            <text id="showLabelMoRent">Monthly Rent</text>
            <text id="showLabelDeposit">Deposit</text>
            <text id="showLabelNoRooms">Bedrooms</text>
            <text id="showLabelNoRoomsBath">Bathrooms</text>
            <input type="text" onkeydown="showLabel('showLabelMoRent')" name="monthlyRent" placeholder="Monthly Rent" />
            <input type="text" onkeydown="showLabel('showLabelDeposit')" name="deposit" placeholder="Deposit" />
            <input type="number" min="0" onkeydown="showLabel('showLabelNoRooms')" name="bedrooms" id="bedrooms" placeholder="Number of Rooms" />
            <input type="number" min="0" onkeydown="showLabel('showLabelNoRoomsBath')" name="baths" id="baths" placeholder="Number of Bathrooms" /><br><br>
            <text id="showLabelDescription">Description</text><br>
            <textarea cols="126" rows="3" onkeydown="showLabel('showLabelDescription')" name ="description" placeholder="Description"></textarea><br><br>
            <text id="showLabelSqFt">Square Feet</text>
            <text id="showLabelPetDeposit">Pet Deposit</text>
            <text id="showLabelKeyDeposit">Key Deposit</text><br>
            <input type="text" onkeydown="showLabel('showLabelSqFt')" name="sqFt" placeholder="Square Feet" />
            <input type="text" onkeydown="showLabel('showLabelPetDeposit')" name="petDeposit" placeholder="Pet Deposit" />
            <input type="text" onkeydown="showLabel('showLabelKeyDeposit')" name="keyDeposit" placeholder="Key Deposit" /><br><br><br>
            <label for="start" id="dates" >Start date</label>
            <input type="date" name="startDate" id="start" placeholder="Available From (Date)" />
            <label for="end" id="dates">End date  </label>
            <input type="date" name="endDate" id="end" placeholder="Available To (Date)" /><br><br><br>
            <input type="checkbox" id="electricity" name="electricity"/> <label for="electricity">Electrical</label>
            <input type="checkbox" id="internet" name="internet"/> <label for="internet">Internet</label>
            <input type="checkbox" id="water" name="water"/> <label for="water">Water</label>
            <input type="checkbox" id="gas" name="gas"/> <label for="gas">Gas</label>
            <input type="checkbox" id="pets" name="pets"/> <label for="pets">Allow Pets</label>
            <input type="checkbox" id="smoking" name="smoking"/> <label for="smoking">Smoking</label>
            <input type="checkbox" id="television" name="television"/> <label for="television">Television</label>
            <input type="checkbox" id="furished" name="furnished"/> <label for="furnished">Furnished</label><br><br><br>
            Add images:<br><br>
            <input type="file" name="images" value="Upload Images of the Listing"/><br><br><br>
            <input type="checkbox" name="agree"/> I agree to the terms
            <input type="submit" class="btn btn-default" name ="submit_listing" value="Create Listing" />
        </form>
    </div>
</div>
