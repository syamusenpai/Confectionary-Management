<?php

include("../include/db_connect.php");

$idURL = $_GET['id'];

// Assuming 'role' is a column in your 'users' table indicating the user's role
$query = "DELETE FROM users WHERE id = '$idURL'";
$result = mysqli_query($dbc, $query) or die("Could not delete data");

// If the user is not found in the 'users' table, try deleting from the 'admin' table
if (!mysqli_affected_rows($dbc)) {
    $query = "DELETE FROM admin WHERE id = '$idURL'";
    $result = mysqli_query($dbc, $query) or die("Could not delete data");
}

if ($result) {
    echo "<script type='text/javascript'> window.location='profiles.php'</script>";
}
?>
