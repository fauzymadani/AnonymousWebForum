<?php
include 'includes/header.php';
include 'includes/db.php';

$category = $_GET['category'];

// Query untuk mendapatkan semua postingan di kategori yang dipilih
$query = $pdo->prepare("SELECT * FROM posts WHERE category = :category");
$query->execute(['category' => $category]);
$posts = $query->fetchAll();
?>

<h1>Posts in <?php echo $category; ?></h1>

<!-- Tombol untuk membuat postingan baru -->
<a href="create_post.php?category=<?php echo $category; ?>">Create New Post</a>

<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>
