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

// Process form submission and update the database with the answer
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $queryId = $_POST['query_id'];
    $answerText = $_POST['answer'];

    // Update the query with the seller's answer
    $updateQuery = "UPDATE user_queries SET answer = '$answerText' WHERE id = $queryId";

    if ($dbc->query($updateQuery) === TRUE) {
        echo "<br>
        <br><br>
        <div class='alert alert-success fade in'>
        <a href='askquery.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Success!</strong> Answer submitted successfully.
        </div>";
    } else {
        echo "Error: " . $updateQuery . "<br>" . $dbc->error;
    }
}

// Close the database connection
$dbc->close();
?>