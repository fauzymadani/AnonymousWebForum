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

// Session timeout - Tambahkan ini di bagian atas
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset(); // Hapus semua session
    session_destroy(); // Hancurkan session
    header('Location: login.php'); // Redirect ke halaman login
    exit;
}
$_SESSION['last_activity'] = time(); // Update waktu terakhir aktivitas

if ($is_owner) {
    $created_at = strtotime($post['created_at']);
    $current_time = time();
    $time_limit = 600; // Batas waktu 1 jam (3600 detik)

    if (($current_time - $created_at) > $time_limit) {
        echo "You can no longer edit this post.";
        exit;
    }
} else {
    echo "You do not have permission to edit this post.";
    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>edit post</title>
    <style>
        /* Dark Web Archetype - Form Style */
        body {
            background-color: #121212;
            color: #e5e5e5;
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
        }

        form {
            background-color: #1c1c1c;
            padding: 20px;
            margin: 50px auto;
            width: 80%;
            max-width: 700px;
            border: 1px solid #444;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            color: #a0a0a0;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 10px;
            background-color: #262626;
            border: 1px solid #333;
            color: #fff;
            font-size: 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-family: 'Courier New', Courier, monospace;
        }

        form input[type="text"]::placeholder,
        form textarea::placeholder {
            color: #555;
        }

        form textarea {
            height: 200px;
            resize: vertical;
        }

        form button {
            background-color: #444;
            color: #e5e5e5;
            border: 1px solid #555;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #333;
        }

        form button:active {
            background-color: #222;
        }

        /* Additional styles for 4chan aesthetic */
        form button:focus,
        form input:focus,
        form textarea:focus {
            outline: none;
            border-color: #777;
        }

        form input,
        form textarea {
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.5);
        }

        form label::after {
            content: '::';
            margin-left: 5px;
            color: #777;
        }

        /* Footer and header dark theme */
        footer,
        header {
            background-color: #1a1a1a;
            padding: 15px 0;
            text-align: center;
            border-top: 1px solid #444;
            border-bottom: 1px solid #444;
        }

        footer p,
        header p {
            color: #888;
            font-size: 14px;
            font-family: 'Courier New', Courier, monospace;
        }
    </style>
</head>

<body>
    <form method="POST">
        <label>Title</label>
        <input type="text" name="title" value="<?php echo $post['title']; ?>" required>

        <label>Content</label>
        <textarea name="content" required><?php echo $post['content']; ?></textarea>

        <button type="submit">Update Post</button>
    </form>

    <?php include 'includes/footer.php'; ?>
</body>

</html>