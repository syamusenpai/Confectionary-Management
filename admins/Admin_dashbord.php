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
        $query = "SELECT name FROM admins WHERE id = ?";

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
          <span class="material-icons-outlined">notifications</span>
          <span class="material-icons-outlined">email</span>
          <div class="dropdown">
          <span class="material-icons-outlined">account_circle</span><p>
          <div class="dropdown-content">
              <a href="http://localhost/FYP%202.0/admins/editAdmin.php"><img src="../img/edit profile.png" alt="Edit Profile" style="width: 30px;">
              Profile</a>
              <a href="http://localhost/FYP%202.0/signup_login/logout.php"><img src="../img/logout.png"alt="Edit Profile" style="width: 20px;">
              Logout</a>
          </div>       
        </div>
        
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">shopping_cart</span>Aneka Rasa Am 
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="http://localhost/FYP%202.0/admins/Admin_dashbord.php" target="_blank">
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="http://localhost/FYP%202.0/startWeb/" target="_blank">
            <span class="material-icons-outlined">store</span> Store
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="http://localhost/FYP%202.0/admins/addKuih.php" target="_blank">
              <span class="material-icons-outlined">inventory_2</span> Products
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="http://localhost/FYP%202.0/admins/addCategory.php" target="_blank">
              <span class="material-icons-outlined">category</span> Categories
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="http://localhost/FYP%202.0/admins/profiles.php" target="_blank">
              <span class="material-icons-outlined">groups</span> Users
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="addUadmin.php" target="_blank">
            <span class="material-icons-outlined">person_add</span> Add Users         
          </a>
          </li>
          <li class="sidebar-list-item">
            <a href="http://localhost/FYP%202.0/admins/listKuih.php" target="_blank">
              <span class="material-icons-outlined">fact_check</span> Inventory
            </a>
          </li>
         
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">poll</span> Reports
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
        $queryAlerts = "SELECT COUNT(*) AS alert_count FROM orders WHERE payment_status = 'pending'";

        // Execute queries
        $resultProducts = mysqli_query($dbc, $queryProducts);
        $resultCategories = mysqli_query($dbc, $queryCategories);
        $resultCustomers = mysqli_query($dbc, $queryCustomers);
        $resultAlerts = mysqli_query($dbc, $queryAlerts);

        // Fetch data
        $productsCount = mysqli_fetch_assoc($resultProducts)['product_count'];
        $categoriesCount = mysqli_fetch_assoc($resultCategories)['category_count'];
        $customersCount = mysqli_fetch_assoc($resultCustomers)['customer_count'];
        $alertsCount = mysqli_fetch_assoc($resultAlerts)['alert_count'];

        

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
                    <h3>ALERTS</h3>
                    <span class="material-icons-outlined">notification_important</span>
                </div>
                <h1><?php echo $alertsCount; ?></h1>
            </div>
        </div>


        <div class="charts">

          <div class="charts-card">
            <h2 class="chart-title">Top 5 Products</h2>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <h2 class="chart-title">Purchase and Sales Orders</h2>
            <div id="area-chart"></div>
          </div>

          <div class="charts-card">
            <h2 class="chart-title">Profits</h2>
            <div id="basic-chart"></div>
          </div>

          <div class="charts-card">
            <h2 class="chart-title">Sales</h2>
            <div id="spark2"></div>
          </div>

        </div>
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Custom JS -->
    <script src="../style/admin_script.js"></script>
  </body>
</html>