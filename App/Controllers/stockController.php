<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Adn.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Host.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";


class stockController extends Controller
{

public function manage()
    {
        $hostModel = new Host();
        $adnModel = new Adn();
        $params['title'] = "Gestió Stock";
        //$params['llista-host'] = $hostModel->getAll();
        //$params['llista-adn'] = $adnModel->getAll();
        // getCompraByIdUsuari


        $this->render("stock/manage", $params, "site");
    }

}