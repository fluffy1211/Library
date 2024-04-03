<?php 

ob_start();
include "header.php"; 
include "index.php";
include "dbconfig.php";

 

if(isset($_SESSION['user'])): ?>
<h1 class="profile">Profil de <?php echo $_SESSION['user']['username'];?> !&#x1F44B;</h1>
<?php endif; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Update username
    if (isset($_POST['username'])) {
        $newUsername = $_POST['username'];
        $sql = "UPDATE users SET username = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newUsername, $_SESSION['user']['id']]);
        $_SESSION['user']['username'] = $newUsername;
    }

    // Update password
    if (isset($_POST['password'])) {
        $newPassword = $_POST['password'];
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$hashedPassword, $_SESSION['user']['id']]);
    }

    // Update avatar
    if (isset($_POST['avatar_submit'])) {
        if ($_FILES['avatar']['size'] > 0) {
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
                        $avatar_name_new = $_SESSION['user']['id'] . "." . $avatar_actual_ext; // Use user ID as the file name
                        $avatar_destination = 'uploads/' . $avatar_name_new;

                        if (move_uploaded_file($avatar_tmp_name, $avatar_destination)) {
                            $sql = "UPDATE users SET avatar = ? WHERE id = ?";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$avatar_destination, $_SESSION['user']['id']]);

                            $_SESSION['user']['avatar'] = $avatar_destination;
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
        }
    }

    // Display the image
    if (isset($_SESSION['user']['avatar'])) {
        $avatar_location = $_SESSION['user']['avatar'];
        echo '<img class="avatar" src="' . $avatar_location . '" >';
    }
} elseif (isset($_SESSION['user']['avatar'])) {
    $avatar_location = $_SESSION['user']['avatar'];
    echo '<img class="avatar" src="' . $avatar_location . '" >';
}
?>

<p class="chose">Choisissez une photo de profil</p>

<form method="post" enctype="multipart/form-data">
    <input type="file" class="file" name="avatar" accept="image/png, image/jpeg">
    <input type="submit" name="avatar_submit" value="Upload Avatar">
</form>

<p class="chose">Choisissez des nouveaux identifiants</p>

<form method="post">
    <div class="inline">
    <input type="text" name="username" placeholder="New Username">
    <input type="password" name="password" placeholder="New Password">
    </div>
    <input type="submit" name="username_password_submit" value="Update">
</form>
<?php
