<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Analysis Visualization</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Website Access and Error Logs Analysis</h1>
    <div>
        <h2>Page Access Timeline</h2>
        <canvas id="accessChart"></canvas>
    </div>
    <div>
        <h2>Error Log Timeline</h2>
        <canvas id="errorChart"></canvas>
    </div>

    <script>
        const accessData = <? php echo json_encode($results['page_accesses']); ?>;
        const errorData = <? php echo json_encode($results['errors']); ?>;
        //the PHP part should be handled within PHP tags and echo'd as JSON encoded strings, but it says I have errors

        const accessLabels = Object.keys(accessData);
        const accessCounts = Object.values(accessData);
        //preparing access data for charting

        const errorTimestamps = errorData.map(item => new Date(item.datetime).toLocaleString());
        const errorStatuses = errorData.map(item => item.status);
        //preparing error data for charting - assuming `datetime` and `status` are available

        new Chart(document.getElementById('accessChart'), {
            type: 'bar',
            data: {
                labels: accessLabels,
                datasets: [{
                    label: 'Page Accesses',
                    data: accessCounts,
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
        // Page Access Chart

        new Chart(document.getElementById('errorChart'), {
            type: 'line',
            data: {
                labels: errorTimestamps,
                datasets: [{
                    label: 'Errors Over Time',
                    data: errorStatuses,
                    fill: false,
                    borderColor: 'red',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                            displayFormats: {
                                day: 'MMM D'
                            }
                        }
                    }
                }
            }
        });// Error Log Chart
    </script>
</body>
</html>
