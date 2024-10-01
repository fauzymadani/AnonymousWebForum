<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    // Menghasilkan username anonim baru untuk setiap postingan
    $user_id = 'Anon-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 8); 

    // Menyimpan postingan ke database
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, category, user_id) VALUES (:title, :content, :category, :user_id)");
    $stmt->execute(['title' => $title, 'content' => $content, 'category' => $category, 'user_id' => $user_id]);

    // Mengarahkan kembali ke halaman kategori setelah berhasil menambah postingan
    header("Location: category.php?category=$category");
    exit();
}
?>
