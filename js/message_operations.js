function getMessages() {
    $.ajax({
        type: "post",
        url: "php/message_operations.php",
        data: "get",
        success: function(data, status) {            
            $("#tablecontent").html(data);
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

getMessages();

function sendMessage() {
    var form = $("#sendmessageform");
    var formData = form.serialize();
    formData += "&send";

    $.ajax({
        type: "post",
        url: "php/message_operations.php",
        data: formData,
        success: function(data, status) {       
            switch(data) {
                case "err-notvalid": 
                    form.prop("class", "needs-validation was-validated"); 
                    break;
                case "true":
                    vt.success("Message sent successfully", {position: "top-center", duration: 2000});
                    form.prop("class", "needs-validation"); 
                    form.trigger("reset");
                    getMessages();
                    break;
                case "err":
                    vt.error("An error occured", {position: "top-center", duration: 2000});
                    form.prop("class", "needs-validation"); 
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}