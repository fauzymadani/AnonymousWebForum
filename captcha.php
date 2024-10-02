<?php
session_start();

// Membuat angka acak
$random_number = rand(1000, 9999);
$_SESSION['captcha'] = $random_number; // Simpan ke session

// Membuat gambar
$image = imagecreate(100, 40); // Ukuran gambar
$background_color = imagecolorallocate($image, 0, 0, 0); // Warna latar belakang (hitam)
$text_color = imagecolorallocate($image, 255, 255, 255); // Warna teks (putih)
$line_color = imagecolorallocate($image, 64, 64, 64); // Warna garis acak

// Menambahkan garis acak ke gambar
for ($i = 0; $i < 5; $i++) {
    imageline($image, 0, rand() % 50, 100, rand() % 50, $line_color);
}

// Menambahkan angka ke gambar
imagestring($image, 5, 30, 10, $random_number, $text_color);

// Menampilkan gambar
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>
