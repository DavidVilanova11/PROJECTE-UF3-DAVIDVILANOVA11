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
        $adnModel = new Adn();
        $stockModel = new Recuperada();
        $params['title'] = "Gestió Stock";
        $distinct_recuperades = $stockModel->getRecuperadesByIdUsuari($_SESSION['user_logged']['id']);

        echo '<pre>';
        var_dump($distinct_hosts);
        echo '</pre>';

        // $distinct_hosts = $stockModel->getDistinct('id_host');
        // $distinct_adn = $stockModel->getDistinct('id_adn');

        // echo '<pre>';
        // var_dump($distinct_hosts);
        // echo '</pre>';

        // echo '<pre>';
        // var_dump(
        //     $distinct_adn
        // );
        // echo '</pre>';

        // die();

        // Recuperar los objetos completos de recuprada
        $recuprades = [];
        foreach ($distinct_hosts as $host_id) {
            if ($host_id !== null) {
                $recuprada = $hostModel->getById($host_id);
                if ($recuprada !== false) {
                    $recuprades[] = $recuprada;
                }
            }
        }

        // Recuperar los objetos completos de recuprada
        $adns = [];
        foreach ($distinct_adn as $adn_id) {
            if ($adn_id !== null) {
                $recuprada = $adnModel->getById($adn_id);
                if ($recuprada !== false) {
                    $adns[] = $recuprada;
                }
            }
        }

        // Asignar los objetos completos a $params['llista']
        $params['llista'] = [
            'recuprada' => $adns,
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
