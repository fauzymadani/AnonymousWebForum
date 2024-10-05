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
    <title>Category - <?php echo $category; ?></title>
    <style>
        /* General Body Styling */
        body {
            background-color: #f0e0d6;
            color: #800000;
            font-family: Tahoma, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            background-color: #ffffff;
            border: 1px solid #d9d9d9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header Styling */
        h1 {
            font-size: 2em;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        /* Back button styling */
        .back button {
            background-color: #800000;
            color: whitesmoke;
        }

        .back:hover {
            background-color: #2980b9;
        }

        .back a {
            text-decoration: none;
            color: inherit;
        }

        /* Create New Post Button */
        .create {
            background-color: #800000;
            color: whitesmoke;
        }

        .create:hover {
            background-color: #c0392b;
        }

        .create a {
            text-decoration: none;
            color: inherit;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #800000;
            color: #fff;
        }

        td {
            background-color: #f0e0d6;
        }

        /* Post title styling */
        .post-title {
            font-size: 1.2em;
            font-weight: bold;
        }

        .post-title a {
            text-decoration: none;
            color: #800000;
        }

        .post-title a:hover {
            color: yellow;
        }

        /* Post metadata styling */
        .post-meta {
            font-size: 0.9em;
            color: #7f8c8d;
            margin-top: 5px;
        }

        /* Last post styling */
        .last-post {
            color: #c96663;
            font-size: 0.9em;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            th, td {
                padding: 10px;
            }

            .create, .back {
                font-size: 0.9em;
                padding: 8px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Back Button -->
        <a href="index.php" class="back"><button>back</button></a>

        <!-- Category Title -->
        <h1><?php echo $category; ?> Posts</h1>

        <!-- Create New Post Button -->
        
            <a href="create_post.php?category=<?php echo $category; ?>"><button class="create">Create New Post</button></a>
        

        <!-- Table of Posts -->
        <table>
            <thead>
                <tr>
                    <th>Topic</th>
                    <th>Posts</th>
                    <th>Last Post</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through posts and display each one -->
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td class="post-title">
                            <a href="post.php?id=<?php echo $post['id']; ?>">
                                <?php echo $post['title']; ?>
                            </a>
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

