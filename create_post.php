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

        // Menyimpan postingan ke database
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, category, user_id) VALUES (:title, :content, :category, :user_id)");
        $stmt->execute(['title' => $title, 'content' => $content, 'category' => $category, 'user_id' => $user_id]);

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
    <style>
        /* CSS untuk memperindah form dan menempatkannya di tengah */
        /* CSS untuk dark web style */
        body {
            font-family: 'Courier New', Courier, monospace;
            /* Font monospaced yang umum di dark web */
            background-color: #121212;
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
            background-color: #1c1c1c;
            /* Warna container yang sedikit lebih terang dari background */
            padding: 20px;
            border: 1px solid #333;
            /* Batasan gelap di sekitar container */
            border-radius: 5px;
            width: 400px;
        }

        h1 {
            text-align: center;
            color: #e0e0e0;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #b3b3b3;
            /* Warna label lebih pudar */
        }

        input[type="text"],
        textarea,
        select {
            background-color: #121212;
            /* Warna input yang sangat gelap */
            color: #e0e0e0;
            /* Teks input tetap kontras */
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #333;
            /* Garis batas input sama dengan container */
            border-radius: 3px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
            outline: none;
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

        button {
            padding: 10px;
            /* background-color: #f39c12; */
            /* Warna tombol oranye terang */
            color: #121212;
            /* Teks tombol lebih gelap untuk kontras */
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 20px;
        }

        button:hover {
            background-color: #d35400;
            /* Sedikit lebih gelap saat dihover */
        }

        a {
            color: yellow;
        }

        @media screen and (max-width: 480px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <!-- Form untuk membuat postingan baru -->
    <div class="container">
        <h1>Create New Post</h1>
        <?php if ($error_message): ?>
            <p id="error-message" style="color:red;"><?= $error_message ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="title">Title</label>
            <input type="text" name="title" required>

            <label for="content">Content</label>
            <textarea name="content" required></textarea>

            <label for="category">Category</label>
            <select name="category" required>
                <option value="Entertainment">Entertainment</option>
                <!-- <option value="Hobbies & interest">Hobbies & interest</option> -->
                <option value="Education">Education</option>
                <option value="Misc.">Misc.</option>
                <option value="Around the world">Around the world</option>
            </select>

            <!-- Bagian CAPTCHA -->
            <div>
                <img src="captcha.php" alt="CAPTCHA Image">
            </div>
            <label for="captcha">Enter CAPTCHA</label>
            <input type="text" name="captcha" required>

            <button type="submit">Create Post</button>
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
</body>