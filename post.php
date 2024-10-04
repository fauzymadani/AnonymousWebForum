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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c1e;
            color: #e5e5e5;
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
            background-color: #2e2e2e;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        /* Post styling */
        .post {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            position: relative;
            border-left: 4px solid #3498db;
            /* Aksen biru */
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            position: relative;
        }

        .post-user {
            font-size: 0.9rem;
            font-style: italic;
            color: #aaa;
            position: absolute;
            top: 0;
            left: 0;
            transform: translateY(-50%);
        }

        .post-title {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            width: 100%;
        }

        .post-content {
            margin-top: 20px;
            font-size: 1.1rem;
        }

        /* Comment section styling */
        .comment-section {
            margin-top: 20px;
        }

        .comment {
            background-color: #444;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border-left: 4px solid #3498db;
            /* Aksen biru */
        }

        .comment p {
            margin: 5px 0;
        }

        .comment-user {
            font-weight: bold;
            font-size: 0.9rem;
            color: #b0c4de;
        }

        .comment-timestamp {
            font-size: 0.8rem;
            color: #888;
        }

        /* Add comment box styling */
        .add-comment {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            background-color: #2e2e2e;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .add-comment textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
            border: 1px solid #555;
            border-radius: 5px;
            resize: none;
            background-color: #444;
            color: #fff;
        }

        .add-comment button {
            padding: 10px;
            background-color: #3498db;
            /* Aksen biru */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-comment button:hover {
            background-color: #2980b9;
            /* Aksen biru saat hover */
        }

        /* Footer styling */
        footer {
            margin-top: 20px;
            text-align: center;
        }

        footer a {
            color: #3498db;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Style for post actions buttons (dark web - low effort aesthetic) */
        .post-actions {
            margin-top: 15px;
        }

        .post-actions a {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #1f1f1f;
            color: #d3d3d3;
            border: 1px solid #3c3c3c;
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            border-radius: 3px;
            display: inline-block;
            margin-right: 10px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .post-actions a:hover {
            background-color: #292929;
        }

        .post-actions a:active {
            background-color: #333;
        }

        .post-actions form button {
            padding: 10px 15px;
            background-color: #262626;
            color: #c1c1c1;
            border: 1px solid #444;
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .post-actions form button:hover {
            background-color: #333;
            color: #fff;
        }

        .post-actions form button:active {
            background-color: #222;
        }

        .post-actions form button:focus {
            outline: none;
            border-color: #555;
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 100%;
            }

            .post-title {
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>

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
                    <form id="delete-post-form-<?php echo $post['id']; ?>" action="delete_post.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                        <button type="button" onclick="confirmDelete(<?php echo $post['id']; ?>)">Delete Post</button>
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

    <footer><a href="index.php">Back to home</a></footer>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(postId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this post? This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-post-form-' + postId).submit();
                }
            });
        }
    </script>

</body>

</html>