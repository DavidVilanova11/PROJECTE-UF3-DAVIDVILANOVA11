<!doctype html>
<html lang="en">

<head>
    <title><?php echo $params['title'] ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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

        .img-container {
            display: flex;
            align-items: center;
            height: 250px;
            overflow: hidden;
        }

        .custom-image {
            max-width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .custom-video {
            width: 100%;
            max-width: 100%;
            height: auto;
        }

        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card .card-body .accordion {
            max-height: calc(100% - 50px);
            /* Ajusta la altura máxima según tus necesidades */
            overflow-y: auto;
        }

        .card .card-body .accordion .card-body {
            padding: 15px;
            /* Ajusta el espaciado interno según tus necesidades */
        }

        .nav-link:not(.active) img {
            opacity: 0.5;
        }

        .nav-link:not(.active):hover img {
            opacity: 1;
        }


        .nav-link.active {
            color: #9400D3 !important;
        }

        .requadre-fix {
            position: fixed;
            top: 80px;
            /* Ajusta la distancia desde la parte superior según tu preferencia */
            right: 20px;
            /* Ajusta la distancia desde el borde derecho según tu preferencia */
            padding: 10px;
            background-color: rgba(0, 128, 0, 0.2);
            /* Verde con menos opacidad */
            border: 2px solid #008000;
            /* Borde verde */
            border-radius: 5px;
        }

        .text {
            font-size: 16px;
            color: #008000;
            /* Color del text verde */
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script>
        let selectedHostId = null;
        let hostConfirmed = false;

        // Función para cambiar los estilos al seleccionar un elemento
        function selectElement(element) {
            // Reiniciar estilos solo si no se ha confirmado el host
            if (!hostConfirmed) {
                document.querySelectorAll('.card').forEach(item => {
                    item.style.border = '';
                    item.style.filter = 'none';
                });
            }

            // Establecer estilos para el elemento seleccionado
            element.style.border = '2px solid';
            element.style.borderColor = (element.dataset.tipo === 'adn') ? 'blue' : 'purple';
            element.style.filter = 'brightness(80%)';
            selectedHostId = (element.dataset.tipo === 'host') ? element.dataset.id : selectedHostId;
        }

        // Event listeners para seleccionar elementos
        document.querySelectorAll('.card').forEach(item => {
            item.addEventListener('click', () => {
                if (!hostConfirmed && item.dataset.tipo === 'host') {
                    selectElement(item);
                    document.getElementById('confirmHostBtn').style.display = 'block';
                } else if (hostConfirmed && item.dataset.tipo === 'adn') {
                    selectElement(item);
                    document.getElementById('fusionBtn').style.display = 'block';
                }
            });
        });

        // Event listener para el botón de confirmar selección de host
        document.getElementById('confirmHostBtn').addEventListener('click', () => {
            document.getElementById('confirmHostBtn').style.display = 'none';
            hostConfirmed = true;
            document.querySelector('h1').textContent = `SELECCIONA UN ADN`;
        });

        // Event listener para el botón de fusionar
        document.getElementById('fusionBtn').addEventListener('click', () => {
            document.getElementById('fusionBtn').style.display = 'none';
            document.querySelector('.container').innerHTML += `<input type="hidden" name="selectedHostId" value="${selectedHostId}">`;
        });
    </script>

</body>


</html>