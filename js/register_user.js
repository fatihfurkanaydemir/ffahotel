function registerUser() {
    var form = $("#registerform");
    var formData = form.serialize();

    $.ajax({
        type: "post",
        url: "php/register_user.php",
        data: formData,
        success: function(data, status) {    
            switch(data) {
                case "err-notvalid": 
                    form.prop("class", "needs-validation was-validated"); 
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
                case "err-password":
                    vt.error("Your passwords do not match", {position: "top-center", duration: 2000});
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
                    $("#signUpBtn").prop("disabled", true);
                    form.prop("class", "needs-validation");
                    vt.success("You have signed up successfully", {position: "top-center", duration: 2000});
                    setTimeout(function() {
                        $('<form action="login.php"></form>').appendTo($(document.body)).submit();
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