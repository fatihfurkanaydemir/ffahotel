function addRoom() {
    var form = $("#addroomform");
    var formData = form.serialize();


    $.ajax({
        type: "post",
        url: "../php/add_room.php",
        data: formData,
        success: function(data, status) {            
            switch(data) {
                case "err-notvalid": 
                    form.prop("class", "needs-validation was-validated"); 
                    break;
                case "true":
                    form.prop("class", "needs-validation");
                    form.trigger("reset");
                    vt.success("Room added successfully", {position: "top-center", duration: 2000});
                    break;
                case "err-roomexists":
                    form.prop("class", "needs-validation");
                    form.trigger("reset");
                    vt.error("Room already exists", {position: "top-center", duration: 2000});
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}