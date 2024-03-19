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

<?php 

if (isset($params['idExtinta']) && $params['idExtinta'] != 0 && isset($params['satisfactori']) && $params['satisfactori'] != 0) {
    
}

?>

<h1>SELECCIONA UN HOST</h1>

<div class="container mt-5">
    <!-- Hosts -->
    <div class="d-flex flex-wrap">
        <?php foreach ($params['llista'] as $tipo => $stocks) : ?>
            <?php if ($tipo === 'host' && !empty($stocks)) : ?>
                <?php foreach ($stocks as $stock) : ?>
                    <div class="card mx-3 my-3 <?php echo ($selectedHostId && $selectedHostId === $stock['id']) ? 'selected' : ''; ?>" style="width: 16rem; height: 28rem;" data-tipo="<?php echo $tipo; ?>" data-id="<?php echo $stock['id']; ?>">
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
                    <div class="card mx-3 my-3" style="width: 16rem; height: 28rem;" data-tipo="<?php echo $tipo; ?>" data-id="<?php echo $stock['id']; ?>">
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


<form id="fusionForm" action="/recuperada/addRecuperada/" method="get">
    <div class="container">
        <!-- Hidden inputs to store selected IDs -->
        <input type="hidden" name="selectedHostId" value="">
        <input type="hidden" name="selectedAdnId" value="">

        <!-- Buttons -->
        <button type="button" id="confirmHostBtn" class="btn btn-primary btn-lg" style="display: none; position: fixed; right: 3%; bottom: 12%; margin: 0 0 12px 0">Confirm Host</button>
        <button type="submit" id="fusionBtn" class="btn btn-success btn-lg" style="display: none; position: fixed; right: 3%; bottom: 12%; margin: 0 0 12px 0">Fusion</button>
    </div>
</form>



</div>
</div>