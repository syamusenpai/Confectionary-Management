<?php
include("../include/db_connect.php");

$msg = "";

// Fetch categories from the database
$result = mysqli_query($dbc, "SELECT * FROM product_categories");
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['upload'])) {
    $targetDir = "images/";
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    $kuihName = mysqli_real_escape_string($dbc, $_POST['kuihName']);
    $kuihPrice = mysqli_real_escape_string($dbc, $_POST['kuihPrice']);
    $kuihDetails = mysqli_real_escape_string($dbc, $_POST['kuihDetails']);
    $quantity = mysqli_real_escape_string($dbc, $_POST['quantity']);
    $selectedCategories = isset($_POST['categories']) ? $_POST['categories'] : [];

    $uploadedImages = [];
    for ($i = 1; $i <= 3; $i++) {
        $imageName = "image_" . $i;
        $target = $targetDir . basename($_FILES[$imageName]['name']);

        if (!empty($_FILES[$imageName]['name'])) {
            $imageExtension = strtolower(pathinfo($target, PATHINFO_EXTENSION));

            if (in_array($imageExtension, $allowedExtensions)) {
                $uploadedImages[$i] = $_FILES[$imageName]['name'];
                move_uploaded_file($_FILES[$imageName]['tmp_name'], $target);
            } else {
                $msg = "Error: Only JPG, JPEG, and PNG files are allowed.";
                break;
            }
        }
    }

    $sql = "INSERT INTO products (name, details, price, quantity, image_01, image_02, image_03) 
            VALUES ('$kuihName', '$kuihDetails', '$kuihPrice', '$quantity', 
                    '{$uploadedImages[1]}', '{$uploadedImages[2]}', '{$uploadedImages[3]}')";
    mysqli_query($dbc, $sql);

    $lastProductId = mysqli_insert_id($dbc);

    foreach ($selectedCategories as $categoryId) {
        $sqlMapping = "INSERT INTO product_category_mapping (product_id, category_id) 
                       VALUES ('$lastProductId', '$categoryId')";
        mysqli_query($dbc, $sqlMapping);
    }

    if (empty($msg)) {
        $msg = "Kuih information uploaded successfully";
        header("location: http://localhost/final%20test%201/admins/addkuih.php");
        exit(); // Add exit to prevent further execution after redirection
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Kuih info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
</head>
<body>
    <br>
    <h1>Add Kuih</h1>
    <hr>
    <br>

    <!-- Display success message -->
    <?php if (!empty($msg)) : ?>
        <div style="color: green;"><?php echo $msg; ?></div>
    <?php endif; ?>

    <div class="fr">
        <form name="insert" method="post" action="addKuih.php" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="hidden" name="size" value="1000000">

            <!-- Repeat for up to three images -->
            <?php for ($i = 1; $i <= 3; $i++) : ?>
                <div>
                    <label><font face="verdana">Image <?php echo $i; ?>:</label>
                    <input type="file" name="image_<?php echo $i; ?>">
                </div>
                <br>
            <?php endfor; ?>

            <div>
                <label><font face="verdana">Kuih Name: </label><input type="text" name="kuihName" class="style1">
            </div>
            <div>
                <label><font face="verdana">Kuih Price: </label><input type="text" name="kuihPrice" class="style1">
            </div>
            <div>
                <label><font face="verdana">Kuih Details: </label><textarea name="kuihDetails" class="style1"></textarea>
            </div>
            <div>
                <label><font face="verdana">Quantity: </label><input type="text" name="quantity" class="style1">
            </div>

            <!-- Add this code inside your form -->
            <div>
                <label><font face="verdana">Select Categories: </label>
                <select name="categories[]" class="style1 form-control" multiple id="categories">
                    <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <a href="addCategory.php"><center>[Add Category]</center></a>
            </div>

            <br>

            <div>
                <input class="button" type="submit" name="upload" value="Submit">
                <input class="button2" type="reset">
            </div>
        </form>
    </div>
    <br><br>
    <a href="Admin_dashbord.php"><center>[Back to Kuih page]</center></a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('categories', {
            rounded: true,
            shadow: true,
            placeholder: 'Search',
            
            tagColor: {
                textColor: '#327b2c',
                borderColor: '#92e681',
                bgColor: '#eaffe6',
            }
            
        });
    </script>

    <script>
        function validateForm() {
            var a = document.forms["insert"]["image_1"].value;
    var b = document.forms["insert"]["kuihName"].value;
    var c = document.forms["insert"]["kuihPrice"].value;
    var d = document.forms["insert"]["kuihDetails"].value;
    var e = document.forms["insert"]["quantity"].value;
    var f = document.forms["insert"]["category"].value;

    if (a == "") {
        document.getElementById("check").innerHTML = "*Please insert an image";
        return false;
    }

    if (b == "") {
        document.getElementById("check").innerHTML = "*Please key in kuih name";
        return false;
    } else if (/^[A-Za-z ]+$/.test(b) == false) {
        document.getElementById("check").innerHTML = "*Name does not contain number or symbol";
        return false;
    }

    if (c == "") {
        document.getElementById("check").innerHTML = "*Please insert the price";
        return false;
    } else if (isNaN(c)) {
        document.getElementById("check").innerHTML = "*Price should contain numbers only";
        return false;
    }

    if (d == "") {
        document.getElementById("check").innerHTML = "*Please insert kuih details";
        return false;
    }

    if (e == "") {
        document.getElementById("check").innerHTML = "*Please insert the quantity";
        return false;
    } else if (isNaN(e)) {
        document.getElementById("check").innerHTML = "*Quantity should be a number";
        return false;
    }

    if (f == "") {
        document.getElementById("check").innerHTML = "*Please select a category";
        return false;
    }            return true;
        }
    </script>
</body>
</html>
