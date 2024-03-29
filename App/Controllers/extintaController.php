<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Extinta.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Stock.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Usuari.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Compra.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Host.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Adn.php";



class ExtintaController extends Controller
{

    public function index()
    {
        $extintaModel = new Extinta();
        $params['llista'] = $extintaModel->getAll();
        $params['user'] = $_SESSION['user_logged']['nom'];

        $this->render("extinta/index", $params, "home");
    }

    public function store()
    {
        $extintaModel = new Extinta();

        $numRecuperada = $_POST['num_extinta'];
        $familiaRecuperada = $_POST['familia_extinta'];
        $nomRecuperada = $_POST['nom_extinta'];
        $idUsuari = $_POST['id'];

        $extinta = array(
            "num_extinta" => $numRecuperada,
            "familia_extinta" => $familiaRecuperada,
            "nom_extinta" => $nomRecuperada,
            "imatge_extinta" => $_FILES['imatge_extinta']['name'],
            "video_extinta" => $_FILES['video_extinta']['name'] ?? null,
            "id_usuari" => $idUsuari
        );

        $origen = $_FILES['imatge_extinta']['tmp_name'];
        $desti = "imatges/recuperades/" . $_POST['familia_extinta'];
        $array = explode(".", $_FILES['imatge_extinta']['name']);
        $extensio = $array[count($array) - 1];
        //$nomFItxer = $_SESSION['id_extinta'] . "." . $extensio;
        $nomFItxer = $_FILES['imatge_extinta']['name'];
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
        if ($_FILES['video_extinta']['name'] != null) {
            $origen = $_FILES['video_extinta']['tmp_name'];
            $desti = "videos/recuperades/" . $_POST['familia_extinta'];
            $array = explode(".", $_FILES['video_extinta']['name']);
            $extensio = $array[count($array) - 1];
            //$nomFItxer = $_SESSION['id_extinta'] . "." . $extensio;
            $nomFItxer = $_FILES['video_extinta']['name'];
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


        $extintaModel->insert($extinta);

        header("Location: /usuari/addRecuperada/?id=" . $_POST['id']);
    }

    public function destroy()
    {
        $extintaModel = new Extinta();

        $extintaModel->removeItemById($_GET['id']);

        $id_usuari = $_SESSION['id_usuari_actual'];

        header("Location: /usuari/addRecuperada/?id=" . $id_usuari);
        // header("Location: /extinta/index");
    }

    public function update()
    {
        $extintaModel = new Extinta();
        $id = $_GET['id'] ?? null;
        $params['extinta'] = $extintaModel->getById($id);

        $this->render("extinta/update", $params, "site");
    }

    public function modify()
    {
        $extintaModel = new Extinta();
        $extinta = array(
            "id" => $_POST['id'],
            "num_extinta" => $_POST['num_extinta'],
            "familia_extinta" => $_POST['familia_extinta'],
            "nom_extinta" => $_POST['nom_extinta'],
            "imatge_extinta" => $_FILES['imatge_extinta']['name'],
            "video_extinta" => $_FILES['video_extinta']['name'] ?? null,
        );

        // $extintaModel->update($extinta); 

        //$extintaModel->insert($extinta, $POST_['id']); // ara no fem
        //update si li assem un id ja fem update

        header("Location: /extinta/index");
    }

    public function manage()
    {
        $extintaModel = new Extinta();
        $params['title'] = "Extintes";
        $params['llista'] = $extintaModel->getAll();

        $stockModel = new Stock();
        $adnModel = new Adn();
        $hostModel = new Host();
        $distinct_hosts = $stockModel->getStockByIdUsuari('id_host', $_SESSION['user_logged']['id']);
        $distinct_adn = $stockModel->getStockByIdUsuari('id_adn', $_SESSION['user_logged']['id']);


        // get complete adn object for $params['llista']

        foreach ($params['llista'] as $index => $extinta) {
            $adn = $adnModel->getById($extinta['id_adn']);
            $params['llista'][$index]['adn'] = $adn;
        }


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

        $this->render("extinta/manage", $params, "site");
    }
}
