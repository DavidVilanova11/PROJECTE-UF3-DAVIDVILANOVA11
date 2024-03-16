<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Adn.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Host.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Stock.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";


class stockController extends Controller
{

    public function manage()
    {
        $hostModel = new Host();
        $adnModel = new Adn();
        $stockModel = new Stock();
        $params['title'] = "Gestió Stock";
        $distinct_hosts = $stockModel->getDistinct('id_host');
        $distinct_adn = $stockModel->getDistinct('id_adn');

        // Recuperar los objetos completos de host
        $hosts = [];
        foreach ($distinct_hosts as $host_id) {
            if ($host_id !== null) {
                $host = $hostModel->getById($host_id);
                if ($host !== false) {
                    $hosts[] = $host;
                }
            }
        }

        // Recuperar los objetos completos de adn
        $adns = [];
        foreach ($distinct_adn as $adn_id) {
            if ($adn_id !== null) {
                $adn = $adnModel->getById($adn_id);
                if ($adn !== false) {
                    $adns[] = $adn;
                }
            }
        }

        // Asignar los objetos completos a $params['llista']
        $params['llista'] = [
            'adn' => $adns,
            'host' => $hosts
        ];

        // agregar la cantidad de productos para 'adn'
        if (isset($params['llista']['adn']) && is_array($params['llista']['adn'])) {
            foreach ($params['llista']['adn'] as $index => $stock) {
                if (isset($stock['id'])) {
                    $params['llista']['adn'][$index]['quantity'] = $stockModel->getProductQuantity($stock['id'], "adn");
                }
            }
        }

        // agregar la cantidad de productos para 'host'
        if (isset($params['llista']['host']) && is_array($params['llista']['host'])) {
            foreach ($params['llista']['host'] as $index => $stock) {
                if (isset($stock['id'])) {
                    $params['llista']['host'][$index]['quantity'] = $stockModel->getProductQuantity($stock['id'], "host");
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
