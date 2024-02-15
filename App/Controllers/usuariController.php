<?php

include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Core/Mailer.php");
include_once(__DIR__ . "/../Core/InitialData.php");

class usuariController extends Controller
{

    public function index()
    {

        $entrenadorModel = new Entrenador();

        if ($entrenadorModel->getAll() == null) {
            $initialData = new InitialData();
            $initialData->charge();
        }

        $params['title'] = "Gestió Entrenadors";
        $params['llista'] = $entrenadorModel->getAll();

        if (!isset($_SESSION['user_logged'])) {
            $this->render("entrenador/login", $params, "main");
        } else {
            header("Location: /entrenador/create");
        }
    }

    public function store()
    {
        $entrenadorModel = new Entrenador();

        $emailEntrenador = $_POST['email_entrenador'];
        $nomEntrenador = $_POST['nom_entrenador'];
        $usuariEntrenador = $_POST['usuari_entrenador'];
        $contrasnyaEntrenador = $_POST['contrasenya_entrenador'];
        $admin = false;


        foreach ($entrenadorModel->getAll() as $entrenador) {
            if ($entrenador['usuari_entrenador'] == $_POST['usuari_entrenador']) {
                $params['flash_ko'] = "Usuari ja existent";
                $this->render("entrenador/index", $params, "main");
                die();
            }
        }

        if ($_POST['usuari_entrenador'] == "admin") {
            $admin = true;
        } else {

            $admin = false;
        }


        $caracters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $token = substr(str_shuffle($caracters), 0, 15);


        $entrenador = array(
            "id" => $_SESSION['id_entrenador']++,
            "email_entrenador" => $emailEntrenador,
            "nom_entrenador" => $nomEntrenador,
            "usuari_entrenador" => $usuariEntrenador,
            "contrasenya_entrenador" => $contrasnyaEntrenador,
            "admin" => $admin,
            "token" => $token,
            "verificat" => false
        );

        // echo '<pre>';
        // var_dump($entrenador);
        // echo '</pre>';

        // die();


        $entrenadorModel->create($entrenador);

        $mail = new Mailer();
        $mail->mailServerSetup();
        $mail->addRec([$entrenador['email_entrenador']], [], []);
        $mail->addVerifyContent($entrenador);
        $mail->send();

        $params['flash_ok'] = "Usuari creat correctament, verifica el teu correu per poder accedir";


        $this->render("entrenador/login", $params, "main");
    }

    public function destroy()
    {
        $entrenadorModel = new Entrenador();

        $entrenadorModel->removeItemById($_GET['id']);

        header("Location: /entrenador/index");
    }

    public function update()
    {
        $entrenadorModel = new Entrenador();
        $id = $_GET['id'] ?? null;
        $params['entrenador'] = $entrenadorModel->getById($id);

        $this->render("entrenador/update", $params, "main");
    }

    public function modify()
    {
        $entrenadorModel = new Entrenador();
        $entrenador = array(
            "id" => $_POST['id'],
            "email_entrenador" => $_POST['email_entrenador'],
            "nom_entrenador" => $_POST['nom_entrenador'],
            "usuari_entrenador" => $_POST['usuari_entrenador'],
            "contrasenya_entrenador" => $_POST['contrasenya_entrenador'],

        );

        $entrenadorModel->update($entrenador);

        header("Location: /entrenador/index");
    }

    public function addOcell()
    {
        $entrenadorModel = new Entrenador();
        $id = $_GET['id'] ?? null;
        $params['title'] = "Afegir Ocell";
        $params['entrenador'] = $entrenadorModel->getById($id);
        $ocellModel = new Extinguida();
        $params['llista'] = $ocellModel->getOcellsByIdEntrenador($id); //aquí necessito el getOcellsByIdEntrenador que es tronba al model

        $this->render("ocell/index", $params, "main");
    }

    public function login()
    {


        $username = $_POST['usuari_entrenador'] ?? null;
        $pass = $_POST['contrasenya_entrenador'] ?? null;

        //   echo "<pre>";
        //     var_dump($_POST);
        //   echo "</pre>";

        //    die();

        $enrenadorModel = new Entrenador();
        $result = $enrenadorModel->login($username, $pass);



        if (is_null($result)) {
            $params['flash_ko'] = "Credencials incorrectes";
            $this->render("entrenador/login", $params, "site");
        } else {
            if ($result['verificat'] == false) {
                $params['flash_ko'] = "Usuari no verificat";
                $this->render("entrenador/login", $params, "site");
            } else {
                if ($result['usuari_entrenador'] == 'admin') {
                    $params['llista'] = $enrenadorModel->getAll();
                }
                $_SESSION['user_logged'] = $result;
                $params['entrenador'] = $result;
                $this->render("home/index", $params, "home");
            }
        }
    }


    public function create()
    {
        $entrenadorModel = new Entrenador();
        $params['title'] = "Gestió Entrenadors";
        $params['llista'] = $entrenadorModel->getAll();
        $params['usuari_loguejat'] = $_GET['id_entrenador'] ?? null; // if user_logejat and admin == true veiem la llista


        //$params['usuari_loguejat'] = $entrenadorModel->getById('1');  


        $this->render("entrenador/index", $params, "main");
    }


    public function logout()
    {
        // $ocellModel = new Ocell();
        // $ocell = array(
        //     "id" => $_POST['id'],
        //     "num_ocell" => $_POST['num_ocell'],
        //     "nom_ocell" => $_POST['nom_ocell'],

        // );

        // $ocellModel->updateItemById($ocell);

        $params = null;

        $this->render("entrenador/logout", $params, "main");
    }

    // public function switchToLogin()
    // {
    //     // $ocellModel = new Ocell();
    //     // $ocell = array(
    //     //     "id" => $_POST['id'],
    //     //     "num_ocell" => $_POST['num_ocell'],
    //     //     "nom_ocell" => $_POST['nom_ocell'],

    //     // );

    //     // $ocellModel->updateItemById($ocell);

    //     $params = null;

    //     $this->render("entrenador/login", $params, "main");
    // }

    public function verify()
    {
        $username = $_GET['username'];
        $token = $_GET['token'];

        $entrenadorModel = new Entrenador();
        $entrenador = $entrenadorModel->getByUsername($username);

        if ($entrenador['token'] == $token) {
            $entrenador['verificat'] = true;
            $entrenadorModel->update($entrenador);
            $params['flash_ok'] = "Usuari verificat correctament";
            $this->render("entrenador/login", $params, "main");
        } else {
            $params['flash_ko'] = "Usuari no verificat";
            $this->render("entrenador/login", $params, "main");
        }
    }
}
