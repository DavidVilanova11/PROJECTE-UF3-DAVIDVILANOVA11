<?php

if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
  header("Location: /usuari/index");
}


include_once(__DIR__ . "/../templates/navbar.php");

$_SESSION['id_usuari_actual'] = $_GET['id'];

?>
<form action="/recuperada/store" method="post" enctype="multipart/form-data" class="col-11 col-sm-9 col-md-7 col-lg-5 mx-auto border bg-light p-4 mt-4">
  <h2><?php echo $params['usuari']['nom_usuari'] ?></h2>

  <div class="mb-3">
    <label for="nom_recuperada" class="form-label">Nom recuperada</label>
    <input type="text" class="form-control" name="nom_recuperada" id="nom_recuperada" aria-describedby="helpId" placeholder="Nom que li vols posar..." required />
  </div>

  <div class="mb-3">
    <label for="especie_recuperada" class="form-label">Espècie recuperada</label>
    <input type="text" class="form-control" name="especie_recuperada" id="especie_recuperada" aria-describedby="helpId" placeholder="Nom de la espècie..." required />
  </div>


  <!-- El timestamp s'hauria de fer automàticament al fet l'insert a la BD -->

  <div class="mb-3"> <!-- Aquí agaferem el mp del que venim a la url amb get i utilitzarem un hidden per recollir-la amb el post -->
    <!-- vull recollir el get  -->
    <input type="hidden" class="form-control" name="id" id="id" aria-describedby="helpId" value="<?php echo $_GET['id'] ?>" />
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
        <th scope="col">ID recuperada</th>
        <th scope="col">Nom recuperada</th>
        <th scope="col">Imatge recuperada</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($params['llista'] as $recuperada) {
        echo "<tr>";
        echo "<td>" . $recuperada['id'] . "</td>";
        echo "<td>" . $recuperada['nom_recuperada'] . "</td>";
        echo "<td>" . $recuperada['imatge_recuperada'] . "</td>";
        echo "<td>
          <a name='' id='' class='btn btn-danger' href='/recuperada/destroy/?id=" . $recuperada['id'] . "' role='button'>Remove</a>
          <a name='' id='' class='btn btn-primary' href='/recuperada/update/?id=" . $recuperada['id'] . "' role='button'>Update</a>
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