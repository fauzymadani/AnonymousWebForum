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

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Anon Forum</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="./favicon/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .navbar a, .announcement a {
            color: yellow;
        }

        .create-new-post {
            background-color: #800000;
            margin-bottom: 20px;
            color: whitesmoke;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Anon Forum</h1>

        <div class="announcement">
            <p>Read our <a href="rule.html">Rules</a> and <a href="#" id="faq-link">FAQ</a> before participating!</p>
            <div class="navbar">
                <a href="index.php">Home</a>
                <a href="blog.php">Blog</a>
                <a href="#" id="faq-link">FAQ</a>
                <!-- Tambahkan link lain sesuai kebutuhan -->
            </div>
        </div>

        <div class="boards-container">
            <div class="boards-title">Boards</div><a href="create_post.php"><button class="create-new-post">create new post</button></a>
            <div class="boards-columns">
                <div class="board-column">
                    <a href="category.php?category=Entertainment">Entertaiment</a>
                    <a href="category.php?category=Education">Education</a>
                    <a href="category.php?category=Misc.">Misc</a>
                    <a href="category.php?category=Mecha">Mecha</a>
                    <a href="category.php?category=Around%20the%20world">Around the world</a>
                </div>
                <div class="board-column">
                    <a href="category.php?category=Comics">Comics & Cartoons</a>
                    <a href="category.php?category=Technology">Technology</a>
                    <a href="category.php?category=Weapons">Weapons</a>
                    <a href="category.php?category=Auto">Auto</a>
                    <a href="category.php?category=Sports">Sports</a>
                </div>
                <div class="board-column">
                    <a href="category.php?category=Photography">Photography</a>
                    <a href="category.php?category=Music">Music</a>
                    <a href="category.php?category=Fashion">Fashion</a>
                    <a href="category.php?category=GraphicDesign">Graphic Design</a>
                    <a href="category.php?category=DIY">Do-It-Yourself</a>
                </div>
                <div class="board-column">
                    <a href="category.php?category=Business">Business & Finance</a>
                    <a href="category.php?category=Travel">Travel</a>
                    <a href="category.php?category=Paranormal">Paranormal</a>
                    <a href="category.php?category=Random">Random</a>
                    <a href="category.php?category=OperatingSystem">OperatingSystem</a>
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
            </p>
        </footer>
    </div>
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
</body>

</html>