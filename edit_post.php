<?php
include 'includes/header.php';
include 'includes/db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
    $stmt->execute(['title' => $title, 'content' => $content, 'id' => $id]);

    header("Location: post.php?id=$id");
} else {
    $query = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $query->execute(['id' => $id]);
    $post = $query->fetch();
}
?>

<form method="POST">
    <label>Title</label>
    <input type="text" name="title" value="<?php echo $post['title']; ?>" required>

    <label>Content</label>
    <textarea name="content" required><?php echo $post['content']; ?></textarea>

    <button type="submit">Update Post</button>
</form>

<?php include 'includes/footer.php'; ?>
