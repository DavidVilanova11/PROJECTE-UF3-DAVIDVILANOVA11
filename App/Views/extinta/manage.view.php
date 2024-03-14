<?php

$_SESSION['actual_page'] = "extinta";

if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
    header("Location: /usuari/index");
}

include_once(__DIR__ . "/../templates/navbar.php");

// Incluir la clase que contiene el método 'get'
require_once(__DIR__ . "/../../Core/Store.php");

?>

<div class="container mt-5">
    <div class="d-flex flex-wrap">

        <?php foreach ($params['llista'] as $index => $extinta) : ?>
            <div class="card mx-3 my-3" style="width: 16rem; height: 28rem;">
                <div class="img-container">
                    <img class="custom-image" src="../../../Public/img/extintes/<?php echo $extinta['img'] ?>" alt="...">
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $extinta['nom']; ?></p>
                    <p class="card-text"><?php echo $extinta['id_adn']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="requadre-fix">
            <p class="text">Pressupost: &emsp; <?= number_format($_SESSION['user_logged']['pressupost'], 2, '.', ',') . "$" ?></p>
            <p class="text">Hosts obtinguts: ...</p>
            <p class="text">Adn obtinguts: ...</p>
        </div>

    </div>
</div>