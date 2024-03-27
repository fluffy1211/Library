<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>
<body>

    <header>
        <nav>
            <ul>

            <?php if (isset($_SESSION['user']) && $_SESSION['user']['logged']) : ?>

                <li><a href="index.view.php">Home</a></li>
                <li><a href="logout.view.php">Logout</a></li>
                <!-- <div class="search">
                <input type="text" placeholder="tu veux lire quoi...?">
                </div> -->

            <?php else: ?>
                <li><a  href="index.view.php">Home</a></li>
                <li><a href="login.view.php">Login</a></li>
                <li><a href="signup.view.php">Signup</a></li>
                <!-- <div class="search">
                <input type="text" placeholder="tu veux lire quoi...?">
                </div> -->
                
            <?php endif; ?>
            </ul>
        </nav>
    </header>
    
</body>
</html>