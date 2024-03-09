<?php

$_SESSION['actual_page'] = "home";

if (!isset($_SESSION['user_logged']) && !isset($params['usuari'])) {
    header("Location: /usuari/index");
}

include_once("App/Views/templates/navbar.php");
?>
<div class="container">
    <div class="titol">
        <h1 class="highlight d-inline">HOME WEB</h1>
    </div>
    <div class="benvinguda">
        <p class="highlight d-inline">Hola <?php if (isset($params['usuari']['nom'])) {
                                                echo $params['usuari']['nom'];
                                            } else {
                                                echo $_SESSION['user_logged']['nom_usuari'];
                                            }

                                            ?></p>
    </div>
    <div class="admin">
        <?php
        if ($_SESSION['user_logged']['admin']) {
            echo "<p class='highlight d-inline'>Ets administrador.</p>";
        }
        ?>
    </div>
</div>
</div>
<?php

?>