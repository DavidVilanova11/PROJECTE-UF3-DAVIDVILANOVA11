<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Recuperada.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Stock.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Usuari.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Compra.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Host.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Adn.php";



class recuperadaController extends Controller
{

    public function index()
    {
        $recuperadaModel = new Recuperada();
        $params['title'] = "Gestió Recuperades";
        $params['llista'] = $recuperadaModel->getAll();
        $params['user'] = $_SESSION['user_logged']['nom_usuari'];

        $this->render("recuperada/index", $params, "site");
    }

    public function store()
    {
        $recuperadaModel = new Recuperada();

        $numRecuperada = $_POST['num_recuperada'];
        $familiaRecuperada = $_POST['familia_recuperada'];
        $nomRecuperada = $_POST['nom_recuperada'];
        $idUsuari = $_POST['id'];

        $recuperada = array(
            "num_recuperada" => $numRecuperada,
            "familia_recuperada" => $familiaRecuperada,
            "nom_recuperada" => $nomRecuperada,
            "imatge_recuperada" => $_FILES['imatge_recuperada']['name'],
            "video_recuperada" => $_FILES['video_recuperada']['name'] ?? null,
            "id_usuari" => $idUsuari
        );

        $origen = $_FILES['imatge_recuperada']['tmp_name'];
        $desti = "imatges/recuperades/" . $_POST['familia_recuperada'];
        $array = explode(".", $_FILES['imatge_recuperada']['name']);
        $extensio = $array[count($array) - 1];
        //$nomFItxer = $_SESSION['id_recuperada'] . "." . $extensio;
        $nomFItxer = $_FILES['imatge_recuperada']['name'];
        Store::store($origen, $desti, $nomFItxer);
        if (isset($_SESSION['missatge_flash_ok'])) {
            $_SESSION['flash_ok0'] = $_SESSION['missatge_flash_ok'];
            unset($_SESSION['missatge_flash_ok']);
        }
        if (isset($_SESSION['missatge_flash_ko'])) {
            $_SESSION['flash_ko0'] = $_SESSION['missatge_flash_ko'];
            unset($_SESSION['missatge_flash_ko']);
        }
        // ara per el vídeo
        if ($_FILES['video_recuperada']['name'] != null) {
            $origen = $_FILES['video_recuperada']['tmp_name'];
            $desti = "videos/recuperades/" . $_POST['familia_recuperada'];
            $array = explode(".", $_FILES['video_recuperada']['name']);
            $extensio = $array[count($array) - 1];
            //$nomFItxer = $_SESSION['id_recuperada'] . "." . $extensio;
            $nomFItxer = $_FILES['video_recuperada']['name'];
            Store::store($origen, $desti, $nomFItxer);
            if (isset($_SESSION['missatge_flash_ok'])) {
                $_SESSION['flash_ok1'] = $_SESSION['missatge_flash_ok'];
                unset($_SESSION['missatge_flash_ok']);
            }
            if (isset($_SESSION['missatge_flash_ko'])) {
                $_SESSION['flash_ko1'] = $_SESSION['missatge_flash_ko'];
                unset($_SESSION['missatge_flash_ko']);
            }
        }


        $recuperadaModel->insert($recuperada);

        header("Location: /usuari/addRecuperada/?id=" . $_POST['id']);
    }

    public function destroy()
    {
        $recuperadaModel = new Recuperada();

        $recuperadaModel->removeItemById($_GET['id']);

        $id_usuari = $_SESSION['id_usuari_actual'];

        header("Location: /usuari/addRecuperada/?id=" . $id_usuari);
        // header("Location: /recuperada/index");
    }

    public function update()
    {
        $recuperadaModel = new Recuperada();
        $id = $_GET['id'] ?? null;
        $params['recuperada'] = $recuperadaModel->getById($id);

        $this->render("recuperada/update", $params, "site");
    }

    public function modify()
    {
        $recuperadaModel = new Recuperada();
        $recuperada = array(
            "id" => $_POST['id'],
            "num_recuperada" => $_POST['num_recuperada'],
            "familia_recuperada" => $_POST['familia_recuperada'],
            "nom_recuperada" => $_POST['nom_recuperada'],
            "imatge_recuperada" => $_FILES['imatge_recuperada']['name'],
            "video_recuperada" => $_FILES['video_recuperada']['name'] ?? null,
        );

        // $recuperadaModel->update($recuperada); 

        //$recuperadaModel->insert($recuperada, $POST_['id']); // ara no fem
        //update si li assem un id ja fem update

        header("Location: /recuperada/index");
    }

    public function manage()
    {
        $recuperadaModel = new Recuperada();
        $params['title'] = "Gestió Recuperades";
        $params['llista'] = $recuperadaModel->getAll();

        $this->render("recuperada/manage", $params, "site");
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

        // echo '<pre>';
        // var_dump($distinct_hosts);
        // echo '</pre>';

        // echo '<pre>';
        // var_dump(
        //     $distinct_adn
        // );
        // echo '</pre>';

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



        // echo '<pre>';
        // var_dump($params['llista']);
        // echo '</pre>';

        // die();

        $this->render("recuperada/fusio", $params, "fusion");
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

        if ($extinta != null) {
            $idExtinta = 0;
        } else {
            // hi ha extinta
            $idExtinta = $extinta['id'];
            //$_SESSION['missatge_flash_ok'] = "Extinta: " . $extinta['nom'];
        }


        // creem un log
        $log = array(
            "id_usuari" => $_SESSION['user_logged']['id'],
            "id_adn" => $idAdn,
            "id_host" => $idHost,
            "id_extinta" => $idExtinta
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


        header("Location: /recuperada/index");
    }
}
