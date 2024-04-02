<?php 

ob_start();
include "header.php"; 
include "index.php";
include "dbconfig.php";


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        $error = "User does not exist";
    } else {

        $hashed_password = $user['password'];

        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['user']['logged'] = true;

            header('Location: index.view.php');
            ob_end_flush();
        } else {
            $error = "Incorrect password";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <h1 class="success">Login</h1>

    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>

<?php if (isset($error)) : ?> 
    <p class="error"><?= $error ?></p>
<?php endif ?>

</body>
</html>