var checkinDateSelector = document.getElementById("checkinDate");
var checkoutDateSelector = document.getElementById("checkoutDate");

var checkinSelected = checkoutSelected = false;


checkinDateSelector.addEventListener('change', (event) => {
    checkinSelected = true;
    if(checkoutSelected) { checkReservations(); }
});
checkoutDateSelector.addEventListener('change', (event) => {
    checkoutSelected = true;
    if(checkinSelected) { checkReservations(); }
});

function checkReservations() {
    var xhttp = new XMLHttpRequest();
    var params = "checkindate=" + checkinDateSelector.value + "&checkoutdate=" + checkoutDateSelector.value

    xhttp.open("POST", "php/check_reservationdates.php?" + params, true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(xhttp.responseText == "true") {
            document.getElementById("roomTypeSelect").removeAttribute("disabled");
        }
      }
    };

    xhttp.send(params);
}