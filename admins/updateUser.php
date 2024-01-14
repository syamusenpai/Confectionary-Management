<?php
include("../include/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone_number"];

    // Escape user inputs to prevent SQL injection
    $firstname = mysqli_real_escape_string($dbc, $firstname);
    $lastname = mysqli_real_escape_string($dbc, $lastname);
    $username = mysqli_real_escape_string($dbc, $username);
    $email = mysqli_real_escape_string($dbc, $email);
    $phoneNumber = mysqli_real_escape_string($dbc, $phoneNumber);

    // Use prepared statements to secure the query
    $query = "UPDATE users SET first_name = ?, last_name = ?, username = ?, email = ?, phone_number = ? WHERE id = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "sssssi", $firstname, $lastname, $username, $email, $phoneNumber, $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<script>window.alert('user profile updated successfully.');</script>";
        echo "<script>window.location.href='profiles.php';</script>";
    } else {
        echo "<script>window.alert('Error updating user profile.');</script>";
        echo "<script>window.location.href='admin.php';</script>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($dbc);
?>
