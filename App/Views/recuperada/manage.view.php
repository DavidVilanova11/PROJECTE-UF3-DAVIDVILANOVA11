<?php

$_SESSION['actual_page'] = "manage";

if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
    header("Location: /usuari/index");
}

include_once(__DIR__ . "/../templates/navbar.php");

// Incluir la clase que contiene el método 'get'
require_once(__DIR__ . "/../../Core/Store.php");

?>

<div class="container mt-5">
    <div class="d-flex flex-wrap">

        <?php foreach ($_SESSION['recuperades'] as $index => $recuperada) : ?>
            <div class="card mx-3 my-3" style="width: 18rem;">
                <img class="custom-image" src="../../../Public/img/recuperades/<?php echo $recuperada['familia_recuperada'] . "/" . $recuperada['imatge_recuperada'] ?>" alt="...">
                <div class="card-body">
                    <p class="card-text"><?php echo $recuperada['nom_recuperada']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>