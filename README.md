> [!IMPORTANT]  
> # ⚠️ Announcement ⚠️
```
-----BEGIN PGP SIGNED MESSAGE-----
Hash: SHA512

For all of people who look at this repository and user who cloned this repository.
I hereby declare that development for this repository or this forum website is stopped because some reason.
and there's a big problem and bug that were hard to fix. thank you for all of your enthusiast.
and again, Thank you very  much.
-----BEGIN PGP SIGNATURE-----

iQIzBAEBCgAdFiEEZFSHdhPyF4ApFuH4L0pyCwpIvzwFAmcc06IACgkQL0pyCwpI
vzzu8A/+OnRq0jaObjdK8MEfvo3D9P9AUi9IGNc6ZT05FT9QyCp4J6YIAvV9lTTC
58GeHfdJjBjzHNtKqwPedXosbC33itVwbdo1sM9WGfo0ErBAUIO3CuWpA/kcSLdB
oGeMYd9L+FXxAs1dy+cdU+1g19+9zVFOfDzspegNuWbEpUbkFPo3ouS2x10o5qSu
9CJ0BAPocf9g5mexDc/FalwjvSxDp+pzWQMon7am5bxb3QdFfhUrCBT+be945Xp5
kByB/3TsDJgBVPsKo18Z3INQnKVR6cYEl4B9AqUpXitGyx/2bBBVXffvwCxti8pJ
6uI/o8faZzDH8woQhWcCbvu1TcCbT3b6RQIm4jGXW83w6k42ej1ZzMRe8CbJUap+
ScPMr930kpFPcJ9glGb2Jy4fmre4AIAMZdE00yO9pMZwZbembXwHxBHsBwfgRVyU
4qnvGdJKlpkBLOW0anqxEg0Nj7Jokj5uvUIVy/G+wFQhBTRm+3CB5UR/0JMAyYT1
ngPhv5aATrMtdOXJT2giFJ7uPRrD0BkwFVF7s8Fmp5avMxMWcg9z4S4DCZjAMiTz
Qjwv2A1h2JJ5oVYwFuYEOrh9mMUz3MmMX1UbjfwJiNMmvSby/Zt7Y9OlMaf+uQ3d
sU0OZzz6H0beyOKMvSzVE/Qm1j/PWSmIjvC6/QCM9JOyXu+o5lU=
=HiCd
-----END PGP SIGNATURE-----
```

# AnonymousWebForum
[![PHP Composer](https://github.com/fauzymadani/AnonymousWebForum/actions/workflows/php.yml/badge.svg)](https://github.com/fauzymadani/AnonymousWebForum/actions/workflows/php.yml)
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

## donate
donate in bitcoin: `bc1q032apdhxqdn67rhaw48qs2mc84lqh4zyy3csh8`

## FAQ

#### is the website safe?

> Of course, the username is generated automatically every session, if you're close the current session, your username is generated again. different session, different username

#### is there any rule in this website?

> yes, there is several rule at `rule.html`


## Repo Activity

![Alt](https://repobeats.axiom.co/api/embed/1540d66aa3a3a326d80c92e7ebce71147da61913.svg "Repobeats analytics image")
