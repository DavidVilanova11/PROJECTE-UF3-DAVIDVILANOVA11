<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Host.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Compra.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Usuari.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Stock.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Adn.php";


class HostController extends Controller
{

    public function index()
    {
        $hostModel = new Host();
        $params['title'] = "Gestió Recuperades";
        $params['llista'] = $hostModel->getAll();
        $params['user'] = $_SESSION['user_logged']['nom'];

        $this->render("host/index", $params, "home");
    }

    public function store()
    {
        $hostModel = new Host();

        $numRecuperada = $_POST['num_host'];
        $familiaRecuperada = $_POST['familia_host'];
        $nomRecuperada = $_POST['nom_host'];
        $idUsuari = $_POST['id'];

        $host = array(
            "num_host" => $numRecuperada,
            "familia_host" => $familiaRecuperada,
            "nom_host" => $nomRecuperada,
            "imatge_host" => $_FILES['imatge_host']['name'],
            "video_host" => $_FILES['video_host']['name'] ?? null,
            "id_usuari" => $idUsuari
        );

        $origen = $_FILES['imatge_host']['tmp_name'];
        $desti = "imatges/recuperades/" . $_POST['familia_host'];
        $array = explode(".", $_FILES['imatge_host']['name']);
        $extensio = $array[count($array) - 1];
        //$nomFItxer = $_SESSION['id_host'] . "." . $extensio;
        $nomFItxer = $_FILES['imatge_host']['name'];
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
        if ($_FILES['video_host']['name'] != null) {
            $origen = $_FILES['video_host']['tmp_name'];
            $desti = "videos/recuperades/" . $_POST['familia_host'];
            $array = explode(".", $_FILES['video_host']['name']);
            $extensio = $array[count($array) - 1];
            //$nomFItxer = $_SESSION['id_host'] . "." . $extensio;
            $nomFItxer = $_FILES['video_host']['name'];
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


        $hostModel->insert($host);

        header("Location: /usuari/addRecuperada/?id=" . $_POST['id']);
    }

    public function destroy()
    {
        $hostModel = new Host();

        $hostModel->removeItemById($_GET['id']);

        $id_usuari = $_SESSION['id_usuari_actual'];

        header("Location: /usuari/addRecuperada/?id=" . $id_usuari);
        // header("Location: /host/index");
    }

    public function update()
    {
        $hostModel = new Host();
        $id = $_GET['id'] ?? null;
        $params['host'] = $hostModel->getById($id);

        $this->render("host/update", $params, "site");
    }

    public function modify()
    {
        $hostModel = new Host();
        $host = array(
            "id" => $_POST['id'],
            "num_host" => $_POST['num_host'],
            "familia_host" => $_POST['familia_host'],
            "nom_host" => $_POST['nom_host'],
            "imatge_host" => $_FILES['imatge_host']['name'],
            "video_host" => $_FILES['video_host']['name'] ?? null,
        );

        // $hostModel->update($host); 

        //$hostModel->insert($host, $POST_['id']); // ara no fem
        //update si li assem un id ja fem update

        header("Location: /host/index");
    }

    public function manage()
    {
        $hostModel = new Host();
        $params['title'] = "Gestió Recuperades";
        $params['llista'] = $hostModel->getAll();

        if (isset($_SESSION['flash']['ok'])) {
            $params['flash']['ok'] = $_SESSION['flash']['ok'];
            unset($_SESSION['flash']['ok']);
        }
        if (isset($_SESSION['flash']['ko'])) {
            $params['flash']['ko'] = $_SESSION['flash']['ko'];
            unset($_SESSION['flash']['ko']);
        }

        $stockModel = new Stock();
        $adnModel = new Adn();
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
        $params['llista-stock'] = [
            'adn' => $adns,
            'host' => $hosts
        ];

        // agregar la cantidad de productos para 'adn'
        if (isset($params['llista-stock']['adn']) && is_array($params['llista-stock']['adn'])) {
            foreach ($params['llista-stock']['adn'] as $index => $stock) {
                if (isset($stock['id'])) {
                    $params['llista-stock']['adn'][$index]['quantity'] = $stockModel->getProductQuantity($stock['id'], $_SESSION['user_logged']['id'], "adn");
                }
            }
        }


        // agregar la cantidad de productos para 'host'
        if (isset($params['llista-stock']['host']) && is_array($params['llista-stock']['host'])) {
            foreach ($params['llista-stock']['host'] as $index => $stock) {
                if (isset($stock['id'])) {
                    $params['llista-stock']['host'][$index]['quantity'] = $stockModel->getProductQuantity($stock['id'], $_SESSION['user_logged']['id'], "host");
                }
            }
        }

        // echo '<pre>';
        // var_dump($params['llista-stock']);
        // echo '</pre>';

        // die();

        $this->render("host/manage", $params, "site");
    }

    public function comprar()
    {

        // funció per comprar el host
        $hostModel = new Host();
        $compraModel = new Compra();
        $usuariModel = new Usuari();

        $id_host = $_GET['id'];
        $id_usuari = $_SESSION['user_logged']['id'];

        $host = $hostModel->getById($id_host);
        $usuari = $usuariModel->getById($id_usuari);

        // Verificar si $_SESSION['flash'] está inicializado como un array
        if (!isset($_SESSION['flash']) || !is_array($_SESSION['flash'])) {
            $_SESSION['flash'] = array(); // Inicializar como un array vacío
        }

        if ($usuari['pressupost'] >= $host['preu']) {
            $compraModel->insert([
                "id_usuari" => $id_usuari,
                "id_host" => $id_host,
                "tipus_compra" => "Host"
            ]);
            $_SESSION['user_logged']['pressupost'] = $usuariModel->updatePressupost($id_usuari, $host['preu']);
            // echo '<pre>';
            // var_dump($_SESSION['user_logged']);
            // echo '</pre>';

            $_SESSION['flash']['ok'] = "Compra realitzada amb èxit";
        } else {
            $_SESSION['flash']['ko'] = "No tens prou pressupost";
        }

        $params['title'] = "Gestió Recuperades";
        $params['llista'] = $hostModel->getAll();





        // $this->render("host/index", $params, "home");
        header("Location: /host/manage");
    }
}
