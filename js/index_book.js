var checkinDateSelector = document.getElementById("checkinDate");
var checkoutDateSelector = document.getElementById("checkoutDate");
var roomTypeSelector = document.getElementById("roomTypeSelect");
var numberPersonSelector = document.getElementById("personNumberSelect");

var checkinSelected = checkoutSelected = false;


checkinDateSelector.addEventListener('change', (event) => {
    checkinSelected = true;
    if(checkoutSelected) { checkReservations(); }
});
checkoutDateSelector.addEventListener('change', (event) => {
    checkoutSelected = true;
    if(checkinSelected) { checkReservations(); }
});
roomTypeSelector.addEventListener('change', (event) => {
    if(!(roomTypeSelector.value == "default")) {
      checkRooms();
    }
});
numberPersonSelector.addEventListener('change', (event) => {
  $("#submit").attr("disabled", false);
});

function checkReservations() {
  var params = "checkindate=" + checkinDateSelector.value +
                "&checkoutdate=" + checkoutDateSelector.value +
                "&checkdate";

  $.ajax({
    type: "post",
    url: "php/check_reservationdates.php",
    data: params,
    success: function(data, status) {            
      switch(data) {
        case "err-date":
          vt.warn("Please select your dates correctly", {position: "top-center", duration: 2000});
          $("#roomTypeSelect").attr("disabled", true);
          $("#personNumberSelect").attr("disabled", true);
          $("#submit").attr("disabled", true);
          $("#roomTypeSelect").prop("selectedIndex", 0);
          $("#personNumberSelect").prop("selectedIndex", 0);
          break;
        case "err-norooms":
          vt.error("All rooms between the dates you have selected are full", {position: "top-center", duration: 2000});
          $("#roomTypeSelect").attr("disabled", true);
          $("#personNumberSelect").attr("disabled", true);
          $("#submit").attr("disabled", true);
          $("#roomTypeSelect").prop("selectedIndex", 0);
          $("#personNumberSelect").prop("selectedIndex", 0);
          break;
        case "true":
          $("#roomTypeSelect").attr("disabled", false);
          break;
      }
    },
    error: function(xhr, desc, err) {
        console.log(desc);
    }
  });
}

function checkRooms() {
  var params = "checkindate=" + checkinDateSelector.value +
                "&checkoutdate=" + checkoutDateSelector.value +
                "&roomtype=" + roomTypeSelector.value +
                "&checkroom";

  $.ajax({
    type: "post",
    url: "php/check_reservationdates.php",
    data: params,
    success: function(data, status) {            
      switch(data) {
        case "err-date":
          vt.warn("Please select your dates correctly", {position: "top-center", duration: 2000});
          break;
        case "err-norooms":
          vt.error("All rooms for this room type between the dates you have selected are full", {position: "top-center", duration: 2000});
          $("#personNumberSelect").attr("disabled", true);
          $("#submit").attr("disabled", true);
          $("#personNumberSelect").prop("selectedIndex", 0);
          break;
        case "true":
          $("#personNumberSelect").attr("disabled", false);
          numberPersonOptions(roomTypeSelector.value);
          break;
      }
    },
    error: function(xhr, desc, err) {
        console.log(desc);
    }
  });
}

function numberPersonOptions(roomtype) {
  switch(roomtype) {
    case "single":
    case "vip":
      $("#personNumberSelect").html(
      "<option value='default' selected>Please select number of persons</option> + \
      <option value='1'>1 Persons</option>");
      break;
    case "double":
      $("#personNumberSelect").html(
        "<option value='default' selected>Please select number of persons</option> + \
        <option value='1'>1 Persons</option> + \
        <option value='2'>2 Persons</option>");
        break;
    case "family":
      $("#personNumberSelect").html(
        "<option value='default' selected>Please select number of persons</option> + \
        <option value='1'>1 Persons</option> + \
        <option value='2'>2 Persons</option> + \
        <option value='3'>3 Persons</option> + \
        <option value='4'>4 Persons</option>");
        break;
  }
}

$("#booknowform").submit(function(event) {
  if($("#personNumberSelect").val() == "default") {
    event.preventDefault();
    vt.warn("Please select number of persons", {position: "top-center", duration: 2000});
  }
});