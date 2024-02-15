<?php include_once(__DIR__ . "/../templates/navbar.php"); ?>
<form action="/mail/send" method="post" class="col-11 col-sm-9 col-md-7 col-lg-5 mx-auto border bg-light p-4 mt-4">
    <div class="mb-3">
        <label for="nom_entrenador" class="form-label">Nom entrendaor</label>
        <input type="text" class="form-control" name="nom_entrenador" id="nom_entrenador" aria-describedby="helpId" placeholder="Nom de l'Entrenador..." />
    </div>
    <div class="mb-3">
        <label for="email_entrenador" class="form-label">Email entrenador</label>
        <input type="email" class="form-control" name="email_entrenador" id="email_entrenador" aria-describedby="helpId" placeholder="Correu del Entrenador..." />
    </div>
    <div class="mb-3">
        <label for="subject" class="form-label">Conecpte</label>
        <input type="text" class="form-control" name="subject" id="subject" aria-describedby="helpId" />
    </div>
    <div class="mb-3">
        <label for="msg" class="form-label">Missatge</label>
        <textarea class="form-control" name="msg" id="msg" aria-describedby="helpId" rows="4"></textarea>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </div>
    <?php echo $params['msg'] ?? null; ?>
</form>