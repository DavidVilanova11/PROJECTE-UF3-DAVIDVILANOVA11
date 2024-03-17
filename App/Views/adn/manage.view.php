<?php

$_SESSION['actual_page'] = "adn";

if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
    header("Location: /usuari/index");
}

include_once(__DIR__ . "/../templates/navbar.php");

// Incluir la clase que contiene el método 'get'
require_once(__DIR__ . "/../../Core/Store.php");

?>

<?php

if (isset($params['flash']['ok'])) {
    echo "<div class='alert alert-success my-3 mx-3' style='display: inline; role='alert'>";
    echo $params['flash']['ok'];
    echo "</div>";
    unset($params['flash']['ok']);
}

if (isset($params['flash']['ko'])) {
    echo "<div class='alert alert-danger my-3 mx-3' style='display: inline;' role='alert'>";
    echo $params['flash']['ko'];
    echo "</div>";
    unset($params['flash']['ko']);
}

?>

<div class="container mt-5">
    <div class="d-flex flex-wrap">

        <?php foreach ($params['llista'] as $index => $adn) : ?>
            <div class="card mx-3 my-3" style="width: 16rem; height: 28rem;">
                <div class="img-container">
                    <img class="custom-image" src="../../../Public/img/adn/<?php echo $adn['img'] ?>" alt="...">
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $adn['nom']; ?></p>
                    <!-- Buy Button -->
                    <div class="buy-group" style="position: absolute; bottom: 1em; left: 1em; right: 0;">
                        <div class="btn-group">
                            <!-- Enlace con etiqueta a -->
                            <a href="/adn/comprar/?id=<?= $adn['id'] ?>" class="btn btn-sm btn-outline-secondary">Comprar</a>
                        </div>
                        <small class="text-muted text-right"><?php echo number_format($adn['preu'], 2, '.', ',') . "$" ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


        <div class="requadre-fix">
            <p class="text">Pressupost: &emsp; <?= number_format($_SESSION['user_logged']['pressupost'], 2, '.', ',') . "$" ?></p>
            <p class="text">Hosts obtinguts:</p>
            <ul>
                <?php foreach ($params['llista-stock']['host'] as $stock) : ?>
                    <?php if ($stock !== null && isset($stock['especie']) && isset($stock['quantity'])) : ?>
                        <li><?php echo $stock['especie'] . ": " . $stock['quantity']; ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <p class="text">Adn obtinguts:</p>
            <ul>
                <?php foreach ($params['llista-stock']['adn'] as $stock) : ?>
                    <?php if ($stock !== null && isset($stock['nom']) && isset($stock['quantity'])) : ?>
                        <li><?php echo $stock['nom'] . ": " . $stock['quantity']; ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
        </div>


    </div>
</div>