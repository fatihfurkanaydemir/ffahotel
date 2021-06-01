function updateDashboard() {
    $.ajax({
        type: "post",
        url: "php/dashboard_status.php",
        data: "",
        success: function(data, status) {  
            var counts = JSON.parse(data);
        
            $("#rooms").html(counts.roomcount);
            $("#customers").html(counts.customercount);
            $("#reviews").html(counts.avgrate + "/5");
            $("#revenue").html(counts.revenuethismonth + " USD");
            $("#expense").html(counts.expensethismonth + " USD");
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

updateDashboard();