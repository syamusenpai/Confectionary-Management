<?php
include("../include/db_connect.php");

if (isset($_POST['delete'])) {
    $productId = mysqli_real_escape_string($dbc, $_POST['kuihId']);

    // Assuming you have foreign key constraints, you might need to delete from related tables first
    // Adjust the queries based on your database schema
    mysqli_query($dbc, "DELETE FROM product_category_mapping WHERE product_id = '$productId'");
    
    // Delete the product
    mysqli_query($dbc, "DELETE FROM products WHERE id = '$productId'");

    // Redirect back to listKuih.php or any other page
    header("Location: listKuih.php");
    exit();
} else {
    echo "Invalid request. Please submit the delete form.";
}
?>
