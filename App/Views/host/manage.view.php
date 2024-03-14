<?php

$_SESSION['actual_page'] = "host";

if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
    header("Location: /usuari/index");
}

include_once(__DIR__ . "/../templates/navbar.php");

// Incluir la clase que contiene el método 'get'
require_once(__DIR__ . "/../../Core/Store.php");

?>

<div class="container mt-5">
    <div class="d-flex flex-wrap">

        <?php foreach ($params['llista'] as $index => $host) : ?>
            <div class="card mx-3 my-3" style="width: 16rem; height: 26rem;">
                <div class="img-container">
                    <img class="custom-image" src="../../../Public/img/hosts/<?php echo $host['img'] ?>" alt="...">
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $host['especie']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>