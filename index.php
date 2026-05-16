<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bento Box Builder</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include "includes/header.php"; ?>

    <div class="bento-box">
        <img src="images/Panda_Bento_Box.jpg" alt="Bento Box">
        <h1>Welcome to the Bento Box Builder</h1>
        <p>
            Create your own custom bento box using flavors from around the world.<br><br>
            Choose your main, side, drink, dessert, and sauce.<br><br>
            Or let the Chef surprise you!
        </p>


        <h1>Build Your Own Bento Box</h1>
    </div>

    <div class="home-buttons">
        <a class="btn" href="pages/build.php">Start Building</a>
    </div>

    <?php include "includes/footer.php"; ?>

</body>
</html>