<?php
session_start();

require_once "../includes/db_connect.php";

$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Looks up the user by username
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If exactly one user is found
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifies the entered password against the hashed password in the database
        if (password_verify($password, $user["password"])) {
            // Store user info in the session
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $user["user_id"];

            header("Location: ../index.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
}

// Includes the navigation/header AFTER logic so redirects work
include "../includes/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<h2>Login</h2>

<!-- Login form -->
<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

<!-- Shows error message if login failed -->
<?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<p style="text-align:center; margin-top:20px;">
    Don't have an account? <a href="register.php">Register here</a>
</p>

<?php include "../includes/footer.php"; ?>

</body>
</html>
