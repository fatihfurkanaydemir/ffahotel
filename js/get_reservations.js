function getReservations() {
    var params = "";
    
    $.ajax({
        type: "post",
        url: "php/get_reservations.php",
        data: params,
        success: function(data, status) {            
            $("#reservations").html(data);
            document.getElementById("makereview-commenttext").value = "";
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

 