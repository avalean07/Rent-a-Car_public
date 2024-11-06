<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Analysis Visualization</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Log Analysis Charts</h1>
    <canvas id="accessChart" width="800" height="400"></canvas>
    <canvas id="errorChart" width="800" height="400"></canvas>

    <script>
        
    const accessData = JSON.parse('<?php echo json_encode($GLOBALS['accessLogs']); ?>');
    const errorData = JSON.parse('<?php echo json_encode($GLOBALS['errorLogs']); ?>');

    const accessChartContext = document.getElementById('accessChart').getContext('2d');
    const errorChartContext = document.getElementById('errorChart').getContext('2d');

   
    const accessChart = new Chart(accessChartContext, {
        type: 'line',
        data: {
            labels: accessData.map(log => log.datetime),
            datasets: [{
                label: 'Access Count',
                data: accessData.map(log => log.status),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const errorChart = new Chart(errorChartContext, {
        type: 'bar',
        data: {
            labels: errorData.map(log => log.datetime),
            datasets: [{
                label: 'Error Count',
                data: errorData.map(log => log.status),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>
</html>
