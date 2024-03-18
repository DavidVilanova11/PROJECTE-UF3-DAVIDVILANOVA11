<?php

$_SESSION['actual_page'] = "log";

if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
  header("Location: /usuari/index");
}

include_once(__DIR__ . "/../templates/navbar.php");

// echo '<pre>';
// var_dump($params['llista']);
// echo '</pre>';

// die();

?>

<div class="llista" style="margin-top: 50px;">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Host</th>
        <th scope="col">ADN</th>
        <th scope="col">Extinta</th>
        <th scope="col">Probabilitat</th>
        <th scope="col">Èxit</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($params['llista'] as $log) : ?>
        <tr>
          <td>
            <?= $log['host']['especie'] ?>
          </td>
          <td>
            <?= $log['adn']['nom'] ?>
          </td>
          <td>
            <?= $log['extinta']['nom'] ?>
          </td>
          <td>
            <?= $log['extinta']['probabilitat'] ?>
          </td>
          <td>
            <?= $log['satisfactori'] ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>