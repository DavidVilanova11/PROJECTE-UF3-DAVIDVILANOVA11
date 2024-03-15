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
        $params['llista'] = $stockModel->getAll();

        foreach ($params['llista'] as $index => $stock) {
            $adn = $adnModel->getById($stock['id_adn']);
            $host = $hostModel->getById($stock['id_host']);
            if ($adn) $params['llista'][$index]['adn'] = $adn;
            if ($host) $params['llista'][$index]['host'] = $host;
        }

        $this->render("stock/manage", $params, "site");
    }
}
