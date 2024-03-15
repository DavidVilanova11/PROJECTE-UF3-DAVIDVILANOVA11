<?php

$_SESSION['actual_page'] = "stock";

if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
    header("Location: /usuari/index");
}

include_once(__DIR__ . "/../templates/navbar.php");

// Incluir la clase que contiene el método 'get'
require_once(__DIR__ . "/../../Core/Store.php");

// echo '<pre>';
// var_dump($params['llista']); // 0 adn i 1 host
// echo '</pre>';

// die();

?>



<div class="container mt-5">
    <div class="d-flex flex-wrap">
        <!-- posició 0 del array = adn i posició 1 del array = hosts -->
        <?php foreach ($params['llista'] as $stock) : ?>
            <?php if (isset($stock['adn'])) : ?>
                <div class="card mx-3 my-3" style="width: 16rem; height: 28rem;">
                    <div class="img-container">
                        <img class="custom-image" src="../../../Public/img/adn/<?php echo $stock['adn']['img']; ?>" alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $stock['adn']['nom']; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($stock['host'])) : ?>
                <div class="card mx-3 my-3" style="width: 16rem; height: 28rem;">
                    <div class="img-container">
                        <img class="custom-image" src="../../../Public/img/hosts/<?php echo $stock['host']['img']; ?>" alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $stock['host']['especie']; ?></p>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>







</div>
</div>