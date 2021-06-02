function getReports(){
    $.ajax({
        type: "post",
        url: "php/report_operations.php",
        data: "getreports",
        success: function(data, status) {            
            $("#tablecontent").html(data);
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

var selectedReport = undefined;
getReports();

function deleteReport() {
    params = "id=" + selectedReport.id + 
            "&delete";

    $.ajax({
        type: "post",
        url: "php/report_operations.php",
        data: params,
        success: function(data, status) {       
            switch(data) {
                case "true":
                    vt.success("Report removed successfully", {position: "top-center", duration: 2000});
                    getReports();
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

function getReport() {
    var form = $("#getreportform");
    var formData = form.serialize();
    formData += "&get";

    $.ajax({
        type: "post",
        url: "php/report_operations.php",
        data: formData,
        success: function(data, status) {    
            console.log(data);   
            if(data == "err-notvalid"){
                form.prop("class", "needs-validation was-validated");
            }
            else if(data == "err-date"){
                vt.warn("Please select dates correctly", {position: "top-center", duration: 2000});
                form.prop("class", "needs-validation");
            }
            else if(data == "err"){
                vt.error("An error occured", {position: "top-center", duration: 2000});
                form.prop("class", "needs-validation");
            }
            else if(data != "[]"){
                var data = JSON.parse(data);

                var days = new Map();

                data.forEach(element => {
                    if(days.has(element.date)) {
                        var day = days.get(element.date);

                        day.revenue += element.revenue;
                        day.expense += element.expense;
                        day.customercount += element.customercount;

                        days.set(element.date, day);
                    }
                    else {
                        var day = {revenue: element.revenue, expense: element.expense, customercount: element.customercount};

                        days.set(element.date, day);
                    }
                });

                var days = new Map([...days.entries()].sort());

                var customers = new Array();
                var revenues = new Array();
                var expenses = new Array();

                for (let pair of days) { 
                    var [key, value] = pair;
                    
                    customers.push(value.customercount);
                    revenues.push(value.revenue);
                    expenses.push(value.expense);
                }

                const labels = Array.from(days.keys());


                var customerctx = document.getElementById("customerChart").getContext("2d");
                customerctx.canvas.hidden = true;
                var customerChart = new Chart(customerctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Customers',
                                data: customers,
                                borderColor: 'rgb(54, 162, 235)',
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            },
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        animation: {
                            onComplete: function () {
                                var ctx = this.chart.ctx;
                                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                                ctx.fillStyle = "black";
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'bottom';
                        
                                this.data.datasets.forEach(function (dataset)
                                {
                                    for (var i = 0; i < dataset.data.length; i++) {
                                        for(var key in dataset._meta)
                                        {
                                            var model = dataset._meta[key].data[i]._model;
                                            if(dataset.data[i] != 0)
                                                ctx.fillText(dataset.data[i], model.x, model.y + 15);
                                        }
                                    }
                                });
                            }
                        }
                    }
                    
                });

                var revenuexpensectx = document.getElementById("revenueExpenseChart").getContext("2d");
                revenuexpensectx.canvas.hidden = true;
                var revenueExpenseChart = new Chart(revenuexpensectx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Revenue',
                                data: revenues,
                                borderColor: 'rgb(75, 192, 192)',
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            },
                            {
                                label: 'Expense',
                                data: expenses,
                                borderColor: 'rgb(255, 99, 132)',
                                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        animation: {
                            onComplete: function () {
                                var ctx = this.chart.ctx;
                                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                                ctx.fillStyle = "black";
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'bottom';
                        
                                this.data.datasets.forEach(function (dataset)
                                {
                                    for (var i = 0; i < dataset.data.length; i++) {
                                        for(var key in dataset._meta)
                                        {
                                            var model = dataset._meta[key].data[i]._model;
                                            if(dataset.data[i] != 0)
                                                ctx.fillText(dataset.data[i], model.x, model.y + 15);
                                        }
                                    }
                                });

                                reportToPdf();
                            }
                        }
                    }
                });
            }            
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

$(document).on("click", ".btn-delete", function() {
    var data_id = $(this).data("id");

    selectedReport = {id: data_id};

});

$('#getReportModal').on('hidden.bs.modal', function (e) {
    $("#getreportform").trigger("reset");
    $("#getreportform").prop("class", "needs-validation");
})

function reportToPdf() {
    var form = $("#getreportform");
    var formData = form.serialize();
    formData += "&add";

    var customerctx = document.getElementById("customerChart").getContext("2d");
    var revenuexpensectx = document.getElementById("revenueExpenseChart").getContext("2d");
    
    //create new pdf and add our new canvas as an image
    var pdf = new jspdf.jsPDF("landscape");

    pdf.addImage(customerctx.canvas.toDataURL("image/png", 1.0), 'PNG', 10, 10, 290, 200);
    pdf.addPage();
    pdf.addImage(revenuexpensectx.canvas.toDataURL("image/png", 1.0), 'PNG', 10, 10, 290, 200);
    
    // download the pdf
    var blob = pdf.output("blob");

    $.ajax(
    {
        type: "post",
        url: "php/report_operations.php",
        data: formData,
        success: function(data, status){
            if(data == "err") {
                vt.error("An error occured", {position: "top-center", duration: 2000});
            }
            else {
                var formData = new FormData();
                formData.append('pdf', blob);
                formData.append("filename", "report-" + data + ".pdf");
                formData.append("upload", "1");

                $.ajax(
                {
                    type: "post",
                    url: "php/report_operations.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data, status){
                    },
                    error: function(xhr, desc, err){
                        console.log(desc)
                    }
                });

                vt.success("Report created successfully", {position: "top-center", duration: 2000});
                form.prop("class", "needs-validation");
                form.trigger("reset");
                $("#getReportModal").modal("hide");
                getReports();
            }
        },
        error: function(xhr, desc, err){
            console.log(desc)
        }
    });
}