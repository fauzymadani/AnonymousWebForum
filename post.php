<?php
include 'includes/header.php';
include 'includes/db.php';

$id = $_GET['id'];
$query = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
$query->execute(['id' => $id]);
$post = $query->fetch();

$comments_query = $pdo->prepare("SELECT * FROM comments WHERE post_id = :post_id");
$comments_query->execute(['post_id' => $id]);
$comments = $comments_query->fetchAll();
?>

<h1><?php echo $post['title']; ?></h1>
<p><?php echo $post['content']; ?></p>
<p>Posted by: <?php echo $post['user_id']; ?></p>

<!-- Tombol Edit dan Delete hanya muncul untuk pembuat postingan -->
<a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit</a>
<a href="delete_post.php?id=<?php echo $post['id']; ?>&category=<?php echo $post['category']; ?>">Delete</a>

<h2>Comments</h2>
<ul>
    <?php foreach ($comments as $comment): ?>
        <li><?php echo $comment['content']; ?> - <i><?php echo $comment['created_by']; ?></i></li>
    <?php endforeach; ?>
</ul>

<form action="comment.php" method="POST">
    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
    <label>Comment</label>
    <textarea name="content" required></textarea>
    <button type="submit">Add Comment</button>
</form>

<?php include 'includes/footer.php'; ?>
