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
            color: #e0e0e0;
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 1000px;
            margin: 20px auto;
        }

        h1 {
            font-size: 2em;
            text-align: left;
            margin-bottom: 20px;
            color: #d4af37;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .create {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            margin-bottom: 20px;
            display: block;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: max-content;
        }

        button a {
            text-decoration: none;
            color: inherit;
        }

        button:hover {
            background-color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        th {
            background-color: #222;
            color: #d4af37;
        }

        td {
            background-color: #1f1f1f;
        }

        .post-title {
            color: #c5c6c7;
            font-size: 1.2em;
        }

        .post-title a {
            text-decoration: none;
            color: inherit;
        }

        .post-title a:hover {
            color: #d4af37;
        }

        .post-meta {
            color: #aaa;
            font-size: 0.9em;
        }

        .back {
            background-color: tomato;
            border: 1px solid red;
            margin-bottom: 20px;
        }

        .back a {
            text-decoration: none;
            color: white;
        }

        .last-post {
            color: #77b7ff;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="index.php"><button class="back">Back</button></a>
        <h1><?php echo $category; ?> Posts</h1>

        <button class="create"><a href="create_post.php?category=<?php echo $category; ?>">Create New Post</a></button>

        <table>
            <thead>
                <tr>
                    <th>Topic</th>
                    <th>Posts</th>
                    <th>Last Post</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td class="post-title">
                            <a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
                            <div class="post-meta">
                                Posted by: <?php echo $post['user_id']; ?> | 
                                <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                            </div>
                        </td>
                        <td><?php echo rand(1, 10); // Placeholder for number of posts ?></td>
                        <td>
                            <div class="last-post">
                                <?php echo date('F j, Y', strtotime($post['created_at'])); ?> 
                                by <?php echo $post['user_id']; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include('./includes/footer.php'); ?>
</body>

</html>
