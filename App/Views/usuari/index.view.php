<?php

$_SESSION['actual_page'] = "create";

include_once(__DIR__ . "/../templates/navbar.php"); ?>
<form action="/usuari/store" method="post" class="col-11 col-sm-9 col-md-7 col-lg-5 mx-auto border bg-light p-4 mt-4">
  <h2>Nou Usuari</h2>
  <div class="mb-3">
    <label for="email_usuari" class="form-label">Email usuari</label>
    <input type="email" class="form-control" name="email_usuari" id="email_usuari" aria-describedby="helpId" placeholder="Correu del Usuari..." required />
  </div>
  <div class="mb-3">
    <label for="nom_usuari" class="form-label">Nom usuari</label>
    <input type="text" class="form-control" name="nom_usuari" id="nom_usuari" aria-describedby="helpId" placeholder="Nom de l'Usuari..." required />
  </div>
  <!-- Data naixement -->
  <div class="mb-3">
    <label for="naixement_usuari" class="form-label">Data naixement</label>
    <input type="date" class="form-control" name="naixement_usuari" id="naixement_usuari" aria-describedby="helpId" placeholder="Data de naixement..." required />
  </div>
  <div class="mb-3">
    <label for="contrasenya_usuari" class="form-label">Contrasenya</label>
    <input type="password" class="form-control" name="contrasenya_usuari" id="contrasenya_usuari" aria-describedby="helpId" placeholder="Introdueix una contrasenya..." required />
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

if (isset($_SESSION['user_logged']) && $_SESSION['user_logged']['nom'] == "admin") {


?>

  <div class="llista" style="margin-top: 50px;">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID Usuari</th>
          <th scope="col">Email Usuari</th>
          <th scope="col">Nom Usuari</th>
          <th scope="col">Naixement Usuari</th>
          <th scope="col">Pressupost Usuari</th>
          <th scope="col">Contrasenya</th>
          <th scope="col">Verificat</th>
          <th scope="col">Admin</th>
          <th scope="col">Actions</th>

        </tr>
      </thead>
      <tbody>

      <?php

      foreach ($params['llista'] as $usuari) {
        echo "<tr>";
        echo "<td>" . $usuari['id'] . "</td>";
        echo "<td>" . $usuari['email'] . "</td>";
        echo "<td>" . $usuari['nom'] . "</td>";
        echo "<td>" . $usuari['naixement'] . "</td>";
        echo "<td>" . number_format($usuari['pressupost'], 2, '.', ',') . "$" . "</td>";
        echo "<td>" . substr($usuari['password'], 0, 5) . "..." . "</td>";
        echo "<td>" . $usuari['verified'] . "</td>";
        echo "<td>" . $usuari['admin'] . "</td>";
        echo "<td>
        <a name='' id='' class='btn btn-danger' href='/usuari/destroy/?id=" . $usuari['id'] . "' role='button'>Remove</a>
        <a name='' id='' class='btn btn-primary' href='/usuari/update/?id=" . $usuari['id'] . "' role='button'>Update</a>
        </td>";
        echo "</tr>";
      }
    }

      ?>

      </tbody>
    </table>
  </div>