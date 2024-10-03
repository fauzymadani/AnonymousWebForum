<?php
session_start();

$stored_hash = '$2y$10$VPsrcdWLUVgOxPgPrRwyge7LXUcRg.TusN/MJhgzAvOAqqJKkFBdW'; // Ganti dengan hash yang dihasilkan

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && password_verify($password, $stored_hash)) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        echo 'Invalid credentials';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
