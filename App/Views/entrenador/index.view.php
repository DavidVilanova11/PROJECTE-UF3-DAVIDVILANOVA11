<?php

$_SESSION['actual_page'] = "create";

include_once(__DIR__ . "/../templates/navbar.php"); ?>
<form action="/entrenador/store" method="post" class="col-11 col-sm-9 col-md-7 col-lg-5 mx-auto border bg-light p-4 mt-4">
  <h2>Nou Entrenador</h2>
  <div class="mb-3">
    <label for="email_entrenador" class="form-label">Email entrenador</label>
    <input type="email" class="form-control" name="email_entrenador" id="email_entrenador" aria-describedby="helpId" placeholder="Correu del Entrenador..." required />
  </div>
  <div class="mb-3">
    <label for="nom_entrenador" class="form-label">Nom entrendaor</label>
    <input type="text" class="form-control" name="nom_entrenador" id="nom_entrenador" aria-describedby="helpId" placeholder="Nom de l'Entrenador..." required />
  </div>
  <div class="mb-3">
    <label for="usuari_entrenador" class="form-label">Usuari</label>
    <input type="text" class="form-control" name="usuari_entrenador" id="usuari_entrenador" aria-describedby="helpId" placeholder="Nom d'Usuari..." required />
  </div>
  <div class="mb-3">
    <label for="contrasenya_entrenador" class="form-label">Contrasenya</label>
    <input type="password" class="form-control" name="contrasenya_entrenador" id="contrasenya_entrenador" aria-describedby="helpId" placeholder="Introdueix una contrasenya..." required />
  </div>

  <?php

  if (isset($params['flash_ko'])) {
    echo "<div class='alert alert-danger mt-y' role='alert'>";
    echo $params['flash_ko'];
    echo "</div>";
    unset($params);
  }

  ?>

  <div class="mb-3">
    <button type="submit" class="btn btn-primary">
      Submit
    </button>
  </div>
</form>

<?php

if (isset($_SESSION['user_logged']) && $_SESSION['user_logged']['usuari_entrenador'] == "admin") {


?>
  <div class="llista">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID Entrenador</th>
          <th scope="col">Email Entrenador</th>
          <th scope="col">Nom Entrenador</th>
          <th scope="col">Usuari</th>
          <th scope="col">Contrasenya</th>
          <th scope="col">Admin</th>
          <th scope="col">Verificat</th>
          <th scope="col">Actions</th>

        </tr>
      </thead>
      <tbody>

      <?php

      foreach ($params['llista'] as $entrenador) {
        echo "<tr>";
        echo "<td>" . $entrenador['id'] . "</td>";
        echo "<td>" . $entrenador['email_entrenador'] . "</td>";
        echo "<td>" . $entrenador['nom_entrenador'] . "</td>";
        echo "<td>" . $entrenador['usuari_entrenador'] . "</td>";
        echo "<td>" . $entrenador['contrasenya_entrenador'] . "</td>";
        echo "<td>" . $entrenador['admin'] . "</td>";
        echo "<td>" . $entrenador['verificat'] . "</td>";
        echo "<td>
        <a name='' id='' class='btn btn-danger' href='/entrenador/destroy/?id=" . $entrenador['id'] . "' role='button'>Remove</a>
        <a name='' id='' class='btn btn-primary' href='/entrenador/update/?id=" . $entrenador['id'] . "' role='button'>Update</a>
        <a name='' id='' class='btn btn-success' href='/entrenador/addOcell/?id=" . $entrenador['id'] . "' role='button'>+Ocell</a>
        </td>";
        echo "</tr>";
      }
    }

      ?>

      </tbody>
    </table>
  </div>