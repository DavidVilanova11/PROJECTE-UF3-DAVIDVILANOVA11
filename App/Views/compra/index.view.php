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

      <?php

      // echo '<pre>';
      // var_dump($params['llista']);
      // echo '</pre>';

      // die();


      foreach ($params['llista'] as $compra) {
        echo "<tr>";
        echo "<td>" . $compra['id'] . "</td>";
        echo "<td>" . $compra['tipus_compra'] . "</td>";
        // recollim el preu de l'adn corresponent
        echo "<td>" . number_format($compra['adn']['preu'], 2, '.', ',') . "$" . "</td>";
        echo "<td>
        </td>";
        echo "</tr>";
      }

      ?>

    </tbody>
  </table>