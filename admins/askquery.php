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
// Retrieve the count of unanswered queries from the database
$countQuery = "SELECT COUNT(*) AS unansweredCount FROM user_queries WHERE answer IS NULL";
$countResult = $dbc->query($countQuery);
$alertsCount = 0;

if ($countResult) {
    $countRow = $countResult->fetch_assoc();
    $alertsCount = $countRow['unansweredCount'];
}

// Close the count result
$countResult->close();
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
echo "<a href='Admin_dashbord.php'><center>[Back to admin page]</center></a>";
// Close the database connection
$dbc->close();
?>
<style>
    section {
  background-color: #f2f2f2;
  padding: 20px;
  border-radius: 5px;
}

h1 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

div {
  background-color: #ffffff;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
}

p {
  margin-bottom: 5px;
}

strong {
  font-weight: bold;
}

form {
  margin-top: 10px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #cccccc;
  border-radius: 5px;
  resize: vertical;
}

input[type="submit"] {
  background-color: #4caf50;
  color: #ffffff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

</style>
