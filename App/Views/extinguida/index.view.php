<?php

if (!isset($_SESSION['user_logged']) && !isset($params['entrenador'])) {
  header("Location: /entrenador/index");
}


include_once(__DIR__ . "/../templates/navbar.php");

$_SESSION['id_entrenador_actual'] = $_GET['id'];

?>
<form action="/extinguida/store" method="post" enctype="multipart/form-data" class="col-11 col-sm-9 col-md-7 col-lg-5 mx-auto border bg-light p-4 mt-4">
  <h2><?php echo $params['entrenador']['nom_entrenador'] ?></h2>
  <div class="mb-3">
    <label for="num_extinguida" class="form-label">Num extinguida</label>
    <input type="number" class="form-control" name="num_extinguida" id="num_extinguida" aria-describedby="helpId" placeholder="Identificador del extinguida..." />
  </div>

  <div class="mb-3">
    <label for="familiaExtinguida">Selecciona una família d'extinguidas:</label>
    <select class="form-select" id="familiaExtinguida" name="familia_extinguida">
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
    <label for="nom_extinguida" class="form-label">Nom extinguida</label>
    <input type="text" class="form-control" name="nom_extinguida" id="nom_extinguida" aria-describedby="helpId" placeholder="Nom de la espècie..." required />
  </div>

  <div class="mb-3">
    <label for="imatge">Selecciona una imatge:</label>
    <input type="file" class="form-control-file" id="imatge" name="imatge_extinguida" accept="image/*" onchange="mostrarPrevisualitzacio()" required>
  </div>
  <div class="mb-3">
    <img id="previsualitzacio" class="img-fluid" style="display: none;" alt="Previsualització de la imatge">
  </div>

  <div class="mb-3">
    <label for="video">Selecciona un fitxer de vídeo MP4 (Opc.):</label>
    <input type="file" class="form-control-file" id="video" name="video_extinguida" accept="video/mp4">
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

<div class="llista">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID extinguida</th>
        <th scope="col">Número extinguida</th>
        <th scope="col">Nom extinguida</th>
        <th scope="col">Familia extinguida</th>
        <th scope="col">Imatge extinguida</th>
        <th scope="col">Vídeo extinguida</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($params['llista'] as $extinguida) {
        echo "<tr>";
        echo "<td>" . $extinguida['id'] . "</td>";
        echo "<td>" . $extinguida['num_extinguida'] . "</td>";
        echo "<td>" . $extinguida['nom_extinguida'] . "</td>";
        echo "<td>" . $extinguida['familia_extinguida'] . "</td>";
        echo "<td>" . $extinguida['imatge_extinguida'] . "</td>";
        if ($extinguida['video_extinguida'] != null) {
          echo "<td>" . $extinguida['video_extinguida'] . "</td>";
        } else {
          echo "<td> No hi ha vídeo </td>";
        }
        echo "<td>
          <a name='' id='' class='btn btn-danger' href='/extinguida/destroy/?id=" . $extinguida['id'] . "' role='button'>Remove</a>
          <a name='' id='' class='btn btn-primary' href='/extinguida/update/?id=" . $extinguida['id'] . "' role='button'>Update</a>
        </td>";
        echo "</tr>";
      } ?>
    </tbody>
  </table>
</div>


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
</script>