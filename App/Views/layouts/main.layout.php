<!doctype html>
<html lang="en">

<head>
    <title><?php echo $params['title'] ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="icon" href="../../../Public/img/web/logo-icon.png" style="border-radius: 6px;" type="image/png"> <!-- Change the href to the path of your icon -->
    <style>
        .logo-video {
            width: 140px;
            /* Ajusta esto al tamaño que desees */
            height: 120px;
            top: -15px;
            bottom: -15px;
            max-width: 200px;
            max-height: 60px;
            left: -15px;
            /* Ajusta esto al tamaño que desees */

            overflow: hidden;
            object-position: center;
        }

        .logo-video video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .nav-link:not(.active) img {
            opacity: 0.5;
        }


        .nav-link.active {
            color: #9400D3 !important;
        }

        .nav-link:not(.active):hover img {
            opacity: 1;
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