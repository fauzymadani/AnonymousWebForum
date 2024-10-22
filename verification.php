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
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .captcha {
            font-size: 24px;
            margin: 20px 0;
        }

        .error {
            color: red;
        }

        .greeter {
            font-family: monospace;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <h1>Verifikasi Anda Bukan Robot</h1>
    <div class="captcha"><?php echo $_SESSION['captcha']; ?></div>
    <form method="POST">
        <input type="text" name="captcha" placeholder="Masukkan CAPTCHA" required>
        <button type="submit">Verifikasi</button>
        <details class="greeter">
            -----BEGIN PGP SIGNED MESSAGE-----<br>
            Hash: SHA512<br>
            <br>
            Please read the rule before making a post and Faq about this forum<br>
            -----BEGIN PGP SIGNATURE-----<br>

            iQIzBAEBCgAdFiEEZFSHdhPyF4ApFuH4L0pyCwpIvzwFAmcXCX8ACgkQL0pyCwpI<br>
            vzxUaw/9HW8CtuaC0EC+2WvxGWXtDWz0dc//u9yRXe/xlnGNSYE896zH4iQ6ADQ/<br>
            cBcYqwXZeoE03ZGtCV8xSm4mib9obALDQuTM1PG/eTsoz4xzyRdu5kGYuypH9ugp<br>
            bPNpG/fTkLDirB38m0eu9FVu5VBJCS49zoL+SGXV9KHHebc+rYz2fa5r9SqN6z7U<br>
            a5HP6wHOU78AILLdt3EUcXCsK6k2sXk1XzLOaNII01Y6e3t6JVyhdCkVvtauR9+T<br>
            P2nGlq6cKqqF76rZNEQq4MqG4kKS4U7Vt/62oNaXXrkP6cFkjonAf1QeZ9DBdBrE<br>
            F2/45I6Mz+bMABMnUdV+Utn3VwM65zqtnYTzAnpOExTEAf13bs835054uhnsQ+ed<br>
            RDjT7j3h9ciTAAXdMVzHvfNWy9fOGJVmEuPoPCxOoSvZeD+AVIlZIN/DMG5ebPJI<br>
            pADw42HoNJDaWi0kiUUrvYke3EszT7FvBdQ8kyeVkK53WOyQNUUQLfsE5YLwFQrb<br>
            KwA8BKlz1dsFs33cxjUQeErjafvDw4bOsYsoervWMPzqky6MRxFMocXPsVE2QNBG<br>
            bo6LTcxW5yuXBk1wfgpWgJ6YSmxlvW08dYqYDhTqfswStKLDq9/jnD5kiX8a0mfe<br>
            THbma7stauAZRG+4/N96I0RQr6npKULNm09jnfMC9nPBlZ6ZNfw=<br>
            =WSG+<br>
            -----END PGP SIGNATURE-----<br>
        </details>
    </form>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blur.js/1.0.0/blur.min.js"></script>

</body>

</html>