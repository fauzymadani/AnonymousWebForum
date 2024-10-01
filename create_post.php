<?php
session_start(); // Memulai sesi
include 'includes/header.php';
include 'includes/db.php';

// Fungsi untuk menghasilkan username anonim
function generateAnonymousUsername() {
    return 'Anon-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
}

// Memproses form saat disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    // Menggunakan ID anonim
    $user_id = generateAnonymousUsername();

    // Menyimpan postingan ke database
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, category, user_id) VALUES (:title, :content, :category, :user_id)");
    $stmt->execute(['title' => $title, 'content' => $content, 'category' => $category, 'user_id' => $user_id]);

    // Setelah menyimpan postingan, simpan ID pengguna di sesi
    $_SESSION['user_id'] = $user_id;

    // Mengarahkan pengguna ke halaman kategori setelah postingan disimpan
    header("Location: category.php?category=$category");
    exit(); // Selalu disarankan untuk memanggil exit setelah header redirection
}
?>

<!-- Form untuk membuat postingan baru -->
<h1>Create New Post</h1>
<form method="POST">
    <label for="title">Title</label>
    <input type="text" name="title" required>

    <label for="content">Content</label>
    <textarea name="content" required></textarea>

    <label for="category">Category</label>
    <select name="category" required>
        <option value="Entertainment">Entertainment</option>
        <option value="Hobbies & interest">Hobbies & interest</option>
        <option value="Education">Education</option>
        <option value="Misc.">Misc.</option>
        <option value="Around the world">Around the world</option>
    </select>

    <button type="submit">Create Post</button>
</form>

<?php include 'includes/footer.php'; ?>
