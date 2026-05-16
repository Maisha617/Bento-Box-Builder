<?php
session_start();

require_once "../includes/db_connect.php";

// Only allows deletion if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Only handles POST requests (form submissions)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $box_id = $_POST["box_id"];
    $user_id = $_SESSION["user_id"];

    // Deletes the box only if it belongs to the logged-in user
    $query = "DELETE FROM bento_boxes WHERE box_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $box_id, $user_id);
    $stmt->execute();
}

// After deleting, sends the user back to their saved boxes
header("Location: saved.php");
exit();
?>
