<?php
session_start();
include 'includes/db.php';

// Mengambil semua blog dari database
$query = $pdo->prepare("SELECT * FROM posts WHERE category = 'Blog' ORDER BY created_at DESC");
$query->execute();
$blogs = $query->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c1e;
            color: #e5e5e5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #2e2e2e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .blog-post {
            background-color: #333;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }

        .blog-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .blog-content {
            margin-top: 10px;
        }

        .blog-date {
            font-size: 0.8rem;
            color: #aaa;
        }

        .navbar {
            display: flex;
            justify-content: space-around;
            background-color: #2e2e2e;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
            border-top: 1px solid #555;
            border-radius: 5px;
        }

        .navbar a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
            padding: 10px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .blog-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .image-left {
            width: 150px;
            height: auto;
            margin-right: 20px;
        }

        .description h1 {
            font-size: 1.5em;
            margin: 0;
        }

        .description p {
            font-size: 1em;
        }

        details {
            font-family: monospace;
            color: red;
        }

        a {
            color: yellow;
        }

        .blog-1, .blog-2, .blog-3 {
            border: 1px solid yellow;
            margin: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Blog Posts</h1>

        <?php foreach ($blogs as $blog): ?>
            <div class="blog-post">
                <div class="blog-title"><?php echo htmlspecialchars($blog['title']); ?></div>
                <div class="blog-content">
                    <p><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>
                </div>
                <div class="blog-date">Posted on: <?php echo $blog['created_at']; ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="blog.php">Blog</a>
        <a href="blog.php">back</a>
    </div>
    <div class="blog-1">
        <div class="blog-container">
            <p><img src="./favicon/arche.jpeg" alt="Blog Image 1" class="image-left"></p>
            <div class="description" align="left">
                <h1><a href="girl.php">Archetyp Dark Market</a></h1>
                <p>a history about the biggest drug market that still operate todays.</p>
            </div>
        </div>
    </div>

    <!-- Blog 2 -->
    <div class="blog-2">
        <div class="blog-container">
            <p><img src="https://upload.wikimedia.org/wikipedia/en/thumb/4/42/Silk_Road_Marketplace_Item_Screen.jpg/300px-Silk_Road_Marketplace_Item_Screen.jpg" alt="Blog Image 2" class="image-left" style="width: 200px;"></p>
            <div class="description" align="left">
                <h1><a href="communicate.php">how Silk road was the First and the largest modern dark market back in the days</a></h1>
                <p>Silk Road was an online black market and the first modern darknet market.[7]</p>
            </div>
        </div>
    </div>

    <!-- blog 3 -->
    <div class="blog-2">
        <div class="blog-container">
            <p><img src="./favicon/android-chrome-192x192.png" alt="Blog Image 2" class="image-left" style="width: 200px;"></p>
            <div class="description" align="left">
                <h1><a href="howtomakepost.php">How to make post in Anonymous Forum</a></h1>
                <p>if you're new in this Forum, you'll need to see this!!</p>
            </div>
        </div>
    </div>

</body>

</html>