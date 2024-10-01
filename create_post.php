<?php
include 'includes/header.php';
include 'includes/db.php';

function generateAnonymousUsername() {
    return 'Anon-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_GET['category'];
    $anonymous_user = generateAnonymousUsername();

    $stmt = $pdo->prepare("INSERT INTO posts (title, content, category, user_id) VALUES (:title, :content, :category, :user_id)");
    $stmt->execute(['title' => $title, 'content' => $content, 'category' => $category, 'user_id' => $anonymous_user]);

    header("Location: category.php?category=$category");
}
?>

<form method="POST">
    <label>Title</label>
    <input type="text" name="title" required>

    <label>Content</label>
    <textarea name="content" required></textarea>

    <button type="submit">Create Post</button>
</form>

<?php include 'includes/footer.php'; ?>
