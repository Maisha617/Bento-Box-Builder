<?php
session_start();

require_once "../includes/db_connect.php";

$error = "";
$success = "";

// Handles form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm  = trim($_POST["confirm"]);

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Checks if username is already taken
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username already taken.";
        } else {
            // Hashes the password before storing it
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $insert = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($insert);
            $stmt->bind_param("ss", $username, $hashed);

            if ($stmt->execute()) {
                $success = "Account created successfully! You can now log in.";
            } else {
                $error = "Error creating account.";
            }
        }
    }
}

// Includes the navigation/header after logic so redirects work
include "../includes/header.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<h2>Create an Account</h2>

<!-- Registration form -->
<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <label>Confirm Password:</label>
    <input type="password" name="confirm" required>

    <button type="submit">Register</button>
</form>

<!-- Shows error or success messages -->
<?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<?php if ($success): ?>
    <p style="color:green;"><?php echo $success; ?></p>
<?php endif; ?>

<p style="text-align:center; margin-top:20px;">
    Already have an account? <a href="login.php">Login here</a>
</p>

<?php include "../includes/footer.php"; ?>

</body>
</html>
