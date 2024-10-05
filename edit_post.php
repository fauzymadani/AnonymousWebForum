<?php
session_start();
include 'includes/header.php';
include 'includes/db.php';

$id = $_GET['id'];

// Ambil data postingan
$query = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
$query->execute(['id' => $id]);
$post = $query->fetch();

// Cek apakah post ada
if (!$post) {
    echo "Post not found!";
    exit();
}

// Cek apakah pengguna adalah pemilik postingan
$is_owner = isset($_SESSION['user_id']) && $_SESSION['user_id'] === $post['user_id'];

// Cek waktu terakhir edit
$created_at = strtotime($post['created_at']);
$current_time = time();
$time_limit = 600; // Batas waktu 10 menit (600 detik)

// Session timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset(); // Hapus semua session
    session_destroy(); // Hancurkan session
    header('Location: login.php'); // Redirect ke halaman login
    exit;
}
$_SESSION['last_activity'] = time(); // Update waktu terakhir aktivitas

// Cek apakah post sudah lebih dari batas waktu
if ($is_owner && (($current_time - $created_at) <= $time_limit)) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
        $stmt->execute(['title' => $title, 'content' => $content, 'id' => $id]);

        header("Location: post.php?id=$id");
        exit();
    }
    ?>
<!DOCTYPE html>
<html>

<head>
    <title>edit post</title>
    <style>
        /* Dark Web Archetype - Form Style */
        body {
            background-color: #f0e0d6;
            color: #e5e5e5;
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
        }

        form {
            background-color: whitesmoke;
            padding: 20px;
            margin: 50px auto;
            width: 80%;
            max-width: 700px;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            color: #800000;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 10px;
            background-color: white;
            border: 1px solid #333;
            color: black;
            font-size: 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            margin-right: 20px;
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
            background-color: #800000;
            padding: 7px;
            color: whitesmoke;
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
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

        <label>Content</label>
        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>

        <button type="submit">Update Post</button>
    </form>
    <?php
} else {
    if (!$is_owner) {
        echo "You do not have permission to edit this post.";
    } else {
        echo "You can no longer edit this post.";
    }
    exit;
}

include 'includes/footer.php';
?>
</body>

</html>