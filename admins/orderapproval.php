<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aneka_2.0";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the order approval form is submitted
if (isset($_POST['approve_order'])) {
    $userID = $_POST['user_id'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = "QR";
    $address = $_POST['address'];
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];
    $proof_of_purchase = $_POST['proof_of_purchase'];
    $profit = $total_products * $total_price;

    // Insert approved order into the sales table
    $query = "INSERT INTO sales (user_id, name, number, email, method, address, total_products, total_price, proof_of_purchase, profit)
    VALUES ($userID, '$name', '$number', '$email', 'QR', '$address', '$total_products', $total_price, '$proof_of_purchase', $profit);";
    
    if ($conn->query($query) === TRUE) {
        // Delete the approved order from the order table
        $deleteQuery = "DELETE FROM `orders` WHERE user_id = '$userID'";
        if ($conn->query($deleteQuery) === TRUE) {
            // Redirect to the Order Management page
            header('Location: orderapproval.php');
            exit();
        } else {
            echo "Error deleting order: " . $conn->error;
        }
    } else {
        echo "Error inserting order into sales: " . $conn->error;
    }
}

// Check if the order decline form is submitted
if (isset($_POST['decline_order'])) {
    $userID = $_POST['user_id'];

    // Delete the declined order from the order table
    $deleteQuery = "DELETE FROM `orders` WHERE user_id = '$userID'";
    if ($conn->query($deleteQuery) === TRUE) {
        // Redirect to the Order Management page
        header('Location: orderapproval.php');
        exit();
    } else {
        echo "Error deleting order: " . $conn->error;
    }
}

$sql = "SELECT * FROM `orders`";


$result = $conn->query($sql);

// Check if any orders were found
if ($result->num_rows > 0) {

    $orders = array();

    // Fetch each row as an associative array and add it to the $orders array
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
} else {
    echo "No orders found.";
}

// Close the database connection
$conn->close();
?>

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<?php if (!empty($orders)): ?>
<?php foreach ($orders as $order): ?>
    <h2>
    <u>Order Approval</u>
    </h2>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .approval-form {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-success {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>User ID:</td>
            <td><?php echo $order['user_id']; ?></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><?php echo $order['name']; ?></td>
        </tr>
        <tr>
            <td>Number:</td>
            <td><?php echo $order['number']; ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $order['email']; ?></td>
        </tr>
        <tr>
            <td>Method:</td>
            <td>QR</td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><?php echo $order['address']; ?></td>
        </tr>
        <tr>
            <td>Total Product:</td>
            <td><?php echo $order['total_products']; ?></td>
        </tr>
        <tr>
            <td>Total Price:</td>
            <td><?php echo $order['total_price']; ?></td>
        </tr>
        <tr>
            <td>Proof Note:</td>
            <td><a href="view.php">View Proof</a></td>
        </tr>
    </table>

    <!-- Approval/Decline Form -->
    <form action="orderapproval.php" method="POST" class="approval-form">
        <input type="hidden" name="user_id" value="<?php echo $order['user_id']; ?>">
        <input type="hidden" name="name" value="<?php echo $order['name']; ?>">
        <input type="hidden" name="number" value="<?php echo $order['number']; ?>">
        <input type="hidden" name="email" value="<?php echo $order['email']; ?>">
        <input type="hidden" name="address" value="<?php echo $order['address']; ?>">
        <input type="hidden" name="total_products" value="<?php echo $order['total_products']; ?>">
        <input type="hidden" name="total_price" value="<?php echo $order['total_price']; ?>">
        
        <button type="submit" class="btn btn-success" name="approve_order">Approve</button>
        <button type="submit" class="btn btn-danger" name="decline_order">Decline</button>
    </form>

</body>
</html>

<?php endforeach; ?>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>
<a href="Admin_dashbord.php"><center>[Back to admin page]</center></a>