<?php
if (!isset($_SESSION['user_logged']) && !isset($params['entrenador'])) {
    header("Location: /entrenador/index");
}


include_once(__DIR__ . "/../templates/navbar.php");

// echo '<pre>';
// var_dump($params['ocell']);
// echo '</pre>';

// die();

?>

<form action="/ocell/store" method="post" enctype="multipart/form-data" class="col-11 col-sm-9 col-md-7 col-lg-5 mx-auto border bg-light p-4 mt-4">
    <h2><?php echo $params['ocell']['nom_ocell'] ?></h2>
    <div class="mb-3">
        <label for="num_ocell" class="form-label">Num ocell</label>
        <input type="number" class="form-control" value="<?php echo $params['ocell']['num_ocell'] ?? null ?>" name="num_ocell" id="num_ocell" aria-describedby="helpId" placeholder="Identificador del ocell..." />
    </div>

    <div class="mb-3">
        <label for="familiaOcell">Selecciona una família d'ocells:</label>
        <select class="form-select" id="familiaOcell" name="familia_ocell" value="<?php echo $params['ocell']['familia_ocell'] ?? null ?>">
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
        <label for="nom_ocell" class="form-label">Nom ocell</label>
        <input type="text" class="form-control" value="<?php echo $params['ocell']['nom_ocell'] ?? null ?>" name="nom_ocell" id="nom_ocell" aria-describedby="helpId" placeholder="Nom de la espècie..." required />
    </div>

    <div class="mb-3">
        <label for="imatge">Selecciona una imatge:</label>
        <label for="imatge"><?php echo $params['ocell']['imatge_ocell'] ?? null ?> (Actual)</label>
        <input type="file" class="form-control-file" id="imatge" name="imatge_ocell" accept="image/*" onchange="mostrarPrevisualitzacio()" required>
    </div>
    <div class="mb-3">
        <img id="previsualitzacio" class="img-fluid" style="display: none;" alt="Previsualització de la imatge">
    </div>

    <div class="mb-3">
        <label for="video">Selecciona un fitxer de vídeo MP4 (Opc.):</label>
        <label for="imatge"><?php echo $params['ocell']['video_ocell'] ?? null ?> (Actual)</label>
        <input type="file" class="form-control-file" id="video" value="<?php echo $params['ocell']['video_ocell'] ?? null ?>" name="video_ocell" accept="video/mp4">
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