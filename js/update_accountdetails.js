function accountDetailsForm() {
    var form = $("#accountdetailsform");
    var formData = form.serialize();

    $.ajax({
        type: "post",
        url: "php/update_accountdetails.php",
        data: formData,
        success: function(data, status) {            
            switch(data) {
                case "err-notvalid": 
                    form.prop("class", "needs-validation was-validated"); 
                    break;
                case "err-email":
                    form.prop("class", "needs-validation");
                    vt.error("Please enter a valid email", {position: "top-center", duration: 2000});
                    break;
                case "err-phonenumber":
                    form.prop("class", "needs-validation");
                    vt.error("Please enter a valid phone number", {position: "top-center", duration: 2000});
                    break;
                case "err-idnumber":
                    form.prop("class", "needs-validation");
                    vt.error("Please enter a valid id number", {position: "top-center", duration: 2000});
                    break;
                case "err-duplicateid":
                    form.prop("class", "needs-validation");
                    vt.error("This id number is already used", {position: "top-center", duration: 2000});
                    break;
                case "err-duplicateemail":
                    form.prop("class", "needs-validation");
                    vt.error("This email is already used", {position: "top-center", duration: 2000});
                    break;
                case "true":
                    form.prop("class", "needs-validation");
                    vt.success("Details updated successfully", {position: "top-center", duration: 2000});
                    break;
                 case "err":
                    form.prop("class", "needs-validation");
                    vt.error("Account details can not be updated, you may have reservations", {position: "top-center", duration: 2000});
                    break;
            }

            getAccountDetails();
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}