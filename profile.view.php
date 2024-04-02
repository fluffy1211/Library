<?php 

ob_start();
include "header.php"; 
include "index.php";
include "dbconfig.php";

?>

<?php 

if(isset($_SESSION['user'])): ?>
<h1 class="profile">Votre pseudo est <?php echo $_SESSION['user']['username'];?></h1>
<?php endif; ?>

    
<p class="chose">Choisissez une photo de profil</p>

<form method="post" enctype="multipart/form-data">
    <input type="file" class="file" name="avatar" accept="image/png, image/jpeg">
    <input type="submit" value="Submit">
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] === "POST" ) {
    $avatar = $_FILES['avatar'];
    $avatar_name = $avatar['name'];
    $avatar_tmp_name = $avatar['tmp_name'];
    $avatar_size = $avatar['size'];
    $avatar_error = $avatar['error'];

    $avatar_ext = explode('.', $avatar_name);
    $avatar_actual_ext = strtolower(end($avatar_ext));

    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($avatar_actual_ext, $allowed)) {
        if ($avatar_error === 0) {
            if ($avatar_size < 1000000) {
                $avatar_name_new = uniqid('', true) . "." . $avatar_actual_ext;
                $avatar_destination = 'uploads/' . $avatar_name_new;

                if (move_uploaded_file($avatar_tmp_name, $avatar_destination)) {
                    $sql = "UPDATE users SET avatar = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$avatar_destination, $_SESSION['user']['id']]);

                    $_SESSION['user']['avatar'] = $avatar_destination;

                    // Display the uploaded image
                    echo '<img class="avatar" src="' . $avatar_destination . '" >';
                } else {
                    echo "Failed to move the uploaded file!";
                }
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
} elseif (isset($_SESSION['user']['avatar'])) {
    $avatar_location = $_SESSION['user']['avatar'];
    echo '<img class="avatar" src="' . $avatar_location . '" >';
}



?>



