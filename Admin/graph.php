<?php
// Database connection parameters
require_once("db/dbconnect.php");

// Get current date
$currentDate = date("Y-m-d");

// Query for daily sales
$daily_sales_query = "SELECT p.sub_category, SUM(quantity) AS total_sales
                      FROM Orders o, products p
                      WHERE FIND_IN_SET(p.product_id, o.product_id)
                        AND DATE(time_created) = '$currentDate'
                      GROUP BY p.sub_category";

$daily_sales_result = $conn->query($daily_sales_query);

// Query for monthly sales
$currentMonth = date("Y-m");

$monthly_sales_query = "SELECT p.sub_category, SUM(quantity) AS total_sales
                        FROM Orders o, products p
                        WHERE FIND_IN_SET(p.product_id, o.product_id)
                          AND DATE_FORMAT(time_created, '%Y-%m') = '$currentMonth'
                        GROUP BY p.sub_category";

$monthly_sales_result = $conn->query($monthly_sales_query);

// Query for total revenue by month
$total_revenue_query = "SELECT DATE_FORMAT(time_created, '%Y-%m') AS month, SUM(price) AS total_revenue
                        FROM Orders
                        WHERE payment_status = 'Completed' AND order_status != 'Cancelled'
                        GROUP BY DATE_FORMAT(time_created, '%Y-%m')";

$total_revenue_result = $conn->query($total_revenue_query);

// Initialize an array to hold monthly revenue data
$monthly_revenue_data = array_fill(0, 12, 0);

// Populate the monthly revenue data array
while ($row = $total_revenue_result->fetch_assoc()) {
    $month_index = (int)substr($row['month'], 5, 2) - 1; // Get the month index (0-indexed)
    $monthly_revenue_data[$month_index] = (float)$row['total_revenue'];
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Daily, Monthly Sales, and Revenue</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .canv {
            border: 1px solid #fff;
            border-radius: 10px;
            padding-bottom: 9px;
        }
    </style>
</head>

<body>
<div class="container mt-5">
    <div class="canv mb-4" style="width: 100%; float: left;">
        <span class="ml-3 mt-4" style="font-size:140%"><strong>Total Revenue Chart</strong></span>
        <canvas id="revenueChart" width="800" height="400"></canvas>
    </div>
    <div class="canv" style="width: 49%; float: left;">
        <span class="ml-3 mt-4" style="font-size:140%"><strong>Daily Sales</strong></span>
        <canvas id="dailySalesChart" width="400" height="400"></canvas>
    </div>
    <div class="canv" style="width: 49%; float: right;">
        <span class="ml-3 mt-4" style="font-size:140%"><strong>Monthly Sales</strong></span>
        <canvas id="monthlySalesChart" width="400" height="400"></canvas>
    </div>
</div><script>
    // Draw revenue chart
    var ctx3 = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Total Revenue',
                data: <?php echo json_encode($monthly_revenue_data); ?>,
                // backgroundColor: 'rgba(31,41,55, 0.2)',
                borderColor: 'rgba(234,88,12, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true,
                        color: 'white' // Change text color to white for y-axis
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.2)' // Change the background grid line color for y-axis
                    }
                },
                x: {
                    ticks: {
                        color: 'white' // Change text color to white for x-axis
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.2)' // Change the background grid line color for x-axis
                    }
                }
            }
        }
    });
</script>



        <script>
            // Process daily sales data
            var dailyLabels = [];
            var dailyData = [];
            <?php
            while ($row = $daily_sales_result->fetch_assoc()) {
                echo "dailyLabels.push('" . $row['sub_category'] . "');";
                echo "dailyData.push(" . $row['total_sales'] . ");";
            }
            ?>

            // Process monthly sales data
            var monthlyLabels = [];
            var monthlyData = [];
            <?php
            while ($row = $monthly_sales_result->fetch_assoc()) {
                echo "monthlyLabels.push('" . $row['sub_category'] . "');";
                echo "monthlyData.push(" . $row['total_sales'] . ");";
            }
            ?>
            console.log("Daily Lables: "+dailyLabels);
            console.log("Daily Data: "+dailyData);
            // Draw daily sales chart
            var ctx1 = document.getElementById('dailySalesChart').getContext('2d');
            var dailySalesChart = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: dailyLabels,
                    datasets: [{
                        label: 'Daily Sales',
                        data: dailyData,
                        backgroundColor: [
                            'rgba(37, 99, 235, 0.5)',
                            'rgba(22, 163, 74, 0.5)',
                            'rgba(234, 88, 12, 0.5)',
                            'rgba(147, 51, 234, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(37, 99, 235, 1)',
                            'rgba(22, 163, 74, 1)',
                            'rgba(234, 88, 12, 1)',
                            'rgba(147, 51, 234, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });

            // Draw monthly sales chart
            var ctx2 = document.getElementById('monthlySalesChart').getContext('2d');
            var monthlySalesChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: monthlyLabels,
                    datasets: [{
                        label: 'Monthly Sales',
                        data: monthlyData,
                        backgroundColor: [
                            'rgba(37, 99, 235, 0.5)',
                            'rgba(22, 163, 74, 0.5)',
                            'rgba(234, 88, 12, 0.5)',
                            'rgba(147, 51, 234, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(37, 99, 235, 1)',
                            'rgba(22, 163, 74, 1)',
                            'rgba(234, 88, 12, 1)',
                            'rgba(147, 51, 234, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
        </script>
    </div>
</body>

</html>
