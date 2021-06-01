function getExpenses() {
    $.ajax({
        type: "post",
        url: "php/expense_operations.php",
        data: "get",
        success: function(data, status) {            
            $("#tablecontent").html(data);
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

var selectedExpense = undefined;
getExpenses();

function addExpense() {
    var form = $("#addexpenseform");
    var formData = form.serialize();
    formData += "&add";

    $.ajax({
        type: "post",
        url: "php/expense_operations.php",
        data: formData,
        success: function(data, status) {       
            switch(data) {
                case "err-notvalid":
                    form.prop("class", "needs-validation m-3 w-100 was-validated"); 
                    break;
                case "err-amount":
                    form.prop("class", "needs-validation m-3 w-100"); 
                    vt.error("Amount is not valid", {position: "top-center", duration: 2000});
                    break;
                case "true":
                    form.prop("class", "needs-validation m-3 w-100"); 
                    vt.success("Expense added successfully", {position: "top-center", duration: 2000});
                    getExpenses();
                    break;
                case "err":
                    form.prop("class", "needs-validation m-3 w-100 was-validated"); 
                    vt.error("An error occured", {position: "top-center", duration: 2000});
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

function deleteExpense() {
    params = "id=" + selectedExpense.id + 
            "&delete";

    $.ajax({
        type: "post",
        url: "php/expense_operations.php",
        data: params,
        success: function(data, status) {       
            switch(data) {
                case "true":
                    vt.success("Expense removed successfully", {position: "top-center", duration: 2000});
                    getExpenses();
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

    selectedExpense = {id: data_id};
});