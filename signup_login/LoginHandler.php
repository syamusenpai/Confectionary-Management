<?php

class LoginHandler
{
    private $dbc;

    public function __construct($databaseConnection)
    {
        $this->dbc = $databaseConnection;
    }

    public function handleLogin()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $this->dbc->real_escape_string($_POST['email']);
            $password = $_POST['password'];
            $errorMessage = "";

            if (empty($email) && empty($password)) {
                $errorMessage = "Please fill in all the fields";
            } elseif (empty($email)) {
                $errorMessage = "Please fill in the email field";
            } elseif (empty($password)) {
                $errorMessage = "Please fill in the password field";
            } else {
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
         header('Location: http://localhost/FInal%20test%201/admins/dashbord.php');
         exit();
     } else {
         $errorMessage = "Invalid password";
     }
 } else {
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
             header('Location: http://localhost/final%20test%201/startWeb/');
             exit();
         } else {
             $errorMessage = "Invalid password";
         }
     } else {
         $errorMessage = "User not found";
     }
 }
            }

            echo "<script>document.getElementById('errorMessage').innerText = '$errorMessage';</script>";
        }

        $this->dbc->close();
    }
}
?>
