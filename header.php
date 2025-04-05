<?php
session_start();
?>
<header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="books.php">Manage Books</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Logout (<?= $_SESSION['username']; ?>)</a></li>
            <?php else: ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
