<?php
session_start();

// Removes all session variables
session_unset();

// Destroys the session completely
session_destroy();

// Redirects back to the home page
header("Location: ../index.php");
exit();
?>
