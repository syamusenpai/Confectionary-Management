<?php
    // Include database connection
    include('../include/db_connect.php');

    // Start the session
    session_start();

    // Check if the admin is logged in and set the username in the session
    if (isset($_SESSION['admin']['id'])) {
        $adminID = $_SESSION['admin']['id'];

        // Fetch admin data based on the ID from the session
        $query = "SELECT * FROM admins WHERE id = ?";
        $stmt = $dbc->prepare($query);
        $stmt->bind_param("i", $adminID);
        $stmt->execute();
        $result = $stmt->get_result();
        $adminData = $result->fetch_assoc();

        // Check if admin data is found
        if (!$adminData) {
            echo "Admin profile not found";
            exit;
        }

        // Extract admin details
        $username = $adminData["username"];
        $firstname = $adminData["first_name"];
        $lastname = $adminData["last_name"];
        $email = $adminData["email"];
        $password = $adminData["password"];
    } else {
        // Redirect to the login page if not logged in
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Profile</title>
    <style>
        /* Your styles here */
    </style>
</head>

<body>
    <br>
    <h1><center>Edit Admin Profile</center></h1>
    <hr>
    <br>
    <div class="fr">
        <table class="sign" align="center">
            <form name="editForm" method="post" onsubmit="return validateForm()" action="updateAdmin.php">

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
    <td align="right">Email:</td>
    <td align="left"><input type="text" name="email" value="<?php echo $email?>"></td>
</tr>
<tr>
    <td align="right">Password:</td>
    <td align="left"><input type="text" name="password" value="<?php echo $password ?>"></td>
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
<a href="Admin_dashbord.php"><center>[Back to admin page]</center></a><p></p>
<a href="profiles.php"><center>[Back to profile page]</center></a>



</body>

</html>
