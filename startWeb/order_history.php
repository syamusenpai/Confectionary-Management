<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header("Location: ../signup_login/login.php");
    exit;
}

// Include database connection file
require('../include/db_connect.php');

// Retrieve user's user_id from the session
$userId = $_SESSION['user']['id'];


// Query to retrieve the user's orders along with the products they bought
$query = "
    SELECT s.id, s.email, s.method, s.total_products, s.total_price, s.sale_date, p.name AS product_name, sd.quantity, sd.price AS unit_price
    FROM sales s
    INNER JOIN sales_details sd ON s.id = sd.sales_id
    INNER JOIN products p ON sd.product_id = p.id
    WHERE s.user_id = ?
    ORDER BY s.id";
$stmt = mysqli_prepare($dbc, $query);

if ($stmt) {
    // Bind the user ID parameter
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if any orders are found
    if (mysqli_num_rows($result) > 0) {
        echo "<h2> Approved Order History </h2>";
        echo "<table border='1'>";
        echo "<tr><th>Order ID</th><th>Email</th><th>Method</th><th>Total Products</th><th>Total Price</th><th>Sales Date</th><th>Product Name</th><th>Quantity</th><th>Unit Price</th></tr>";

        $prevOrderId = null;
        $prevEmail = null;
        $prevMethod = null;
        $prevTotalProducts = null;
        $prevTotalPrice = null;
        $prevSaleDate = null;

        // Fetch and display each order
        while ($row = mysqli_fetch_assoc($result)) {
            // Check if the current order is different from the previous one
            if ($row['id'] != $prevOrderId) {
                // Display order information
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['method'] . "</td>";
                echo "<td>" . $row['total_products'] . "</td>";
                echo "<td>" . $row['total_price'] . "</td>";
                echo "<td>" . $row['sale_date'] . "</td>";

                // Reset the previous values
                $prevOrderId = $row['id'];
                $prevEmail = $row['email'];
                $prevMethod = $row['method'];
                $prevTotalProducts = $row['total_products'];
                $prevTotalPrice = $row['total_price'];
                $prevSaleDate = $row['sale_date'];
            } else {
                // For subsequent rows, leave the order info cells empty
                echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td>";
            }

            // Display product details
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['unit_price'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No orders found.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Error in preparing the statement
    die("Error: " . mysqli_error($dbc));
}

// Close the database connection
mysqli_close($dbc);
?>
<br>
<br>
<a href="../startWeb/index.php"><center>[Back to home page]</center></a>
