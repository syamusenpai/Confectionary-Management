<?php
include("../include/db_connect.php");

if (isset($_GET['kuihId'])) {
    $productId = mysqli_real_escape_string($dbc, $_GET['kuihId']);

    $query = "SELECT * FROM products WHERE id = '$productId'";
    $result = mysqli_query($dbc, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // You can display product details here and provide options for modification
        $kuihName = $row['name'];
        $kuihDetails = $row['details'];
        $kuihPrice = $row['price'];
        $quantity = $row['quantity'];

        
if (isset($_SESSION['modify_success']) && $_SESSION['modify_success']) {
    echo '<p style="color: green;">Changes saved successfully!</p>';
    unset($_SESSION['modify_success']); // Clear the session variable
}

        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta http-equiv="content-type" content="text/html" charset="UTF-8">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
            <title>View Kuih</title>
            <style>
                /* Add your styles here */
            </style>
        </head>

        <body>
            <br>
            <h1>Kuih Details</h1>
            <br>

            <table align="center">
                <tr style="background-color: #ffea6b;">
                    <th style="width: 90px;">Image</th>
                    <th style="width: 200px;">Kuih Name</th>
                    <th style="width: 80px;">Detail</th>
                    <th style="width: 80px;">Quantity</th>
                    <th style="width: 80px;">Price</th>

                    <!-- Add more columns for other details as needed -->
                </tr>

                <tr>
                    <td><?php echo '<img src="../img/', $row['image_01'], '" >'; ?></td>
                    <td><?php echo $kuihName; ?></td>
                    <td><?php echo $kuihDetails; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>RM<?php echo $kuihPrice; ?></td>
                    <!-- Add more cells for other details as needed -->
                </tr>
            </table>

            <br>

            <!-- Form for modifying details -->
            
            <form method="post" action="modifyKuih.php">
                <input type="hidden" name="kuihId" value="<?php echo $productId; ?>">

                <!-- Modify Image -->
                <label for="newImage">New Image URL:</label>
                <input type="file" id="newImage" name="newImage" placeholder="Enter new image ">

                <label for="newName">New Name:</label>
                <input type="text" id="newName" name="newName" placeholder="Enter new Name">

                <!-- Modify Price -->
                <label for="newPrice">New Price:</label>
                <input type="text" id="newPrice" name="newPrice" placeholder="Enter new price">

                <!-- Modify Details -->
                <label for="newDetails">New Details:</label>
                <textarea id="newDetails" name="newDetails" placeholder="Enter new details"></textarea>

                <!-- Modify Quantity -->
                <label for="newQuantity">New Quantity:</label>
                <input type="text" id="newQuantity" name="newQuantity" placeholder="Enter new quantity">

                <!-- Submit button for modifications -->
                <input type="submit" name="modify" value="Modify">
            </form>

            <!-- Delete button -->
            <form method="post" action="deleteKuih.php">
                <input type="hidden" name="kuihId" value="<?php echo $productId; ?>">
                <input type="submit" name="delete" value="Delete" onclick="return confirmation()">
            </form>

            <br>
            <a href="listKuih.php"><center>[Back to Kuih List]</center></a>

            <script>
                function confirmation() {
                    return confirm("Are you sure you want to delete this info?");
                }
            </script>
        </body>
        </html>

    <?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid request. Please provide a product ID.";
}
?>
