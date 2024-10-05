<?php
session_start(); // Memulai sesi
include 'includes/header.php';
include 'includes/db.php';

// Fungsi untuk menghasilkan username anonim
function generateAnonymousUsername()
{
    return 'Anon-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
}

// Variabel untuk pesan kesalahan
$error_message = '';

// Memproses form saat disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $user_captcha = $_POST['captcha']; // Mendapatkan input CAPTCHA dari form

    // Validasi CAPTCHA
    if ($user_captcha == $_SESSION['captcha']) {
        // CAPTCHA cocok, lanjutkan proses penyimpanan postingan
        $user_id = generateAnonymousUsername();

        // Menangani upload gambar
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = "uploads/";
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Validasi tipe file (hanya mengizinkan gambar)
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($imageFileType, $allowedTypes)) {
                // Pindahkan file ke folder uploads
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $imagePath = $targetFilePath;
                } else {
                    $error_message = "Error uploading the image.";
                }
            } else {
                $error_message = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        }

        // Menyimpan postingan ke database (termasuk path gambar)
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, category, user_id, image) VALUES (:title, :content, :category, :user_id, :image)");
        $stmt->execute([
            'title' => $title,
            'content' => $content,
            'category' => $category,
            'user_id' => $user_id,
            'image' => $imagePath
        ]);

        // Setelah menyimpan postingan, simpan ID pengguna di sesi
        $_SESSION['user_id'] = $user_id;

        // Mengarahkan pengguna ke halaman kategori setelah postingan disimpan
        header("Location: category.php?category=$category");
        exit(); // Selalu disarankan untuk memanggil exit setelah header redirection
    } else {
        // CAPTCHA tidak cocok
        $error_message = "Incorrect CAPTCHA. Please try again.";
    }
}

// Session timeout - Tambahkan ini di bagian atas
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset(); // Hapus semua session
    session_destroy(); // Hancurkan session
    header('Location: login.php'); // Redirect ke halaman login
    exit;
}
$_SESSION['last_activity'] = time(); // Update waktu terakhir aktivitas
?>

<!DOCTYPE html>
<html>

<head>
    <title>posting</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blur.js/1.0.0/blur.min.js"></script>

    <style>
        /* CSS untuk memperindah form dan menempatkannya di tengah */
        /* CSS untuk dark web style */
        body {
            font-family: 'Courier New', Courier, monospace;
            /* Font monospaced yang umum di dark web */
            /* background-color: #121212; */
            background-color: #f0e0d6;
            /* Warna latar belakang gelap */
            color: #e0e0e0;
            /* Warna teks yang kontras tapi tidak terlalu terang */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            /* Warna container yang sedikit lebih terang dari background */
            padding: 20px;
            /* Batasan gelap di sekitar container */
            width: 600px;
        }

        h1 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: black;
            /* Warna label lebih pudar */
        }

        input[type="text"],
        textarea,
        select {
            background-color: #f0e0d6;
            /* Warna input yang sangat gelap */
            color: black;
            /* Teks input tetap kontras */
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
            
        }

        textarea {
            resize: vertical;
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            border-color: #f39c12;
            /* Warna garis batas berubah saat fokus */
        }

        .submit {
            padding: 10px;
            /* background-color: #f39c12; */
            /* Warna tombol oranye terang */
            color: whitesmoke;
            /* Teks tombol lebih gelap untuk kontras */
            cursor: pointer;
            font-size: 16px;
            background-color: #800000;
        }

        a {
            color: yellow;
        }

        .back {
            background-color: #800000;
            color: whitesmoke;
        }

        @media screen and (max-width: 480px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>

<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blur.js/1.0.0/blur.min.js"></script>

    <!-- Form untuk membuat postingan baru -->
    <div class="container">
        <a href="index.php"><button class="back">back</button></a>
        <h1>Create New Post</h1>
        <?php if ($error_message): ?>
            <p id="error-message" style="color:red;"><?= $error_message ?></p>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data"> <!-- Tambahkan enctype untuk upload gambar -->
            <label for="title">Title</label>
            <input type="text" name="title" required>

            <label for="content">Content</label>
            <textarea name="content" required></textarea>

            <label for="category">Category</label>
            <select name="category" required>
                <option value="Entertainment">Entertainment</option>
                <option value="Education">Education</option>
                <option value="Misc.">Misc.</option>
                <option value="Mecha">Mecha</option>
                <option value="Around the world">Around the world</option>
                <option value="Comics">Comics & Cartoons</option>
                <option value="Technology">Technology</option>
                <option value="Weapons">Weapons</option>
                <option value="Auto">Auto</option>
                <option value="Sports">Sports</option>
                <option value="Photography">Photography</option>
                <option value="Music">Music</option>
                <option value="Fashion">Fashion</option>
                <option value="Graphic Design">Graphic Design</option>
                <option value="DIY">Do-It-Yourself</option>
                <option value="Business">Business & Finance</option>
                <option value="Travel">Travel</option>
                <option value="Paranormal">Paranormal</option>
                <option value="Random">Random</option>
                <option value="OperatingSystem">OperatingSystem</option>
            </select>
            
            <!-- Bagian untuk upload gambar -->
            <label for="image">Attach Image</label>
            <input type="file" name="image" accept="image/*">

            <!-- Bagian CAPTCHA -->
            <div>
                <img src="captcha.php" alt="CAPTCHA Image">
            </div>
            <label for="captcha">Enter CAPTCHA</label>
            <input type="text" name="captcha" required>

            <button type="submit" class="submit">Create Post</button>
        </form>
        <script>
            // Mengecek apakah elemen dengan id "error-message" ada
            const errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                // Setelah 3 detik (3000 ms), sembunyikan pesan kesalahan
                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 3000);
            }
        </script>

    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blur.js/1.0.0/blur.min.js"></script>

</body>
</html>
