<?php
include("../include/db_connect.php");

$idURL = $_GET['id'];

if (!$idURL) {
    echo "Invalid or missing profile ID";
    exit;
}

$query = "SELECT * FROM users WHERE id = '$idURL'";
$result = mysqli_query($dbc, $query) or die("Could not fetch user data");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "User profile not found";
    exit;
}

$username = $row["username"];
$firstname = $row["first_name"];
$lastname = $row["last_name"];
$role = $row["role"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <style>
        /* Your styles here */
    </style>
</head>

<body>
    <br>
    <h1><center>Edit User Profile</center></h1>
    <hr>
    <br>
    <div class="fr">
        <table class="sign" align="center">
            <form name="editForm" method="post" onsubmit="return validateForm()" action="updateUser.php">

                <tr>
                    <td colspan="2" align="center"><h3>Edit User Profile</h3></td>
                </tr>
                <tr>
                    <td align="right">First name:</td>
                    <td align="left"><input type="text" name="firstname" value="<?php echo $firstname ?>"></td>
                </tr>
                <tr>
                    <td align="right">Last name:</td>
                    <td align="left"><input type="text" name="lastname" value="<?php echo $lastname ?>"></td>
                </tr>
                <tr>
                    <td align="right">Username:</td>
                    <td align="left"><input type="text" name="username" value="<?php echo $username ?>"></td>
                </tr>
                <tr>
                    <td align="right">Role:</td>
                    <td align="left">
                        <select name="role">
                            <option value="user" <?php echo ($role == 'user') ? 'selected' : ''; ?>>User</option>
                            <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="hidden" name="id" value="<?php echo $idURL; ?>">
                        <input type="submit" value="Update">
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
    <a href="profile.php"><center>[Back to profile page]</center></a>

    <script>
        function validateForm() {
            // Validation logic
            // You can copy the validation function from your provided code
        }
    </script>
</body>

</html>
