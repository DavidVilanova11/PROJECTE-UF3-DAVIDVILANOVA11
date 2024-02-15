<?php

$_SESSION['actual_page'] = "home";

if (!isset($_SESSION['user_logged']) && !isset($params['entrenador'])) {
    header("Location: /entrenador/index");
}

include_once("App/Views/templates/navbar.php");
?>
<div class="container">
    <h1>HOME WEB</h1>
    <p>Hola <?php if (isset($params['entrenador']['nom_entrenador'])) {
                echo $params['entrenador']['nom_entrenador'];
            } else {
                echo $_SESSION['user_logged']['nom_entrenador'];
            }

            ?></p>


    <?php
    // $archivo = '/var/www/html/Public/Assetsimatges/ocells/Apodidae/Acridotheres tristis.avif';

    // if (file_exists($archivo)) {
    //     echo "El archivo existe.";
    // } else {
    //     echo "El archivo no existe.";
    // }
    ?>

    <?php
    // echo '<pre>';
    // var_dump($_SESSION['user_logged']);
    // echo '</pre>';

    // die();
    if ($_SESSION['user_logged']['admin']) {
        echo "<p'>Ets administrador.</p>";
    }
    ?>
</div>
<?php

?>