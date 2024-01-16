<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Logins</title>
</head>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login | PHP</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <style>
        body {
            background-color: #55007D;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
        background-color: #ffffff;
        margin-top: 100px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 0px #000000;
        padding: 20px;
        text-align: center; /* Center the content within the container */
        width: 200%; /* Set a fixed width for the container */
        max-width: 500px; /* Set a maximum width for the container */
}

        h1 {
            text-align: center;
            color: #007bff;
        }
        
        .logo {
            text-align: center;
        }

        .logo img {
            width: 100px; 
            height: auto;
        }
        .form-control {
    border-radius: 8px;
}

    </style>
</head>

<div>
        <form action="login.php" method="post">
            <div class="container">
                
                <div class="logo">
                    <!-- Include your logo image -->
                    <img src="../img/logo.png" alt="Logo">

                <div class="row">
                    <div class="col-sm-12 col-md-6 offset-md-3">
                        <h1>Login</h1>
                        <p>Enter your credentials.</p>
                        <hr class="mb-3">

                        <label for="email"><b>Email Address</b></label>
                        <input class="form-control" id="email" type="email" name="email" required>
<br>
<br>
                        <label for="password"><b>Password</b></label>
                        <input class="form-control" id="password" type="password" name="password" required>                 
                        <hr class="mb-3">
                        <br>
                        <input class="btn btn-primary" type="submit" id="login" name="login" value="Login">
<br>
<br>
                        <p>Don't have an account? <a href="signup.php">Register here</a>.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    
   



</html>
<?php
session_start();
require('../include/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $dbc->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    if (empty($email) && empty($password)) {
        $errorMessage = "Please fill in all the fields";
    } if (empty($email)) {
        echo "Please fill in the email field";
        exit();
    }
       // Check if email is provided
   if (empty($password)) {
        echo "Please fill in the password field";
        exit();
    }

    // Check if the user is an admin
    $sqlAdmin = "SELECT id, email, password, role FROM admins WHERE email = ?";
    $stmtAdmin = $dbc->prepare($sqlAdmin);
    $stmtAdmin->bind_param("s", $email);
    $stmtAdmin->execute();
    $resultAdmin = $stmtAdmin->get_result();

    if ($resultAdmin->num_rows > 0) {
        $rowAdmin = $resultAdmin->fetch_assoc();
        // Note: No password hashing during login
        if ($password === $rowAdmin['password']) {
            $_SESSION['admin'] = $rowAdmin;
            header('Location: http://localhost/aneka_rasa_git/Confectionary-Management/admins/Admin_dashbord.php');
            exit();
        } else {
            echo "Invalid password";
            exit();
        }
    }

    // Check if the user is a regular user
    $sqlUser = "SELECT id, first_name, last_name, email, password, role FROM users WHERE email = ?";
    $stmtUser = $dbc->prepare($sqlUser);
    $stmtUser->bind_param("s", $email);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();

    if ($resultUser->num_rows > 0) {
        $rowUser = $resultUser->fetch_assoc();
        // Note: No password hashing during login
        if ($password === $rowUser['password']) {
            $_SESSION['user'] = $rowUser;
            header('Location: http://localhost/aneka_rasa_git/Confectionary-Management/startWeb/index.php');
            exit();
        } else {
            echo "Invalid password";
            exit();
        }
    }

    // User not found
    echo "User not found";
}

$dbc->close();
?>

