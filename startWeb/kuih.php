<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Add to Cart Interaction Example</title>
  <link rel="stylesheet" href="../style/style2.css">
  <link rel="stylesheet" type="text/css" href="../style/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<div id="wrapper">
<div class="cart-icon-top">
</div>

<div class="cart-icon-bottom">
</div>

<div id="checkout">
	CHECKOUT
</div>
<div id="header">	
<?php include './include/user_header.php'; ?>

</div>



<div id="sidebar">
	<h3>CART</h3>
    <div id="cart">
    	<span class="empty">No items in cart.</span>       
    </div>
    
  
    
    
 
    
</div>
<?php
// Database connection parameters
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'aneka_2.0');

// Create connection
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$query = "SELECT * FROM products";
$result = mysqli_query($dbc
, $query);
?>


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
                        <span class="product_price"><?php echo $row['price']; ?></span>
                        <button class="add-cart-large">Add To Cart</button>                          
                    </div>
                    <div class="row-img">
                        <img src="./img/<?php echo $row['image_01']; ?>" alt="<?php echo $row['name']; ?>">
                    </div>
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
</div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- partial -->
  <script  src="../style/style2.js"></script>

</body>
</html>
