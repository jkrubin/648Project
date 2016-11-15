<div id="page-title"> <h2> Create a Listing </h2> </div>

<div class="add-listing">
    <div>
        <form data-toggle="validator" role="form" action="<?php echo URL; ?>listing/addListing" method="POST"><br>
            <text id="showLabelSTNo">Street Number</text>
            <text id="showLabelSTName">Street Name</text>
            <text id="showLabelCity">City</text>
            <text id="showLabelZipCode">Zip Code</text><br>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <input type="text" onkeydown="showLabel('showLabelSTNo')" class="form-control" name="streetNo" placeholder="Street Number" required/>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <input type="text" onkeydown="showLabel('showLabelSTName')" name="streetName" placeholder="Street Name" required class="form-control"/>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <input type="text" class="form-control" onkeydown="showLabel('showLabelCity')" name="city" placeholder="City" required/>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <input type="number" class="form-control" min="0" onkeydown="showLabel('showLabelZipCode')" name="zipCode" placeholder="Zip Code" required>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <br>
            <text id="showLabelMoRent">Monthly Rent</text>
            <text id="showLabelDeposit">Deposit</text>
            <text id="showLabelNoRooms">Bedrooms</text>
            <text id="showLabelNoRoomsBath">Bathrooms</text>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" min="0" onkeydown="showLabel('showLabelMoRent')" pattern="0-9" class="form-control" name="monthlyRent" placeholder="Monthly Rent" required/>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" min="0" step=".1" onkeydown="showLabel('showLabelDeposit')" pattern="0-9" name="deposit" placeholder="Deposit" required class="form-control"/>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <input type="number" class="form-control" min="0" onkeydown="showLabel('showLabelNoRooms')" name="bedrooms" id="bedrooms" placeholder="Number of Rooms" required/>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <input type="number" min="0" onkeydown="showLabel('showLabelNoRoomsBath')" name="baths" id="baths" placeholder="Number of Bathrooms" required class="form-control">
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <text id="showLabelDescription">Description</text><br>
            <textarea cols="126" rows="3" onkeydown="showLabel('showLabelDescription')" name ="description" placeholder="Description"></textarea><br><br>
            <text id="showLabelSqFt">Square Feet</text>
            <text id="showLabelPetDeposit">Pet Deposit</text>
            <text id="showLabelKeyDeposit">Key Deposit</text><br>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <input type="number" pattern="0-9" class="form-control" onkeydown="showLabel('showLabelSqFt')" name="sqFt" placeholder="Square Feet">
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" pattern="0-9" class="form-control" onkeydown="showLabel('showLabelPetDeposit')" name="petDeposit" placeholder="Pet Deposit"/>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" min="0" onkeydown="showLabel('showLabelKeyDeposit')" name="keyDeposit" placeholder="Key Deposit" pattern="0-9" min="0" class="form-control">
                </div>
                <div class="help-block with-errors"></div>
            </div><br>
            <label for="start" id="dates" required>Start date</label>
            <input type="date" name="startDate" id="start" placeholder="Available From (Date)" />
            <label for="end" id="dates" required>End date  </label>
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
