function getReservations() {
    $.ajax({
        type: "post",
        url: "php/reservation_operations.php",
        data: "get",
        success: function(data, status) {            
            $("#tablecontent").html(data);
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

function cancelReservation() {
    var params = "&checkindate=" + selectedReservation.checkindate +
                 "&doornumber=" + selectedReservation.doornumber +
                 "&cancel";

    $.ajax({
        type: "post",
        url: "php/reservation_operations.php",
        data: params,
        success: function(data, status) {            
            switch(data) {
                case "true":
                    vt.success("Reservation canceled successfully", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
                case "err":
                    vt.success("An error occured", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

var selectedReservation = undefined;
getReservations();

$(document).on("click", ".btn-edit", function() {
    var data_checkindate = $(this).data("checkindate");
    var data_checkoutdate = $(this).data("checkoutdate");
    var data_doornumber = $(this).data("doornumber");

    selectedReservation = {checkindate: data_checkindate, checkoutdate: data_checkoutdate, doornumber: data_doornumber};
    
    $("#newdoornumber").prop("value", data_doornumber);
    $("#newcheckindate").prop("value", data_checkindate);
    $("#newcheckoutdate").prop("value", data_checkoutdate);

    $("#newcheckindate").prop("disabled", false);
    if((new Date()) > (new Date(data_checkindate))) {
        $("#newcheckindate").prop("disabled", true);
    }
});

function editReservation(){
    var params = "checkindate=" + $("#newcheckindate").val() +
                  "&checkoutdate=" + $("#newcheckoutdate").val() +
                  "&oldcheckindate=" + selectedReservation.checkindate +
                  "&olddoornumber=" + selectedReservation.doornumber +
                  "&doornumber=" + $("#newdoornumber").val() +
                  "&edit";

    $.ajax({
        type: "post",
        url: "php/reservation_operations.php",
        data: params,
        success: function(data, status) {  
            switch(data) {
                case "true":
                    vt.success("Reservation successfully updated", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
                case "err":
                    vt.error("An error occured", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

$(document).on("click", ".btn-checkin", function() {
    var params = "customerid=" + $(this).data("customerid") +
                 "&checkin";

    $.ajax({
        type: "post",
        url: "php/reservation_operations.php",
        data: params,
        success: function(data, status) {            
            switch(data) {
                case "true":
                    vt.success("Customer checked in successfully", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
                case "err":
                    vt.success("An error occured", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
});

$(document).on("click", ".btn-cancel", function() {
    var data_checkindate = $(this).data("checkindate");
    var data_doornumber = $(this).data("doornumber");

    selectedReservation = {checkindate: data_checkindate, doornumber: data_doornumber};
});

$(document).on("click", ".btn-checkout", function() {
    var params = "customerid=" + $(this).data("customerid") +
                 "&checkindate=" + $(this).data("checkindate") +
                 "&doornumber=" + $(this).data("doornumber") +
                 "&checkout";

    $.ajax({
        type: "post",
        url: "php/reservation_operations.php",
        data: params,
        success: function(data, status) {            
            switch(data) {
                case "true":
                    vt.success("Customer checked out successfully", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
                case "err":
                    vt.success("An error occured", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
});

$(document).on("change", "#newcheckindate", function() {
    checkReservations();
});
$(document).on("change", "#newcheckoutdate", function() {
    checkReservations();
});
$(document).on("input", "#newdoornumber", function() {
    checkReservations();
});


function checkReservations() {
    var params = "checkindate=" + $("#newcheckindate").val() +
                  "&checkoutdate=" + $("#newcheckoutdate").val() +
                  "&oldcheckindate=" + selectedReservation.checkindate +
                  "&doornumber=" + $("#newdoornumber").val() +
                  "&checkdoornumber";

    $.ajax({
      type: "post",
      url: "php/reservation_operations.php",
      data: params,
      success: function(data, status) {          
        switch(data) {
          case "err-notvalid":
            vt.warn("Please enter a valid doornumber", {position: "top-center", duration: 2000});
            $("#btn-extendReservation").prop("disabled", true);
            break;
          case "err-room":
            vt.error("This room does not exist", {position: "top-center", duration: 2000});
            $("#btn-extendReservation").prop("disabled", true);
            break;
          case "err-date":
            vt.warn("Please select your dates correctly", {position: "top-center", duration: 2000});
            $("#btn-extendReservation").prop("disabled", true);
            break;
          case "err-norooms":
            vt.error("This operation is not possible between these dates", {position: "top-center", duration: 2000});
            $("#btn-extendReservation").prop("disabled", true);
            break;
          case "true":
            $("#btn-extendReservation").prop("disabled", false);
            break;
        }
      },
      error: function(xhr, desc, err) {
          console.log(desc);
      }
    });
}

function searchByName() {
    var form = $("#searchnameform");
    var formData = form.serialize();
    formData += "&searchname";

    $.ajax({
        type: "post",
        url: "php/reservation_operations.php",
        data: formData,
        success: function(data, status) {  
            if(data == "err-notvalid") {
                form.prop("class", "needs-validation was-validated"); 
            }         
            else {
                form.prop("class", "needs-validation");
                $("#tablecontent").html(data);
            } 
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

function searchByDates() {
    var form = $("#searchdatesform");
    var formData = form.serialize();
    formData += "&searchdate";

    $.ajax({
        type: "post",
        url: "php/reservation_operations.php",
        data: formData,
        success: function(data, status) {  
            if(data == "err-notvalid") {
                form.prop("class", "needs-validation was-validated"); 
            }         
            else if(data == "err-date") {
                vt.warn("Please select your dates correctly", {position: "top-center", duration: 2000});
                form.prop("class", "needs-validation"); 
            }         
            else {
                form.prop("class", "needs-validation");
                $("#tablecontent").html(data);
            } 
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}