<h1><?= $params['var'] ?></h1>


<div class="signin col-11 col-md-9 col-lg-7 col-xl-5 mx-auto border p-4 bg-light mt-4">
    <form action="/usuari/login" method="post">
        <h2>Login</h2>

        <div class="mb-3">
            <label for="usuari" class="form-label">Usuari</label>
            <input type="text" class="form-control" name="usuari" id="usuari" aria-describedby="helpId" placeholder="" required>
        </div>
        <div class="mb-3">
            <label for="contrasenya" class="form-label">Contrasenya</label>
            <input type="text" class="form-control" name="contrasenya" id="contrasenya" aria-describedby="helpId" placeholder="" required>
        </div>
        <?php

        if (isset($params['flash_ok'])) {
            echo "<div class='alert alert-success mt-y' role='alert'>";
            echo $params['flash_ok'];
            echo "</div>";
            unset($params);
        }

        if (isset($params['flash_ko'])) {
            echo "<div class='alert alert-danger mt-y' role='alert'>";
            echo $params['flash_ko'];
            echo "</div>";
            unset($params);
        }

        ?>
        <button type="submit" class="btn btn-primary">Accedir</button>

        <a class="px-4" href="/usuari/create">Crea un compte</a>

    </form>

    <i>
        <p class="mt-4"><b>Consell:</b> admin admin per accedir com a usuari administrador.</p>
    </i>

    <?php

    if (isset($params['flash']['ko'])) {
        echo "<div class='alert alert-danger mt-y' role='alert'>";
        echo $params['flash']['ko'];
        echo "</div>";
        unset($params['flash']['ko']);
    }

    ?>

</div>