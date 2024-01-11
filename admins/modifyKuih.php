<?php
include("../include/db_connect.php");

if (isset($_POST['modify'])) {
    $productId = mysqli_real_escape_string($dbc, $_POST['kuihId']);

    // Fetch existing product details
    $result = mysqli_query($dbc, "SELECT * FROM products WHERE id = '$productId'");
    $existingDetails = mysqli_fetch_assoc($result);

    // Get new values from the form
    $newImage = !empty($_POST['newImage']) ? mysqli_real_escape_string($dbc, $_POST['newImage']) : $existingDetails['image_01'];
    $newName = !empty($_POST['newName']) ? mysqli_real_escape_string($dbc, $_POST['newName']) : $existingDetails['name'];
    $newPrice = !empty($_POST['newPrice']) ? mysqli_real_escape_string($dbc, $_POST['newPrice']) : $existingDetails['price'];
    $newDetails = !empty($_POST['newDetails']) ? mysqli_real_escape_string($dbc, $_POST['newDetails']) : $existingDetails['details'];
    $newQuantity = !empty($_POST['newQuantity']) ? mysqli_real_escape_string($dbc, $_POST['newQuantity']) : $existingDetails['quantity'];

    // Output debug information
    echo "Product ID: $productId<br>";
    echo "New Image: $newImage<br>";
    echo "New Name: $productId<br>";
    echo "New Price: $newPrice<br>";
    echo "New Details: $newDetails<br>";
    echo "New Quantity: $newQuantity<br>";

    // Update the product details
    mysqli_query($dbc, "UPDATE products 
                        SET image_01 = '$newImage', 
                            price = '$newPrice', 
                            details = '$newDetails', 
                            quantity = '$newQuantity' 
                        WHERE id = '$productId'");

    $_SESSION['modify_success'] = true;

    // Redirect back to viewKuih.php
    header("Location: viewKuih.php?kuihId=$productId");
    exit();
} else {
    echo "Invalid request. Please submit the modification form.";
}
?>
