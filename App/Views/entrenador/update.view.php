<?php
if (!isset($_SESSION['user_logged']) && !isset($params['entrenador'])) {
    header("Location: /entrenador/index");
}


include_once(__DIR__ . "/../templates/navbar.php");

?>

<form action="/entrenador/modify" method="post" class="col-11 col-sm-9 col-md-7 col-lg-5 mx-auto border bg-light p-4 mt-4">
    <h2>Update Entrenador</h2>
    <div class="mb-3">
        <label for="email_entrenador" class="form-label">Email Entrenador</label>
        <input value="<?php echo $params['entrenador']['email_entrenador'] ?? null ?>" type="email" class="form-control" name="email_entrenador" id="email_entrenador" aria-describedby="helpId" placeholder="Correu del Entrenador" required />
    </div>
    <div class="mb-3">
        <label for="nom_entrenador" class="form-label">Nom Entrenador</label>
        <input value="<?php echo $params['entrenador']['nom_entrenador'] ?? null ?>" type="text" class="form-control" name="nom_entrenador" id="nom_entrenador" aria-describedby="helpId" placeholder="Nom de l'Entrenador..." required />
    </div>
    <div class="mb-3">
        <label for="usuari_entrenador" class="form-label">Usuari Entrenador</label>
        <input value="<?php echo $params['entrenador']['usuari_entrenador'] ?? null ?>" type="text" class="form-control" name="usuari_entrenador" id="usuari_entrenador" aria-describedby="helpId" placeholder="Nom d'usuari..." required />
    </div>
    <div class="mb-3">
        <label for="contrasenya_entrenador" class="form-label">Nom Entrenador</label>
        <input value="<?php echo $params['entrenador']['contrasenya_entrenador'] ?? null ?>" type="text" class="form-control" name="contrasenya_entrenador" id="contrasenya_entrenador" aria-describedby="helpId" placeholder="Introdueix una contrasenya..." required />
    </div>

    <input type="hidden" name="id" value="<?php echo $params['entrenador']['id'] ?? null ?>">

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </div>
</form>