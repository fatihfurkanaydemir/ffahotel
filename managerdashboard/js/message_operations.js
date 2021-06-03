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

$(document).on("click", ".btn-markread", function() {
    var data_id = $(this).data("id");

    params = "id=" + data_id + 
            "&markread";

    $.ajax({
        type: "post",
        url: "php/message_operations.php",
        data: params,
        success: function(data, status) {       
            switch(data) {
                case "true":
                    vt.success("Message marked as read successfully", {position: "top-center", duration: 2000});
                    getMessages();
                    break;
                case "err":
                    vt.error("An error occured", {position: "top-center", duration: 2000});
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
});