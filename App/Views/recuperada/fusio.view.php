<?php

$_SESSION['actual_page'] = "fusion";

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

<h1>SELECCIONA UN HOST</h1>

<div class="container mt-5">
    <!-- Hosts -->
    <div class="d-flex flex-wrap">
        <?php foreach ($params['llista'] as $tipo => $stocks) : ?>
            <?php if ($tipo === 'host' && !empty($stocks)) : ?>
                <?php foreach ($stocks as $stock) : ?>
                    <div class="card mx-3 my-3 <?php echo ($selectedHostId && $selectedHostId === $stock['id']) ? 'selected' : ''; ?>" style="width: 16rem; height: 28rem; border: 2px solid transparent;" data-tipo="<?php echo $tipo; ?>" data-id="<?php echo $stock['id']; ?>">
                        <div class="img-container">
                            <img class="custom-image" src="../../../Public/img/hosts/<?php echo $stock['img']; ?>" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo trim($stock['especie']); ?></p>
                            <?php if (isset($stock['quantity'])) : ?>
                                <p class="card-text"><?php echo "X" . $stock['quantity']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <hr> <!-- Línea horizontal para separar los hosts de los adn -->

    <!-- Adn -->
    <div class="d-flex flex-wrap">
        <?php foreach ($params['llista'] as $tipo => $stocks) : ?>
            <?php if ($tipo === 'adn' && !empty($stocks)) : ?>
                <?php foreach ($stocks as $stock) : ?>
                    <div class="card mx-3 my-3" style="width: 16rem; height: 28rem; border: 2px solid transparent;" data-tipo="<?php echo $tipo; ?>" data-id="<?php echo $stock['id']; ?>">
                        <div class="img-container">
                            <img class="custom-image" src="../../../Public/img/adn/<?php echo $stock['img']; ?>" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo trim($stock['nom']); ?></p>
                            <?php if (isset($stock['quantity'])) : ?>
                                <p class="card-text"><?php echo "X" . $stock['quantity']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>




<button id="confirmHostBtn" style="display: none;">Confirmar host</button>
<button id="fusionBtn" style="display: none;">Fusionar</button>


</div>
</div>