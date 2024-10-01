<?php
session_start();
include 'includes/db.php';

// Memastikan user telah login atau setidaknya ada session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
</head>
<body>

<h1>Create New Post</h1>

<form action="add_post.php" method="POST">
    <input type="text" name="title" placeholder="Post Title" required>
    <textarea name="content" placeholder="Write your post here..." required></textarea>
    
    <!-- Dropdown untuk memilih kategori -->
    <select name="category" required>
        <option value="hobbies_and_interests">Hobbies and Interests</option>
        <option value="technology">Technology</option>
        <option value="news">News</option>
        <!-- Tambahkan kategori lain sesuai kebutuhan -->
    </select>

    <button type="submit">Create Post</button>
</form>

<a href="category.php?category=hobbies_and_interests">Back to Hobbies and Interests</a>

</body>
</html>
