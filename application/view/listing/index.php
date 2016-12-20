

<div id="page-title"> <h2> Create a Listing </h2> </div>

<div class="add-listing">
    <div>
        <form data-toggle="validator" role="form" method="post" enctype="multipart/form-data" action="<?php echo URL; ?>listing/addlisting"><br>
            <text id="showLabelSTNo">Street Number</text>
            <text id="showLabelSTName">Street Name</text>
            <text id="showLabelCity">City</text>
            <text id="showLabelZipCode">Zip Code</text><br>
            <div class="form-group has-feedback">
                <div class="input-group required-field-block">
                    <input type="number" id="streetNo" class="form-control" name="streetNo" placeholder="Street Number" required/>
                    <div class="required-icon">
                        <div class="text">*</div>
                    </div>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group required-field-block">
                    <input type="text" id="streetName" name="streetName" placeholder="Street Name" required class="form-control"/>
                    <div class="required-icon">
                        <div class="text">*</div>
                    </div>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group required-field-block">
                    <input type="text" id="city" class="form-control" name="city" placeholder="City" required/>
                    <div class="required-icon">
                        <div class="text">*</div>
                    </div>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group required-field-block">
                    <input type="number" id="zipCode" class="form-control" min="0" name="zipCode" placeholder="Zip Code" required>
                    <div class="required-icon">
                        <div class="text">*</div>
                    </div>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <br>
            <text></text>
            <text></text>
            <text id="showLabelMoRent">Monthly Rent</text>
            <text id="showLabelDeposit">Deposit</text>
            <br>
            <div class="form-group has-feedback">
                <div class="input-group required-field-block">
                    <span class="input-group-addon">Start Date</span>
                    <input type="date" id="sDate" name="startDate" style="margin-right: -60px; padding-right: 10px;" placeholder="Available From (Date)" required class="form-control"/>
                    <div class="required-icon">
                        <div class="text">*</div>
                    </div>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group required-field-block">
                    <span class="input-group-addon">End  Date</span>
                    <input type="date" id="eDate" name="endDate" style="margin-right: -60px; padding-right: 10px;" placeholder="Available To (Date)" required class="form-control"/>
                    <div class="required-icon">
                        <div class="text">*</div>
                    </div>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group required-field-block">
                    <span class="input-group-addon">$</span>
                    <input type="number" id="monthlyRent" min="0" pattern="0-9" class="form-control" name="monthlyRent" placeholder="Monthly Rent" required/>
                    <div class="required-icon">
                        <div class="text">*</div>
                    </div>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group required-field-block">
                    <span class="input-group-addon">$</span>
                    <input type="number" id="deposit" min="0" step="1" pattern="0-9" name="deposit" placeholder="Deposit" required class="form-control"/>
                    <div class="required-icon">
                        <div class="text">*</div>
                    </div>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <br>
            <text id="showLabelNoRooms">Bedrooms</text>
            <text id="showLabelNoRoomsBath">Bathrooms</text>
            <br>
            <div class="form-group has-feedback">
                <div class="input-group required-field-block">
                    <input type="number" class="form-control" min="0" name="bedrooms" id="bedrooms" placeholder="Number of Rooms" required/>
                    <div class="required-icon">
                        <div class="text">*</div>
                    </div>
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <div class="input-group required-field-block">
                    <input type="number" min="0" name="baths" id="baths" placeholder="Number of Bathrooms" required class="form-control">
                    <div class="required-icon">
                        <div class="text">*</div>
                    </div>
                </div>
                <div class="help-block with-errors"></div>
            </div><br>

            <div class="help-block with-errors"></div>
    </div>
    <text id="showLabelDescription">Description</text><br>
    <textarea cols="126" id="description" rows="3" name ="description" placeholder="Description"></textarea><br><br>
    <text id="showLabelSqFt">Square Feet</text>
    <text id="showLabelPetDeposit">Pet Deposit</text>
    <text id="showLabelKeyDeposit">Key Deposit</text><br>
    <div class="form-group has-feedback">
        <div class="input-group">
            <input type="number" pattern="0-9" class="form-control" name="sqFt" id="sqFt" placeholder="Square Feet">
        </div>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group has-feedback">
        <div class="input-group">
            <span class="input-group-addon">$</span>
            <input type="number" pattern="0-9" class="form-control" name="petDeposit" id="petDeposit" placeholder="Pet Deposit"/>
        </div>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group has-feedback">
        <div class="input-group">
            <span class="input-group-addon">$</span>
            <input type="number" min="0" name="keyDeposit" id="keyDeposit" placeholder="Key Deposit" pattern="0-9" min="0" class="form-control">
        </div>
        <div class="help-block with-errors"></div>

    </div>
    <br><br><br>
    <input type="checkbox" id="electricity" name="electricity"/> <label for="electricity">Electrical</label>
    <input type="checkbox" id="internet" name="internet"/> <label for="internet">Internet</label>
    <input type="checkbox" id="water" name="water"/> <label for="water">Water</label>
    <input type="checkbox" id="gas" name="gas"/> <label for="gas">Gas</label>
    <input type="checkbox" id="pets" name="pets"/> <label for="pets">Allow Pets</label>
    <input type="checkbox" id="smoking" name="smoking"/> <label for="smoking">Smoking</label>
    <input type="checkbox" id="television" name="television"/> <label for="television">Television</label>
    <input type="checkbox" id="furished" name="furnished"/> <label for="furnished">Furnished</label><br><br><br>
    Add images:<br><br>
    <input type="file" id="images" name="images[]" multiple/><br>
    <div id="center">
        <input type="checkbox" name="agree"/> By checking, I accept the <a href="#">Terms of Service</a><br><br>
        <input type="submit" id="button" class="btn btn-default" name ="submit_listing" value="Create Listing" />
    </div>
</form>
</div>
