function addReservation() {
    var form = $("#addreservationform");
    var formData = form.serialize();
    formData += "&add";


    $.ajax({
        type: "post",
        url: "php/reservation_operations.php",
        data: formData,
        success: function(data, status) {   
            switch(data) {
                case "err-notvalid": 
                    form.prop("class", "needs-validation was-validated"); 
                    break;
                case "err-room":
                    vt.error("This room does not exist", {position: "top-center", duration: 2000});
                    form.prop("class", "needs-validation");
                    break;
                case "err-customer":
                    vt.error("This customer does not exist", {position: "top-center", duration: 2000});
                    form.prop("class", "needs-validation");
                    break;
                case "err-date":
                    vt.warn("Please select your dates correctly", {position: "top-center", duration: 2000});
                    form.prop("class", "needs-validation");
                    break;
                case "err-norooms":
                    vt.error("This operation is not possible between these dates", {position: "top-center", duration: 2000});
                    form.prop("class", "needs-validation");
                    break;
                case "true":
                    form.prop("class", "needs-validation");
                    form.trigger("reset");
                    vt.success("Reservation added successfully", {position: "top-center", duration: 2000});
                    break;
                case "err":
                    form.prop("class", "needs-validation");
                    vt.error("An error occured", {position: "top-center", duration: 2000});
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}