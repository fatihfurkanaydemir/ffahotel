function bookNow() {
    var form = $("#bookform");
    var formData = form.serialize();

    $.ajax({
        type: "post",
        url: "php/booknow.php",
        data: formData,
        success: function(data, status) {    
            console.log(data);
            switch(data) {
                case "err-notvalid": 
                    form.prop("class", "needs-validation was-validated"); 
                    vt.error("fill", {position: "top-center", duration: 2000});
                    break;
                case "err-cardnumber": 
                    form.prop("class", "needs-validation was-validated"); 
                    vt.error("Please control your card number", {position: "top-center", duration: 2000});
                    break;
                case "err-cvc": 
                    form.prop("class", "needs-validation was-validated"); 
                    vt.error("Please control your cvc", {position: "top-center", duration: 2000});
                    break;
                case "err-expirationdate": 
                    form.prop("class", "needs-validation was-validated"); 
                    vt.error("Please control your expiration date", {position: "top-center", duration: 2000});
                    break;
                case "err-emailused":
                    vt.error("This email is used by another customer", {position: "top-center", duration: 2000});
                    break;
                case "err-email":
                    vt.error("Please check your email", {position: "top-center", duration: 2000});
                    break;
                case "err-idnumber":
                    vt.error("Please check your id number", {position: "top-center", duration: 2000});
                    break;
                case "err-phonenumber":
                    vt.error("Please check your phonenumber", {position: "top-center", duration: 2000});
                    break;
                case "err-idused": 
                    vt.error("This id number is used by another customer", {position: "top-center", duration: 2000});
                    break;
                case "err-accountexistsid": 
                    vt.error("There exists an account linked with this id number, please login", {position: "top-center", duration: 2000});
                    break;
                case "err-accountexistsemail": 
                    vt.error("There exists an account linked with this email, please login", {position: "top-center", duration: 2000});
                    break;
                case "true":
                    form.prop("disabled", true);
                    $("#bookNowBtn").prop("disabled", true);
                    form.prop("class", "needs-validation");
                    vt.success("Reservation successfully added", {position: "top-center", duration: 2000});
                    setTimeout(function() {
                        $('<form action="index.php"></form>').appendTo($(document.body)).submit();
                    }, 2200);
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