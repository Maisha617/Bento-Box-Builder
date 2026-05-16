<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <ul>
        <li><a href="/INFO152Project_mr3798/index.php">Home</a></li>
        <li><a href="/INFO152Project_mr3798/pages/build.php">Build a Bento Box</a></li>
        <li><a href="/INFO152Project_mr3798/pages/saved.php">Saved Boxes</a></li>

        <?php if (isset($_SESSION['username'])): ?>
            <li><a href="/INFO152Project_mr3798/pages/logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
        <?php else: ?>
            <li><a href="/INFO152Project_mr3798/pages/login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>