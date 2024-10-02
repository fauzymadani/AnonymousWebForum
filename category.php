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

<h1><?php echo $category; ?> Posts</h1>

<!-- Tautan untuk membuat postingan baru -->
<button><a href="create_post.php?category=<?php echo $category; ?>">Create New Post</a></button>

<!-- Menampilkan daftar postingan -->
<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a> - <i>Posted by: <?php echo $post['user_id']; ?></i>
        </li>
    <?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>
