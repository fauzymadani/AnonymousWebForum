<?php
include 'includes/header.php';
include 'includes/db.php';

// Mendapatkan kategori dari URL
$category = $_GET['category'];

// Mengambil postingan dari kategori yang dipilih
$query = $pdo->prepare("SELECT * FROM posts WHERE category = :category");
$query->execute(['category' => $category]);
$posts = $query->fetchAll();

$category = $_GET['category']; // Mendapatkan kategori dari URL
$stmt = $pdo->prepare("SELECT * FROM posts WHERE category = :category");
$stmt->execute(['category' => $category]);
$posts = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html>

<head>
    <title>category</title>
    <style>
        body {
            background-color: #121212;
            /* Dark background */
            color: #e0e0e0;
            /* Text color */
            font-family: 'Courier New', Courier, monospace;
            /* Monospace font for dark web style */
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #1a1a1a;
            /* Slightly lighter background for container */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 800px;
            margin: 20px auto;
        }

        h1 {
            font-size: 2em;
            text-align: center;
            margin-bottom: 20px;
            color: #d4af37;
            /* Gold color for category title */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            /* Text shadow for a more striking effect */
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        button a {
            text-decoration: none;
            color: inherit;
        }

        button:hover {
            background-color: #555;
        }

        .post-container {
            background-color: #1f1f1f;
            /* Slightly lighter background for post container */
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s;
        }

        .post-container:hover {
            background-color: #2b2b2b;
        }

        .post-title {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #c5c6c7;
            /* Light gray for post title */
        }

        .post-title a {
            text-decoration: none;
            color: #c5c6c7;
            transition: color 0.3s;
        }

        .post-title a:hover {
            color: #d4af37;
            /* Gold hover color for post title */
        }

        .post-meta {
            font-size: 0.9em;
            color: #aaa;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><?php echo $category; ?> Posts</h1>

        <!-- Tautan untuk membuat postingan baru -->
        <button><a href="create_post.php?category=<?php echo $category; ?>">Create New Post</a></button>

        <!-- Menampilkan daftar postingan -->
        <ul>
            <?php foreach ($posts as $post): ?>
                <li class="post-container">
                    <div class="post-title">
                        <a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
                    </div>
                    <div class="post-meta">
                        Posted by: <?php echo $post['user_id']; ?> |
                        <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php include('./includes/footer.php'); ?>
</body>

</html>