$(document).on("change", "#newcheckindate", function() {
    checkReservations();
});
$(document).on("change", "#newcheckoutdate", function() {
    checkReservations();
});


function checkReservations() {
    var params = "checkindate=" + $("#newcheckindate").val() +
                  "&checkoutdate=" + $("#newcheckoutdate").val() +
                  "&oldcheckindate=" + selectedReservation.checkindate +
                  "&oldcheckoutdate=" + selectedReservation.checkoutdate +
                  "&doornumber=" + selectedReservation.doornumber +
                  "&checkdoornumber";

    $.ajax({
      type: "post",
      url: "php/check_reservationdates.php",
      data: params,
      success: function(data, status) {          
        console.log(data);  
        switch(data) {
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