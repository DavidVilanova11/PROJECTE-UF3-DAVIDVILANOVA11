<?php

$_SESSION['actual_page'] = "stock";

if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
    header("Location: /usuari/index");
}

include_once(__DIR__ . "/../templates/navbar.php");

// Incluir la clase que contiene el método 'get'
require_once(__DIR__ . "/../../Core/Store.php");


// echo '<pre>';
// var_dump($params['llista']);
// echo '</pre>';

// die();


?>



<div class="container mt-5">
    <div class="d-flex flex-wrap">
        <!-- posició 0 del array = adn i posició 1 del array = hosts -->
        <?php foreach ($params['llista'] as $tipo => $stocks) : ?>
            <?php if (!empty($stocks)) : ?>
                <?php foreach ($stocks as $stock) : ?>
                    <?php //echo '<pre>';
                    // var_dump($tipo);
                    // echo '</pre>';
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL); ?>

                    <?php if ($stock !== null && ((isset($stock['nom']) && $tipo === 'adn') || (isset($stock['especie']) && $tipo === 'host'))) : ?>
                        <div class="card mx-3 my-3" style="width: 16rem; height: 28rem;">
                            <div class="img-container">
                                <img class="custom-image" src="../../../Public/img/<?php echo $tipo === 'adn' ? 'adn' : 'hosts'; ?>/<?php echo $stock['img']; ?>" alt="...">
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo trim($tipo === 'adn' ? $stock['nom'] : $stock['especie']); ?></p>
                                <?php if (isset($stock['quantity'])) : ?>
                                    <p class="card-text"><?php echo "X" . $stock['quantity']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>








    </div>
</div>







</div>
</div>