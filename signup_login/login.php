<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" ><br>

        <label for="password">Password:</label>
        <input type="password" name="password" ><br>

        <input type="submit" value="Login">
    </form>
</body>
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
            header('Location: http://localhost/FYP%202.0/admins/indexAdmin.php');
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
            header('Location: http://localhost/FYP%202.0/startWeb/');
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

