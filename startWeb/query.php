
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aneka Rasa-Home</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;0,900;1,500;1,800&display=swap" rel="stylesheet">
</head>

<body>
	

<?php include '../include/user_header.php'; ?>

<style>
    .askquery {
  background-color: #f2f2f2;
  padding: 20px;
  border-radius: 10px;
}

.askquery h1 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.askquery p {
  font-size: 16px;
  margin-bottom: 20px;
}

.askquery form {
  display: flex;
  flex-direction: column;
}

.askquery label {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 5px;
}

.askquery input[type="text"],
.askquery textarea {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}

.askquery input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

.askquery input[type="submit"]:hover {
  background-color: #45a049;
}

</style>
<br>
<br>
<br>

<section class="askquery">
    <h1>Ask a Query</h1>
    <p>Hi there! Please enter your name and ask us anything:</p>
    <!-- Your form for asking queries goes here -->
    <form action="query.php" method="post">
        <label for="name">Your Name:</label>
		
        <input type="text" name="name" id="name" required>
        <br>
        <label for="query">Your Query:</label>
        <textarea name="query" id="query" rows="4" cols="50" required></textarea>
        <br>
		<br>
        <input class="btn" type="submit" value="Submit Query">
    </form>

</section>

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

// Process form submission and insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user input
    $name = $_POST["name"];
    $queryText = $_POST["query"];

    if (empty($name) || empty($queryText)) {
        echo "Both name and query are required!";
    } else {
        // SQL to insert data into the user_queries table
        $sql = "INSERT INTO user_queries (name, query) VALUES ('$name', '$queryText')";

        if ($dbc->query($sql) === TRUE) {
            echo "Query submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $dbc->error;
        }
    }
}

// Close the database connection
$dbc->close();
?>
<style>
  .bubble-chat {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  width: 300px;
  background-color: #f2f2f2;
  padding: 10px;
  border-radius: 10px;
  margin-bottom: 10px;
}

.bubble-chat p {
  margin: 0;
  padding: 0;
}

.bubble-chat .name {
  font-weight: bold;
}

.bubble-chat .query {
  color: #555555;
}

.bubble-chat .answer {
  color: #333333;
}
</style>
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

// Display answered queries
$query = "SELECT * FROM user_queries WHERE answer IS NOT NULL";
$result = $dbc->query($query);

echo "<section>";
echo "<h1>Answered Queries</h1>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='bubble-chat'>";
        echo "<p class='name'><strong>Name:</strong> " . $row['name'] . "</p>";
        echo "<p class='query'><strong>Query:</strong> " . $row['query'] . "</p>";
        echo "<p class='answer'><strong>Answer:</strong> " . $row['answer'] . "</p>";
        echo "</div>";
        echo "<br>";
    }
} else {
    echo "<p>No answered queries.</p>";
}

echo "</section>";

$dbc->close();
?>