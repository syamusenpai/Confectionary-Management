<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User/Admin</title>
    <style>
        /* Your styles here */
    </style>
</head>
<body>
    <?php
    include("../include/db_connect.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];

        // Additional validation and sanitization if needed

        // Insert the new user/admin into the appropriate table
        if ($role === 'user') {
            $query = "INSERT INTO users (username, first_name, last_name, role) VALUES ('$username', '$firstname', '$lastname', '$role')";
        } elseif ($role === 'admin') {
            $query = "INSERT INTO admins (name, role) VALUES ('$username', '$role')";
        }

        $result = mysqli_query($dbc, $query) or die("Could not add data");

        if ($result) {
            echo "<script type='text/javascript'> window.location='admin.php'</script>";
        }
    }
    ?>

    <br>
    <h1><center>Add User/Admin</center></h1>
    <hr>
    <br>
    <div class="fr">
        <table class="sign" align="center">
            <form name="addForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <tr>
                    <td colspan="2" align="center"><h3>Add User/Admin</h3></td>
                </tr>
                <tr>
                    <td align="right">Username:</td>
                    <td align="left"><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td align="right">First name:</td>
                    <td align="left"><input type="text" name="firstname" required></td>
                </tr>
                <tr>
                    <td align="right">Last name:</td>
                    <td align="left"><input type="text" name="lastname" required></td>
                </tr>
                <tr>
                    <td align="right">Role:</td>
                    <td align="left">
                        <select name="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Add">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <label id="msg1"></label>
                    </td>
                </tr>
            </form>
        </table>
    </div>
    <br>
    <br>
    <a href="admin.php"><center>[Back to admin page]</center></a>

    <script>
        // You can add client-side validation logic here if needed
    </script>
</body>
</html>
