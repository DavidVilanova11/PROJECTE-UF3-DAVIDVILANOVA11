<?php

include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Core/Mailer.php");
include_once(__DIR__ . "/../Core/InitialData.php");

class usuariController extends Controller
{

    public function index()
    {

        $usuariModel = new Usuari();

        if ($usuariModel->getAll() == null) {
            $initialData = new InitialData();
            $initialData->charge();
        }

        $params['title'] = "Gestió usuaris";
        $params['llista'] = $usuariModel->getAll();

        if (!isset($_SESSION['user_logged'])) {
            $this->render("usuari/login", $params, "main");
        } else {
            header("Location: /usuari/create");
        }
    }

    public function store()
    {
        $usuariModel = new Usuari();

        $emailusuari = $_POST['email_usuari'];
        $nomusuari = $_POST['nom_usuari'];
        $usuariusuari = $_POST['usuari_usuari'];
        $contrasnyausuari = $_POST['contrasenya_usuari'];
        $admin = false;


        foreach ($usuariModel->getAll() as $usuari) {
            if ($usuari['usuari_usuari'] == $_POST['usuari_usuari']) {
                $params['flash_ko'] = "Usuari ja existent";
                $this->render("usuari/index", $params, "main");
                die();
            }
        }

        if ($_POST['usuari_usuari'] == "admin") {
            $admin = true;
        } else {

            $admin = false;
        }


        $caracters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $token = substr(str_shuffle($caracters), 0, 15);


        $usuari = array(
            "id" => $_SESSION['id_usuari']++,
            "email_usuari" => $emailusuari,
            "nom_usuari" => $nomusuari,
            "usuari_usuari" => $usuariusuari,
            "contrasenya_usuari" => $contrasnyausuari,
            "admin" => $admin,
            "token" => $token,
            "verificat" => false
        );

        // echo '<pre>';
        // var_dump($usuari);
        // echo '</pre>';

        // die();


        $usuariModel->create($usuari);

        $mail = new Mailer();
        $mail->mailServerSetup();
        $mail->addRec([$usuari['email_usuari']], [], []);
        $mail->addVerifyContent($usuari);
        $mail->send();

        $params['flash_ok'] = "Usuari creat correctament, verifica el teu correu per poder accedir";


        $this->render("usuari/login", $params, "main");
    }

    public function destroy()
    {
        $usuariModel = new Usuari();

        $usuariModel->removeItemById($_GET['id']);

        header("Location: /usuari/index");
    }

    public function update()
    {
        $usuariModel = new Usuari();
        $id = $_GET['id'] ?? null;
        $params['usuari'] = $usuariModel->getById($id);

        $this->render("usuari/update", $params, "main");
    }

    public function modify()
    {
        $usuariModel = new Usuari();
        $usuari = array(
            "id" => $_POST['id'],
            "email_usuari" => $_POST['email_usuari'],
            "nom_usuari" => $_POST['nom_usuari'],
            "usuari_usuari" => $_POST['usuari_usuari'],
            "contrasenya_usuari" => $_POST['contrasenya_usuari'],

        );

        $usuariModel->update($usuari);

        header("Location: /usuari/index");
    }

    public function addRecuperada()
    {
        $usuariModel = new Usuari();
        $id = $_GET['id'] ?? null;
        $params['title'] = "Afegir Extinguides";
        $params['usuari'] = $usuariModel->getById($id);
        $recuperadaModel = new Recuperada();
        $params['llista'] = $recuperadaModel->getExtinguidesByIdusuari($id); //aquí necessito el getExtinguidesByIdusuari que es tronba al model

        $this->render("recuperada/index", $params, "main");
    }

    public function login()
    {


        $username = $_POST['usuari_usuari'] ?? null;
        $pass = $_POST['contrasenya_usuari'] ?? null;

        //   echo "<pre>";
        //     var_dump($_POST);
        //   echo "</pre>";

        //    die();

        $enrenadorModel = new Usuari();
        $result = $enrenadorModel->login($username, $pass);



        if (is_null($result)) {
            $params['flash_ko'] = "Credencials incorrectes";
            $this->render("usuari/login", $params, "site");
        } else {
            if ($result['verificat'] == false) {
                $params['flash_ko'] = "Usuari no verificat";
                $this->render("usuari/login", $params, "site");
            } else {
                if ($result['usuari_usuari'] == 'admin') {
                    $params['llista'] = $enrenadorModel->getAll();
                }
                $_SESSION['user_logged'] = $result;
                $params['usuari'] = $result;
                $this->render("home/index", $params, "home");
            }
        }
    }


    public function create()
    {
        $usuariModel = new Usuari();
        $params['title'] = "Gestió usuaris";
        $params['llista'] = $usuariModel->getAll();
        $params['usuari_loguejat'] = $_GET['id_usuari'] ?? null; // if user_logejat and admin == true veiem la llista


        //$params['usuari_loguejat'] = $usuariModel->getById('1');  


        $this->render("usuari/index", $params, "main");
    }


    public function logout()
    {
        // $recuperadaModel = new Recuperada();
        // $recuperada = array(
        //     "id" => $_POST['id'],
        //     "num_recuperada" => $_POST['num_recuperada'],
        //     "nom_recuperada" => $_POST['nom_recuperada'],

        // );

        // $recuperadaModel->updateItemById($recuperada);

        $params = null;

        $this->render("usuari/logout", $params, "main");
    }

    // public function switchToLogin()
    // {
    //     // $recuperadaModel = new Recuperada();
    //     // $recuperada = array(
    //     //     "id" => $_POST['id'],
    //     //     "num_recuperada" => $_POST['num_recuperada'],
    //     //     "nom_recuperada" => $_POST['nom_recuperada'],

    //     // );

    //     // $recuperadaModel->updateItemById($recuperada);

    //     $params = null;

    //     $this->render("usuari/login", $params, "main");
    // }

    public function verify()
    {
        $username = $_GET['username'];
        $token = $_GET['token'];

        $usuariModel = new Usuari();
        $usuari = $usuariModel->getByUsername($username);

        if ($usuari['token'] == $token) {
            $usuari['verificat'] = true;
            $usuariModel->update($usuari);
            $params['flash_ok'] = "Usuari verificat correctament";
            $this->render("usuari/login", $params, "main");
        } else {
            $params['flash_ko'] = "Usuari no verificat";
            $this->render("usuari/login", $params, "main");
        }
    }
}
