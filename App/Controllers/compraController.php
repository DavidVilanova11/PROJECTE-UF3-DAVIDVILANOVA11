<?php

include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Core/Mailer.php");
include_once(__DIR__ . "/../Models/Compra.php");
include_once(__DIR__ . "/../Models/Adn.php");
include_once(__DIR__ . "/../Models/Host.php");

class compraController extends Controller
{
    public function index()
    {
        $compraModel = new Compra();
        $compraModel->getAll();

        $params = null;
        if (isset($_SESSION['flash'])) {
            $params['flash'] = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        // if ($compraModel->getAll() == null) {

        // }


        $params['title'] = "Gestió compres";
        $params['llista'] = $compraModel->getAll();
        $params['var'] = $_ENV['DB_NAME']; //


        if (!isset($_SESSION['user_logged'])) {
            $this->render("compra/login", $params, "main");
        } else {
            header("Location: /compra/manage");
        }
    }

    public function manage()
    {
        $compraModel = new Compra();
        $params['title'] = "Compres realitzades";
        $params['llista'] = $compraModel->getCompraByIdUsuari($_SESSION['user_logged']['id']);
        foreach ($params['llista'] as $index => $compra) {
            $adnModel = new Adn();
            $adn = $adnModel->getById($compra['id_adn']);
            $params['llista'][$index]['adn'] = $adn;
            $hostModel = new Host();
            $host = $hostModel->getById($compra['id_host']);
            $params['llista'][$index]['host'] = $host;
        }

        // echo '<pre>';
        // var_dump($params['llista']);
        // echo '</pre>';

        // die();

        //$params['compra_loguejat'] = $compraModel->getById('1');  


        $this->render("compra/index", $params, "main");
    }
}
