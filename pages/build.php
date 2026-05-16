<?php
session_start();

require_once "../includes/db_connect.php";

// If user is not logged in, redirects them to the login page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$categories = ["Main", "Side", "Drink", "Sauce"]; // removed Dessert

$food = [];

// Fetches food items for each category from the database
foreach ($categories as $cat) {
    $query = "SELECT * FROM food_items WHERE category = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $cat);
    $stmt->execute();
    $result = $stmt->get_result();
    $food[$cat] = $result->fetch_all(MYSQLI_ASSOC);
}

// Message to show when a box is successfully saved
$success = "";

// Handles form submission when user saves a bento box
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $box_name = $_POST["box_name"];
    $main = $_POST["main"];
    $side = $_POST["side"];
    $drink = $_POST["drink"];
    $sauce = $_POST["sauce"];
    $notes = $_POST["notes"];
    $user_id = $_SESSION["user_id"];

    $insert = "INSERT INTO bento_boxes 
        (user_id, box_name, main_item, side_item, drink_item, sauce_item, notes)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($insert);
    $stmt->bind_param("issssss", $user_id, $box_name, $main, $side, $drink, $sauce, $notes);

    if ($stmt->execute()) {
        $success = "Your Bento Box has been saved!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Build a Bento Box</title>
    <link rel="stylesheet" href="/INFO152Project_mr3798/style.css?v=1">
</head>

<body>

<?php include "../includes/header.php"; ?>

<h2>Build Your Bento Box</h2>

<div class="builder-wrapper">

    <!-- LEFT SIDE -->
    <div class="bento-preview">
        <img src="../images/Bento Items Images/Empty Bento Box.png" class="bento-base">

        <img id="mainPreview" class="main-slot" style="display:none;">
        <img id="sidePreview" class="side-slot" style="display:none;">
        <img id="drinkPreview" class="drink-slot" style="display:none;">
        <img id="saucePreview" class="sauce-slot" style="display:none;">
    </div>

    <!-- RIGHT SIDE -->
    <div class="builder-form">

        <form method="POST">

            <label>Box Name:</label>
            <input type="text" name="box_name" required>

            <label>Main Item:</label>
            <select name="main" required>
                <option value="">Select a main</option>
                <?php foreach ($food["Main"] as $item): ?>
                    <option value="<?php echo $item["name"]; ?>"><?php echo $item["name"]; ?></option>
                <?php endforeach; ?>
            </select>

            <label>Side Item:</label>
            <select name="side" required>
                <option value="">Select a side</option>
                <?php foreach ($food["Side"] as $item): ?>
                    <option value="<?php echo $item["name"]; ?>"><?php echo $item["name"]; ?></option>
                <?php endforeach; ?>
            </select>

            <label>Drink:</label>
            <select name="drink" required>
                <option value="">Select a drink</option>
                <?php foreach ($food["Drink"] as $item): ?>
                    <option value="<?php echo $item["name"]; ?>"><?php echo $item["name"]; ?></option>
                <?php endforeach; ?>
            </select>

            <label>Sauce:</label>
            <select name="sauce" required>
                <option value="">Select a sauce</option>
                <?php foreach ($food["Sauce"] as $item): ?>
                    <option value="<?php echo $item["name"]; ?>"><?php echo $item["name"]; ?></option>
                <?php endforeach; ?>
            </select>

            <label>Notes (optional):</label>
            <textarea name="notes" rows="3"></textarea>

            <button type="submit">Save Bento Box</button>
        </form>

    </div>
</div>

<!-- Button to auto-generate a random bento box -->
<button type="button" class="chef-btn" onclick="chefsRecommendation()">Chef's Recommendation</button>

<script>
// Randomly fills in the selects 
function chefsRecommendation() {
    const selects = document.querySelectorAll("select");

    selects.forEach(select => {
        const options = Array.from(select.options).filter(opt => opt.value !== "");
        const random = options[Math.floor(Math.random() * options.length)];
        select.value = random.value;

        // Updates the bento box preview 
        select.dispatchEvent(new Event("change"));
    });

    document.querySelector("input[name='box_name']").value = "✨ Chef's Surprise ✨";
}


</script>

<?php include "../includes/footer.php"; ?>
<script src="../interactions.js?v=1000"></script>

</body>
</html>
