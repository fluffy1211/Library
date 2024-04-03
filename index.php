<?php
$isLoggedIn = isset($_SESSION['user']) && $_SESSION['user']['logged'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <?php if ($isLoggedIn): ?>
        <script src="app.js" defer></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <?php endif; ?>
</head>

