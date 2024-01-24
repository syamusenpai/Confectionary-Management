<?php
// Replace these with your database credentials
$hostname = "localhost";
$username = "root";
$password = "";
$database = "aneka_2.0";

// Create a mysqli connection
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query="SELECT * FROM orders";
echo"<table><tr><th>Proof</th>";

$result = $mysqli->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td><img src='data:image/jpeg;base64," . base64_encode($row['proof_of_purchase']) . "'></td></tr>";
    }
    $result->free(); // Free the result set
} else {
    echo "Query failed: " . $mysqli->error;
}

// Close the connection
$mysqli->close();

echo "</table>";
?>
<a href="orderapproval.php"><center>[Back?]</center></a><p></p>