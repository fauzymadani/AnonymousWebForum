<?php
session_start(); // Memulai session
include 'includes/header.php';

// Mengecek apakah user sudah login dan user adalah admin
// if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
//     echo "<div class='announcement'>
//             <h1>Admin Announcement</h1>
//             <p>This is a special announcement for all users!</p>
//           </div>";
// } else {
//     echo "<p>Read our Rule First!</p>";
// }

// Session timeout - Tambahkan ini di bagian atas
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset(); // Hapus semua session
    session_destroy(); // Hancurkan session
    header('Location: login.php'); // Redirect ke halaman login
    exit;
}
$_SESSION['last_activity'] = time(); // Update waktu terakhir aktivitas

include 'includes/footer.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Post</title>
    <link rel="shortcut icon" href="./favicon/favicon.ico" type="image/x-icon">
    <style>
        body {
            background-color: black;
        }

        h1 {
            color: yellow;
        }

        p {
            color: white;
        }

        * {
            font-family: Poppins;
        }

        span img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 15%;
        }

        .container {
            display: flex;
            padding: 10px;
        }

        .left-container {
            align-items: left;
            justify-content: start;
            margin-right: 20px;
            border: 2px solid #3498db;
            /* Ganti dengan warna border yang kamu inginkan */
            padding: 20px;
            border-radius: 10px;
            /* Opsional, untuk membuat sudut border melengkung */
            background-color: #0d2442;
            /* Opsional, untuk memberikan warna latar */
        }


        .right-container {
            padding-left: 20px;
            align-items: right;
            justify-content: start;
            margin-right: 20px;
            border: 2px solid #3498db;
            /* Ganti dengan warna border yang kamu inginkan */
            padding: 20px;
            border-radius: 10px;
            /* Opsional, untuk membuat sudut border melengkung */
            background-color: #0d2442;
            /* Opsional, untuk memberikan warna latar */
        }

        .right-content {
            align-items: center;
        }

        .blog-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .image-left {
            width: 150px;
            height: auto;
            margin-right: 20px;
        }

        .description h1 {
            font-size: 1.5em;
            margin: 0;
        }

        .description p {
            font-size: 1em;
        }

        details {
            font-family: monospace;
            color: red;
        }

        a {
            color: yellow;
        }

        button {
            background-color: brown;
            border-radius: 15px;
        }

        .blog-container {
            border: 2px solid yellow;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-container">
            <h1 class="boards" style="text-align: center;">Boards</h1>
            <span align="center"><img align="center" src="./favicon/android-chrome-192x192.png" alt="image" style="width: 120px;"></span>
            <h1 align="center">Welcome to Our Forum</h1>
            <p>Explore various topics and share your thoughts!, create a new post to explore our category. this site is <strong>under development,</strong>
                <a href="rule.html">read our rule</a>
            </p>

            <!-- Tautan untuk membuat postingan baru -->
            <button><a href="create_post.php">Create New Post</a></button>
            <article>
                <ul>
                    <li><a href="category.php?category=Entertainment">entertaiment</a></li>
                    <li><a href="category.php?category=Education">education</a></li>
                    <li><a href="category.php?category=Misc.">Misc</a></li>
                    <li><a href="category.php?category=Around%20the%20world">Around the world</a></li>
                    <!-- Tambahkan kategori lainnya sesuai screenshot -->
                </ul>
            </article>
            <?php include 'includes/footer.php'; ?>
            <p>donate bitcoin to this location: <a style="font-family: monospace;">bc1q0cg7xarp8dxf24kerrmzws9zjk2qrh08exc7l7</a></p>
            <footer>
                <p>help improves this page? <a href="pgpkeyadmin.asc" download>contact admin</a></p>
            </footer>
            <footer>
                <p>help improving this page by contacting <a href="#">okmnjijn@protonmail.com</a> and sending encrypted message to this public key: </p>


                <details>-----BEGIN PGP PUBLIC KEY BLOCK-----

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

            </footer>
        </div>
        <div class="right-container" align="right">
            <div class="right-content">
                <h1 align="center">Blog</h1>

                <!-- Blog 1 -->
                <div class="blog-1">
                    <div class="blog-container">
                        <p><img src="./favicon/arche.jpeg" alt="Blog Image 1" class="image-left"></p>
                        <div class="description" align="left">
                            <h1><a href="girl.php">Archetyp Dark Market</a></h1>
                            <p>a history about the biggest drug market that still operate todays.</p>
                        </div>
                    </div>
                </div>

                <!-- Blog 2 -->
                <div class="blog-2">
                    <div class="blog-container">
                        <p><img src="https://upload.wikimedia.org/wikipedia/en/thumb/4/42/Silk_Road_Marketplace_Item_Screen.jpg/300px-Silk_Road_Marketplace_Item_Screen.jpg" alt="Blog Image 2" class="image-left" style="width: 200px;"></p>
                        <div class="description" align="left">
                            <h1><a href="communicate.php">how Silk road was the First and the largest modern dark market back in the days</a></h1>
                            <p>Silk Road was an online black market and the first modern darknet market.[7]</p>
                        </div>
                    </div>
                </div>

                <!-- blog 3 -->
                <div class="blog-2">
                    <div class="blog-container">
                        <p><img src="./favicon/android-chrome-192x192.png" alt="Blog Image 2" class="image-left" style="width: 200px;"></p>
                        <div class="description" align="left">
                            <h1><a href="howtomakepost.php">How to make post in Anonymous Forum</a></h1>
                            <p>if you're new in this Forum, you'll need to see this!!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>