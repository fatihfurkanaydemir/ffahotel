function getReviews() {
    $.ajax({
        type: "post",
        url: "php/review_operations.php",
        data: "get",
        success: function(data, status) {            
            $("#tablecontent").html(data);
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

var selectedReview = undefined;
getReviews();

function deleteReview() {
    params = "id=" + selectedReview.id + 
            "&delete";

    $.ajax({
        type: "post",
        url: "php/review_operations.php",
        data: params,
        success: function(data, status) {       
            switch(data) {
                case "true":
                    vt.success("Review removed successfully", {position: "top-center", duration: 2000});
                    getReviews();
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
}

$(document).on("click", ".btn-modal", function() {
    var data_id = $(this).data("id");

    selectedReview = {id: data_id};
});