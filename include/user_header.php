<!-- header.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags and stylesheets as before -->
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>

    <!-- Font stylesheets as before -->
</head>

<body>

    <!-- Header section design -->
    <header>
        

        <ul class="navbar">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="./about.php">About</a></li>
            <li><a href="kuih.php">Shop</a></li>
            <li><a href="query.php">Query</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        
        <div class="icons">
            <a href=""><i class="ri-search-line"></i></a>
            <a href=""><i class="ri-shopping-cart-line"></i></a>            
            <div class="bx bx-menu" id="menu-icon"></div>
            <?php
            session_start();

            if (isset($_SESSION['user'])) {
                // If user is logged in, show user icon
                echo '<a href="#" onclick="toggleMenu()"><i class="ri-user-line"></i></a>';
            } else {
                // If user is not logged in, show signup/login links
                echo '<div class="signup-login">';
                echo '<a href="http://localhost/aneka_rasa_git/Confectionary-Management/signup_login/signup.php">Signup</a> | ';
                echo '<a href="http://localhost/aneka_rasa_git/Confectionary-Management/signup_login/login.php">Login</a>';
                echo '</div>';
            }
            ?>
        </div>
        
        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <?php
                    if (isset($_SESSION['user'])) {
                        require('../include/db_connect.php');

                        // Retrieve user information from the database based on the user's ID
                        $userId = $_SESSION['user']['id'];
                        $query = "SELECT username FROM users WHERE id = ?";
                        
                        $stmt = $dbc->prepare($query);
                        $stmt->bind_param("i", $userId);
                        $stmt->execute();
                        
                        $stmt->store_result();
                        
                        if ($stmt->num_rows > 0) {
                            $stmt->bind_result($username);
                            $stmt->fetch();

                            // Display the dynamically retrieved username
                            echo '<div class="user-info">';
                            echo '<h2>' . $username . '</h2>';
                            echo '</div>';
                        }

                        echo '<hr>';
                        echo '<a href="" class="sub-menu-link">';
                        echo '<img src="../img/edit profile.png">';
                        echo '<p>Edit profile</p>';
                        echo '<span>></span>';
                        echo '</a>';
                        echo '<a href="" class="sub-menu-link">';
                        echo '<img src="../img/order history.png">';
                        echo '<p>Order history</p>';
                        echo '<span>></span>';
                        echo '</a>';
                        echo '<a href="../signup_login/logout.php" class="sub-menu-link">';
                        echo '<img src="../img/logout.png">';
                        echo '<p>Logout</p>';
                        echo '<span>></span>';
                        echo '</a>';
                    }
                ?>

            </div>
        </div>
            <script src="../style/style.js"></script>

        <script>
            
            let subMenu = document.querySelector(".sub-menu-wrap");
            let userIcon = document.getElementById("user-icon");
            let signupLogin = document.querySelector(".signup-login");

            // Function to toggle the menu and switch between user icon and signup/login links
            function toggleMenu() {
                subMenu.classList.toggle("open-menu");
                userIcon.style.display = (userIcon.style.display === 'none') ? 'inline-block' : 'none';
                signupLogin.style.display = (signupLogin.style.display === 'none') ? 'inline-block' : 'none';
            }
        </script>

       
    </header>
</body>

</html>
