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

    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* General Styles */
        body {
            font-family: Tahoma, sans-serif;
            background-color: #f0e0d6;
            color: #000;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 20px auto;
            padding: 10px;
            background-color: #f0f0f5;
            border: 1px solid #b0b0b0;
        }

        /* Post styling */
        .post {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 15px;
            border: 1px solid #d9d9d9;
            position: relative;
            /* Tambahkan untuk post-header */
        }

        .post-header {
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
            color: #707070;
            position: relative;
        }

        .post-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 40px;
            text-align: center;
            /* Judul ditengah */
            color: #202020;
        }

        .post-user {
            font-style: italic;
            font-size: 12px;
            position: absolute;
            right: 10px;
            bottom: -92px;
            /* User dan tanggal di pojok kanan bawah */
            color: #707070;
        }

        .post-content {
            font-size: 0.9rem;
            margin-top: 10px;
            color: #2c2c2c;
        }

        /* Comment section styling */
        .comment-section {
            margin-top: 10px;
            padding: 10px;
            border-top: 1px solid #c2c2c2;
            background-color: #fafafa;
        }

        .comment {
            background-color: #ffffff;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #d9d9d9;
        }

        .comment p {
            margin: 5px 0;
            font-size: 0.85rem;
            color: #3a3a3a;
        }

        .comment-user {
            font-weight: bold;
            font-size: 0.9rem;
            color: #007700;
        }

        .comment-timestamp {
            font-size: 0.75rem;
            color: #999999;
            text-align: right;
        }

        /* Add comment box styling */
        .add-comment {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #d9d9d9;
            background-color: #f7f7f7;
        }

        .add-comment textarea {
            width: 100%;
            height: 60px;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 3px;
            resize: none;
            font-family: Tahoma, sans-serif;
            font-size: 13px;
        }

        .add-comment button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #800000;
            color: whitesmoke;
            border: 1px solid #b0b0b0;
            border-radius: 3px;
            cursor: pointer;
        }

        .add-comment button:hover {
            background-color: #d0d0d0;
        }

        /* Style for post actions buttons */
        .post-actions {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }

        .post-actions a,
        .post-actions form button {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #f0f0f0;
            color: #000;
            border: 1px solid #b0b0b0;
            font-family: Tahoma, sans-serif;
            font-size: 12px;
            cursor: pointer;
        }

        .post-actions a:hover,
        .post-actions form button:hover {
            background-color: #e0e0e0;
        }

        /* Footer styling */
        footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }

        footer a {
            color: #0073e6;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .back-button {
            background-color: #800000;
            color: whitesmoke;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 100%;
            }

            .post-title {
                font-size: 1.1rem;
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

                <!-- CAPTCHA -->
                <p><img src="captcha.php" alt="CAPTCHA image"></p>
                <p><input type="text" name="captcha" placeholder="Enter CAPTCHA" required></p>
                <button type="submit" class="submit">Submit Comment</button>
            </form>
        </div>
    </div>

    <footer><a href="index.php"><button class="back-button">back to home</button></a></footer>

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