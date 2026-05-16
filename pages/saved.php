<?php
session_start();

require_once "../includes/db_connect.php";

// If user is not logged in, sends them to login page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Gets all saved bento boxes for this user, newest first
$query = "SELECT * FROM bento_boxes WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Includes header after logic so redirects work
include "../includes/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saved Bento Boxes</title>
    <link rel="stylesheet" href="../style.css?v=1">
</head>

<body>

<h2>Your Saved Bento Boxes</h2>
<h3> Click on a box for a closer look! </h3>

<!-- If user has no saved boxes yet -->
<?php if ($result->num_rows === 0): ?>
    <p style="text-align: center;">You haven't created any bento boxes yet.</p>
    <p style="text-align: center;">
        <a href="build.php">Build your first box</a>
    </p>
<?php else: ?>

    <!-- Shows each saved bento box -->
    <div class="saved-container">
        <?php while ($box = $result->fetch_assoc()): ?>
            <div class="saved-box">

                <h3><?php echo htmlspecialchars($box["box_name"]); ?></h3>

                <!-- MINI BENTO PREVIEW -->
                <div class="saved-bento-preview"
                    onclick="openBentoModal(
                        '<?php echo $box['main_item']; ?>',
                        '<?php echo $box['side_item']; ?>',
                        '<?php echo $box['drink_item']; ?>',
                        '<?php echo $box['sauce_item']; ?>'
                    )">

                    <img src="../images/Bento Items Images/Empty Bento Box.png" class="saved-base">

                    <img src="../images/Bento Items Images/Mains/<?php echo $box['main_item']; ?>.png"
                        class="saved-main">

                    <img src="../images/Bento Items Images/Sides/<?php echo $box['side_item']; ?>.png"
                        class="saved-side">

                    <img src="../images/Bento Items Images/Drinks/<?php echo $box['drink_item']; ?>.png"
                        class="saved-drink">

                    <img src="../images/Bento Items Images/Sauces/<?php echo $box['sauce_item']; ?>.png"
                        class="saved-sauce">
                </div>


                <!-- Only show notes if they exist -->
                <?php if (!empty($box["notes"])): ?>
                    <p><strong>Notes:</strong> <?php echo nl2br(htmlspecialchars($box["notes"])); ?></p>
                <?php endif; ?>

                <p class="timestamp">Created on: <?php echo $box["created_at"]; ?></p>

                <!-- Form to delete specific box -->
                <form method="POST" action="delete_box.php" class="delete-form">
                    <input type="hidden" name="box_id" value="<?php echo $box['box_id']; ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>

            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>

<?php include "../includes/footer.php"; ?>

<!-- MODAL FOR FULL-SIZE PREVIEW -->
<div id="bentoModal" class="bento-modal" onclick="closeBentoModal()">
    <div class="bento-modal-content">
        <img id="modalBase" src="../images/Bento Items Images/Empty Bento Box.png">

        <img id="modalMain" class="modal-main-slot">
        <img id="modalSide" class="modal-side-slot">
        <img id="modalDrink" class="modal-drink-slot">
        <img id="modalSauce" class="modal-sauce-slot">
    </div>
</div>

<script>
function openBentoModal(main, side, drink, sauce) {
    document.getElementById("modalMain").src =
        `../images/Bento Items Images/Mains/${main}.png`;

    document.getElementById("modalSide").src =
        `../images/Bento Items Images/Sides/${side}.png`;

    document.getElementById("modalDrink").src =
        `../images/Bento Items Images/Drinks/${drink}.png`;

    document.getElementById("modalSauce").src =
        `../images/Bento Items Images/Sauces/${sauce}.png`;

    document.getElementById("bentoModal").style.display = "flex";
}

function closeBentoModal() {
    document.getElementById("bentoModal").style.display = "none";
}
</script>

</body>
</html>
