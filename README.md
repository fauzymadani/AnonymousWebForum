# AnonymousWebForum

<p align="center">
<img align="center" src="https://github.com/user-attachments/assets/0c6e5db0-9b28-41f0-9547-d648b70ec3be" alt="Project Image" />
</p>

## about
<div align="center">
<img align="center" src="https://img.shields.io/badge/License-GPLv3-blue.svg" alt="GPLv3 License" />
</div>

this forum is anonymous, you can post whatever topic in here, but still have a rule. at `rule.html`, the username is generated automaticalyy, you can edit and delete your post, but when you stay at the same session. if you're log out from the web, your session is ended and you cannot edit or delete your post. the captcha is generated with php.
```php
<?php
session_start();

// make random number
$random_number = rand(1000, 9999);
$_SESSION['captcha'] = $random_number; // Simpan ke session

// Membuat gambar
$image = imagecreate(100, 40); // Ukuran gambar
$background_color = imagecolorallocate($image, 0, 0, 0); // Warna latar belakang (hitam)
$text_color = imagecolorallocate($image, 255, 255, 255); // Warna teks (putih)
$line_color = imagecolorallocate($image, 64, 64, 64); // Warna garis acak

// add random lines
for ($i = 0; $i < 5; $i++) {
    imageline($image, 0, rand() % 50, 100, rand() % 50, $line_color);
}

// show niumber
imagestring($image, 5, 30, 10, $random_number, $text_color);

//show the image
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>

```

## license
this repository is licensed under the GPL license. 
