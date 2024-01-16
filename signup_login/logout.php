<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header('Location: http://localhost/aneka_rasa_git/Confectionary-Management/startWeb/index.php');
exit();
?>
