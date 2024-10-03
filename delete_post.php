<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['id'];

    // Ambil data postingan untuk memeriksa pemiliknya
    $query = $pdo->prepare("SELECT user_id, created_at, category FROM posts WHERE id = :id");
    $query->execute(['id' => $post_id]);
    $post = $query->fetch();

    if (!$post) {
        echo "Post not found!";
        exit();
    }

    // Memeriksa apakah pengguna adalah pemilik postingan
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== $post['user_id']) {
        echo "You do not have permission to delete this post!";
        exit();
    }

    // Ambil waktu pembuatan posting
    $created_at = strtotime($post['created_at']);
    $current_time = time();
    $time_limit = 600; // Batas waktu 10 menit (600 detik)

    // Cek apakah post sudah lebih dari 10 menit
    if (($current_time - $created_at) > $time_limit) {
        echo "You can no longer delete this post.";
        exit();
    }

    // Menghapus postingan
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->execute(['id' => $post_id]);

    // Redirect ke halaman kategori setelah penghapusan berhasil
    header("Location: category.php?category=" . $post['category']);
    exit();
}
