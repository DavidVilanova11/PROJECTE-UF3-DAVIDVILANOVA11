<?php

$_SESSION['actual_page'] = "stock";

if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
    header("Location: /usuari/index");
}

include_once(__DIR__ . "/../templates/navbar.php");

// Incluir la clase que contiene el método 'get'
require_once(__DIR__ . "/../../Core/Store.php");

?>

<div class="container mt-5">
    <div class="d-flex flex-wrap">

    <?php foreach ($params['llista-host'] as $index => $host) : ?>
            <div class="card mx-3 my-3" style="width: 16rem; height: 26rem;">
                <div class="img-container">
                    <img class="custom-image" src="../../../Public/img/hosts/<?php echo $host['img'] ?>" alt="...">
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $host['especie']; ?></p>
                    <!-- Buy Button -->
                    <div class="buy-group" style="position: absolute; bottom: 1em; left: 1em; right: 0;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Comprar</button>
                        </div>
                        <small class="text-muted text-right"><?php echo number_format($host['preu'], 2, '.', ',') . "$" ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php foreach ($params['llista-adn'] as $index => $adn) : ?>
            <div class="card mx-3 my-3" style="width: 16rem; height: 28rem;">
                <div class="img-container">
                    <img class="custom-image" src="../../../Public/img/adn/<?php echo $adn['img'] ?>" alt="...">
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $adn['nom']; ?></p>
                    <!-- Buy Button -->
                    <div class="buy-group" style="position: absolute; bottom: 1em; left: 1em; right: 0;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Comprar</button>
                        </div>
                        <small class="text-muted text-right"><?php echo number_format($adn['preu'], 2, '.', ',') . "$" ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        </div>
</div>