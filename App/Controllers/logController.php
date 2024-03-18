<?php

include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Core/Mailer.php");
include_once(__DIR__ . "/../Models/Adn.php");
include_once(__DIR__ . "/../Models/Host.php");
include_once(__DIR__ . "/../Models/Log.php");

class logController extends Controller
{
    public function index()
    {
        $logModel = new Log();
        $logModel->getAll();

        $params = null;
        if (isset($_SESSION['flash'])) {
            $params['flash'] = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        // if ($logModel->getAll() == null) {

        // }


        $params['title'] = "Gestió compres";
        $params['llista'] = $logModel->getAll();
        $params['var'] = $_ENV['DB_NAME']; //


        if (!isset($_SESSION['user_logged'])) {
            $this->render("usuari/login", $params, "main");
        } else {
            header("Location: /log/index");
        }
    }

    public function manage()
    {
        $logModel = new Log();
        $params['title'] = "Compres realitzades";
        $params['llista'] = $logModel->getLogByIdUsuari($_SESSION['user_logged']['id']);
        foreach ($params['llista'] as $index => $log) {
            $adnModel = new Adn();
            $adn = $adnModel->getById($log['id_adn']);
            $params['llista'][$index]['adn'] = $adn;
            $hostModel = new Host();
            $host = $hostModel->getById($log['id_host']);
            $params['llista'][$index]['host'] = $host;
        }

        // echo '<pre>';
        // var_dump($params['llista']);
        // echo '</pre>';

        // die();

        //$params['log_loguejat'] = $logModel->getById('1');  


        $this->render("log/index", $params, "main");
    }
}
