<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aneka Rasa-Shop</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;0,900;1,500;1,800&display=swap" rel="stylesheet">
    
    
</head>

<body>
    <?php include '../include/user_header.php'; ?>
    <?php include '../include/db_connect.php'; ?>

    <section>
        <div class="middle-text" style="text-align: center; display: flex; justify-content: center; align-items: center;">
            <h2>Products from the Database</h2>
        </div>

        <div class="feature-content">
            <?php
            // Fetch products from the database
            $sql = "SELECT * FROM products";
            $result = $dbc->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="row">
                        <div class="main-row">
                            <div class="row-text">
                                <h3><?php echo $row['name']; ?></h3>
                                <h6>Description:<br><?php echo $row['details']; ?></h6>
                                <h3>RM <?php echo $row['price']; ?></h3>
                                <a href="#" class="row-btn">Add it to Cart !</a>
                            </div>
                            <div class="row-img">
                                <img src="../img/<?php echo $row['image_01']; ?>" alt="<?php echo $row['name']; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <?php
                }
            } else {
                echo "No products found.";
            }

            // Close the database connection
            $dbc->close();
            ?>
        </div>
    </section>

    <!-- Back button -->
    <center>
        <div class="btn">
            <a href="index.php" class="btn-back">Back to Home</a>
        </div>
    </center>

    <!-- Include your script link here -->
</body>
</html>
