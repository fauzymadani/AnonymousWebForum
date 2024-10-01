<?php
$host = 'localhost'; // Ganti dengan host database Anda
$db   = 'forum_anon'; // Ganti dengan nama database Anda
$user = 'root'; // Ganti dengan username database Anda
$pass = 'halonamasayafauzy'; // Ganti dengan password database Anda
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO('mysql:host=localhost;dbname=forum_anon', 'root', 'halonamasayafauzy'); // Ganti dengan kredensial Anda
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit();
}
?>
