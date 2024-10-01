<?php
session_start();
include 'includes/db.php'; // Pastikan ini menghubungkan ke database dengan benar

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 'Anon-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 8);
}
echo $_SESSION['user_id']; // Debug untuk melihat apakah ID disimpan dengan benar


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id']; // ID postingan yang dikomentari
    $content = $_POST['content']; // Konten komentar

    // Menghasilkan ID anonim untuk pengguna jika belum ada di sesi
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['user_id'] = 'Anon-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 8);
    }
    $user_id = $_SESSION['user_id'];

    // Menyimpan komentar ke database
    $stmt = $pdo->prepare("INSERT INTO comments (post_id, content, created_by) VALUES (:post_id, :content, :created_by)");
    $stmt->execute(['post_id' => $post_id, 'content' => $content, 'created_by' => $user_id]);

    // Redirect ke halaman postingan setelah berhasil menambah komentar
    header("Location: post.php?id=$post_id");
    exit();
}
?>

