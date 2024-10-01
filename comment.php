<?php
include 'includes/db.php';

function generateAnonymousUsername() {
    return 'Anon-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];
    $created_by = generateAnonymousUsername();

    $stmt = $pdo->prepare("INSERT INTO comments (post_id, content, created_by) VALUES (:post_id, :content, :created_by)");
    $stmt->execute(['post_id' => $post_id, 'content' => $content, 'created_by' => $created_by]);

    header("Location: post.php?id=$post_id");
}
?>
