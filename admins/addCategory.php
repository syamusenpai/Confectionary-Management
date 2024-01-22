<?php
include("../include/db_connect.php");

$msg = "";

// Check if the form is submitted
if (isset($_POST['addCategory'])) {
    $categoryName = mysqli_real_escape_string($dbc, $_POST['categoryName']);

    $sql = "INSERT INTO product_categories (name) VALUES ('$categoryName')";
    mysqli_query($dbc, $sql);

    $msg = "Category added successfully";
}

// Fetch all categories
$sqlCategories = "SELECT * FROM product_categories";
$resultCategories = mysqli_query($dbc, $sqlCategories);

// Check if the query was successful
if (!$resultCategories) {
    die("Query failed: " . mysqli_error($dbc));
}

// Fetch categories into an array
$categories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

// Close the database connection
mysqli_close($dbc);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
</head>
<body>
    <br>
    <h1>Add Category</h1>
    <hr>
    <br>

    <!-- Display success message -->
    <?php if (!empty($msg)) : ?>
        <div style="color: green;"><?php echo $msg; ?></div>
    <?php endif; ?>
<style>
    /* Form Styles */
form {
  font-family: Verdana, sans-serif;
  margin-bottom: 20px;
}

label {
  font-weight: bold;
}

input[type="text"] {
  border: 1px solid #ccc;
  padding: 5px;
  font-size: 14px;
}

input[type="submit"],
input[type="reset"] {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin-right: 10px;
  cursor: pointer;
}

input[type="reset"] {
  background-color: #f44336;
}

/* Additional Styles */
.style1 {
  background-color: #f2f2f2;
  border: 1px solid #ccc;
  padding: 5px;
  font-size: 14px;
}

.button {
  background-color: #4CAF50;
}

.button2 {
  background-color: #f44336;
}

</style>
    <!-- Form to add category -->
    <form name="insert" method="post" action="addCategory.php">
        <div>
            <label><font face="verdana">Category Name: </label>
            <input type="text" name="categoryName" class="style1">
        </div>

        <br>

        <div>
            <input class="button" type="submit" name="addCategory" value="Add Category">
            <input class="button2" type="reset">
        </div>
    </form>

    <br>

    <!-- List of all categories -->
    <h2>List of Categories:</h2>
    <ul>
        <?php foreach ($categories as $category) : ?>
            <li><?php echo $category['name']; ?></li>
        <?php endforeach; ?>
    </ul>

    <br><br>
    <a href="addKuih.php"><center>[Back to Add Kuih page]</center></a><p></p>
    <a href="Admin_dashbord.php"><center>[Back to Add admin page]</center></a>
</body>
</html>
