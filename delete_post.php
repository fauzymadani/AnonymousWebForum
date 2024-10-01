<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['id'];

    // Ambil data postingan untuk memeriksa pemiliknya
    $query = $pdo->prepare("SELECT user_id FROM posts WHERE id = :id");
    $query->execute(['id' => $post_id]);
    $post = $query->fetch();

    if (!$post) {
        echo "Post not found!";
        exit();
    }

    // Memeriksa apakah pengguna adalah pemilik postingan
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $post['user_id']) {
        echo "You cannot delete your own post!";
        exit();
    }

    // Menghapus postingan
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->execute(['id' => $post_id]);

    header("Location: category.php?category=" . $post['category']);
    exit();
}
