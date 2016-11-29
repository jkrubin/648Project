src = "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js";
$(document).ready(function () {

    var streetNo = document.getElementById("streetNo").value;
    var streetName = document.getElementById("streetName").value;
    var city = document.getElementById("city").value;
    var zipCode = document.getElementById("zipCode").value;
    var monthlyRent = document.getElementById("monthlyRent").value;
    var deposit = document.getElementById("deposit").value;
    var bathrooms = document.getElementById("bathrooms").value;
    var bedrooms = document.getElementById("bedrooms").value;
    var description = document.getElementById("description").value;


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
    $(document.getElementById("baths")).click(function () {
        showLabel("showLabelNoRoomsBath");
    });
    $(document.getElementById("bedrooms"))(function () {
        showLabel("showLabelNoRooms");
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
    $(document.getElementById("deposit")).click(function () {
        showLabel("showLabelDeposit");
    });
    $(document.getElementById("keyDeposit")).click(function () {
        showLabel("showLabelKeyDeposit");
    });
    $(document.getElementById("monthlyRent")).click(function () {
        showLabel("showLabelMoRent");
    });

    if (streetNo !== "") {
        showLabel("streetNo");
    }
    if (streetName !== "") {
        showLabel("streetName");
    }
    if (city !== "") {
        showLabel("city");
    }
    if (zipCode !== "") {
        showLabel("zipCode");
    }
    if (streetNo !== "") {
        showLabel("streetNo");
    }
    if (streetNo !== "") {
        showLabel("streetNo");
    }


});
function showLabel(idName) {
    document.getElementById(idName).style.visibility = "visible";
}

$(function () {
    $('.required-icon').tooltip({
        placement: 'left',
        title: 'Required field'
    });
});