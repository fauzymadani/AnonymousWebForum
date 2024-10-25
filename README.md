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

iQIzBAEBCgAdFiEEZFSHdhPyF4ApFuH4L0pyCwpIvzwFAmcbjOUACgkQL0pyCwpI
vzwHTw/+P+RXnMNIrBKTviRwLLv9Y66OvpUblOCeZ5iXH+f9BGMDwn6YuyFdvNS8
3fjYYhEpfuh6LdxlMR530D3qUxvyqlp3gMZVjghNQHR7kCihr31Yj7tl+GwUxQlP
PPHN/14wjzCmFFHH1QB+yMTs2i8N2FTryLyJGBaePl84oNC2StW3rG+nYsyfxJwf
OKXMZ1Re/rDbdnpDQSlKnXdXK7lEpsR8PRpD9OtTnhMdMELQg43zUGzaXdmyHNlz
WgtyEQGo7fIhtkf+8wPkkDpVDnYpPLbmn08j7UPaiLNHKjOUSnMQie3cg27fC26h
DILizDLwcCQH7d1vozMw7D4q3AqqCPUrf8KnvOs2QeQLXkuURo/P9+wxkaIj7lmt
RkIRF1rFEUaTIY4JJQ3+oC2SqMdNdqsFJeptVbkZ7hLuYPBCbqVQGIG+5hpMBOwq
7+72qhPlv6IqJl9NkgqMMXK24FfG6oYlyg1Sw5jeAZ487R1IV2gPtKWD9eF7Da/5
1YslWcR/Fn4Y9tG+ONTivYxt0ztnjDxrjbUQsAkyr1dnZqMYVGguqKJZQQ36DZBq
vnZK+tDIQu379x0kWSQk1o8SkTfCwtTihT3BmSf1ubfHmCgHOKNU7p9naMocwsIv
eOWczT9tqAj/hinOLjT5BObnD6oFECHk7TxT4bmlggfa+sNri00=
=ALtm
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
