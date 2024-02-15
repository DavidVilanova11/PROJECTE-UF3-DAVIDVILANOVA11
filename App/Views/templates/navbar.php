<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;"> <a class="navbar-brand" href="#">
        <div class="logo-video">
            <video autoplay muted playsinline>
                <source src="/Public/Assetsvideos/WebOriginals/Digital_Bird_Logo.mp4" type="video/mp4">
            </video>
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "home") {
                                        echo "active";
                                    } ?>" href="/home/index">Inici</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "create") {
                                        echo "active";
                                    } ?>" href="/entrenador/index">Gestionar Entrenadors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "manage") {
                                        echo "active";
                                    } ?>" href="/ocell/manage">Gestionar Aus</a> <!-- Aquí he de posar la ruta del controlador i la funció (no té sentit posar uf ja que sempre dependrem de un mp) -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view_tasks.php">Veure Entrenaments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/entrenador/logout">Sortir</a>
                <!-- <a class="nav-link" href="logout.php">Sortir</a> -->
            </li>
        </ul>
    </div>
</nav>