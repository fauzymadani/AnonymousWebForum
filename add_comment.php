<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];

    // Menggunakan ID anonim untuk komentar jika sesi tidak ada
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Anon-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 8);

    // Menyimpan komentar ke database
    $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)");
    $stmt->execute(['post_id' => $post_id, 'user_id' => $user_id, 'content' => $content]);

    // Mengarahkan kembali ke halaman postingan setelah komentar ditambahkan
    header("Location: post.php?id=" . $post_id);
    exit();
}
?>
