<div class="signin col-11 col-md-9 col-lg-7 col-xl-5 mx-auto border p-4 bg-light mt-4">
    <form action="/user/login" method="post">
        <h2 class="text-success">Login</h2>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Password</label>
            <input type="text" class="form-control" name="pass" id="pass" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <?php

        if (isset($params['flash_ok'])) {
            echo "<div class='alert alert-success mt-y' role='alert'>";
            echo $params['flash_ok'];
            echo "</div>";
            unset($params);
        }

        ?>
        <button type="submit" class="btn btn-primary">Desa</button>

    </form>
</div>