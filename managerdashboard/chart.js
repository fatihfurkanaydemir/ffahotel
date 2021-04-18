var randomScalingFactor = function() {
    return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
};
var randomColorFactor = function() {
    return Math.round(Math.random() * 255);
};

var barChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
        label: 'Dataset 1',
        backgroundColor: "rgba(151,187,205,0.5)",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
        borderColor: 'white',
        borderWidth: 2
    }, {
        label: 'Dataset 2',
        backgroundColor: "rgba(151,187,205,0.5)",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
        borderColor: 'white',
        borderWidth: 2
    }, {
        type: 'line',
        label: 'Dataset 3',
        backgroundColor: "rgba(220,220,220,0.5)",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }, ]

};
var myBar = null;
window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
        }
    });
};

function randomize() {
    $.each(barChartData.datasets, function(i, dataset) {
        dataset.backgroundColor = 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
        dataset.data = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];

    });
    myBar.update();
}

setInterval(randomize, 5000);