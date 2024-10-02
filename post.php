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
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fefefe;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Post styling */
        .post {
            background-color: #e0f7fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            position: relative;
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .post-header .post-user {
            font-size: 0.9rem;
            font-style: italic;
            color: #555;
        }

        .post-header .post-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            width: 100%;
            position: absolute;
            top: 0;
            transform: translateY(-50%);
        }

        .post-content {
            margin-top: 30px;
            font-size: 1.1rem;
        }

        /* Comment section styling */
        .comment-section {
            margin-top: 20px;
        }

        .comment {
            background-color: #f1f1f1;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .comment p {
            margin: 5px 0;
        }

        .comment-user {
            font-weight: bold;
            font-size: 0.9rem;
            color: #333;
        }

        .comment-timestamp {
            font-size: 0.8rem;
            color: #777;
        }

        /* Add comment box styling */
        .add-comment {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .add-comment textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
        }

        .add-comment button {
            padding: 10px;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Footer styling */
        footer {
            margin-top: 20px;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 100%;
            }

            .post-header .post-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>



<div class="container">
    <!-- Postingan -->
    <div class="post">
        <div class="post-header">
            <p class="post-user"><?php echo htmlspecialchars($post['user_id']); ?> | <?php echo $post['created_at']; ?></p>
            <h1 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h1>
        </div>
        <div class="post-content">
            <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        </div>
        
        <!-- Tampilkan link edit dan hapus hanya untuk pemilik postingan -->
        <?php if ($is_owner): ?>
            <div class="post-actions">
                <a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit Post</a>
                <form action="delete_post.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?');">Delete Post</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- Komentar -->
    <div class="comment-section">
        <h2>Comments</h2>

        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                <p class="comment-user"><?php echo htmlspecialchars($comment['created_by']); ?></p>
                <p class="comment-timestamp"><?php echo $comment['created_at']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Form untuk menambahkan komentar -->
    <div class="add-comment">
        <form action="add_comment.php" method="POST">
            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
            <textarea name="content" placeholder="Add a comment..." required></textarea>
            <button type="submit">Submit Comment</button>
        </form>
    </div>
</div>

<footer><button><a href="index.php">Back to home</a></button></footer>

</body>

</html>