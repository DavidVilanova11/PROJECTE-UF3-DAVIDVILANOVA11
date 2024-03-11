<?php
if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
    header("Location: /usuari/index");
}


include_once(__DIR__ . "/../templates/navbar.php");

?>

<form action="/usuari/modify" method="post" class="col-11 col-sm-9 col-md-7 col-lg-5 mx-auto border bg-light p-4 mt-4">
    <h2>Update Usuari</h2>
    <div class="mb-3">
        <label for="email_usuari" class="form-label">Email Usuari</label>
        <input value="<?php echo $params['usuari']['email'] ?? null ?>" type="email" class="form-control" name="email_usuari" id="email_usuari" aria-describedby="helpId" placeholder="Correu del Usuari" required />
    </div>
    <div class="mb-3">
        <label for="nom_usuari" class="form-label">Nom Usuari</label>
        <input value="<?php echo $params['usuari']['nom'] ?? null ?>" type="text" class="form-control" name="nom_usuari" id="nom_usuari" aria-describedby="helpId" placeholder="Nom de l'Usuari..." required />
    </div>
    <div class="mb-3">
        <label for="usuari_usuari" class="form-label">Naixement Usuari</label>
        <input value="<?php echo $params['usuari']['naixement'] ?? null ?>" type="text" class="form-control" name="usuari_usuari" id="usuari_usuari" aria-describedby="helpId" placeholder="Nom d'usuari..." required />
    </div>
    <div class="mb-3">
        <label for="contrasenya_usuari" class="form-label">Contrasenya Usuari</label>
        <input value="<?php echo $params['usuari']['password'] ?? null ?>" type="text" class="form-control" name="contrasenya_usuari" id="contrasenya_usuari" aria-describedby="helpId" placeholder="Introdueix una contrasenya..." required />
    </div>

    <input type="hidden" name="id" value="<?php echo $params['usuari']['id'] ?? null ?>">

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </div>
</form>