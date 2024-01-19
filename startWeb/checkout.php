<!DOCTYPE html>

<html lang="en">
<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'aneka_2.0';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;0,900;1,500;1,800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
    
    <section class="home2">
    <div class="home2--text" > 
        <br>
        <br>
        <br>
        <br><h4> hey checking out already? Here .</h4>
        <br>
        <br>
        
    </div>       
    <section class="home2">
            <div class="middle-text">
                <h2><span> come again next time okay?</span></h2>
            </div>
        
            <div class="product-content">
                <!-- Product Box 1 -->
                <div class="box">
                    <div class="box-img">
                        <img src="../img/qr1.jpg" alt="QRCODE">
                    </div>
                    <br><h3>Touch n Go</h3>
                    <h4></h4>
                  
                </div>
        
                <!-- Product Box 2 -->
                <div class="box">
                    <div class="box-img">
                        <img src="../img/qr2.jpg" alt="QRCODE">
                    </div>
                    <br><h3>MAE</h3>
                    <h4></h4>
                    
                </div>
      
                <br>
                <br>
            </div>
            
        </section>
    
    </body>
  
    <script src="jquery.min.js"></script>
    
</body>

<?php
// Retrieve cart data from the URL parameter
$cartData = isset($_GET['cartData']) ? json_decode(urldecode($_GET['cartData']), true) : [];

// Clear the cart data from the URL parameter after processing
unset($_GET['cartData']);

?>


<body>
<body>
    <section class="checkout">
    <?php
if (!empty($cartData)) {
    // Display order summary
    echo '<h2>Order Summary</h2>';
    echo '<ul>';
    foreach ($cartData as $item) {
        echo '<li>' . $item['name'] . ' - Quantity: ' . $item['quantity'] . ' - Price: RM ' . number_format($item['price'], 2) . '</li>';
    }
    echo '</ul>';

    // Calculate total price
    $totalPrice = array_sum(array_column($cartData, 'price'));
    echo '<h3>Total Price: RM ' . number_format($totalPrice, 2) . '</h3>';
} else {
    echo '<p>Your cart is empty.</p>';
}
?>
   </section>

</html>

<body>
<h2><span> Your details</span></h2>
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-6 offset-md-3">
    <form action="" method="post" enctype="multipart/form-data">
    
        <label for="name">Name:</label>
        <input class="form-control" type="text" id="name" name="name" required>
<br>
        <label for="phoneNumber">Phone Number:</label>
        <input class="form-control"type="tel" id="phoneNumber" name="phoneNumber" required>
<br>
        <label for="address">Address:</label>
        <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
<br>
        <label for="email">Email:(use your login email)</label>
        <input class="form-control"type="email" id="email" name="email" required>
<br>
        <label for="proofOfPurchase">Upload Proof of Purchase:</label>
        <input class="form-control" type="file" id="proofOfPurchase" name="proofOfPurchase" accept=".pdf, .jpg, .jpeg, .png" required>
<br>
        <button class="btn btn-primary" type="submit">Submit</button>
        <br>
    </form>
 </div>
 </div>
 </div>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST["name"];
    $phoneNumber = $_POST["phoneNumber"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    
    // Retrieve user_id based on email (you might need to adjust this query based on your actual database schema)
    $userQuery = "SELECT id FROM users WHERE email = ?";
    
    $stmtUser = $conn->prepare($userQuery);
    $stmtUser->bind_param("s", $email);
    $stmtUser->execute();
    $stmtUser->bind_result($user_id);
    
    // Fetch the user_id
    if ($stmtUser->fetch()) {
        // Additional data for the database
        $method = "QR";
        $placedOn = date("Y-m-d H:i:s");  // Current timestamp
        $paymentStatus = "Pending";

        // Calculate total products and total price based on your requirements
        $totalProducts = array_sum(array_column($cartData, 'quantity'));
        $totalPrice =  array_sum(array_column($cartData, 'price'));

        // Read the content of the uploaded file
        $fileContent = file_get_contents($_FILES["proofOfPurchase"]["tmp_name"]);
        $stmtUser->close();
        // Save the data to the database
        $sql = "INSERT INTO orders (user_id, name, number, email, method, address, total_products, total_price, placed_on, payment_status, proof_of_purchase) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Use prepared statements for security
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssiddbs", $user_id, $name, $phoneNumber, $email, $method, $address, $totalProducts, $totalPrice, $placedOn, $paymentStatus, $fileContent);
        $stmt->execute();

        
        $stmt->close();

        echo "Order details with proof of purchase saved successfully!<br>";
    } else {
        echo "User not found with the provide email.<br>";
    }
}
?>

    <a href="kuih.php" class="btn">Explore more?</a>