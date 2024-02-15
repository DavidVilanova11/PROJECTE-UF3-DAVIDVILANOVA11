<!doctype html>
<html lang="en">

<head>
    <title><?php echo $params['title'] ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        body {
            background: url(/Public/Assetsimatges/WebOriginals/home_wallapaer_4k.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .logo-video {
            width: 200px;
            /* Ajusta esto al tamaño que desees */
            height: 100px;
            top: -15px;
            bottom: -15px;
            max-width: 200px;
            max-height: 100px;
            left: -15px;
            /* Ajusta esto al tamaño que desees */

            overflow: hidden;
            object-position: center;
        }

        .logo-video video {
            width: 100%;
            height: 85%;
            object-fit: cover;
        }

        .container {
            margin-left: 2vw;
            margin-top: 1vh;
        }
    </style>
</head>

<body>
    <header>
        <!-- place navbar here -->
        <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </header>
    <main>
        <?php echo $params['content'] ?>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>