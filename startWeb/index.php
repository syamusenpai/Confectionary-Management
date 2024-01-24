<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aneka Rasa-Home</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;0,900;1,500;1,800&display=swap" rel="stylesheet">
   


</head>


<body>


<script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
<script>
  window.botpressWebChat.init({
      "composerPlaceholder": "Chat with Aneka Rasa Bot",
      "botConversationDescription": "This bot will help you : )",
      "botId": "9eaba247-365c-4ff8-a4ac-a78c083a2143",
      "hostUrl": "https://cdn.botpress.cloud/webchat/v1",
      "messagingUrl": "https://messaging.botpress.cloud",
      "clientId": "9eaba247-365c-4ff8-a4ac-a78c083a2143",
      "webhookId": "1ec209d1-63b9-4c0b-93cc-4faa5c3fd241",
      "lazySocket": true,
      "themeName": "prism",
      "botName": "Aneka Rasa Bot",
      "avatarUrl": "https://cdn1.iconfinder.com/data/icons/christmas-avatar-4/512/50-Christmas-Avatars-Icons_19-512.png",
      "stylesheet": "https://webchat-styler-css.botpress.app/prod/code/66f7e764-6125-4f88-bbfa-a1f4f900013e/v70515/style.css",
      "frontendVersion": "v1",
      "theme": "prism",
      "themeColor": "#2563eb"
  });
</script>

    <?php include '../include/user_header.php'; ?>
    <!-- Home section design -->
    <section class="home">
        <div class="home--text">
            <br><h4 style="color: #FFC0CB ;">In this season, find the best 🔥</h4>
            <h1 style="color: #C54B8C ;">ANEKA RASA</h1>
            <h1 style="color: #C54B8C ;">Find the best for your family</h1>
            <a href="kuih.php" class="btn">Explore now</a>
        </div>
    </section>
    <br>
    <br>
    <br>

    <!-- Features section design -->
    <section>
        <div class="middle-text">
            <h2>Discover more.<span> sweet treats</span></h2>
        </div>
        <div class="feature-content">
            <!-- Row 1 -->
            <div class="row">
                <div class="main-row">
                    <div class="row-text">
                        <h6>Explore new and wonderful treats</h6>
                        <h3>Give the gift <br> of choice</h3>
                        <a href="kuih.php" class="row-btn">Show me all</a>
                    </div>
                    <div class="row-img">
                        <img src="../img/d1.jpg" alt="Image 1">
                    </div>
                </div>
            </div>
    
            <!-- Row 2 -->
            <div class="row row2">
                <div class="main-row">
                    <div class="row-text">
                        <h6>Explore new and wonderful treats</h6>
                        <h3>Give the gift <br> of choice</h3>
                        <a href="kuih.php" class="row-btn">Show me all</a>
                    </div>
                    <div class="row-img">
                        <img src="../img/d2.jpg" alt="Image 2">
                    </div>
                </div>
            </div>
    
            <!-- Row 3 -->
            <div class="row row3">
                <div class="main-row">
                    <div class="row-text">
                        <h6>Explore new and wonderful treats</h6>
                        <h3>Give the gift <br> of choice</h3>
                        <a href="kuih.php" class="row-btn">Show me all</a>
                    </div>
                    <div class="row-img">
                        <img src="../img/d3.jpg" alt="Image 3">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product section design -->
    <section>
    <div class="middle-text">
        <h2>New treats.<span> Best selling of the month</span></h2>
    </div>

    <div class="product-content">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "aneka_2.0";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $res = mysqli_query($conn, "SELECT sd.product_id, p.name, p.image, sd.quantity FROM sales_details sd
                            INNER JOIN products p ON sd.product_id = p.id
                            ORDER BY sd.quantity DESC
                            LIMIT 3");

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                // Output product boxes dynamically
                echo '<div class="box">';
                echo '<div class="box-img">';
                echo '<img src="../img/' . $row['image'] . '" alt="Product Image">';
                echo '</div>';
                echo '<br><h3>' . $row['name'] . '</h3>';
                echo '<h4></h4>';
                echo '<div class="inbox">';
                echo '<a href="kuih.php" class="price">RM ' . $row['quantity'] . '</a>';
                echo '</div>';
                echo '<div class="heart">';
                echo '<i class="ri-heart-fill"></i>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No products found.";
        }

        $conn->close();
        ?>
    </div>
</section>
<section class="cta-content">
    <div class="cta">
        <div class="cta-text">
            <a href="" class="logo"><img src="../img/logo.png"></a>
            <h3>Rare New Kuih thats never seen Before</h3>
            <p>let the sweetness take you to another world</p>
            <a href="kuih.php" class="btn">Discover more</a>
        </div>
    </div>
</section>
<br>
<br>
<br>
<br>
<br>
<br>    
<?php include '../include/user_footer.php'; ?>

</body>

</html>
