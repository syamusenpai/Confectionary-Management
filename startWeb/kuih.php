<?php
// Database connection parameters
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'aneka_2.0');

// Create connection
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}

// Fetch categories from the database
$sql = "SELECT id, name FROM product_categories";
$resultCategories = $dbc->query($sql);
// Check if the form is submitted for searching
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];
    $selectedCategory = $_POST["category"];

    // Construct the SQL query with search criteria and category filter
    $query = "SELECT * FROM products";

    // Add WHERE clause if search criteria is provided
    if (!empty($search)) {
        $query .= " WHERE name LIKE '%$search%' OR details LIKE '%$search%'";
    }

    // Add AND only if WHERE clause is present
    if (!empty($selectedCategory)) {
        $query .= (!empty($search) ? " AND" : " WHERE") . " id IN (SELECT product_id FROM product_category_mapping WHERE category_id = '$selectedCategory')";
    }
} else {
    // Default query to fetch all products
    $query = "SELECT * FROM products";
}

$result = mysqli_query($dbc, $query);

?>

<!DOCTYPE html>
<html lang="en">
<?php include '../include/user_header.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Product Listing</title>
    <link rel="stylesheet" type="text/css" href="../style/style2.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Add your other stylesheets and scripts here -->
</head>


<body>

    <div id="wrapper">
        <div id="header">
            <!-- Include your header content here -->
        </div>

        <div class="cart-icon-bottom">
</div>

<div id="checkout" style="cursor: pointer; padding: 10px; background-color: #4CAF50; color: white; text-align: center;">
    CHECKOUT
</div>
<br>

        <div id="sidebar">
            <h3>CART</h3>
            <div id="cart">
                <span class="empty">No items in cart.</span>
            </div>

           
        </div>
        <form method="post" action="">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search">

    <label for="category">Filter by Category:</label>
    <select id="category" name="category">
        <option value="">All Categories</option>
        <?php
        // Populate the dropdown with fetched categories
        while ($category = $resultCategories->fetch_assoc()) {
            echo "<option value='{$category['id']}'>{$category['name']}</option>";
        }
        ?>
    </select>

    <input type="submit" value="Search">
</form>


        <div class="feature-content">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="row">
                        <div class="main-row">
                            <div class="row-text">
                                <h3><?php echo $row['name']; ?></h3>
                                <h6>Description:<br><?php echo $row['details']; ?></h6>
                                <span class="product_price">RM<?php echo $row['price']; ?></span>
                                <p>Quantity in Stock: <?php echo $row['quantity']; ?></p>
                            </div>
                            <div class="row-img">
                                <center><img src="../img/<?php echo $row['image_01']; ?>" alt="<?php echo $row['name']; ?>"></center>
                            </div>
                            <div class="quantity-input">
                                <label for="quantity<?php echo $row['id']; ?>">Quantity:</label>
                                <input type="number" id="quantity<?php echo $row['id']; ?>" name="quantity" value="1" min="1" max="<?php echo $row['quantity']; ?>">
                            </div>
                            <center><button class="add-cart-large">Add To Cart</button></center>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No products found.";
            }

            // Close the database connection
            mysqli_close($dbc);
            ?>
        </div>
    </div>

    <script src="../style/style2.js"></script>
    <script src="../style/style.js"></script>
   
</body>

</html>
