<?php
session_start();

// Mengatur CAPTCHA
if (!isset($_SESSION['captcha'])) {
    $_SESSION['captcha'] = rand(1000, 9999);
}

// Jika verifikasi berhasil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Memeriksa apakah CAPTCHA yang dimasukkan benar
    if ($_POST['captcha'] == $_SESSION['captcha']) {
        $_SESSION['verified'] = true; // Set session verified
        header("Location: index.php"); // Redirect ke halaman utama
        exit();
    } else {
        $error = "CAPTCHA salah, silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blur.js/1.0.0/blur.min.js"></script>

    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .captcha { font-size: 24px; margin: 20px 0; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Verifikasi Anda Bukan Robot</h1>
    <div class="captcha"><?php echo $_SESSION['captcha']; ?></div>
    <form method="POST">
        <input type="text" name="captcha" placeholder="Masukkan CAPTCHA" required>
        <button type="submit">Verifikasi</button>
    </form>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blur.js/1.0.0/blur.min.js"></script>

</body>
</html>
