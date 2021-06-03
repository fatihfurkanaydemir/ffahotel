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

            var daysData = counts.days;

            var days = new Map();

            if(daysData.length != 0) {
                daysData.forEach(element => {
                    if(days.has(element.date)) {
                        var day = days.get(element.date);
    
                        day.customercount += element.customercount;
    
                        days.set(element.date, day);
                    }
                    else {
                        var day = {customercount: element.customercount};
    
                        days.set(element.date, day);
                    }
                });
            }
            else {
                days.set((new Date()).toISOString().split('T')[0], {customercount: 0});
            }

            var days = new Map([...days.entries()].sort());

            var customers = new Array();

            for (let pair of days) { 
                var [key, value] = pair;
                
                customers.push(value.customercount);
            }

            const labels = Array.from(days.keys());

            var chartctx = document.getElementById("chart").getContext("2d");
            var chart = new Chart(chartctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Customers This Month',
                            data: customers,
                            borderColor: 'rgb(54, 162, 235)',
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        },
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true
                            }
                        }]
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
                                        if(dataset.data[i] == 1)
                                            ctx.fillText(dataset.data[i], model.x, model.y - 15);
                                        else if(dataset.data[i] != 0)
                                            ctx.fillText(dataset.data[i], model.x, model.y + 15);
                                    }
                                }
                            });
                        }
                    }
                }
                
            });
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

updateDashboard();