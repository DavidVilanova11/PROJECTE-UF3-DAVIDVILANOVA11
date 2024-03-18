<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Adn.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Host.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Stock.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Usuari.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Recuperada.php";


class recuperadaController extends Controller
{

    public function manage()
    {
        $hostModel = new Host();
        $recuperadaModel = new Adn();
        $stockModel = new Recuperada();
        $params['title'] = "Gestió Stock";
        $distinct_recuperades = $stockModel->getRecuperadesByIdUsuari($_SESSION['user_logged']['id']);

        echo '<pre>';
        var_dump($distinct_recuperades);
        echo '</pre>';

        // $distinct_recuperades = $stockModel->getDistinct('id_host');
        // $distinct_recuperada = $stockModel->getDistinct('id_recuperada');

        // echo '<pre>';
        // var_dump($distinct_recuperades);
        // echo '</pre>';

        // echo '<pre>';
        // var_dump(
        //     $distinct_recuperada
        // );
        // echo '</pre>';

        // die();

        // Recuperar los objetos completos de recuprada
        $recuprades = [];
        foreach ($distinct_recuperades as $host_id) {
            if ($host_id !== null) {
                $recuprada = $hostModel->getById($host_id);
                if ($recuprada !== false) {
                    $recuprades[] = $recuprada;
                }
            }
        }

        // Recuperar los objetos completos de recuprada
        $recuperades = [];
        foreach ($distinct_recuperada as $recuperada_id) {
            if ($recuperada_id !== null) {
                $recuprada = $recuperadaModel->getById($recuperada_id);
                if ($recuprada !== false) {
                    $recuperades[] = $recuprada;
                }
            }
        }

        // Asignar los objetos completos a $params['llista']
        $params['llista'] = [
            'recuprada' => $recuperades,
            'recuprada' => $recuprades
        ];

        // agregar la cantidad de productos para 'recuprada'
        if (isset($params['llista']['recuprada']) && is_array($params['llista']['recuprada'])) {
            foreach ($params['llista']['recuprada'] as $index => $stock) {
                if (isset($stock['id'])) {
                    $params['llista']['recuprada'][$index]['quantity'] = $stockModel->getProductQuantity($stock['id'], $_SESSION['user_logged']['id'], "recuprada");
                }
            }
        }


        // agregar la cantidad de productos para 'recuprada'
        if (isset($params['llista']['recuprada']) && is_array($params['llista']['recuprada'])) {
            foreach ($params['llista']['recuprada'] as $index => $stock) {
                if (isset($stock['id'])) {
                    $params['llista']['recuprada'][$index]['quantity'] = $stockModel->getProductQuantity($stock['id'], $_SESSION['user_logged']['id'], "recuprada");
                }
            }
        }



        // echo '<pre>';
        // var_dump($params['llista']);
        // echo '</pre>';

        // die();

        $this->render("stock/manage", $params, "site");
    }
}
