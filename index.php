<?php
session_start();
include 'includes/header.php';

// Session timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
$_SESSION['last_activity'] = time();

include 'includes/footer.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $secret_key = '6LdHR1gqAAAAAEarOconZgR7ncs551Fe_GYZw8HJ';

    // Verifikasi reCAPTCHA dengan mengirimkan permintaan ke Google
    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptcha_response}");
    $response_data = json_decode($verify_response);

    if ($response_data->success) {
        // CAPTCHA berhasil diverifikasi
        echo "Selamat, Anda bukan robot!";
    } else {
        // CAPTCHA gagal diverifikasi
        echo "Verifikasi CAPTCHA gagal, silakan coba lagi.";
    }
}

?>
<?php
session_start();

// Periksa apakah pengguna sudah terverifikasi
if (!isset($_SESSION['verified'])) {
    // Arahkan ke halaman verifikasi
    header("Location: verification.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Anon Forum</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="./favicon/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blur.js/1.0.0/blur.min.js"></script>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <style>
        /* Style umum mirip dengan 4chan */
        body {
            background-color: #f0e0d6;
            color: #800000;
            font-family: Tahoma, sans-serif;
            margin: 0;
            padding: 0;
        }

        a {
            color: #800000;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        h1 {
            font-size: 1.5em;
            color: #fff;
            background-color: #800000;
            padding: 10px;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #d7bfb7;
        }

        .announcement {
            background-color: #b00000;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 5px;
        }

        /* Layout untuk Boards mirip dengan gambar */
        .boards-container {
            margin-top: 20px;
            padding: 10px;
            border: 2px solid #d7bfb7;
            background-color: #f0e0d6;
        }

        .boards-title {
            font-size: 1.2em;
            font-weight: bold;
            color: #800000;
            margin-bottom: 10px;
        }

        .boards-columns {
            display: flex;
            justify-content: space-between;
        }

        .board-column {
            width: 24%;
        }

        .board-column a {
            display: block;
            color: #800000;
            padding: 5px;
            border-bottom: 1px solid #d7bfb7;
        }

        .board-column a:last-child {
            border-bottom: none;
        }

        .board-column a:hover {
            background-color: #ffdead;
        }

        /* Style Footer */
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
        }

        footer a {
            color: #800000;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .navbar a,
        .announcement a {
            color: yellow;
        }

        .create-new-post,
        .reply-button {
            background-color: #800000;
            margin-bottom: 20px;
            color: whitesmoke;
        }

        .disabled {
            pointer-events: none;
            /* Menonaktifkan interaksi */
            color: gray;
            /* Mengubah warna untuk menunjukkan bahwa tautan dinonaktifkan */
        }

        .verify-button {
            background-color: #800000;
            color: whitesmoke;
            margin-top: 10px;
        }

        .image-span {
            width: 70px;
            height: 50px;
            margin-left: 20px;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .greeter {
            font-family: monospace;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blur.js/1.0.0/blur.min.js"></script>


    <!-- <form method="POST" action="index.php">
        
        <div class="g-recaptcha" data-sitekey="6LdHR1gqAAAAAF4FqKgGQRuAgPKO2FapNLmo4qMq"></div>
        <button type="submit">Submit</button>
    </form> -->

    <div class="container">
        <h1>Welcome to Anon Forum</h1>

        <div class="announcement">
            <p>Read our <a href="rule.html">Rules</a> and <a href="#" id="faq-link">FAQ</a> before participating!, <strong>you have to verify you're not a robot before exploring our forum!</strong></p>
            <div class="navbar">
                <a href="index.php" class="board-link">Home</a>
                <a href="blog.php" class="board-link">Blog</a>
                <a href="#" id="faq-link" class="board-link">FAQ</a>
                <!-- Tambahkan link lain sesuai kebutuhan -->
            </div>
        </div>

        <form method="POST" action="index.php" align="center">
            <!-- Field lainnya seperti input CAPTCHA -->
            <div class="g-recaptcha" data-sitekey="6LdHR1gqAAAAAF4FqKgGQRuAgPKO2FapNLmo4qMq" data-callback="onCaptchaSuccess" align="center"></div>
            <button type="submit" align="center" class="verify-button">Submit</button>
        </form>
        <div class="boards-container">
            <div class="boards-title">Boards</div><a href="create_post.php" class="board-link"><button class="create-new-post">create new post</button></a> <a href="./howtoreply.php"><button class="reply-button">How do i reply a comment?</button></a>
            <h1 align="center"><strong align="center">DO NOT SPAMMING!</strong><img src="./favicon/android-chrome-192x192.png" alt="" class="image-span"></h1>
            <div class="boards-columns">
                <div class="board-column">
                    <a href="category.php?category=Entertainment" class="board-link">Entertaiment</a>
                    <a href="category.php?category=Education" class="board-link">Education</a>
                    <a href="category.php?category=Misc." class="board-link">Misc</a>
                    <a href="category.php?category=Mecha" class="board-link">Mecha</a>
                    <a href="category.php?category=Around%20the%20world" class="board-link">Around the world</a>
                </div>
                <div class="board-column">
                    <a href="category.php?category=Comics" class="board-link">Comics & Cartoons</a>
                    <a href="category.php?category=Technology" class="board-link">Technology</a>
                    <a href="category.php?category=Weapons" class="board-link">Weapons</a>
                    <a href="category.php?category=Auto" class="board-link">Auto</a>
                    <a href="category.php?category=Sports" class="board-link">Sports</a>
                </div>
                <div class="board-column">
                    <a href="category.php?category=Photography" class="board-link">Photography</a>
                    <a href="category.php?category=Music" class="board-link">Music</a>
                    <a href="category.php?category=Fashion" class="board-link">Fashion</a>
                    <a href="category.php?category=Graphic%20Design" class="board-link">Graphic Design</a>
                    <a href="category.php?category=DIY" class="board-link">Do-It-Yourself</a>
                </div>
                <div class="board-column">
                    <a href="category.php?category=Business" class="board-link">Business & Finance</a>
                    <a href="category.php?category=Travel" class="board-link">Travel</a>
                    <a href="category.php?category=Paranormal" class="board-link">Paranormal</a>
                    <a href="category.php?category=Random" class="board-link">Random</a>
                    <a href="category.php?category=OperatingSystem" class="board-link">OperatingSystem</a>
                </div>
            </div>
        </div>

        <footer>
            <p>Donate bitcoin to this location: <a style="font-family: monospace;">bc1q0cg7xarp8dxf24kerrmzws9zjk2qrh08exc7l7</a></p>
            <p>Help improve this page? <a href="pgpkeyadmin.asc" download>Contact Admin</a> with pgp encrypted message to this email: <strong>okmnjiijn@protonmail.com</strong></p>
            <p>Send encrypted messages to: <br>
            <details>
                -----BEGIN PGP PUBLIC KEY BLOCK-----

                mQINBGb6T1ABEADh4oWgxd5PZcIzcDNx98Sf3MmP1TjOeUZOCBVChy1R6t/YYLTM
                3NmMzz8yGDfgKEpK9dta2g2lIWNXy8NlVjB80igFS2FOu4FmuNeRJBDvh3VIS11v
                25MQoPRBuK8zxhY0Tww4PivaW/k0tFCFE23b7IKiK8I0+0N2BgjqEHTuVTK68FXK
                zBqbR1KoaOmOgIWFE8CM/3Ig0OmV6VVTAxv/3oWlQ3b01MtNnag7eGLPmbiwYUlF
                BgEv2KHE3eIp/oZaXdicBcIr2ftmPknARjyVmFh/Mu69aRFwFVqgRX5t/YjXEs5H
                /O3k/kXZCLrlbsWMWM5uk8ScotJ4016td+KbcnS7XgRBPW/UVTAJQiT1LCiorXjU
                B06ITsYfI3mESMza4+AOD65634IkEa1fFmpsXDSviCKgerZUqC526EsXo+vsa5uf
                Da4VGGWF4h3hRU/klEFX3sq1+bosc+tI49DfyDX6viF765SSXnytJPriuXnnj4So
                5CBrguEbL0TjaQ/vp9Xlrgr0O9eDK5vK6zkJ3xpjdiP9zV9fHkfGhsuj4JfMXB0o
                0ocFX/kFDqQ+COCbMpeN4je9ku9SFh460zoXCKKC3BW+JumL3tmTwBWuvvauHE4T
                e0pGSrRQdgSz40ALjSvaGuhZA2mFSMmwqQOCRNJ3noIyZElCk2To6TdBKwARAQAB
                tAVub29uZYkCVwQTAQgAQRYhBE8Ud6ATv2zva7wNNl4peVoUMF1ZBQJm+k9QAhsD
                BQkFo3uABQsJCAcCAiICBhUKCQgLAgQWAgMBAh4HAheAAAoJEF4peVoUMF1ZdjIP
                /Axyt/x6OO8IJAidaPP6jv9/Q620KGj/dNh/3FE65HT63HQ/sLnxUespNGzmwd4J
                ZmKSpY3jScoGnuz6gKsQdx7JBYqqDtnbtHLFJBttR2aWfqZ/zMmLgB6yyYhheLw8
                y80TE1dN/CqKRPat2+3frpg5OV4C8b9TKuTpQkefQk0FytWju9QFkqoYz7StpeM3
                NnQ4iimpPJCXyDBXhnC3OpzigfTkOc9/zV9KZ0jrQbB4+EzcsIzya+xV11QUOVZk
                NvzRBpnuyU70SuyY09PZcHP0e9cJ6ACoCHYmQX/PiBf21zy1V8UNDDEY7q2vomnF
                TGZGB49Fe+hgfIPGmoO2d0AhWmFZ1H8dL6LNb/mhwwAGToZgxatrGwKNgiYUHpv8
                6iTi1WqH97AfgG5HKAGW03Q70bCDS8AM80IawWnsau4IW4Wf8a727SOHlFGU8v3X
                Nxwx2tmS90cmM68MdLEB3Wh+UUBV0LrYG2ghhv/60ku8u/QZ8gZbZhffpdg7I3US
                zvUKS8urJ115shIvDdf8bTK2yq1eeesJjLubPpWV8mOkK7pxIzierEkposyw8x/X
                UmQlptDKupnOEUV2YAhwQMtUg6SJorWs08sEJLANmxRKwSM+3zTG9W9kNRaj7sWW
                qeSmIuG5tL2N5JODLa+iL+2kiRD8TghXzp4aEciMNke3uQINBGb6T1ABEACrhMzD
                vAMO1gKp/WUQUVqsXIdGWrnKnSbvaCj4uYGIw5PyoCjYiduDdOcUGl5gUiDR1eoA
                9idxhjEegGk+deY3xeOM2Q32+Cmha/PRdCcjUfrmfZdyOk9MEhefCReAIT7ap3AY
                ItlgMUKjKRSjoZrHDB67N3TN2jtBxI33VinGiS6Dl01hG6WLNpIFvy3MkMyGUs/r
                YiU6YZ817hwByPJlRaBxbe2nHSlwZ8ofQcAdyL11TqM6wbFPTc6PWuD6LNZcVNsF
                EDgTAV5Q36bnkdPNPK0MKXj9mgjLWmQ8Wj/Aoxp1JaUDAtSfYDC6nD03bLj8MntB
                UipyY8JrgvfbWDhBGGZFdwqZlpQvCCn8OJPIT2dUGGSt7zKDYtv+nt5G2qHKG1NI
                FyllqFIbgMCUWfT9YA8TYJIfk6fyoWnGIiw1DedmIjAggpCfiQ6ETSyvRILLYmNY
                smv86/heOqWgO0vFmIEsdblypOCImeujbbuv6oaWqEF7no6tum/H03y6yMdu5ihV
                qqxR+RPgX6GdFeNjJNXc6QAn4Zar6cyxsLB+8FLmVAWCHHFuwK8jlXfM18+33hIm
                2tEy9QhoH5AK0trQFe5qysYU1o+VIBN8BedIE7VI2kA3F/1WWwxt5O2dnGfLXFGY
                vpp0ENKUGL/6c0Ci/Iqx/q34z99nifEqlzDEgQARAQABiQI8BBgBCAAmFiEETxR3
                oBO/bO9rvA02Xil5WhQwXVkFAmb6T1ACGwwFCQWje4AACgkQXil5WhQwXVmA3g//
                W/IR2blouTMQiHTfFzTKsC2rxuljt6ra7DKP75pJ8XkLLtGucF305a/0oP3fItvX
                aEwhnsKZG8ZjbGe+5VOzV/ktaQcHT5bGHCEUpXT9p48XAiDhXWa6DJgQTq0TT1y5
                cnS2JlTF95JBBBLOBxlI9ykVMPbuecLZvUbhXEi8ptkxdAm3nmE4jPVldwauCTAk
                +Mc2LNQBjgJlwDgvyQOUEe7rZkCfLYi+Q0BGJE1hgRGT9P+MJOpKrY4KiQm0ljdy
                uA+RP1LixqFwTfMm6+cdBWXONxQWXvn/+6A7chxIRKLQcfHsouzQf1H1ZFSgJcPx
                PAlirawllbtUa7fYY8ZazmUDNiWDpakVH+P7vPSIoxfZq7Joe2JbVKgHEvc5NWyh
                /OMBM2Bn/x5/tEoicYOpT32xI7hOlWb0m6ay/0JiOlU3pQ3ysmjU2UOGstKAGUJ3
                kkVI8tMNi1wt3sOjHwSeNpTV1iDPLb9EV6/mX6vsm0jGEDVDzXxYvQNe2m5V9mG/
                gbDNDmgSTUE5qQ629At2znAgo8N+GG6TAurN3S+MFba+vK0S3mjckVFIsxJU+ZXl
                9ks7+nwr2E+tgRXguy9np/v3bj0uUTay85pAeulo+BCIZ6tIxWEo7F8oje7UUehW
                81qOdO7pC0W1QurxTuhhNDrmi87YfKfQNmdn10YVbzU=
                =75yb
                -----END PGP PUBLIC KEY BLOCK-----

            </details>
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
            </p>
        </footer>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('faq-link').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah link melakukan navigasi

            Swal.fire({
                title: 'Frequently Asked Questions',
                html: `
                    <h3>Welcome to the forum FAQ!</h3>
                    <p>1. <strong>What is this forum about?</strong><br>This forum is a place to discuss various topics including Entertainment, Education, and more.</p>
                    <p>2. <strong>How do I post?</strong><br>To create a post, click on the 'Create Post' button and fill in the required fields.</p>
                    <p>3. <strong>Can I edit my post?</strong><br>Yes, you can edit your post within a certain time frame.</p>
                    <p>4. <strong>How do I delete my post?</strong><br>You can delete your post by clicking the 'Delete' button available in your post.</p>
                    <p>5. <strong>What is the comment section for?</strong><br>Use the comment section to discuss and share your thoughts on the post.</p>
                `,
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                }
            });
        });
    </script>
    <script>
        // Menonaktifkan semua tautan di dalam navbar
        document.querySelectorAll('.navbar a').forEach(link => {
            link.classList.add('disabled');
        });

        // Fungsi untuk mengaktifkan tautan setelah reCAPTCHA berhasil
        function enableLinks() {
            document.querySelectorAll('.navbar a').forEach(link => {
                link.classList.remove('disabled');
            });
        }

        // Panggil fungsi enableLinks jika reCAPTCHA berhasil
        function onCaptchaSuccess() {
            enableLinks();
        }
    </script>
    <script>
        // Menonaktifkan tautan kategori
        const links = document.querySelectorAll('.board-link');
        links.forEach(link => {
            link.style.pointerEvents = 'none'; // Menonaktifkan interaksi
            link.style.color = 'gray'; // Menandai tautan sebagai non-aktif
        });

        function enableLinks() {
            links.forEach(link => {
                link.style.pointerEvents = 'auto'; // Mengaktifkan interaksi
                link.style.color = '#800000'; // Mengembalikan warna tautan
            });
        }

        function onSubmit(e) {
            e.preventDefault(); // Mencegah pengiriman form secara default
            const recaptchaResponse = grecaptcha.getResponse();

            if (recaptchaResponse.length === 0) {
                alert("Silakan centang 'I'm not a robot' untuk melanjutkan.");
            } else {
                // Kirim permintaan untuk memverifikasi reCAPTCHA
                fetch('your-verification-endpoint.php', { // Ganti dengan endpoint verifikasi Anda
                        method: 'POST',
                        body: new URLSearchParams({
                            'g-recaptcha-response': recaptchaResponse
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Jika verifikasi berhasil, aktifkan tautan
                            enableLinks();
                            Swal.fire("Verifikasi Berhasil!", "Anda sekarang dapat mengakses semua kategori.", "success");
                        } else {
                            Swal.fire("Verifikasi Gagal!", "Silakan coba lagi.", "error");
                        }
                    });
            }
        }

        // Mengaitkan fungsi submit form
        document.querySelector('form').addEventListener('submit', onSubmit);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blur.js/1.0.0/blur.min.js"></script>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit"></script>
    <script>
        // if using synchronous loading, will be called once the DOM is ready
        turnstile.ready(function() {
            turnstile.render("#example-container", {
                sitekey: "<YOUR_SITE_KEY>",
                callback: function(token) {
                    console.log(`Challenge Success ${token}`);
                },
            });
        });
    </script>



</body>

</html>