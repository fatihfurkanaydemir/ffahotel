$(document).on("click", "#btn-cancelReservation", function(){
    var params="checkindate=" + selectedReservation.checkindate +
                "&doornumber=" + selectedReservation.doornumber +
                "&cancel";

    $.ajax({
        type: "post",
        url: "php/reservation_operations.php",
        data: params,
        success: function(data, status) {  
            switch(data) {
                case "true":
                    vt.success("Reservation successfully canceled", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
                case "err":
                    vt.error("An error occured", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
});

$(document).on("click", "#btn-makeReview", function(){
    if($("#makereview-commenttext").val().trim() != "")
    {
        $rate = 0;
        for(r of $("#makereview-commentrate input[name='rating']")) {
            if(r.checked) {
                $rate = r.value;
            }
        }

        var params="checkindate=" + selectedReservation.checkindate +
                "&doornumber=" + selectedReservation.doornumber +
                "&commenttext=" + $("#makereview-commenttext").val().trim() +
                "&commentrate=" + $rate +
                "&makereview";

        $.ajax({
            type: "post",
            url: "php/reservation_operations.php",
            data: params,
            success: function(data, status) {  
                switch(data) {
                    case "true":
                        vt.success("Review successfully added", {position: "top-center", duration: 2000});
                        getReservations();
                        break;
                    case "err":
                        vt.error("An error occured", {position: "top-center", duration: 2000});
                        getReservations();
                        break;
                }
            },
            error: function(xhr, desc, err) {
                console.log(desc);
            }
        });
    }
    
});

$(document).on("click", "#btn-deleteReview", function(){
    var params="checkindate=" + selectedReservation.checkindate +
                "&doornumber=" + selectedReservation.doornumber +
                "&commentid=" + selectedReservation.commentid +
                "&deletereview";

    $.ajax({
        type: "post",
        url: "php/reservation_operations.php",
        data: params,
        success: function(data, status) {  
            switch(data) {
                case "true":
                    vt.success("Review successfully removed", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
                case "err":
                    vt.error("An error occured", {position: "top-center", duration: 2000});
                    getReservations();
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
});

$(document).on("click", "#btn-editReview", function(){
    if($("#editreview-commenttext").val().trim() != "")
    {
        $rate = 0;
        for(r of $("#editreview-commentrate input[name='rating']")) {
            if(r.checked) {
                $rate = r.value;
            }
        }

        var params="checkindate=" + selectedReservation.checkindate +
                "&doornumber=" + selectedReservation.doornumber +
                "&commentid=" + selectedReservation.commentid +
                "&commenttext=" + $("#editreview-commenttext").val().trim() +
                "&commentrate=" + $rate +
                "&editreview";

        $.ajax({
            type: "post",
            url: "php/reservation_operations.php",
            data: params,
            success: function(data, status) {  
                switch(data) {
                    case "true":
                        vt.success("Review successfully updated", {position: "top-center", duration: 2000});
                        getReservations();
                        break;
                    case "err":
                        vt.error("An error occured", {position: "top-center", duration: 2000});
                        getReservations();
                        break;
                }
            },
            error: function(xhr, desc, err) {
                console.log(desc);
            }
        });
    }
    
});