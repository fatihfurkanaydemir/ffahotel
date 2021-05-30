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
                    vt.success("Room updated successfully", {position: "top-center", duration: 2000});
                    $.redirectPost("editroom.php", {"doornumber": newNumber});
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

// jquery extend function
$.extend(
{
    redirectPost: function(location, args)
    {
        var form = '';
        $.each( args, function( key, value ) {
            value = value.split('"').join('\"')
            form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        });

        setTimeout(function() {
            $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo($(document.body)).submit();
        }, 2200);
        
    }
});