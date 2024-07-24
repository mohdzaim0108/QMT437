document.addEventListener('DOMContentLoaded', function () {
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', 
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Fetch data from the hidden input
    const data = JSON.parse(document.getElementById('chartData').value);

    // Process data
    const trueCount = data.trueCount || 0;
    const falseCount = data.falseCount || 0;

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart").getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: [trueCount, falseCount],
                backgroundColor: [
                    'rgb(31, 224, 0)', // Green for correct
                    'rgb(255, 0, 0)'  // Red for wrong
                ],
                hoverOffset: 4
            }],
            labels: ['Correct', 'Wrong'] // Labels for the pie chart
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            },
            cutoutPercentage: 0, // For full pie
            responsive: true,
        }
    });
});
