function getCustomers() {
    $.ajax({
        type: "post",
        url: "php/customer_operations.php",
        data: "get",
        success: function(data, status) {            
            $("#tablecontent").html(data);
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

getCustomers();

function submitForm(form) {
    $("#"+form).submit();
}

function getUser(id) {
    $.ajax({
        type: "post",
        url: "php/customer_operations.php",
        data: "id="+ id + "&getuser",
        success: function(data, status) {            
            var user = JSON.parse(data);
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

function editUser() {
    var form = $("#edituserform");
    var formData = form.serialize();
    formData += "&edit";

    $.ajax({
        type: "post",
        url: "php/customer_operations.php",
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
                    setTimeout(function() {
                        $('<form action="customers.php" method="POST"></form>').appendTo($(document.body)).submit();
                    }, 2200);
                    $("#btn-edituser").prop("disabled", true);
                    break;
                 case "err":
                    form.prop("class", "needs-validation");
                    vt.error("Customer can not be updated now, customer may have reservations", {position: "top-center", duration: 2000});
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

function addUser() {
    var form = $("#adduserform");
    var formData = form.serialize();
    formData += "&add";

    $.ajax({
        type: "post",
        url: "php/customer_operations.php",
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
                    vt.success("Customer added successfully", {position: "top-center", duration: 2000});
                    form.trigger("reset");
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