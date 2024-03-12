<nav class="navbar navbar-expand-lg" style="background-color: white;"> <a class="navbar-brand" href="#">
        <div class="logo-video">
            <video autoplay muted playsinline>
                <source src="/Public/img/web/DES-EXTINCIÓ (2).mp4" type="video/mp4">
            </video>
        </div>
    </a>
    <button class="navbar-toggler m-2" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "home") {
                                        echo "active";
                                    } ?>" href="/home/index">Inici</a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "create") {
                                        echo "active";
                                    } ?>" href="/usuari/index">Gestionar Usuaris<img src="../../../Public/img/web/icons/user-solid.svg" alt="My Happy SVG" width="15px" style="margin-left: 10px; margin-bottom: 5px;" /></a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "manage") {
                                        echo "active";
                                    } ?>" href="/recuperada/manage">Gestionar Recuperades<img src="../../../Public/img/web/icons/dragon-solid.svg" alt="My Happy SVG" width="25px" style="margin-left: 10px; margin-bottom: 5px;" /></a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link" href="/extincta/view">Veure Extintes<img src="../../../Public/img/web/icons/book-solid.svg" alt="My Happy SVG" width="15px" style="margin-left: 10px; margin-bottom: 5px;" /></a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link" href="/extincta/view">Veure Hosts<img src="../../../Public/img/web/icons/cow-solid.svg" alt="My Happy SVG" width="25px" style="margin-left: 10px; margin-bottom: 5px;" /></a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link" href="/extincta/view">Veure Adn<img src="../../../Public/img/web/icons/dna-solid.svg" alt="My Happy SVG" width="15px" style="margin-left: 10px; margin-bottom: 5px;" /></a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link" href="/usuari/logout">Sortir</a>
                <!-- <a class="nav-link" href="logout.php">Sortir</a> -->
            </li>
        </ul>
    </div>
</nav>