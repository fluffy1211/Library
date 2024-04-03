<?php

include "header.php"; 
include "index.php";
include "dbconfig.php";
include "functions.php";

// Delete a book from the database
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    $userId = $_SESSION['user']['id'];

    $sql = "DELETE FROM books WHERE id_user = ? AND id_book = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId, $deleteId]);
    header('Location: favoris.view.php');
}

// Get infos from the URL with the GET method and send it to database
if (isset($_GET['id'])) {
    $id_book = $_GET['id'];
    $title = $_GET['title'];
    $author = $_GET['authors'];
    $poster = $_GET['imageLinks'];
    $id_user = $_SESSION['user']['id'];

    $sql = "INSERT INTO books (id_user, id_book, title, author, poster) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_user, $id_book, $title, $author, $poster]);
    header('Location: favoris.view.php');
}

?>
<div class="favoris-container">
    <h1 class="welcome">Ma liste de favoris ! &#128140;</h1>
    <div class="favoris">
</div>
</div>

<?php

// Get the books from the database and display them in the favoris container
$sql = "SELECT * FROM books WHERE id_user = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user']['id']]);
$books = $stmt->fetchAll();

foreach ($books as $book) {
    echo "<div class='booksfav'>";
    echo "<img src='" . $book['poster'] . "' alt=''>";
    echo "<p class='title'>" . $book['title'] . "</p>";
    
    $author = $book['author'];
    if (strlen($author) > 35) {
        $author = substr($author, 0, 35) . "...";
    }
    
    echo "<p class='author'>" . $author . "</p>";
    echo "<a class='deleteBtn' href='favoris.view.php?delete=" . $book['id_book'] . "' >Supprimer des favoris</a>";
    echo "</div>";
}

?>
