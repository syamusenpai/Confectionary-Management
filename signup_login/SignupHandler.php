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
                $this->checkUser($email, $password);
            }

            echo "<script>document.getElementById('errorMessage').innerText = '$errorMessage';</script>";
        }

        $this->dbc->close();
    }

    private function checkUser($email, $password)
    {
        $sqlAdmin = "SELECT id, email, password, role FROM admins WHERE email = ?";
        $stmtAdmin = $this->dbc->prepare($sqlAdmin);
        $stmtAdmin->bind_param("s", $email);
        $stmtAdmin->execute();
        $resultAdmin = $stmtAdmin->get_result();

        if ($resultAdmin->num_rows > 0) {
            $this->handleAdminLogin($resultAdmin, $password);
        } else {
            $this->checkRegularUser($email, $password);
        }
    }

    private function handleAdminLogin($resultAdmin, $password)
    {
        $rowAdmin = $resultAdmin->fetch_assoc();
        if ($password === $rowAdmin['password']) {
            $_SESSION['admin'] = $rowAdmin;
            header('Location: http://localhost/FInal%20test%201/admins/dashbord.php');
            exit();
        } else {
            $errorMessage = "Invalid password";
        }

        echo "<script>document.getElementById('errorMessage').innerText = '$errorMessage';</script>";
    }

    private function checkRegularUser($email, $password)
    {
        $sqlUser = "SELECT id, first_name, last_name, email, password, role FROM users WHERE email = ?";
        $stmtUser = $this->dbc->prepare($sqlUser);
        $stmtUser->bind_param("s", $email);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result();

        if ($resultUser->num_rows > 0) {
            $this->handleUserLogin($resultUser, $password);
        } else {
            $errorMessage = "User not found";
        }

        echo "<script>document.getElementById('errorMessage').innerText = '$errorMessage';</script>";
    }

    private function handleUserLogin($resultUser, $password)
    {
        $rowUser = $resultUser->fetch_assoc();
        if ($password === $rowUser['password']) {
            $_SESSION['user'] = $rowUser;
            header('Location: http://localhost/FYP%202.0/startWeb/');
            exit();
        } else {
            $errorMessage = "Invalid password";
        }

        echo "<script>document.getElementById('errorMessage').innerText = '$errorMessage';</script>";
    }
}

class SignupHandler
{
    private $dbc;

    public function __construct($databaseConnection)
    {
        $this->dbc = $databaseConnection;
    }

    public function handleSignup()
    {
        if (isset($_POST['submitted'])) {
            $errorMessage = '';

            $username = $this->validateField('username', 'You forgot to enter your username.');
            $password = $this->validatePassword();
            $first_name = $this->validateField('first_name', 'You forgot to enter your first name.');
            $last_name = $this->validateField('last_name', 'You forgot to enter your last name.');
            $email = $this->validateField('email', 'You forgot to enter your email address.');
            $phone_number = $this->validateField('phone_number', 'You forgot to enter your phone number.');

            if (empty($errorMessage)) {
                $query = "SELECT id FROM users WHERE username='$username'";
                $result = @mysqli_query($this->dbc, $query);

                if (mysqli_num_rows($result) == 0) {
                    $query = "INSERT INTO users (username, password, first_name, last_name, email, phone_number, role)
                              VALUES ('$username', '$password', '$first_name', '$last_name', '$email', '$phone_number', 'user')";

                    $insert_result = mysqli_query($this->dbc, $query);

                    if ($insert_result) {
                        echo '<h1 id="mainhead">Success!</h1>
                              <p class="success">Registration successful!</p>';
                    } else {
                        $errorMessage = "Error inserting data into the database.";
                    }
                } else {
                    $errorMessage = "The username has already been registered.";
                }
            }

            echo "<script>document.getElementById('errorMessage').innerText = '$errorMessage';</script>";

            mysqli_close($this->dbc);
        }
    }

    private function validateField($fieldName, $errorMessage)
    {
        if (empty($_POST[$fieldName])) {
            return $errorMessage;
        }
        return $_POST[$fieldName];
    }

    private function validatePassword()
    {
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if ($password1 != $password2) {
            return 'Your password did not match the confirmed password.';
        } elseif (strlen($password1) < 8) {
            return 'Your password must be at least 8 characters long.';
        }

        return $password1;
    }
}

// Example usage:

$loginHandler = new LoginHandler($dbc);
$loginHandler->handleLogin();

$signupHandler = new SignupHandler($dbc);
$signupHandler->handleSignup();

?>
