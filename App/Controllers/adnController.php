<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Adn.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Stock.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Usuari.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Compra.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Host.php";


class AdnController extends Controller
{

    public function index()
    {
        $adnModel = new Adn();
        $params['title'] = "Comprar Adn";
        $params['llista'] = $adnModel->getAll();
        $params['user'] = $_SESSION['user_logged']['nom'];

        $this->render("adn/index", $params, "home");
    }

    public function store()
    {
        $adnModel = new Adn();

        $numRecuperada = $_POST['num_adn'];
        $familiaRecuperada = $_POST['familia_adn'];
        $nomRecuperada = $_POST['nom_adn'];
        $idUsuari = $_POST['id'];

        $adn = array(
            "num_adn" => $numRecuperada,
            "familia_adn" => $familiaRecuperada,
            "nom_adn" => $nomRecuperada,
            "imatge_adn" => $_FILES['imatge_adn']['name'],
            "video_adn" => $_FILES['video_adn']['name'] ?? null,
            "id_usuari" => $idUsuari
        );

        $origen = $_FILES['imatge_adn']['tmp_name'];
        $desti = "imatges/recuperades/" . $_POST['familia_adn'];
        $array = explode(".", $_FILES['imatge_adn']['name']);
        $extensio = $array[count($array) - 1];
        //$nomFItxer = $_SESSION['id_adn'] . "." . $extensio;
        $nomFItxer = $_FILES['imatge_adn']['name'];
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
        if ($_FILES['video_adn']['name'] != null) {
            $origen = $_FILES['video_adn']['tmp_name'];
            $desti = "videos/recuperades/" . $_POST['familia_adn'];
            $array = explode(".", $_FILES['video_adn']['name']);
            $extensio = $array[count($array) - 1];
            //$nomFItxer = $_SESSION['id_adn'] . "." . $extensio;
            $nomFItxer = $_FILES['video_adn']['name'];
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


        $adnModel->insert($adn);

        header("Location: /usuari/addRecuperada/?id=" . $_POST['id']);
    }

    public function destroy()
    {
        $adnModel = new Adn();

        $adnModel->removeItemById($_GET['id']);

        $id_usuari = $_SESSION['id_usuari_actual'];

        header("Location: /usuari/addRecuperada/?id=" . $id_usuari);
        // header("Location: /adn/index");
    }

    public function update()
    {
        $adnModel = new Adn();
        $id = $_GET['id'] ?? null;
        $params['adn'] = $adnModel->getById($id);

        $this->render("adn/update", $params, "site");
    }

    public function modify()
    {
        $adnModel = new Adn();
        $adn = array(
            "id" => $_POST['id'],
            "num_adn" => $_POST['num_adn'],
            "familia_adn" => $_POST['familia_adn'],
            "nom_adn" => $_POST['nom_adn'],
            "imatge_adn" => $_FILES['imatge_adn']['name'],
            "video_adn" => $_FILES['video_adn']['name'] ?? null,
        );

        // $adnModel->update($adn); 

        //$adnModel->insert($adn, $POST_['id']); // ara no fem
        //update si li assem un id ja fem update

        header("Location: /adn/index");
    }

    public function manage()
    {
        $adnModel = new Adn();
        $params['title'] = "Comprar Adn";
        $params['llista'] = $adnModel->getAll();
        if (isset($_SESSION['flash']['ok'])) {
            $params['flash']['ok'] = $_SESSION['flash']['ok'];
            unset($_SESSION['flash']['ok']);
        }
        if (isset($_SESSION['flash']['ko'])) {
            $params['flash']['ko'] = $_SESSION['flash']['ko'];
            unset($_SESSION['flash']['ko']);
        }

        $stockModel = new Stock();
        $hostModel = new Host();
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

        $this->render("adn/manage", $params, "site");
    }

    public function comprar()
    {

        // funció per comprar el adn
        $adnModel = new Adn();
        $compraModel = new Compra();
        $usuariModel = new Usuari();

        $id_adn = $_GET['id'];
        $id_usuari = $_SESSION['user_logged']['id'];

        $adn = $adnModel->getById($id_adn);
        $usuari = $usuariModel->getById($id_usuari);

        // Verificar si $_SESSION['flash'] está inicializado como un array
        if (!isset($_SESSION['flash']) || !is_array($_SESSION['flash'])) {
            $_SESSION['flash'] = array(); // Inicializar como un array vacío
        }

        if ($usuari['pressupost'] >= $adn['preu']) {
            $compraModel->insert([
                "id_usuari" => $id_usuari,
                "id_adn" => $id_adn,
                "tipus_compra" => "ADN"
            ]);
            $_SESSION['user_logged']['pressupost'] = $usuariModel->updatePressupost($id_usuari, $adn['preu']);
            // echo '<pre>';
            // var_dump($_SESSION['user_logged']);
            // echo '</pre>';

            $_SESSION['flash']['ok'] = "Compra realitzada amb èxit";
        } else {
            $_SESSION['flash']['ko'] = "No tens prou pressupost";
        }

        $params['title'] = "Gestió Recuperades";
        $params['llista'] = $adnModel->getAll();

        // $this->render("adn/index", $params, "home");
        header("Location: /adn/manage");
    }
}
