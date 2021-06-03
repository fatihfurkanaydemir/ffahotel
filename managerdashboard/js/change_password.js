function changePassword() {
    var form = $("#changepasswordform");
    var formData = form.serialize();

    $.ajax({
        type: "post",
        url: "php/change_password.php",
        data: formData,
        success: function(data, status) {  
            console.log(data);
            switch(data) {
                case "err-notvalid": 
                    form.prop("class", "needs-validation was-validated"); 
                    break;
                case "err-oldpswdwrong":
                    form.prop("class", "needs-validation");
                    vt.error("Your old password is wrong", {position: "top-center", duration: 2000});
                    break;
                case "err-pswdnomatch":
                    form.prop("class", "needs-validation");
                    vt.error("Your passwords do not match", {position: "top-center", duration: 2000});
                    break;
                case "true":
                    form.prop("class", "needs-validation");
                    form.trigger("reset");
                    vt.success("Password updated successfully", {position: "top-center", duration: 2000});
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