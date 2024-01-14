<?php
include("../include/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $id = $_POST["id"];
   $firstname = $_POST["firstname"];
   $lastname = $_POST["lastname"];
   $username = $_POST["username"];
   $email = $_POST["email"];
   $password = $_POST["password"];

   // Escape user inputs to prevent SQL injection
   $firstname = mysqli_real_escape_string($dbc, $firstname);
   $lastname = mysqli_real_escape_string($dbc, $lastname);
   $username = mysqli_real_escape_string($dbc, $username);
   $email = mysqli_real_escape_string($dbc, $email);
   $password = mysqli_real_escape_string($dbc, $password);

   // Use prepared statements to secure the query
   $query = "UPDATE admins SET first_name = ?, last_name = ?, name = ?, email = ?, password = ? WHERE id = ?";
   $stmt = mysqli_prepare($dbc, $query);
   mysqli_stmt_bind_param($stmt, "sssssi", $firstname, $lastname, $username, $email, $password, $id);
   $result = mysqli_stmt_execute($stmt);

   if ($result) {
       echo "<script>window.alert('Admin profile updated successfully.');</script>";
       echo "<script>window.location.href='profiles.php';</script>";
   } else {
       echo "<script>window.alert('Error updating admin profile.');</script>";
       echo "<script>window.location.href='admin.php';</script>";
   }

   // Close the statement
   mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($dbc);
?>
