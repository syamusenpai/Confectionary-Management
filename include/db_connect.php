<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aneka_2.0";

$dbc = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}



?>