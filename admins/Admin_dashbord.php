<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
       /* ---------- DROPDOWN STYLES ---------- */
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position:absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  z-index: 1;
  right: 0;
  white-space: nowrap;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
  display: block;
} 
    </style>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style/admin _style.css">

    <?php
    // Include database connection
    include('../include/db_connect.php');

    // Start the session
    session_start();

    // Check if the admin is logged in and set the username in the session
    if (isset($_SESSION['admin'])) {
        // Retrieve admin information from the database based on the admin's ID
        $adminId = $_SESSION['admin']['id'];
        $query = "SELECT username FROM admins WHERE id = ?";

        $stmt = $dbc->prepare($query);
        $stmt->bind_param("i", $adminId);
        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($adminUsername);
            $stmt->fetch();

            // Set the admin username in the session
            $_SESSION['admin_username'] = $adminUsername;
        }
    }
?>
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
        </div>
        <div class="header-right">
          <div class="dropdown">
          <span class="material-icons-outlined">account_circle</span><p>
          <div class="dropdown-content">
              <a href="http://localhost/aneka_rasa_git/Confectionary-Management/admins/editAdmin.php"><img src="../img/edit profile.png" alt="Edit Profile" style="width: 30px;">
              Profile</a>
              <a href="http://localhost/aneka_rasa_git/Confectionary-Management/signup_login/logout.php"><img src="../img/logout.png"alt="Edit Profile" style="width: 20px;">
              Logout</a>
          </div>       
        </div>
        
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">shopping_cart</span>Aneka Rasa 
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="http://localhost/aneka_rasa_git/Confectionary-Management/admins/orderapproval.php">
            <span class="material-icons-outlined">grading</span>Order Approval           
          </a>
          </li>
          <li class="sidebar-list-item">
            <a href="http://localhost/aneka_rasa_git/Confectionary-Management/startWeb/">
            <span class="material-icons-outlined">store</span> Store
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="http://localhost/aneka_rasa_git/Confectionary-Management/admins/addKuih.php">
              <span class="material-icons-outlined">inventory_2</span> Products
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="http://localhost/aneka_rasa_git/Confectionary-Management/admins/addCategory.php">
              <span class="material-icons-outlined">category</span> Categories
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="http://localhost/aneka_rasa_git/Confectionary-Management/admins/profiles.php">
              <span class="material-icons-outlined">groups</span> Users
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="addUadmin.php">
            <span class="material-icons-outlined">person_add</span> Add Users         
          </a>
          </li>
          <li class="sidebar-list-item">
            <a href="http://localhost/aneka_rasa_git/Confectionary-Management/admins/listKuih.php">
              <span class="material-icons-outlined">fact_check</span> Inventory
            </a>
          </li>
         
          <li class="sidebar-list-item">
            <a href="askquery.php">
              <span class="material-icons-outlined">poll</span> Asked Query
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <?php
        // Include database connection

        // Query to get the count of products, categories, customers, and alerts
        $queryProducts = "SELECT COUNT(*) AS product_count FROM products";
        $queryCategories = "SELECT COUNT(*) AS category_count FROM product_categories";
        $queryCustomers = "SELECT COUNT(*) AS customer_count FROM users WHERE role = 'user'";
        $queryAlerts = "SELECT COUNT(*) AS alert_count FROM orders" ;
        $AsksQuery = "SELECT COUNT(*) AS ask_query FROM user_queries";

        // Execute queries
        $resultProducts = mysqli_query($dbc, $queryProducts);
        $resultCategories = mysqli_query($dbc, $queryCategories);
        $resultCustomers = mysqli_query($dbc, $queryCustomers);
        $resultAlerts = mysqli_query($dbc, $queryAlerts);
        $resultQuery =  mysqli_query($dbc,$AsksQuery);

        // Fetch data
        $productsCount = mysqli_fetch_assoc($resultProducts)['product_count'];
        $categoriesCount = mysqli_fetch_assoc($resultCategories)['category_count'];
        $customersCount = mysqli_fetch_assoc($resultCustomers)['customer_count'];
        $alertsCount = mysqli_fetch_assoc($resultAlerts)['alert_count'];
        $queryCount = mysqli_fetch_assoc($resultQuery)['ask_query'];

        

        // Close the database connection
        mysqli_close($dbc);
        ?>
         <main class="main-container">
              <div class="main-title">
                  <?php if (isset($_SESSION['admin_username'])): ?>
                      <h2>Welcome, <?php echo $_SESSION['admin_username']; ?>!<br><br>DASHBOARD</h2>
                  <?php else: ?>
                      <h2>DASHBOARD</h2>
                  <?php endif; ?>
              </div>
        <div class="main-cards">
            
            <!-- Card for PRODUCTS -->
            <div class="card">
                <div class="card-inner">
                    <h3>PRODUCTS</h3>
                    <span class="material-icons-outlined">inventory_2</span>
                </div>
                <h1><?php echo $productsCount; ?></h1>
            </div>

            <!-- Card for CATEGORIES -->
            <div class="card">
                <div class="card-inner">
                    <h3>CATEGORIES</h3>
                    <span class="material-icons-outlined">category</span>
                </div>
                <h1><?php echo $categoriesCount; ?></h1>
            </div>

            <!-- Card for CUSTOMERS -->
            <div class="card">
                <div class="card-inner">
                    <h3>CUSTOMERS</h3>
                    <span class="material-icons-outlined">groups</span>
                </div>
                <h1><?php echo $customersCount; ?></h1>
            </div>

            <!-- Card for ALERTS -->
            <div class="card">
                <div class="card-inner">
                    <h3>ORDER APPROVAL</h3>
                    <span class="material-icons-outlined">notification_important</span>
                </div>
                <h1><?php echo $alertsCount; ?></h1>
            </div>
            
            
        </div>
            <!-- Card for ALERTS -->
            <div class="card">
                <div class="card-inner">
                    <h3>Asked Query</h3>
                    <span class="material-icons-outlined">notification_important</span>
                </div>
                <h1><?php echo $queryCount; ?></h1>
            </div>


        <div class="charts">

          <div class="charts-card">
            <h2 class="chart-title">Top Products</h2>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <h2 class="chart-title">Profit and Sales </h2>
            <div id="area-chart"></div>
          </div>

       
        </div>
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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
 
 $test = array();
 $count=0;
 // Modify the query to order by quantity in descending order and limit to 5 rows
 $res = mysqli_query($dbc, "SELECT sd.product_id, p.name, SUM(sd.quantity) AS total_quantity FROM sales_details sd
                            INNER JOIN products p ON sd.product_id = p.id
                            GROUP BY sd.product_id, p.name
                            ORDER BY total_quantity DESC
                            LIMIT 5");
 
 while ($row = mysqli_fetch_array($res)) {
     $test[$count]["label"] = $row["name"];
     $test[$count]["y"] = $row["total_quantity"];
     $count++;
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

 
 ?>

 
 <script>
     // Assuming $test is already defined in PHP
     const categories = <?php echo json_encode(array_column($test, 'label')); ?>;
     const dataPoints = <?php echo json_encode(array_column($test, 'y')); ?>;
     
     // Custom color scheme with 6 colors
     const customColors = ['#2962ff', '#d50000', '#2e7d32', '#ff6d00', '#583cb3', '#ffbb00'];
 
     // BAR CHART
     const barChartOptions = {
         series: [{
             data: dataPoints,
             name: 'Products',
         }],
         chart: {
             type: 'bar',
             background: 'transparent',
             height: 350,
             toolbar: {
              show: false,
             },
         },
         colors: customColors,
         plotOptions: {
             bar: {
                 distributed: true,
                 borderRadius: 4,
                 horizontal: false,
                 columnWidth: '30%',
                 
             },
         },
         dataLabels: {
             enabled: false,
         },
         fill: {
             opacity: 1,
         },
         grid: {
             borderColor: '#55596e',
             yaxis: {
                 lines: {
                     show: true,
                 },
             },
             xaxis: {
                 lines: {
                     show: true,
                 },
             },
         },
         legend: {
             labels: {
                 colors: '#f5f7ff',
             },
             show: true,
             position: 'top',
         },
         stroke: {
             colors: ['transparent'],
             show: true,
             width: 2,
         },
         tooltip: {
             shared: true,
             intersect: false,
             theme: 'dark',
         },
         xaxis: {
             categories: categories,
             title: {
                 style: {
                     color: '#f5f7ff',
                 },
             },
             axisBorder: {
                 show: true,
                 color: '#55596e',
             },
             axisTicks: {
                 show: true,
                 color: '#55596e',
             },
             labels: {
                 style: {
                     colors: '#f5f7ff',
                 },
             },
         },
         yaxis: {
             title: {
                 text: 'Count',
                 style: {
                     color: '#f5f7ff',
                 },
             },
             axisBorder: {
                 color: '#55596e',
                 show: true,
             },
             axisTicks: {
                 color: '#55596e',
                 show: true,
             },
             labels: {
                 style: {
                     colors: '#f5f7ff',
                 },
             },
         },
     };
 
     const barChart = new ApexCharts(
         document.querySelector('#bar-chart'),
         barChartOptions
     );
     barChart.render();

     //profits
     const profitData = <?php echo json_encode($profitData); ?>;

document.addEventListener('DOMContentLoaded', function () {
    // AREA CHART
  
const areaChartOptions = {
  chart: {
        height: 350,
        type: 'area',
        zoom: {
            enabled: false
        },
        grid: {
            borderColor: '#000000', // Change this line
            yaxis: {
                lines: {
                    show: true,
                },
            },
            xaxis: {
                lines: {
                    show: true,
                },
            },
        },
    },
    series: [{
        name: 'Total Profits',
        data: profitData.map(entry => ({ x: entry.label, y: entry.total })),
    }],
    tooltip: {
    theme: "dark"
  },
    xaxis: {
        type: 'category',
        categories: profitData.map(entry => entry.label),
        title: {
                 style: {
                     color: '#f5f7ff',
                 },
             },
             axisBorder: {
                 show: true,
                 color: '#55596e',
             },
             axisTicks: {
                 show: true,
                 color: '#55596e',
             },
             labels: {
                 style: {
                     colors: '#f5f7ff',
                 },
             },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    title: {
        text: 'Profits Overview - Total: RM' + profitData.reduce((total, entry) => total + parseFloat(entry.total), 0).toFixed(2),
        align: 'left',
        style: {
            color: '#ffffff', // Black color for title text
        },
    },
    subtitle: {
        text: 'Price Movements',
        align: 'left',
        style: {
            color: '#ffffff', // Black color for subtitle text
        },
    },
    labels: {
        show: true,
        formatter: function (val) {
            return val.split(' ')[1]; // Display only the day
        },
        style: {
            colors: '#ffffff', // Black color for label text
        },
    },
    yaxis: {
        opposite: true,
        labels: {
            style: {
                colors: '#ffffff', // Black color for y-axis labels
            },
        },
    },
    legend: {
        horizontalAlign: 'left',
        labels: {
            colors: '#ffffff', // Black color for legend text
        },
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
   </body>
</html>