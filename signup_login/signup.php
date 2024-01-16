<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <style>
        body {
            background-color: #55007D;
        }

		.container {
        background-color: #ffffff;
        margin-top: 100px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 0px #000000;
        padding: 20px;
        text-align: center; /* Center the content within the container */
        width: 70%; /* Set a fixed width for the container */
        max-width: 500px; /* Set a maximum width for the container */
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

		        /* Add a style for the logo */
				.logo {
            text-align: center;
        }

        /* Style the logo image */
        .logo img {
            width: 100px; /* Adjust the width as needed */
            height: auto;
        }

    </style>
</head>
<body>

<div>
	<form action="signup.php" method="post">
		<div class="container">
			
		<div class="logo">
                 <!-- Include your logo image -->
                <img src="../img/logo.png" alt="Logo">
			<div class="row">
				<div class="col-sm-12 col-md-6 offset-md-3">
					<h1>Registration</h1>
					<p>Fill up the form with correct values.</p>
					<hr class="mb-3">
                    <label for="username"><b>Username</b></label>
					<input class="form-control" id="username" type="text" name="username" required>

					<label for="first_name"><b>First Name</b></label>
					<input class="form-control" id="first_name" type="text" name="first_name" required>

					<label for="last_name"><b>Last Name</b></label>
					<input class="form-control" id="last_name"  type="text" name="last_name" required>

					<label for="email"><b>Email Address</b></label>
					<input class="form-control" id="email"  type="text" name="email" required>

					<label for="phone_number"><b>Phone Number</b></label>
					<input class="form-control" id="phone_number"  type="text" name="phone_number" required>

					<label for="password"><b>Password</b></label>
					<input class="form-control" id="password"  type="password" name="password" required>

                    <label for="password"><b>Confirm Password</b></label>
					<input class="form-control" id="password2"  type="password" name="password2" required>
					<hr class="mb-3">
					<input class="btn btn-primary" type="submit" id="submitted" name="submitted" value="Sign Up">
                    <br>
                    <br>
                    <p>Already have an account?</p>
      <a href="../signup_login/login.php" class="option-btn">Login Now</a>
				</div>
			</div>
		</div>
	</form>
</div>

<script src="js/script.js"></script>

</body>
</html>
<?php

// Check if the form has been submitted.
if (isset($_POST['submitted'])) {

    require('../include/db_connect.php');


    $errors = array(); // Initialize error array.
    
    // Check for a username.
    if (empty($_POST['username'])) {
        $errors[] = 'You forgot to enter your username.';
    } else {
        $username = $_POST['username'];
    }

    // Check for a password and match against the confirmed password.
    if (!empty($_POST['password'])) {
        $password1 = $_POST['password'];
        $password2 = $_POST['password2'];
    
        if ($password1 != $password2) {
            $errors[] = 'Your password did not match the confirmed password.';
        } elseif (strlen($password1) < 8) {
            $errors[] = 'Your password must be at least 8 characters long.';
        } else {
            $password = $password1;
        }
    } else {
        $errors[] = 'You forgot to enter your password.';
    }
    // Check for a first name.
    if (empty($_POST['first_name'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $first_name = $_POST['first_name'];
    }

    // Check for a last name.
    if (empty($_POST['last_name'])) {
        $errors[] = 'You forgot to enter your last name.';
    } else {
        $last_name = $_POST['last_name'];
    }

    // Check for an email address.
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $email = $_POST['email'];
    }

    // Check for a phone number.
    if (empty($_POST['phone_number'])) {
        $errors[] = 'You forgot to enter your phone number.';
    } else {
        $phone_number = $_POST['phone_number'];
    }

    if(empty($errors)){

        // kalau semua okay validation
        $query = "SELECT id FROM users WHERE username='$username'";
        $result = @mysqli_query($dbc, $query); // Run the query.

        if (mysqli_num_rows($result) == 0) {
            $query = "INSERT INTO users (username, password, first_name, last_name, email, phone_number, role)
                      VALUES ('$username', '$password', '$first_name', '$last_name', '$email', '$phone_number', 'user')";
        
            // Execute the INSERT query
            $insert_result = mysqli_query($dbc, $query);
        
            if ($insert_result) {
                echo '<h1 id="mainhead">Success!</h1>
                      <p class="success">Registration successful!</p>';
            } else {
                echo '<h1 id="mainhead">Error!</h1>
                      <p class="error">Error inserting data into the database.</p>';
            }
        } else { // Already registered.
            echo '<h1 id="mainhead">Error!</h1>
                  <p class="error">The username has already been registered.</p>';
        }
        
  

            

} else { // Report the errors.
    echo '<h1 id="mainhead">Error!</h1>
    <p class="error">The following error(s) occurred:<br />';
    foreach ($errors as $msg) { // Print each error.
        echo " - $msg<br />\n";
    }
    echo '</p><p>Please try again.</p><p><br /></p>';
} // End of if (empty($errors)) IF.
mysqli_close($dbc); // Close the database connection.
} // End of the main Submit conditional.
?>


