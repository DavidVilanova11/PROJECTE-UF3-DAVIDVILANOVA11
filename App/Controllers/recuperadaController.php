<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Adn.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Host.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Stock.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Usuari.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Recuperada.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Extinta.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Log.php";


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

    public function addRecuperada()
    {

        // remove the adn ant the hosts selected from the stock

        echo '<pre>';
        var_dump($_GET);
        echo '</pre>';

        $idHost = $_GET['selectedHostId'];
        $idAdn = $_GET['selectedAdnId'];

        $stockModel = new Stock();
        $stockModel->removeStock($idHost, 'host'); // només 1 no tots
        $stockModel->removeStock($idAdn, 'adn'); // només 1 no tots

        // veure si el id_adn i el id_host són compatibles i quina extinta podem obtenir

        $extintaModel = new Extinta();

        $extinta = $extintaModel->checkAdnAndHost($idAdn, $idHost);

        // echo '<pre>';
        // var_dump($extinta);
        // echo '</pre>';

        // die();

        if ($extinta != null) {
            $idExtinta = 0;
        } else {
            // hi ha extinta
            $idExtinta = $extinta['id'];
            //$_SESSION['missatge_flash_ok'] = "Extinta: " . $extinta['nom'];
        }

        // calcular si ha set satisafctori segons el percentatge de probabilitat

        $probabilitat = $extinta['probabilitat'];

        // allow decimal between 0 and 1
        $random = mt_rand() / mt_getrandmax();

        echo '<pre>';
        var_dump($random);
        echo '</pre>';


        if ($random <= $probabilitat) {
            $satisfactori = 1;
        } else {
            $satisfactori = 0;
        }

        // creem un log
        $log = array(
            "id_usuari" => $_SESSION['user_logged']['id'],
            "id_adn" => $idAdn,
            "id_host" => $idHost,
            "id_extinta" => $idExtinta,
            "satisfactori" => $satisfactori,
        );

        $logModel = new Log();
        $logModel->insert($log);

        // creem la recuperada corresponent segon la probabilitat 

        $recuperadaModel = new Recuperada();

        $recuperada = array(
            "num_recuperada" => $_GET['num_recuperada'],
            "familia_recuperada" => $_GET['familia_recuperada'],
            "nom_recuperada" => $_GET['nom_recuperada'],
            "imatge_recuperada" => $_GET['imatge_recuperada'],
            "video_recuperada" => $_GET['video_recuperada'],
            "id_usuari" => $_GET['id']
        );

        $recuperadaModel->insert($recuperada);

        $params['title'] = "Gestió Stock";


        header("Location: /recuperada/index");
        $this->render("stock/manage", $params, "site");
    }

    public function fusio()
    {
        $hostModel = new Host();
        $adnModel = new Adn();
        $stockModel = new Stock();
        $params['title'] = "Gestió Stock";
        $distinct_hosts = $stockModel->getStockByIdUsuari('id_host', $_SESSION['user_logged']['id']);
        $distinct_adn = $stockModel->getStockByIdUsuari('id_adn', $_SESSION['user_logged']['id']);

        // $distinct_hosts = $stockModel->getDistinct('id_host');
        // $distinct_adn = $stockModel->getDistinct('id_adn');

        // die();

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
                    $params['llista']['adn'][$index]['quantity'] = $stockModel->getProductQuantity($stock['id'], $_SESSION['user_logged']['id'], "adn");
                }
            }
        }


        // agregar la cantidad de productos para 'host'
        if (isset($params['llista']['host']) && is_array($params['llista']['host'])) {
            foreach ($params['llista']['host'] as $index => $stock) {
                if (isset($stock['id'])) {
                    $params['llista']['host'][$index]['quantity'] = $stockModel->getProductQuantity($stock['id'], $_SESSION['user_logged']['id'], "host");
                }
            }
        }

        // die();

        $this->render("recuperada/fusio", $params, "fusion");
    }
}
