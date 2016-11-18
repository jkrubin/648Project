src = "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js";

function showLabel(idName) {
    document.getElementById(idName).style.visibility = "visible";
}

$(function () {
    $('.required-icon').tooltip({
        placement: 'left',
        title: 'Required field'
    });
});
