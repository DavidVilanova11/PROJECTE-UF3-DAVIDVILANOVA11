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
                                    } ?>" href="/home/index">Inici
                    <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "home") {
                        // Si el enlace está activo, muestra el SVG morado
                        echo '<img src="../../../Public/img/web/icons/house-solid-purple.svg" alt="My Happy SVG" width="20px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } else {
                        // Si el enlace no está activo, muestra el SVG original
                        echo '<img src="../../../Public/img/web/icons/house-solid.svg" alt="My Happy SVG" width="20px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } ?>
                </a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "create") {
                                        echo "active";
                                    } ?>" href="/usuari/index">Gestionar Usuaris
                    <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "create") {
                        echo '<img src="../../../Public/img/web/icons/user-solid-purple.svg" alt="My Happy SVG" width="15px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } else {
                        echo '<img src="../../../Public/img/web/icons/user-solid.svg" alt="My Happy SVG" width="15px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } ?>
                </a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "manage") {
                                        echo "active";
                                    } ?>" href="/recuperada/manage">Gestionar Recuperades
                    <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "manage") {
                        echo '<img src="../../../Public/img/web/icons/dragon-solid-purple.svg" alt="My Happy SVG" width="25px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } else {
                        echo '<img src="../../../Public/img/web/icons/dragon-solid.svg" alt="My Happy SVG" width="25px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } ?>
                </a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "extinta") {
                                        echo "active";
                                    } ?>" href="/extinta/manage">Veure Extintes
                    <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "extinta") {
                        echo '<img src="../../../Public/img/web/icons/book-solid-purple.svg" alt="My Happy SVG" width="17px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } else {
                        echo '<img src="../../../Public/img/web/icons/book-solid.svg" alt="My Happy SVG" width="17px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } ?>
                </a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "host") {
                                        echo "active";
                                    } ?>" href="/host/manage">Veure Hosts
                    <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "host") {
                        echo '<img src="../../../Public/img/web/icons/cow-solid-purple.svg" alt="My Happy SVG" width="28px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } else {
                        echo '<img src="../../../Public/img/web/icons/cow-solid.svg" alt="My Happy SVG" width="28px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } ?>
                </a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "adn") {
                                        echo "active";
                                    } ?>" href="/adn/manage">Veure Adn
                    <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "adn") {
                        echo '<img src="../../../Public/img/web/icons/dna-solid-purple.svg" alt="My Happy SVG" width="15px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } else {
                        echo '<img src="../../../Public/img/web/icons/dna-solid.svg" alt="My Happy SVG" width="15px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } ?>
                </a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "stock") {
                                        echo "active";
                                    } ?>" href="/stock/manage">Stock
                    <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "stock") {
                        echo '<img src="../../../Public/img/web/icons/warehouse-solid-purple.svg" alt="My Happy SVG" width="20px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } else {
                        echo '<img src="../../../Public/img/web/icons/warehouse-solid.svg" alt="My Happy SVG" width="20px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } ?>
                </a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "purchase") {
                                        echo "active";
                                    } ?>" href="/compra/index">Compres
                    <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "purchase") {
                        echo '<img src="../../../Public/img/web/icons/tag-solid-purple.svg" alt="My Happy SVG" width="20px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } else {
                        echo '<img src="../../../Public/img/web/icons/tag-solid.svg" alt="My Happy SVG" width="20px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } ?>
                </a>
            </li>
            <li class="nav-item" style="margin-left: 15px;">
                <a class="nav-link <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "logout") {
                                        echo "active";
                                    } ?>" href="/usuari/logout">Sortir
                    <?php if (isset($_SESSION['actual_page']) && $_SESSION['actual_page'] == "logout") {
                        echo '<img src="../../../Public/img/web/icons/arrow-right-to-bracket-solid-purple.svg" alt="My Happy SVG" width="20px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } else {
                        echo '<img src="../../../Public/img/web/icons/arrow-right-to-bracket-solid.svg" alt="My Happy SVG" width="20px" style="margin-left: 5px; margin-bottom: 5px;" />';
                    } ?>
                </a>
            </li>
        </ul>
    </div>
</nav>