<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Models/Recuperada.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Controller.php";


class recuperadaController extends Controller
{

    public function index()
    {
        $recuperadaModel = new Recuperada();
        $params['title'] = "Gestió Recuperades";
        $params['llista'] = $recuperadaModel->getAll();

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
}
