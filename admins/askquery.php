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

// Retrieve unanswered queries from the database
$query = "SELECT * FROM user_queries WHERE answer IS NULL";
$result = $dbc->query($query);

if ($result->num_rows > 0) {
    echo "<section>";
    echo "<h1>Unanswered Queries</h1>";

    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
        echo "<p><strong>Query:</strong> " . $row['query'] . "</p>";
        echo "<form action='process_answer.php' method='post'>";
        echo "<input type='hidden' name='query_id' value='" . $row['id'] . "'>";
        echo "<label for='answer'>Your Answer:</label>";
        echo "<textarea name='answer' rows='4' cols='50' required></textarea>";
        echo "<input type='submit' value='Submit Answer'>";
        echo "</form>";
        echo "</div>";
    }

    echo "</section>";
} else {
    echo "<section>";
    echo "<h1>No Unanswered Queries</h1>";
    echo "</section>";
}

// Close the database connection
$dbc->close();
?>
