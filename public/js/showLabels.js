$(document).ready(function () {
    // variables for input fields
    var streetNo = document.getElementById("streetNo").value.toString();
    var streetName = document.getElementById("streetName").value.toString();
    var city = document.getElementById("city").value.toString();
    var zipCode = document.getElementById("zipCode").value.toString();
    var monthlyRent = document.getElementById("monthlyRent").value.toString();
    var deposit = document.getElementById("deposit").value.toString();
    var bathrooms = document.getElementById("baths").value.toString();
    var bedrooms = document.getElementById("bedrooms").value.toString();
    var description = document.getElementById("description").value.toString();
    var sqFt = document.getElementById("sqFt").value.toString();
    var petDeposit = document.getElementById("description").value.toString();
    var keyDeposit = document.getElementById("description").value.toString();

    // checks if input is blank for page reload
    if (streetNo !== "") {
        showLabel("showLabelSTNo");
    }
    if (streetName !== "") {
        showLabel("showLabelSTName");
    }
    if (city !== "") {
        showLabel("showLabelCity");
    }
    if (zipCode !== "") {
        showLabel("showLabelZipCode");
    }
    if (monthlyRent !== "") {
        showLabel("showLabelMoRent");
    }
    if (deposit !== "") {
        showLabel("showLabelDeposit");
    }
    if (bedrooms !== "") {
        showLabel("showLabelNoRooms");
    }
    if (bathrooms !== "") {
        showLabel("showLabelNoRoomsBath");
    }
    if (description !== "") {
        showLabel("showLabelDescription");
    }
    if (sqFt !== "") {
        showLabel("showLabelSqFt");
    }
    if (petDeposit !== "") {
        showLabel("showLabelPetDeposit");
    }
    if (keyDeposit !== "") {
        showLabel("showLabelKeyDeposit");
    }

    // For click events
    $(document.getElementById("streetNo")).click(function () {
        showLabel("showLabelSTNo");
    });
    $(document.getElementById("streetName")).click(function () {
        showLabel("showLabelSTName");
    });
    $(document.getElementById("city")).click(function () {
        showLabel("showLabelCity");
    });
    $(document.getElementById("zipCode")).click(function () {
        showLabel("showLabelZipCode");
    });
    $(document.getElementById("monthlyRent")).click(function () {
        showLabel("showLabelMoRent");
    });
    $(document.getElementById("deposit")).click(function () {
        showLabel("showLabelDeposit");
    });
    $(document.getElementById("bedrooms")).click(function () {
        showLabel("showLabelNoRooms");
    });
    $(document.getElementById("baths")).click(function () {
        showLabel("showLabelNoRoomsBath");
    });
    $(document.getElementById("description")).click(function () {
        showLabel("showLabelDescription");
    });
    $(document.getElementById("sqFt")).click(function () {
        showLabel("showLabelSqFt");
    });
    $(document.getElementById("petDeposit")).click(function () {
        showLabel("showLabelPetDeposit");
    });
    $(document.getElementById("keyDeposit")).click(function () {
        showLabel("showLabelKeyDeposit");
    });

    // For tab instances

    $(document.getElementById("streetNo")).select(function () {
        showLabel("showLabelSTNo");
    });
    $(document.getElementById("streetName")).select(function () {
        showLabel("showLabelSTName");
    });
    $(document.getElementById("city")).select(function () {
        showLabel("showLabelCity");
    });
    $(document.getElementById("zipCode")).select(function () {
        showLabel("showLabelZipCode");
    });
    $(document.getElementById("monthlyRent")).select(function () {
        showLabel("showLabelMoRent");
    });
    $(document.getElementById("deposit")).select(function () {
        showLabel("showLabelDeposit");
    });
    $(document.getElementById("bedrooms")).select(function () {
        showLabel("showLabelNoRooms");
    });
    $(document.getElementById("baths")).select(function () {
        showLabel("showLabelNoRoomsBath");
    });
    $(document.getElementById("description")).select(function () {
        showLabel("showLabelDescription");
    });
    $(document.getElementById("sqFt")).select(function () {
        showLabel("showLabelSqFt");
    });
    $(document.getElementById("petDeposit")).select(function () {
        showLabel("showLabelPetDeposit");
    });
    $(document.getElementById("keyDeposit")).select(function () {
        showLabel("showLabelKeyDeposit");
    });

});

// Set label visible
function showLabel(idName) {
    document.getElementById(idName).style.visibility = "visible";
}

// Set asterik for required fields
$(function () {
    $('.required-icon').tooltip({
        placement: 'left',
        title: 'Required field'
    });
});