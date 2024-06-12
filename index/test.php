<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="chart-container">
        <canvas id="drinkSalesChart"></canvas>
        <canvas id="machineSalesChart"></canvas>
    </div>

    <script>
        function fetchSales() {
            fetch('../index/getsales.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Received Data:', data);

                    const drinkLabels = data.drinks.map(drink => drink.name);
                    const drinkSalesData = data.drinks.map(drink => drink.total_sales);

                    const machineLabels = data.machines.map(machine => machine.vID);
                    const machineSalesData = data.machines.map(machine => machine.total_sales);

                    // 创建饮料销售量条形图
                    createChart('drinkSalesChart', 'Drink Sales', drinkLabels, drinkSalesData);

                    // 创建售卖机销售量条形图
                    createChart('machineSalesChart', 'Machine Sales', machineLabels, machineSalesData);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        function createChart(canvasId, chartTitle, labels, data) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: chartTitle,
                        data: data,
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
        }

        fetchSales();
    </script>
</body>
</html>
