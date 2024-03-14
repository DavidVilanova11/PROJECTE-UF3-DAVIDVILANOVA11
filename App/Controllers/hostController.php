<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Host.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";


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

        $this->render("host/manage", $params, "site");
    }
}
