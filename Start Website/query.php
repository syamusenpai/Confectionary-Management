
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aneka Rasa-Home</title>
    <link rel="stylesheet" type="text/css" href="../edit/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;0,900;1,500;1,800&display=swap" rel="stylesheet">
</head>

<body>
	

<?php include '../include/user_header.php'; ?>



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

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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

        if ($conn->query($sql) === TRUE) {
            echo "Query submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
<section>
<h1>Answered Queries</h1>
</section>
