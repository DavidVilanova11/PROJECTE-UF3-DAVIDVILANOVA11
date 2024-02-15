<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";


class extinguidaController extends Controller
{

    public function index()
    {
        $extinguidaModel = new Extinguida();
        $params['title'] = "Gestió Extinguidas";
        $params['llista'] = $extinguidaModel->getAll();

        $this->render("extinguida/index", $params, "site");
    }

    public function store()
    {
        $extinguidaModel = new Extinguida();

        $numExtinguida = $_POST['num_extinguida'];
        $familiaExtinguida = $_POST['familia_extinguida'];
        $nomExtinguida = $_POST['nom_extinguida'];
        $idUsuari = $_POST['id'];

        $extinguida = array(
            "id" => $_SESSION['id_extinguida']++,
            "num_extinguida" => $numExtinguida,
            "familia_extinguida" => $familiaExtinguida,
            "nom_extinguida" => $nomExtinguida,
            "imatge_extinguida" => $_FILES['imatge_extinguida']['name'],
            "video_extinguida" => $_FILES['video_extinguida']['name'] ?? null,
            "id_usuari" => $idUsuari
        );

        $origen = $_FILES['imatge_extinguida']['tmp_name'];
        $desti = "imatges/extinguidas/" . $_POST['familia_extinguida'];
        $array = explode(".", $_FILES['imatge_extinguida']['name']);
        $extensio = $array[count($array) - 1];
        //$nomFItxer = $_SESSION['id_extinguida'] . "." . $extensio;
        $nomFItxer = $_FILES['imatge_extinguida']['name'];
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
        if ($_FILES['video_extinguida']['name'] != null) {
            $origen = $_FILES['video_extinguida']['tmp_name'];
            $desti = "videos/extinguidas/" . $_POST['familia_extinguida'];
            $array = explode(".", $_FILES['video_extinguida']['name']);
            $extensio = $array[count($array) - 1];
            //$nomFItxer = $_SESSION['id_extinguida'] . "." . $extensio;
            $nomFItxer = $_FILES['video_extinguida']['name'];
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


        $extinguidaModel->create($extinguida);

        header("Location: /usuari/addExtinguida/?id=" . $_POST['id']);
    }

    public function destroy()
    {
        $extinguidaModel = new Extinguida();

        $extinguidaModel->removeItemById($_GET['id']);

        $id_usuari = $_SESSION['id_usuari_actual'];

        header("Location: /usuari/addExtinguida/?id=" . $id_usuari);
        // header("Location: /extinguida/index");
    }

    public function update()
    {
        $extinguidaModel = new Extinguida();
        $id = $_GET['id'] ?? null;
        $params['extinguida'] = $extinguidaModel->getById($id);

        $this->render("extinguida/update", $params, "site");
    }

    public function modify()
    {
        $extinguidaModel = new Extinguida();
        $extinguida = array(
            "id" => $_POST['id'],
            "num_extinguida" => $_POST['num_extinguida'],
            "familia_extinguida" => $_POST['familia_extinguida'],
            "nom_extinguida" => $_POST['nom_extinguida'],
            "imatge_extinguida" => $_FILES['imatge_extinguida']['name'],
            "video_extinguida" => $_FILES['video_extinguida']['name'] ?? null,
        );

        $extinguidaModel->update($extinguida);

        header("Location: /extinguida/index");
    }

    public function manage()
    {
        $extinguidaModel = new Extinguida();
        $params['title'] = "Gestió Extinguidas";
        $params['llista'] = $extinguidaModel->getAll();

        $this->render("extinguida/manage", $params, "site");
    }
}
