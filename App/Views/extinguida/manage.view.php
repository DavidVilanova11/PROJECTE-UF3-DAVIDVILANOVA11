<?php

$_SESSION['actual_page'] = "manage";

if (!isset($_SESSION['user_logged']) && !isset($params['entrenador'])) {
    header("Location: /entrenador/index");
}

include_once(__DIR__ . "/../templates/navbar.php");

// Incluir la clase que contiene el método 'get'
require_once(__DIR__ . "/../../Core/Store.php");

?>

<div class="container mt-5">
    <div class="d-flex flex-wrap">

        <?php foreach ($_SESSION['ocells'] as $index => $ocell) : ?>
            <div class="card mx-3 my-3" style="width: 18rem;">
                <img class="custom-image" src="../../../Public/Assetsimatges/ocells/<?php echo $ocell['familia_ocell'] . "/" . $ocell['imatge_ocell'] ?>" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $ocell['num_ocell']; ?></h5>
                    <p class="card-text"><?php echo $ocell['nom_ocell']; ?></p>

                    <!-- Acordeón Bootstrap -->
                    <div class="accordion" id="accordion-<?php echo $index; ?>">
                        <div class="card">
                            <div class="card-header" id="infoHeading-<?php echo $index; ?>">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#infoCollapse-<?php echo $index; ?>" aria-expanded="false" aria-controls="infoCollapse-<?php echo $index; ?>">
                                        Informació adicional
                                    </button>
                                </h5>
                            </div>

                            <div id="infoCollapse-<?php echo $index; ?>" class="collapse" aria-labelledby="infoHeading-<?php echo $index; ?>" data-parent="#accordion-<?php echo $index; ?>">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $ocell['familia_ocell']; ?></p>
                                    <p class="card-text"><?php
                                                            // mostrar nom del entrenador
                                                            foreach ($_SESSION['entrenadors'] as $entrenador) {
                                                                if ($entrenador['id'] == $ocell['id_entrenador']) {
                                                                    echo $entrenador['nom_entrenador'];
                                                                }
                                                            }; ?></p>
                                    <p class="card-text">Altra informació adicional...</p>
                                    <!-- Puedes agregar más información aquí -->

                                    <hr>
                                    <?php if ($ocell['video_ocell'] != null) { ?>
                                        <!-- Video en la sección de acordeón -->
                                        <video class="custom-video" controls>
                                            <source src="../../../Public/Assetsvideos/ocells/<?php echo $ocell['familia_ocell'] .  "/" . $ocell['video_ocell'] ?>" type="video/mp4">
                                            El navegador no soporta el elemento video.
                                        </video>
                                    <?php } else { ?>
                                        <p class="card-text">No hi ha video disponible.</p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>