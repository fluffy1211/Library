<?php

include "header.php"; 
include "index.php";
include "dbconfig.php";
include "functions.php";




?>
<div class="favoris-container">
    <h1 class="welcome">Ma liste de favoris ! &#128140;</h1>
    <div class="favoris">
</div>
</div>

<?php

if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "DELETE FROM favoris WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}