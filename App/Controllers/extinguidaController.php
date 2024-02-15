<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/App/Core/Store.php";


class ocellController extends Controller
{

    public function index()
    {
        $ocellModel = new Ocell();
        $params['title'] = "Gestió Ocells";
        $params['llista'] = $ocellModel->getAll();

        $this->render("ocell/index", $params, "site");
    }

    public function store()
    {
        $ocellModel = new Ocell();

        $numOcell = $_POST['num_ocell'];
        $familiaOcell = $_POST['familia_ocell'];
        $nomOcell = $_POST['nom_ocell'];
        $idEntrenador = $_POST['id'];

        $ocell = array(
            "id" => $_SESSION['id_ocell']++,
            "num_ocell" => $numOcell,
            "familia_ocell" => $familiaOcell,
            "nom_ocell" => $nomOcell,
            "imatge_ocell" => $_FILES['imatge_ocell']['name'],
            "video_ocell" => $_FILES['video_ocell']['name'] ?? null,
            "id_entrenador" => $idEntrenador
        );

        $origen = $_FILES['imatge_ocell']['tmp_name'];
        $desti = "imatges/ocells/" . $_POST['familia_ocell'];
        $array = explode(".", $_FILES['imatge_ocell']['name']);
        $extensio = $array[count($array) - 1];
        //$nomFItxer = $_SESSION['id_ocell'] . "." . $extensio;
        $nomFItxer = $_FILES['imatge_ocell']['name'];
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
        if ($_FILES['video_ocell']['name'] != null) {
            $origen = $_FILES['video_ocell']['tmp_name'];
            $desti = "videos/ocells/" . $_POST['familia_ocell'];
            $array = explode(".", $_FILES['video_ocell']['name']);
            $extensio = $array[count($array) - 1];
            //$nomFItxer = $_SESSION['id_ocell'] . "." . $extensio;
            $nomFItxer = $_FILES['video_ocell']['name'];
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


        $ocellModel->create($ocell);

        header("Location: /entrenador/addOcell/?id=" . $_POST['id']);
    }

    public function destroy()
    {
        $ocellModel = new Ocell();

        $ocellModel->removeItemById($_GET['id']);

        $id_entrenador = $_SESSION['id_entrenador_actual'];

        header("Location: /entrenador/addOcell/?id=" . $id_entrenador);
        // header("Location: /ocell/index");
    }

    public function update()
    {
        $ocellModel = new Ocell();
        $id = $_GET['id'] ?? null;
        $params['ocell'] = $ocellModel->getById($id);

        $this->render("ocell/update", $params, "site");
    }

    public function modify()
    {
        $ocellModel = new Ocell();
        $ocell = array(
            "id" => $_POST['id'],
            "num_ocell" => $_POST['num_ocell'],
            "familia_ocell" => $_POST['familia_ocell'],
            "nom_ocell" => $_POST['nom_ocell'],
            "imatge_ocell" => $_FILES['imatge_ocell']['name'],
            "video_ocell" => $_FILES['video_ocell']['name'] ?? null,
        );

        $ocellModel->update($ocell);

        header("Location: /ocell/index");
    }

    public function manage()
    {
        $ocellModel = new Ocell();
        $params['title'] = "Gestió Ocells";
        $params['llista'] = $ocellModel->getAll();

        $this->render("ocell/manage", $params, "site");
    }
}
