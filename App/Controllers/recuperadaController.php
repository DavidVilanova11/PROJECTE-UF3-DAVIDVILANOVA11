<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Adn.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Host.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Stock.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Usuari.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Recuperada.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Extinta.php";


class recuperadaController extends Controller
{

    public function manage()
    {
        $extintaModel = new Extinta();
        $recuperadaModel = new Recuperada();
        $params['title'] = "Gestió Stock";
        $distinct_recuperades = $recuperadaModel->getRecuperadesByIdUsuari($_SESSION['user_logged']['id']);



        // Recuperar los objetos completos de recuperada
        $recuperades = [];
        foreach ($distinct_recuperades as $recuperada) {
            if ($recuperada !== null) {
                $recuperada = $extintaModel->getById($recuperada['id']);
                if ($recuperada !== false) {
                    $recuperades[] = $recuperada;
                }
            }
        }


        // Asignar los objetos completos a $params['llista']
        $params['llista'] = [
            'recuperades' => $recuperades
        ];

        // agregar la cantidad de productos para 'recuperada'
        if (isset($params['llista']['recuperades']) && is_array($params['llista']['recuperades'])) {
            foreach ($params['llista']['recuperades'] as $index => $recuperada) {
                if (isset($recuperada['id'])) {
                    $params['llista']['recuperades'][$index]['quantity'] = $recuperadaModel->getProductQuantity($recuperada['id'], $_SESSION['user_logged']['id']);
                }
            }
        }


        $this->render("recuperada/manage", $params, "site");
    }
}
