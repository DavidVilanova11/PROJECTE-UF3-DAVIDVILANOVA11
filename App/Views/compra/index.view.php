<?php

$_SESSION['actual_page'] = "purchase";

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
        <th scope="col">Nom Producte</th>
        <th scope="col">Tipus Producte</th>
        <th scope="col">Preu</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($params['llista'] as $compra) : ?>
        <tr>
          <td><?php
              if ($compra['tipus_compra'] === 'ADN' && isset($compra['adn'])) {
                echo $compra['adn']['nom'];
              } elseif ($compra['tipus_compra'] === 'Host' && isset($compra['host'])) {
                echo $compra['host']['especie'];
              }
              ?></td>
          <td><?= $compra['tipus_compra'] ?></td>
          <td>
            <?php
            if ($compra['tipus_compra'] === 'ADN' && isset($compra['adn'])) {
              echo number_format($compra['adn']['preu'], 2, '.', ',') . "$";
            } elseif ($compra['tipus_compra'] === 'Host' && isset($compra['host'])) {
              echo number_format($compra['host']['preu'], 2, '.', ',') . "$";
            }
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>