<?php include 'includes/header.php'; ?>
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
            <footer><p>help improves this page? <a href="pgpkeyadmin.asc" download>contact admin</a></p></footer>
            <footer><p>help improving this page by contacting <a href="#">okmnjijn@protonmail.com</a> and sending encrypted message to this public key: </p>


                <details>-----BEGIN PGP PUBLIC KEY BLOCK----- <br>

                    mQINBGbuGycBEACdLiale6UEgrYdUxW60AtkZvkisz9wReeD+x5dm9K/ghFymAOd
                    GMri8NebblUiktw/Cwx29JXZ80lG2PBzkb2NNgXuRKqYP+X2Wahou2Z/4lDxL8tS
                    27T3FQ4AkQz1g6AUiTZe0M3YIIQmo8nktm3rJYwmXokVJ5Hb7ZUcjB5Sim8Y2JZE
                    n/WC3b6oQ4Q7VjEyonkxYzt+LaYbebO4RgTAQOKaqx5PeJVCeVADKVnuSaithU4K
                    sQnq476vITsVs15ckozj6ivKVXhJpBiZ2ijr1d+1lTPEx5TeE62nPmWkevQ2vjbd
                    /aKEM3P+KQ92IenIBSvlDnipouy8RTyuvPthcHb4545zHPVaWjz9ycERUUtzucGI
                    +pE24C749q2JD8BCIGCoAmz/vknc1PBa/Xv6ofHzK5heSUW204YVHqSJOPdxP5XF
                    cq8dEPH0LzwW5XVa4mQ4wyDeGRC4tGqOu5BMOESCPCnZi51I0f8WTHcda6xwJFGx
                    c/w+tQD0VHhH19wLCSiWLU//Axl0US+18rJpV6UoqHXS1idt6giKz6KdybFpFc/c
                    d2YkJbwghwS8tNUfm05XdfFRwJgbLVcEUUh3jzAGzSTuen+eSGz0wb2gPot2+QnJ
                    t1jvvkaIIs1vlWo8rH3dpvJZqJ25eQxBS7ExVoPmtnx1kwmNbI6GzRZPowARAQAB
                    tCdmYXV6eSA8a2VwZXJsdWFuc2Vrb2xhaGZhdXp5QGdtYWlsLmNvbT6JAk4EEwEK
                    ADgWIQRkVId2E/IXgCkW4fgvSnILCki/PAUCZu4bJwIbAwULCQgHAgYVCgkICwIE
                    FgIDAQIeAQIXgAAKCRAvSnILCki/PImaD/9/jf11cytmMg6hn7628uJXoaLRrM/+
                    ZPFgSZ7PP/z23bMFeHe1LwbTIsW6B206y+Aet7JKJo63iQVKTjM6ay71u4RTCUpQ
                    dgCJescKmT1bs08nFgNZ4ApisWLJrhCmaSUX4+nZCTxQPNL1MaMs2AZSl/w1sVPc
                    8/SxohPrmQWeKGYdrTCqOOSMSHmCLf85Fs04VZd18TbFvPiUaghqOtbCDsnSt09l
                    sj/BgAuWfQCRYJaJN3q+wLr4X105ram062IGs6UCDXz2G9lHEkt6Q/itzpp1bDNC
                    VInWOw/CI0aOe+yvYBxn8tElQ6+3xSzr6WPpPyVNGv9OP9qQGxM6riD4McEuNGHo
                    tARuFchCom5+hddp7PPDiaBZAPB4/IjHSsZl/2wGmmqAUghuGnWb5fiFx6mcPu4C
                    xxVQLoGgU4irqnS5UBruh17bn9XMtiuVPYBiY44HRpdwvVzaGTOUFsghDFMT2c1L
                    XpN0m0YYkzugeQRnrTy8ifXHmX1GYxS/Lz/iFMinoLfhwQ1yGXQx2KijmPl/oRcU
                    +a/4LQIVpMPZzAhcYz5Qx44JovNJEogLRoo3vzxB/OuPD35xSUACmzpQPUkEKt6E
                    fPZaysUMMX/yU8arAdABO/+syUULe3YX6t2NVq99gmozDaFNtL+YpPVNCjpQlof6
                    EE8YYHK1t82MmrkCDQRm7hsnARAAvJFx09TVM3cWJRi9tQTt8pxZWxhZkNR7DNwr
                    zmQRs0cKUcQ8F8iH1PQKYuOpQda02GQ846rK9GfZllOQx/kr5rABamMPDMAf32m2
                    7WGhBT9vDzKb6DJsMHm6TPxjB99VwTyzKdJ4qLeES5i8BZLwU9nDnGoL8m8A3523
                    peXcXYEzUjg+iOC7cE62Yncy3S2vBYqD5iou3UXssMdTMcVaR90kh3xS5SV+UteC
                    3B3fCEl44R+MlYG8TeVHamDJ76dlr0SiPX+aOHn3AirVA44i7hz2xXb1NmxQffHf
                    q/u+Lb+daZSLMEiJCKamaqw1yLYkHNzRNf0Qlipyf9sEjX9U5CVLUas/VKmXH6mM
                    rCIri75e5m+79XQPKLhIsNs6UIzxSeXfgGrheNBxv9FCr21EG5iPcmErRj2YU6RE
                    ocxvPT3+09n8OXgUr93ZzKRjY8Xv/WEXrD+A3g7DWUe5yHbOCWmnuB/qLmXdanyC
                    y7YGsLwwexJePfzbPk1++0ZTxzeGCzqDwCRJ15ADCBcZ1WrMrdSVpP+5ePBr59lA
                    mr11BQ4Gx0Qbtwm0T/b9h30neuk6qKzMZT/bb4LZW8Q8rxtJGnZbLll3errXaoOy
                    kL5ATcbilCKV1aRtwF+4PxlLzSGKYx96sX+es31uHIn8g4sk1ss9WCbKBRZry7WK
                    eFuNY6MAEQEAAYkCNgQYAQoAIBYhBGRUh3YT8heAKRbh+C9KcgsKSL88BQJm7hsn
                    AhsMAAoJEC9KcgsKSL88x+IQAI4GgE2a99wnC8H5BCBBa/rcNpVQk5oM5IgrvIh5
                    H22a7YFjRfEDeHOcT7cpQPWux7srd5YBfOoUBYRDkDEDRAMmgLhO4+a889uqkIRK
                    /T4b4Ta3giY8xkCqNSXCdRralGQEKgcLfvAQLwe2hOb8tq++/eZDB5fazx7ao82U
                    uVHEh1n1jFHjza7HYYH06rtUl3sbSCDI2rY8kgllVM8/z6TemBV1CqD9Jf2Ou5Bv
                    /0vdLNMHgIf6RhIPh+gg/J6q8zgewF3LuOM6KGurR6IQcUWn+3dlB6jCnJwuNL78
                    FYqsuEvDuuCLv3rGO+8CvdCy8Kmz9ZsZ2h0ekbRIZUKNJU72id93bHie3o6CkLg1
                    3ZfAn+ac/lr21P49SpMpT5lamnWSJL4dYwzQQ9jJU1FMgOV0wZ4w44gXRJLOX+Dc
                    Y2eGTEDAetAOaM5gf7vJyPwPDwp3GfPRzvmZPAzCAhMgJnNL3LEfxnYe9K2mfzOS
                    bH/axlFQjBvYHRBpn59wmRPf1TEi/2Ww71/JcN8wVfL1Ww1eptutOM/zE8R/uVmN
                    9Z8EbpU8QVH3aQdU9NpyyEvoSImm582Xh4DZuM8LTGNzvYZzsB1EmVsqoZ0ho2XG
                    veQHRAp8ar1gzhM1fdNjm+BSK0aB/zWOBuaSFKNGJSu+83xIqFj5PsyEhnmGJP/j<br>
                    8MGs
                    =DYR6<br>
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
                        <p><img src="./favicon/howto.jpeg" alt="Blog Image 1" class="image-left"></p>
                        <div class="description" align="left">
                            <h1><a href="girl.php">How to Get a Girlfriend</a></h1>
                            <p>Learn effective ways to build meaningful relationships and find a girlfriend. This blog offers tips and guidance on how to navigate the dating world.</p>
                        </div>
                    </div>
                </div>

                <!-- Blog 2 -->
                <div class="blog-2">
                    <div class="blog-container">
                        <p><img src="./favicon/memedarkweb.jpeg" alt="Blog Image 2" class="image-left" style="width: 200px;"></p>
                        <div class="description" align="left">
                            <h1><a href="communicate.php">how to Improve Communication Skills</a></h1>
                            <p>Develop better communication skills for personal and professional relationships. This blog covers various techniques for improving how you interact with others.</p>
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