<?php 

ob_start();

include "header.php"; 
include "index.php";
include "dbconfig.php";
include "functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $regex = "/^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/";

        $passValid = preg_match($regex, $password);

        if($passValid) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $error = 'Password must be at least 8 characters long and contain at least one digit';
        }

        if (checkExists('username', $username, $pdo)) {
            $error = 'User already exists';
        } else {
            if (isset($hash)) {
                $sql = "INSERT INTO users(username, password) VALUES(?, ?)";
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([$username, $hash]);

                if ($result) {
                    header('Location: signup-success.view.php');
                    ob_end_flush();
                } else {
                    $error = 'Error during signup : ' . $stmt->errorInfo();
                }
            }
        }
    } else {
        $error = 'Please fill in all fields';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    
    <h1 class="success">Signup</h1>

    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Signup</button>
    </form>

    <?php if (isset($error)) : ?>
        <p class="error"><?= $error ?></p>
    <?php endif ?>

</body>
</html>