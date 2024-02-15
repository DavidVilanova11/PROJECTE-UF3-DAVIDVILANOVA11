<?php
if (!isset($_SESSION['user_logged']) && !isset($params['entrenador'])) {
    header("Location: /entrenador/index");
}


include_once(__DIR__ . "/../templates/navbar.php");

// echo '<pre>';
// var_dump($params['recuperada']);
// echo '</pre>';

// die();

?>

<form action="/recuperada/store" method="post" enctype="multipart/form-data" class="col-11 col-sm-9 col-md-7 col-lg-5 mx-auto border bg-light p-4 mt-4">
    <h2><?php echo $params['recuperada']['nom_recuperada'] ?></h2>
    <div class="mb-3">
        <label for="num_recuperada" class="form-label">Num recuperada</label>
        <input type="number" class="form-control" value="<?php echo $params['recuperada']['num_recuperada'] ?? null ?>" name="num_recuperada" id="num_recuperada" aria-describedby="helpId" placeholder="Identificador del recuperada..." />
    </div>

    <div class="mb-3">
        <label for="familiaRecuperada">Selecciona una família d'recuperadas:</label>
        <select class="form-select" id="familiaRecuperada" name="familia_recuperada" value="<?php echo $params['recuperada']['familia_recuperada'] ?? null ?>">
            <option value="Accipitridae">Accipitridae (Àguiles, Estepàries, Aufranys)</option>
            <option value="Alcedinidae">Alcedinidae (Martins Pescadors)</option>
            <option value="Anatidae">Anatidae (Ànecs, Oques, Cignes)</option>
            <option value="Apodidae">Apodidae (Orenetes, Martinets)</option>
            <option value="Ardeidae">Ardeidae (Bernats, Garserols, Aguaitadors)</option>
            <option value="Charadriidae">Charadriidae (Corriols, Escars, Fumarells)</option>
            <option value="Columbidae">Columbidae (Coloms, Tortores)</option>
            <option value="Corvidae">Corvidae (Corbs, Gaig, Esquirols)</option>
            <option value="Falconidae">Falconidae (Falcons, Falconets)</option>
            <option value="Fringillidae">Fringillidae (Pinsans, Llavors, Tallarols)</option>
            <option value="Hirundinidae">Hirundinidae (Orenetes)</option>
            <option value="Passeridae">Passeridae (Pardals)</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="nom_recuperada" class="form-label">Nom recuperada</label>
        <input type="text" class="form-control" value="<?php echo $params['recuperada']['nom_recuperada'] ?? null ?>" name="nom_recuperada" id="nom_recuperada" aria-describedby="helpId" placeholder="Nom de la espècie..." required />
    </div>

    <div class="mb-3">
        <label for="imatge">Selecciona una imatge:</label>
        <label for="imatge"><?php echo $params['recuperada']['imatge_recuperada'] ?? null ?> (Actual)</label>
        <input type="file" class="form-control-file" id="imatge" name="imatge_recuperada" accept="image/*" onchange="mostrarPrevisualitzacio()" required>
    </div>
    <div class="mb-3">
        <img id="previsualitzacio" class="img-fluid" style="display: none;" alt="Previsualització de la imatge">
    </div>

    <div class="mb-3">
        <label for="video">Selecciona un fitxer de vídeo MP4 (Opc.):</label>
        <label for="imatge"><?php echo $params['recuperada']['video_recuperada'] ?? null ?> (Actual)</label>
        <input type="file" class="form-control-file" id="video" value="<?php echo $params['recuperada']['video_recuperada'] ?? null ?>" name="video_recuperada" accept="video/mp4">
    </div>

    <div class="mb-3"> <!-- Aquí agaferem el mp del que venim a la url amb get i utilitzarem un hidden per recollir-la amb el post -->
        <!-- vull recollir el get  -->
        <input type="hidden" class="form-control" name="id" id="id" aria-describedby="helpId" value="<?php echo $_GET['id'] ?>" />
    </div>

    <?php

    ?>

    <?php if (isset($_SESSION['flash_ok0'])) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['flash_ok0'];
            unset($_SESSION['flash_ok0']); ?>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION['flash_ko0'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['flash_ko0'];
            unset($_SESSION['flash_ko0']); ?>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION['flash_ok1'])) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['flash_ok1'];
            unset($_SESSION['flash_ok1']); ?>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['flash_ko1'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['flash_ko1'];
            unset($_SESSION['flash_ko1']); ?>
        </div>
    <?php } ?>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </div>
</form>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function mostrarPrevisualitzacio() {
        var imatgeInput = document.getElementById('imatge');
        var previsualitzacio = document.getElementById('previsualitzacio');

        if (imatgeInput.files && imatgeInput.files[0]) {
            var lector = new FileReader();

            lector.onload = function(e) {
                previsualitzacio.src = e.target.result;
                previsualitzacio.style.display = 'block';
            };

            lector.readAsDataURL(imatgeInput.files[0]);
        }
    }

    // mostrarPrevisualitzacio();
</script>