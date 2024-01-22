<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User/Admin</title>
    <link rel="stylesheet" type="text/css" href="../style/sign.css">

</head>
<body>
        <?php
        include("../include/db_connect.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $phone_number = $_POST['phone_number'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Additional validation and sanitization if needed

            if ($password === $confirm_password) {
                // Passwords match, proceed to insert
                if (isset($_POST['add_admin'])) {
                    // Insert the new admin into the appropriate table
                    $query = "INSERT INTO admins (email, first_name, last_name, phone_number, password) VALUES ('$email','$username', '$firstname', '$lastname', '$phone_number', '$password')";
                } elseif (isset($_POST['add_user'])) {
                    // Insert the new user into the appropriate table
                    $query = "INSERT INTO users (email, username, first_name, last_name, phone_number, password) VALUES ('$email', '$username', '$firstname', '$lastname', '$phone_number', '$password')";
                }

                $result = mysqli_query($dbc, $query) or die("Could not add data");

                if ($result) {
                    echo "<script type='text/javascript'>redirectToAdminDashboard();</script>";
                }
            } else {
                // Passwords do not match, handle accordingly
                echo "<script type='text/javascript'>alert('Passwords do not match.');</script>";
            }
        }

        // Close the database connection
        mysqli_close($dbc);
        ?>

    <br>
    <br>
    <div class="cont">
        <div class="form sign-in">
            <h2>Add Admin</h2>
            <form name="addAdminForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Form inputs for admin -->
                <label>
                    <span>Email</span>
                    <input type="email" name="email" required>
                </label>
                <label>
                    <span>Username</span>
                    <input type="text" name="username" required>
                </label>
                <label>
                    <span>First Name</span>
                    <input type="text" name="first_name" required>
                </label>
                <label>
                    <span>Last Name</span>
                    <input type="text" name="last_name" required>
                </label>
                <label>
                    <span>Phone Number</span>
                    <input type="text" name="phone_number" required>
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="password" required>
                </label>
                <label>
                    <span>Confirm Password</span>
                    <input type="password" name="confirm_password" required>
                </label>
                <button type="submit" class="submit" name="add_admin">Add Admin</button>
            </form>
        </div>
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h3>Add an User</h3>
                </div>
                <div class="img__text m--in">
                    <h3>Add a Admin.</h3>
                </div>
                <div class="img__btn">
                    <span class="m--up">Add User</span>
                    <span class="m--in">Add Admin</span>
                </div>
            </div>
            <div class="form sign-up">
                <h2>Create User Account</h2>
                <form name="addUserForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <!-- Form inputs for user -->
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" required>
                    </label>
                    <label>
                        <span>Username</span>
                        <input type="text" name="username" required>
                    </label>
                    <label>
                        <span>First Name</span>
                        <input type="text" name="first_name" required>
                    </label>
                    <label>
                        <span>Last Name</span>
                        <input type="text" name="last_name" required>
                    </label>
                    <label>
                        <span>Phone Number</span>
                        <input type="text" name="phone_number" required>
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" required>
                    </label>
                    <label>
                        <span>Confirm Password</span>
                        <input type="password" name="confirm_password" required>
                    </label>
                    <button type="submit" class="submit" name="add_user">Add User</button>
                </form>
            </div>
        </div>
    </div>
    <a href="Admin_dashbord.php"><center>[Back to admin page]</center></a>

    <script>
    document.querySelector('.img__btn').addEventListener('click', function() {
        document.querySelector('.cont').classList.toggle('s--signup');
    });

    // Function to redirect after form submission
    function redirectToAdminDashboard() {
        window.location.href = 'Admin_dashbord.php';
    }
</script>

</body>
</html>
