<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    // Menghasilkan username anonim baru untuk setiap postingan
    $user_id = 'Anon-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 8); 

    // Menyimpan postingan ke database
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, category, user_id) VALUES (:title, :content, :category, :user_id)");
    $stmt->execute(['title' => $title, 'content' => $content, 'category' => $category, 'user_id' => $user_id]);

    // Mengarahkan kembali ke halaman kategori setelah berhasil menambah postingan
    header("Location: category.php?category=$category");
    exit();
}

// Pastikan form di create_post.php memiliki enctype="multipart/form-data"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id']; // Pastikan user sudah login

    // Proses upload gambar
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = 'uploads/' . $imageName;

        // Pindahkan file ke folder uploads
        if (!move_uploaded_file($imageTmpPath, $imagePath)) {
            echo "Failed to upload image.";
            exit();
        }
    }

    // Simpan postingan ke database
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, image, user_id) VALUES (:title, :content, :image, :user_id)");
    $stmt->execute([
        'title' => $title,
        'content' => $content,
        'image' => $imagePath,  // Path gambar disimpan di database
        'user_id' => $user_id
    ]);

    header("Location: index.php");
}

?>