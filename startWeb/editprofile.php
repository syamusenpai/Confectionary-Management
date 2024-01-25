<?php
session_start();

// Check if the 'user' session variable is set
if (!isset($_SESSION['user'])) {
    // Redirect to login page if user is not logged in
    header("Location: ../signup_login/login.php");
    exit;
}

// Include database connection file
require('../include/db_connect.php');

// Retrieve user information from the database based on the user's ID
$userId = $_SESSION['user']['id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($dbc, $query);

if ($stmt) {
    // Bind the user ID parameter
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Fetch user data
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        // User profile not found
        echo "User profile not found";
        exit;
    }

    // Extract user information
    $username = $row["username"];
    $firstname = $row["first_name"];
    $lastname = $row["last_name"];
    $email = $row["email"];
    $phone_number = $row["phone_number"];
} else {
    // Error in preparing the statement
    die("Error: " . mysqli_error($dbc));
}

// Close the database connection
mysqli_close($dbc);
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
            <form name="editForm" method="post" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <tr>
                    <td colspan="2" align="center">
                        <h3>Edit User Profile</h3>
                    </td>
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
                    <td align="right">Email:</td>
                    <td align="left"><input type="email" name="email" value="<?php echo $email ?>"></td>
                </tr>
                <tr>
                    <td align="right">Phone number:</td>
                    <td align="left"><input type="text" name="phone_number" value="<?php echo $phone_number ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="hidden" name="id" value="<?php echo $userId ?>"> <!-- Add this line to pass user ID -->
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
    <a href="../startWeb/index.php"><center>[Back to home page]</center></a>

    <script>
        function validateForm() {
            // Validation logic
            // You can copy the validation function from your provided code
        }
    </script>
</body>

</html>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aneka_2.0";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "form submitted";
    $id = $_POST["id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone_number"];

    // Escape user inputs to prevent SQL injection
    $firstname = mysqli_real_escape_string($conn, $firstname); // Change $dbc to $conn
    $lastname = mysqli_real_escape_string($conn, $lastname); // Change $dbc to $conn
    $username = mysqli_real_escape_string($conn, $username); // Change $dbc to $conn
    $email = mysqli_real_escape_string($conn, $email); // Change $dbc to $conn
    $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber); // Change $dbc to $conn

    // Use prepared statements to secure the query
    $query = "UPDATE users SET first_name = ?, last_name = ?, username = ?, email = ?, phone_number = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query); // Change $dbc to $conn
    mysqli_stmt_bind_param($stmt, "sssssi", $firstname, $lastname, $username, $email, $phoneNumber, $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Check if any rows were affected by the update
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>window.alert('User profile updated successfully.');</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>window.alert('No changes were made to the user profile.');</script>";
            echo "<script>window.location.href='editprofile.php';</script>";
            
        }
    } else {
        // Error handling for SQL execution failure
        echo "<script>window.alert('Error updating user profile: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.location.href='editprofile.php';</script>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>
