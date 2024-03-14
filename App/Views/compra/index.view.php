<div class="llista" style="margin-top: 50px;">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nom Producte</th>
          <th scope="col">Tipus Producte</th>
          <th scope="col">Contrasenya</th>
          <th scope="col">Preu</th>
        </tr>
      </thead>
      <tbody>

      <?php

      foreach ($params['llista'] as $compra) {
        echo "<tr>";
        echo "<td>" . $compra['id'] . "</td>";
        echo "<td>" . $compra['email'] . "</td>";
        echo "<td>" . $compra['nom'] . "</td>";
        echo "<td>" . $compra['naixement'] . "</td>";
        echo "<td>" . number_format($compra['preu'], 2, '.', ',') . "$" . "</td>";
        echo "<td>" . substr($compra['password'], 0, 5) . "..." . "</td>";
        echo "<td>" . $compra['verified'] . "</td>";
        echo "<td>" . $compra['admin'] . "</td>";
        echo "<td>
        </td>";
        echo "</tr>";
      }

      ?>

      </tbody>
    </table>