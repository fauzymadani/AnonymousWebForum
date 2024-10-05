<?php
session_start();

// Membuat kode acak untuk CAPTCHA (hanya angka 0-9)
$captcha_code = '';
for ($i = 0; $i < 6; $i++) {
    $captcha_code .= rand(0, 9); // Angka acak 0-9
}

// Menyimpan CAPTCHA di sesi
$_SESSION['captcha'] = $captcha_code;

// Membuat gambar CAPTCHA
$img = imagecreatetruecolor(120, 40);

// Warna latar belakang dan teks yang lebih kontras
$bg_color = imagecolorallocate($img, 255, 255, 255); // Background putih
$txt_color = imagecolorallocate($img, 0, 0, 0);      // Teks hitam

// Mengisi gambar dengan warna latar
imagefilledrectangle($img, 0, 0, 120, 40, $bg_color);

// Tambahkan gangguan berupa garis acak agar CAPTCHA sulit dipecahkan oleh bot
for ($i = 0; $i < 5; $i++) {
    $line_color = imagecolorallocate($img, rand(100, 255), rand(100, 255), rand(100, 255));
    imageline($img, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
}

// Menambahkan teks CAPTCHA (angka) ke gambar
imagettftext($img, 20, rand(-10, 10), 15, 30, $txt_color, 'monospace', $captcha_code);

// Menambahkan titik acak untuk gangguan tambahan
for ($i = 0; $i < 100; $i++) {
    $dot_color = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($img, rand(0, 120), rand(0, 40), $dot_color);
}

// Menampilkan gambar
header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
?>
