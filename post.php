<?php
session_start();
include 'includes/db.php';

// Memeriksa apakah ada ID postingan yang diberikan
if (!isset($_GET['id'])) {
    echo "Post not found!";
    exit();
}

$post_id = $_GET['id'];

// Mengambil postingan dari database
$query = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
$query->execute(['id' => $post_id]);
$post = $query->fetch();

if (!$post) {
    echo "Post not found!";
    exit();
}

// Memeriksa apakah pengguna adalah pemilik postingan
$is_owner = isset($_SESSION['user_id']) && $_SESSION['user_id'] === $post['user_id'];

// Ambil komentar dari database berdasarkan post_id
$stmt = $pdo->prepare("SELECT content, created_by, created_at FROM comments WHERE post_id = :post_id ORDER BY created_at ASC");
$stmt->execute(['post_id' => $post['id']]);
$comments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
</head>
<body>

<h1><?php echo htmlspecialchars($post['title']); ?></h1>
<p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
<p>Posted by: <?php echo htmlspecialchars($post['user_id']); ?></p>

<?php if ($is_owner): ?> <!-- Menampilkan hanya jika pemilik -->
    <a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit Post</a>
    <form action="delete_post.php" method="POST" style="display:inline;">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <button type="submit" onclick="return confirm('Are you sure you want to delete this post?');">Delete Post</button>
    </form>
<?php endif; ?>

<!-- Menampilkan Komentar -->
<h2>Comments</h2>

<?php
foreach ($comments as $comment) {
    echo "<div class='comment'>";
    echo "<p><strong>" . htmlspecialchars($comment['created_by']) . "</strong>: " . nl2br(htmlspecialchars($comment['content'])) . "</p>";
    echo "<p><em>Posted on " . $comment['created_at'] . "</em></p>";
    echo "</div>";
}
?>

<!-- Formulir untuk menambahkan komentar -->
<form action="add_comment.php" method="POST">
    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
    <textarea name="content" placeholder="Add a comment..." required></textarea>
    <button type="submit">Submit Comment</button>
</form>

<footer><a href="index.php">back to home</a></footer>

</body>
</html>

