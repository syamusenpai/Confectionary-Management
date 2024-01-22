<?php
 


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aneka_2.0";

$dbc = new mysqli($servername, $username, $password, $dbname);
// Check the connection
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}

$profitData = array();

// Modify the query to select profit data from the sales table
$resProfit = mysqli_query($dbc, "SELECT DATE_FORMAT(sale_date, '%b %d') as day_month, 
                                  SUM(profit) as total_profit
                                  FROM sales
                                  GROUP BY DAY(sale_date)
                                  ORDER BY DAY(sale_date)");

$totalProfit = 0;

while ($rowProfit = mysqli_fetch_array($resProfit)) {
    $totalProfit += $rowProfit["total_profit"]; // Calculate running total
    $profitData[] = array(
        "label" => $rowProfit["day_month"],
        "total" => $rowProfit["total_profit"],
        "full" => $totalProfit // Running total represents full profits
    );
}





?><!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApexCharts Example</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.5"></script>
</head>
<body>

<div class="charts">
    <div class="charts-card">
        <h2 class="chart-title">Top 5 Products</h2>
        <div id="bar-chart"></div>
    </div>

    <div class="charts-card">
        <h2 class="chart-title">Profit Movements</h2>
        <div id="area-chart"></div>
    </div>
</div>
<script>
  // Assuming $profitData is already defined in PHP
const profitData = <?php echo json_encode($profitData); ?>;

document.addEventListener('DOMContentLoaded', function () {
    // AREA CHART
    const areaChartOptions = {
        chart: {
            height: 350,
            type: 'area',
            zoom: {
                enabled: false
            }
            
        },
        
        series: [{
            name: 'Total Profits',
            data: profitData.map(entry => ({ x: entry.label, y: entry.total })),
        }],
        xaxis: {
            type: 'category',
            categories: profitData.map(entry => entry.label),
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
    text: 'Profits Overview - Total: RM' + profitData.reduce((total, entry) => total + parseFloat(entry.total), 0).toFixed(2),
    align: 'left'
},

        subtitle: {
            text: 'Price Movements',
            align: 'left'
        },
        labels: {
            show: true,
            formatter: function (val) {
                return val.split(' ')[1]; // Display only the day
            }
        },
        yaxis: {
            opposite: true
        },
        legend: {
            horizontalAlign: 'left'
        }
    };

    const areaChart = new ApexCharts(
        document.querySelector('#area-chart'),
        areaChartOptions
    );
    areaChart.render();
});

</script>

</body>
</html>

