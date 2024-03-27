<?php include "header.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>

<h1 class="welcome">La librairie de Gabriel et Benjamin ! &#x261D;&#x1F913;&#x1F4D6;</h1>

<div class="center">
    <input class="search" type="text" placeholder="Chercher un livre">
    <select name="genre" class="genre">
        <option value="all">Genre</option>
        <option value="geography">Géographie</option>
        <option value="non-fiction">Non-Fiction</option>
        <option value="mystery">Mystère</option>
        <option value="thriller">Thriller</option>
        <option value="romance">Romance</option>
        <option value="horror">Horreur</option>
        <option value="fantasy">Fantaisie</option>
    </select>
    <button class="go">Go</button>

</div>
<div class="books"></div>
</body>
</html>