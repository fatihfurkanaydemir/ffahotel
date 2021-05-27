function editRoom() {
    var form = $("#editroomform");
    var newNumber = document.getElementById("newdoornumber").value;

    var formData = form.serialize();

    $.ajax({
        type: "post",
        url: "../php/edit_room.php",
        data: formData,
        success: function(data, status) {            
            switch(data) {
                case "err-notvalid": 
                    form.prop("class", "needs-validation was-validated"); 
                    break;
                case "true":
                    form.prop("class", "needs-validation");
                    $("#doornumber").prop("value", newNumber);
                    getRoom();
                    vt.success("Room updated successfully", {position: "top-center", duration: 2000});
                    break;
                case "err-roomexists":
                    form.prop("class", "needs-validation");
                    getRoom();
                    vt.error("Doornumber exists", {position: "top-center", duration: 2000});
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}